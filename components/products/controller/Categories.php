<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 19.03.16
 * Time: 1:10
 */

namespace components\products\controller;

use core\Controller;

class Categories extends Controller
{
    public function actionShow($context = array()) {
        $this->getModel();
        $this->assignParameter('categories', $this->model->getList());
        $this->assignParameter('current_category', $context[current_category]);
    }
}