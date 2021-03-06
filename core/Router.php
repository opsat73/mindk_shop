<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 20:42
 */

namespace core;

/**
 * Class Router
 * for parsing routes
 *
 * @package core
 */
class Router
{
    private $routes = null;

    /**
     * construct router
     *
     * @param $routes path to config routes file
     */
    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    /**
     * parse uri and return command
     *
     * @return array|string result of query
     */
    public function processRequest()
    {

        $request = ServiceLocator::get('core:Request');
        $uri     = $request->request_URI;
        foreach ($this->routes as $key => $value) {
            $request_method = (isset($value[method])?$value[method]:'GET');
            if (preg_match('/'.$value[path].'/', $uri, $rez) && $request_method == $request->request_type) {
                $session = ServiceLocator::get('core:Session');
                $session->putParameter('current_location', $key);
                $action = array(
                    'controller' => $value[controller],
                    'action'     => $value[action],
                    'parameters' => $rez
                );
                if ($request->request_type == 'POST') {
                    $action[parameters] = $_REQUEST;
                }
                $action[need_front_controller] = isset($value[is_front])?$value[is_front]:false;
                return $action;
            }
        }
        return null;
    }
}