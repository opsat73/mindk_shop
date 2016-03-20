<?php

namespace components\products\model;

use \core\Model;

class Products extends Model
{
    public function getList($from, $how_many, $category = 0) {
        $q = 'select p.*, pictures.* from
              products p,
              category2products_map map,
              pictures
              where 1 = 1
              and p.product_id = map.cat2prod_map_product_id
              and pictures.picture_product_id = p.product_id';
        if ($category != 0) {
            $q .= ' and map.cat2prod_map_category_id = '.$category;
        }

        if (($from != 0) && ($how_many != 0)) {
            $q .= ' limit '.$from.', '.$how_many;
        }

        return $this->executeSelectQuery($q);
    }

    public function getItem($product_id) {
        $q = 'select * from
              products,
              pictures
              where
                 pictures.picture_product_id = products.product_id
               and product_id = '.$product_id;
        $result = $this->executeSelectQuery($q);
        return $result[0];
    }

    public function getRandom($product_id, $count) {
        $max = $this->getCount();

        $randoms = array();
        while (sizeof($randoms) < $count) {
            $rand = rand(0, $max);
            if  (($product_id != $rand) && (!in_array($rand, $randoms))) {
                $randoms[] = $rand;
            }
        }
        $condition = implode(', ',$randoms);
        $q = 'select * from
              products,
              pictures
              where pictures.picture_product_id = products.product_id
               and product_id in ('.$condition.')';
        $result = $this->executeSelectQuery($q);
        return $result;
    }

    public function getCount() {
        $q = 'select count(*) from
              products';
        $result = $this->executeSelectQuery($q);
        return $result[0][0];
    }

    public function getCountByCategory($category_id) {
        $q = 'select count(*) from
              category2products_map map
              WHERE map.cat2prod_map_category_id = '. $category_id;
        if ($category_id == 0) {
              return $this->getCount();
        }
        $result = $this->executeSelectQuery($q);
        return $result[0][0];
    }

}