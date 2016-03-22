<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 20.03.16
 * Time: 11:16
 */

namespace components\bucket\model;

use core\Model;

/**
 * Class Buckets
 * realize bucket busines logic
 *
 * @package components\bucket\model
 */
class Buckets extends Model
{
    /**
     * add product to bucket
     *
     * @param        $product_id product id
     * @param        $user_id    id of session
     * @param        $count      count of products
     * @param string $mode       add or set product count
     *
     * @return mixed
     */
    public function addProduct($product_id, $user_id, $count, $mode = 'add')
    {
        $uid = uniqid($user_id);
        $q   = "insert into orders (
                            order_session,
                            order_uid)
                (select
                    '".$user_id."' as order_session,
                    '".$uid."' as order_uid
                from dual where not exists(select 1 from orders where order_status = 'D' and order_session = '".$user_id."'))";
        $this->executeUpdateQuery($q);

        $q      = 'select bucket_id
              from bucket
              where bucket_product_id = '.$product_id.'
              and bucket_order_id in (select order_id from orders where order_status = "D" and order_session = "'.$user_id.'")';
        $result = $this->executeSelectQuery($q);

        if ($mode != 'delete') {
            if (sizeof($result) != 0) {
                $inc = ($mode == 'add')?'bucket_product_count + ':'';
                $q   = 'update bucket set bucket_product_count = '.$inc.$count.' where bucket_id = '.$result[0][bucket_id];
                $this->executeUpdateQuery($q);
            } else {
                $q = 'insert into bucket (bucket_product_id, bucket_product_count, bucket_order_id)
                  values ('.$product_id.', '.$count.', (select order_id from orders where order_status = "D" and order_session = "'.$user_id.'" limit 1 ))';
                $this->executeUpdateQuery($q);
            }
        } else {
            $q = 'delete from bucket where bucket_product_id = '.$product_id.'
                  and bucket_order_id = (select order_id from orders where order_status = "D" and order_session = "'.$user_id.'" limit 1 )';
            $this->executeUpdateQuery($q);
        }

        $q      = '
            select
                sum(bucket_product_count) count,
                sum(p.product_price*b.bucket_product_count) total_price from
                bucket b,
                orders o,
                products p
            where
                b.bucket_product_id = p.product_id
                and o.order_status = "D"
                and o.order_id = b.bucket_order_id
                and o.order_session = "'.$user_id.'"';
        $result = $this->executeSelectQuery($q);
        return $result[0];
    }

    /**
     * get info about bucket
     *
     * @param $user_id id of session
     *
     * @return mixed return array with info
     */
    public function getOrderInfo($user_id)
    {
        $q      = 'select
            p.product_id,
            p.product_name,
            p.product_price,
            b.bucket_product_count,
            p.product_price*b.bucket_product_count summary_price
        from
            bucket b,
            orders o,
            products p
        where
            b.bucket_product_id = p.product_id
            and o.order_id = b.bucket_order_id
            and o.order_status = "D"
            and o.order_session = "'.$user_id.'"';
        $result = $this->executeSelectQuery($q);
        return $result;
    }

    /**
     * get ordered towards
     *
     * @param $uid order UID
     *
     * @return mixed ordered broducts
     */
    public function getOrdered($uid)
    {
        $q      = 'select
            p.product_id,
            p.product_name,
            p.product_price,
            b.bucket_product_count,
            p.product_price*b.bucket_product_count summary_price
        from
            bucket b,
            orders o,
            products p
        where
            b.bucket_product_id = p.product_id
            and o.order_id = b.bucket_order_id
            and o.order_status = "O"
            and o.order_uid = "'.$uid.'"';
        $result = $this->executeSelectQuery($q);
        return $result;
    }

    /**
     * @param $first_name  first name of consumer
     * @param $last_name   last name of consumer
     * @param $description description of order
     * @param $email       consumer email
     * @param $phone       consumer odred
     * @param $user_id     ID of current session
     *
     * @return mixed
     */
    public function processOrder($first_name, $last_name, $description, $email, $phone, $user_id)
    {
        $q         = 'select order_id,
                     order_uid
              from orders where
              order_session = "'.$user_id.'"
              and order_status = "D"';
        $order_id  = $this->executeSelectQuery($q)[0][order_id];
        $order_uid = $this->executeSelectQuery($q)[0][order_uid];

        $q = '  update
                    orders
                set
                    order_status = "O",
                    order_session = null,
                    order_description = "'.$description.'",
                    order_consumer_first_name = "'.$first_name.'",
                    order_consumer_last_name = "'.$last_name.'",
                    order_consumer_phone = "'.$phone.'",
                    order_consumer_email = "'.$email.'"
                where
                    order_id = '.$order_id;
        $this->executeUpdateQuery($q);
        return $order_uid;
    }


}