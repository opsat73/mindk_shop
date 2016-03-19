<?php

namespace components\products\model;

use \core\Model;

class Categories extends Model
{
    public function getList() {
        $q = 'select
                  category_name,
                  category_id,
                  count(*) as count
              from
                  categories,
                  category2products_map
              WHERE
                  categories.category_id = category2products_map.cat2prod_map_category_id
              group by
                  cat2prod_map_category_id
              order by
                  category_order;';
        return $this->executeSelectQuery($q);
    }

}