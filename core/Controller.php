<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 21:32
 */

namespace core;
class Controller {

    protected $view = null;
    protected $view_parameters_assign = array();
    protected $model = null;

    public function __construct() {
        $this->getDefaultView();
    }

    public function getDefaultView() {
        $reflection = new \ReflectionClass($this);
        $path = $reflection->getFileName();
        $fragments = explode(DS, $path);
        $fragments[sizeof($fragments)-2] = 'view';
        $fragments[sizeof($fragments)-1] = strtolower($fragments[sizeof($fragments)-1]);
        $path = implode(DS, $fragments);
        $this->view = $path;
    }

    public function getView($view) {
        $reflection = new \ReflectionClass($this);
        $path = $reflection->getFileName();
        $fragments = explode(DS, $path);
        $fragments[sizeof($fragments)-2] = 'view';
        $fragments[sizeof($fragments)-1] = strtolower($view).'.php';
        $path = implode(DS, $fragments);
        $this->view = $path;
    }

    public function assignParameter($key, $value) {
        $this->view_parameters_assign[$key] = $value;
    }

    public function render() {
        ob_start();
        extract($this->view_parameters_assign);
        include($this->view);
        return ob_get_clean();
    }

    public function getModel () {
        $reflection = new \ReflectionClass($this);
        $path = $reflection->getName();
        $fragments = explode('\\', $path);
        unset($fragments[0]);
        $fragments[sizeof($fragments)-1] = 'model';
        $fragments[sizeof($fragments)] = $fragments[sizeof($fragments)];
        $path = implode('.', $fragments);
        $path = 'com:'.$path;
        $this->model = ServiceLocator::get($path);
    }
}