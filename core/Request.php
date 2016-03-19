<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 20:51
 */

namespace core;

class Request
{
    public $request_type = null;
    public $request_URI = null;
    //private $request_type = null;
    public function __construct() {
        $this->request_type = $_SERVER['REQUEST_METHOD'];
        $this->request_URI  = $_SERVER['REQUEST_URI'];
    }
}