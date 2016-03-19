<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 21:32
 */

namespace core;

class FrontController extends Controller
{
    public function __construct() {
      $this->view = BASE_DIR.DS.'media'.DS.'main.php';
    }

    public function execute($action_p) {
        $action = array('controller' => 'com:menu.controller.Menu', 'action' => 'DrawMenu');
        $menu = ServiceLocator::get('core:Application')->process($action);

        $content = ServiceLocator::get('core:Application')->process($action_p);

        $this->assignParameter('menu', $menu);
        $this->assignParameter('content', $content);
    }

}