<?php

namespace components\products\controller;

use core\Controller;
use core\ServiceLocator;

class Products extends Controller
{
    public function actionShowList($context = array()) {
        $category = isset($context[1])?$context[1]:0;
        $sort = isset($context[2])?$context[2]:'ASC';
        $page = isset($context[3])?$context[3]:1;

        $action = array('controller' => 'com:products.controller.Categories', 'action' => 'Show', 'parameters' => array('current_category' => $category ));
        $categories = ServiceLocator::get('core:Application')->process($action);
        $this->getModel();
        $this->getView('products_list');
        $product_list = $this->model->getList(10*($page-1), 10, $category, $sort);
        $page_count = ceil($this->model->getCountByCategory($category)/10);
        $this->assignParameter('page_count', $page_count);
        $this->assignParameter('sort', $sort);
        $this->assignParameter('current_category', $category);
        $this->assignParameter('current_page', $page);
        $this->assignParameter('product_list', $product_list);
        $this->assignParameter('categories', $categories);
    }

    public function actionShowProduct($context = array()) {
        $action = array('controller' => 'com:products.controller.Categories', 'action' => 'Show');
        $categories = ServiceLocator::get('core:Application')->process($action);
        $this->getModel();
        $this->getView('product');

        $action = array('controller' => 'com:products.controller.Products',
                        'action' => 'ShowRandom',
                        'parameters' => array('product_id' => $context[1],
                                              'random_count' => 3));
        $random = ServiceLocator::get('core:Application')->process($action);

        $this->assignParameter('product', $this->model->getItem($context[1]));
        $this->assignParameter('categories', $categories);
        $this->assignParameter('random', $random);
    }

    public function actionShowRandom($context = array()) {
        $this->getView('products_small');
        $this->getModel();
        $random = $this->model->getRandom($context[1], 3);
        $this->assignParameter('random_list', $random);
    }
}