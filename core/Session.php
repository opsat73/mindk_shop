<?php
/**
 * Created by PhpStorm.
 * User: opsat73
 * Date: 02.10.15
 * Time: 22:46
 */

namespace core;


class Session
{

    /**
     * construcn session manager and start session
     */
    public function __construct() {
        $this->startSession();
    }

    public function get_session_id() {
        return session_id();
    }
    /**
     * check if parameter exist in Session context
     * @param $parameter String name of parameter
     * @return bool true if parameter exist
     */
    public function hasParameter($parameter) {
        return array_key_exists($parameter, $_SESSION);
    }

    /**
     * put parameter with value in SESSION context
     * @param $parameter String name of parameter
     * @param $value value of parameter
     * @param bool|true $rewrite if need rewrite parameter in session context, use TRUE
     */
    public function putParameter($parameter, $value, $rewrite = true) {
        if ($this -> hasParameter($parameter)) {
            if ($rewrite) {
                $_SESSION[$parameter] = $value;
            }
        } else {
            $_SESSION[$parameter] = $value;
        }
    }

    /**
     * remove parameter from SESSION context
     * @param $parameter String name of parameter
     */
    public function removeParameter ($parameter) {
        if ($this -> hasParameter($parameter))
            unset($_SESSION[$parameter]);
    }

    /**
     * get parameter by name form SESSION context
     * @param $parameter String name of parameter
     * @return value or noll if parameter not exist
     */
    public function getParameter ($parameter) {
        if ($this->hasParameter($parameter))
            return $_SESSION[$parameter];
        return null;
    }

    private function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->putParameter('flush', array(), false);
    }

    /**
     * stop session if not need anymore
     */
    public function stopSession() {
        if (session_status() == PHP_SESSION_DISABLED) {
            session_abort();
        }
    }

}