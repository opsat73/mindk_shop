<?php

namespace components\products\model;

use \core\Model;

/**
 * Class Products
 * realize product busines logic
 *
 * @package components\products\model
 */
class Products extends Model
{

    /**
     * get list of product
     *
     * @param        $from     star product
     * @param        $how_many how many show
     * @param int    $category category id
     * @param string $sort     sorting
     *
     * @return mixed
     */
    public function getList($from, $how_many, $category = 0, $sort = 'ASC')
    {
        $q = 'select p.*, pictures.* from
              products p
              inner join pictures on pictures.picture_product_id = p.product_id';

        if ($category != 0) {
            $q .= ' inner join category2products_map map on p.product_id = map.cat2prod_map_product_id
                    where
                        map.cat2prod_map_category_id = '.$category;
        }
        $q .= ' order by product_price '.$sort;
        if ($how_many != 0) {
            $q .= ' limit '.$from.', '.$how_many;
        }
        return $this->executeSelectQuery($q);
    }

    /**
     * get product by id
     *
     * @param $product_id
     *
     * @return mixed product parameters
     */
    public function getItem($product_id)
    {
        $q      = 'select * from
              products,
              pictures
              where
                 pictures.picture_product_id = products.product_id
               and product_id = '.$product_id;
        $result = $this->executeSelectQuery($q);
        return $result[0];
    }

    /**
     * get random products
     *
     * @param $product_id current product id
     * @param $count      cont of random products
     *
     * @return mixed array with random products
     */
    public function getRandom($product_id, $count)
    {
        $max = $this->getCount();

        $randoms = array();
        while (sizeof($randoms) < $count) {
            $rand = rand(0, $max);
            if (($product_id != $rand) && (!in_array($rand, $randoms))) {
                $randoms[] = $rand;
            }
        }
        $condition = implode(', ', $randoms);
        $q         = 'select * from
              products,
              pictures
              where pictures.picture_product_id = products.product_id
               and product_id in ('.$condition.')';
        $result    = $this->executeSelectQuery($q);
        return $result;
    }

    /**
     * get count of products in shop
     *
     * @return mixed count of products
     */
    public function getCount()
    {
        $q      = 'select count(*) from
              products';
        $result = $this->executeSelectQuery($q);
        return $result[0][0];
    }

    /**
     * get count of products by product category id
     *
     * @param $category_id category id
     *
     * @return mixed array with products
     */
    public function getCountByCategory($category_id)
    {
        $q = 'select count(*) from
              category2products_map map
              WHERE map.cat2prod_map_category_id = '.$category_id;
        if ($category_id == 0) {
            return $this->getCount();
        }
        $result = $this->executeSelectQuery($q);
        return $result[0][0];
    }
}