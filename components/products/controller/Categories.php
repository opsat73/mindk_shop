<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 19.03.16
 * Time: 1:10
 */

namespace components\products\controller;

use core\Controller;

/**
 * Class Categories
 * process categories busines action
 * @package components\products\controller
 */
class Categories extends Controller
{
    /**
     * show categories tree
     * @param array $context paramters with parent id of category
     *                       if not set parent id = 1 (top)
     */
    public function actionShow($context = array()) {
        $category = $context[current_category];
        if (empty($category)) {
            $category = $context[1];
        }
        $this->getModel();
        $this->assignParameter('categories', $this->model->getList($category));
        $this->assignParameter('current_category', $context[current_category]);
    }
}