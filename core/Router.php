<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 20:42
 */

namespace core;

class Router
{
    private $routes = null;

    public function __construct($routes) {
        $this->routes = $routes;
    }

    public function processRequest() {

        $request = ServiceLocator::get('core:Request');
        $uri = $request->request_URI;
        foreach ($this->routes as $key => $value) {
            if (preg_match('/'.$value[path].'/', $uri, $rez)) {
                $action = array(
                    'controller' => $value[controller],
                    'action'     => $value[action],
                    'parameters' => $rez
                );
                return $action;
            }
        }
        return 'request object';
    }

    public function buildRoute($request) {
        return 'link';
    }
}