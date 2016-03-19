<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 18.03.16
 * Time: 1:32
 */

namespace core;

class ServiceLocator
{

    private $available_services = null;
    private static $instance = null;
    private static $services = array();

    private function __construct()
    {
        $this->available_services = include(BASE_DIR.DS.'config'.DS.'services.php');
    }

    private static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new ServiceLocator();
        }
        return self::$instance;
    }

    public function __callStatic($fname, $fparams)
    {
        $locator = self::getInstance();
        if ($fname == 'get') {
            $fragments = explode(':', $fparams[0]);
            switch ($fragments[0]) {
                case 'serv': {
                    if (!array_key_exists($fragments[1], self::$services)) {
                        $path    = $locator->available_services[$fragments[1]]['class'];
                        $r_class = new \ReflectionClass($path);

                        if (is_array($locator->available_services[$fragments[1]]['init_parameters'])) {
                            $parameters = $locator->available_services[$fragments[1]]['init_parameters'];
                        } else
                         {
                            $parameters = include($locator->available_services[$fragments[1]]['init_parameters']);
                        }
                        $result                        = $r_class->newInstanceArgs($parameters);
                        $locator->services[$fragments[1]] = $result;
                    }
                    return $locator->services[$fragments[1]];
                }
                    break;
                case 'core': {
                    $path = 'core';
                    $path    = $path.'\\'.implode('\\', explode('.', $fragments[1]));
                    $r_class = new \ReflectionClass($path);
                    return $r_class->newInstance($fparams[1]);
                }
                    break;
                case 'com': {
                    $path = 'components\\';
                    $path    = $path.implode('\\', explode('.', $fragments[1]));
                    $r_class = new \ReflectionClass($path);
                    return $r_class->newInstance($fparams[1]);
                }
                    break;
            }
        } else {
            throw new \Excepion ('wrong function name');
        }
    }
}