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
                return $action;
            }
        }
        return 'request object';
    }

    public function buildRoute($request) {
        return 'link';
    }
}