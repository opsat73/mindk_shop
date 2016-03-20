<?php

/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 22:11
 */
namespace components\menu\controller;
use core\Controller;

class Menu extends Controller
{
    public function actionDrawMenu ($context = array())
    {
        if (($context[orig_action][controller] == 'com:products.controller.Products') &&
            ($context[orig_action][action] == 'ShowList')
        ) {
            $category = isset($context[orig_action][parameters][1])?$context[orig_action][parameters][1]:0;
            $sort = isset($context[orig_action][parameters][2])?$context[orig_action][parameters][2]:'ASC';
            $this->assignParameter('sort', $sort);
            $this->assignParameter('show_sort_buttons', true);
            $this->assignParameter('category', $category);
        } else {
            $this->assignParameter('show_sort_buttons', false);
        }
    }
}