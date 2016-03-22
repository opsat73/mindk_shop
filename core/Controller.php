<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 21:32
 */

namespace core;

/**
 * Class Controller
 * controller with default method for all controllers
 *
 * @package core
 */
class Controller
{

    protected $view = null;
    protected $view_parameters_assign = array();
    protected $model = null;

    /**
     * construct controller and set default view using name of controller
     */
    public function __construct()
    {
        $this->getDefaultView();
    }

    /**
     * set default view on controller using namespace
     */
    public function getDefaultView()
    {
        $reflection                        = new \ReflectionClass($this);
        $path                              = $reflection->getFileName();
        $fragments                         = explode(DS, $path);
        $fragments[sizeof($fragments) - 2] = 'view';
        $fragments[sizeof($fragments) - 1] = strtolower($fragments[sizeof($fragments) - 1]);
        $path                              = implode(DS, $fragments);
        $this->view                        = $path;
    }

    /**
     * @param $view name of view
     *              set default view on controller using namespace of controller and view name
     */
    public function getView($view)
    {
        $reflection                        = new \ReflectionClass($this);
        $path                              = $reflection->getFileName();
        $fragments                         = explode(DS, $path);
        $fragments[sizeof($fragments) - 2] = 'view';
        $fragments[sizeof($fragments) - 1] = strtolower($view).'.php';
        $path                              = implode(DS, $fragments);
        $this->view                        = $path;
    }

    /**
     * assign parameter to view for rendering
     *
     * @param $key   parameter name
     * @param $value value
     */
    public function assignParameter($key, $value)
    {
        $this->view_parameters_assign[$key] = $value;
    }

    /**
     * render curren view
     *
     * @return string render result
     */
    public function render()
    {
        ob_start();
        extract($this->view_parameters_assign);
        include($this->view);
        return ob_get_clean();
    }

    /**
     * set model using namespace of controller
     */
    public function getModel()
    {
        $reflection = new \ReflectionClass($this);
        $path       = $reflection->getName();
        $fragments  = explode('\\', $path);
        unset($fragments[0]);
        $fragments[sizeof($fragments) - 1] = 'model';
        $fragments[sizeof($fragments)]     = $fragments[sizeof($fragments)];
        $path                              = implode('.', $fragments);
        $path                              = 'com:'.$path;
        $this->model                       = ServiceLocator::get($path);
    }
}