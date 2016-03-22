<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 1:39
 */

namespace core;

/**
 * Class Application
 * main class of application
 *
 * @package core
 */
class Application
{
    /**
     * Default constructor
     */
    public function __construct()
    {
    }

    /**
     * process busines action
     *
     * @param $action              array with action, controller and parameters for action
     * @param $needFrontController true if need menu and CSS
     *
     * @return mixed return rendered information ready to output
     */
    public function process($action, $needFrontController)
    {
        $session = ServiceLocator::get('core:Session');
        if ($needFrontController) {
            $frontController = ServiceLocator::get('core:FrontController');
            $frontController->execute($action);
            return $frontController->render();
        } else {
            $controller = ServiceLocator::get($action[controller]);
            $method     = 'action'.$action[action];
            $controller->$method($action[parameters]);
            return $controller->render();
        }
    }
}