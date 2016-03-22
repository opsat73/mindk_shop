<?php

/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 22:11
 */
namespace components\menu\controller;

use core\Controller;
use core\ServiceLocator;

/**
 * Class Menu
 * menu
 *
 * @package components\menu\controller
 */
class Menu extends Controller
{
    /**
     * draw top menu
     *
     * @param array $context parameters
     */
    public function actionDrawMenu($context = array())
    {
        $session          = ServiceLocator::get('core:Session');
        $current_location = $session->getParameter('current_location');
        if (in_array($current_location, array('products', 'home', 'product'))) {
            $current_location = 'list';
        }
        if (in_array($current_location, array('bucket'))) {
            $current_location = 'bucket';
        }
        $this->assignParameter('current_location', $current_location);
        $session     = ServiceLocator::get('core:Session');
        $count       = $session->getParameter('count');
        $total_price = $session->getParameter('total_price');
        if (isset($count)) {
            $this->assignParameter('count', $count);
            $this->assignParameter('total_price', $total_price);
        }
        if (($context[orig_action][controller] == 'com:products.controller.Products') &&
            ($context[orig_action][action] == 'ShowList')
        ) {
            $category = isset($context[orig_action][parameters][1])?$context[orig_action][parameters][1]:0;
            $sort     = isset($context[orig_action][parameters][2])?$context[orig_action][parameters][2]:'ASC';
            $this->assignParameter('sort', $sort);
            $this->assignParameter('show_sort_buttons', true);
            $this->assignParameter('category', $category);
        } else {
            $this->assignParameter('show_sort_buttons', false);
        }
    }
}