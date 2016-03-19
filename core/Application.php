<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 1:39
 */

namespace core;

class Application
{
    public function __construct() {
    }

    public function process($action, $needFrontController) {
        if ($needFrontController) {
            $frontController = ServiceLocator::get('core:FrontController');
            $frontController->execute($action);
            echo $frontController->render();
        } else {
            $controller = ServiceLocator::get($action[controller]);
            $method = 'action'.$action[action];
            $controller->$method($action[parameters]);
            return $controller->render();
        }
    }
}