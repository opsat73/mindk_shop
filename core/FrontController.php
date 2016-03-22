<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 21:32
 */

namespace core;

/**
 * Class FrontController
 * Front controller to show menu and content
 *
 * @package core core
 */
class FrontController extends Controller
{
    /**
     * construct front controller and set front layout
     */
    public function __construct()
    {
        $this->view = BASE_DIR.DS.'media'.DS.'main.php';
    }

    /**
     * execute action
     *
     * @param $action_p action with parameters
     */
    public function execute($action_p)
    {
        $action = array(
            'controller' => 'com:menu.controller.Menu',
            'action'     => 'DrawMenu',
            'parameters' => array('orig_action' => $action_p)
        );
        $menu   = ServiceLocator::get('core:Application')->process($action);

        $content = ServiceLocator::get('core:Application')->process($action_p);

        $this->assignParameter('menu', $menu);
        $this->assignParameter('content', $content);
    }

}