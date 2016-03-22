<?php

namespace components\products\controller;

use core\Controller;
use core\ServiceLocator;

/**
 * Class Products
 * process busines action with products
 *
 * @package components\products\controller
 */
class Products extends Controller
{
    /**
     * show all products with menu
     */
    public function actionShowAll()
    {
        $this->getModel();
        $this->getView('shop');
        $sort       = 'ASC';
        $page       = 1;
        $action     = array('controller' => 'com:products.controller.Categories', 'action' => 'Show');
        $categories = ServiceLocator::get('core:Application')->process($action);

        $action  = array('controller' => 'com:products.controller.Products', 'action' => 'ShowList');
        $content = ServiceLocator::get('core:Application')->process($action);

        $page_count = ceil($this->model->getCountByCategory(0) / 10);

        $this->assignParameter('content', $content);
        $this->assignParameter('categories', $categories);
        $this->assignParameter('page_count', $page_count);
        $this->assignParameter('sort', $sort);
        $this->assignParameter('current_page', $page);
    }

    /**
     * show product with menu
     *
     * @param array $context parameterw with product id
     */
    public function actionShowProductFront($context = array())
    {
        $this->getModel();
        $this->getView('shop');
        $sort       = 'ASC';
        $page       = 1;
        $action     = array('controller' => 'com:products.controller.Categories', 'action' => 'Show');
        $categories = ServiceLocator::get('core:Application')->process($action);

        $action  = array(
            'controller' => 'com:products.controller.Products',
            'action'     => 'ShowProduct',
            'parameters' => array(1 => $context[1])
        );
        $content = ServiceLocator::get('core:Application')->process($action);

        $page_count = ceil($this->model->getCountByCategory(0) / 10);

        $this->assignParameter('content', $content);
        $this->assignParameter('categories', $categories);
        $this->assignParameter('page_count', $page_count);
        $this->assignParameter('sort', $sort);
        $this->assignParameter('current_page', $page);
    }

    /**
     * show list of producs
     *
     * @param array $context paramete with show action
     *                       sort, page and category id
     */
    public function actionShowList($context = array())
    {
        $category = isset($context[1])?$context[1]:0;
        $sort     = isset($context[2])?$context[2]:'ASC';
        $page     = isset($context[3])?$context[3]:1;
        $this->getModel();
        $this->getView('products_list');
        $product_list = $this->model->getList(10 * ($page - 1), 10, $category, $sort);
        $page_count   = ceil($this->model->getCountByCategory($category) / 10);
        $this->assignParameter('page_count', $page_count);
        $this->assignParameter('sort', $sort);
        $this->assignParameter('current_page', $page);
        $this->assignParameter('product_list', $product_list);
    }

    /**
     * show product
     *
     * @param array $context parameter with product id
     */
    public function actionShowProduct($context = array())
    {
        $this->getModel();
        $this->getView('product');

        $action = array(
            'controller' => 'com:products.controller.Products',
            'action'     => 'ShowRandom',
            'parameters' => array(
                'product_id'   => $context[1],
                'random_count' => 3
            )
        );
        $random = ServiceLocator::get('core:Application')->process($action);

        $this->assignParameter('product', $this->model->getItem($context[1]));
        $this->assignParameter('random', $random);
    }

    /**
     * show three random products
     *
     * @param array $context parameter with id of current page
     */
    public function actionShowRandom($context = array())
    {
        $this->getView('products_small');
        $this->getModel();
        $random = $this->model->getRandom($context[1], 3);
        $this->assignParameter('random_list', $random);
    }
}