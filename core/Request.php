<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 20:51
 */

namespace core;

/**
 * Class Request
 * base function for request
 *
 * @package core
 */
class Request
{
    public $request_type = null;
    public $request_URI = null;
    public $current_location = null;

    /**
     * construct request
     */
    public function __construct()
    {
        $this->request_type = $_SERVER['REQUEST_METHOD'];
        $this->request_URI  = $_SERVER['REQUEST_URI'];
    }
}