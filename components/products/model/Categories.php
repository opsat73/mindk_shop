<?php

namespace components\products\model;

use \core\Model;

class Categories extends Model
{
    public function getList($parent_category = 1) {
        if ($parent_category == 0) {
            $parent_category = 1;
        }
        $q = 'select
          category_name,
          category_id,
          parent_id,
          (select count(*) from categories tmp where tmp.parent_id = cat.category_id) child_count,
          (select count(*) from category2products_map tmp where tmp.cat2prod_map_category_id = cat.category_id) count
        from
          categories cat
        where cat.parent_id = '.$parent_category.'
        order by
        cat.category_order';
        return $this->executeSelectQuery($q);
    }

}