<?php

namespace System\Cookie;

class Cookie
{
    public function set($name, $value , $expire)
    {
        setcookie($name, $value , array('expires' => time() + ($expire)));
    }

    public function get($name)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : false;
    }

    public function remove($name)
    {
        if (isset($_COOKIE[$name])) {
            unset($_COOKIE[$name]); 
            setcookie($name, null, time() -1); 
            return true;
        } else {
            return false;
        }
    }

    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return call_user_func_array([$instance, $name], $arguments);
    }
}
