<?php

namespace Controllers;

class WLRouter
{
    protected static $data        = [];
    protected static $dataFetched = false;

    public function __construct()
    {

        if ($_SERVER['PATH_INFO'][-1] !== '/')
            $this->requestUrl =  explode('/', $_SERVER['PATH_INFO']);
        else
            $this->requestUrl =  explode('/', substr($_SERVER['PATH_INFO'], 0, -1));
    }

    private static function fetch_request(){
        $data = null;
        
        if ($_SERVER['PATH_INFO'][-1] !== '/')
            $data =  explode('/', $_SERVER['PATH_INFO']);
        else
            $data =  explode('/', substr($_SERVER['PATH_INFO'], 0, -1));
        
        return $data;
    }

    public static function route($route, $action)
    {
        $args       = [];
        $requestUrl = self::fetch_request();
    
        if ($route[-1] !== '/')
            $routeArray = explode('/', $route);
        else
            $routeArray = explode('/', substr($route, 0, -1));

        $routeLength = count($requestUrl);
        $ind = 0;

        for ($ind; $ind < $routeLength; $ind++) {
            if(count($routeArray) <= $ind)
                continue;
            
            $checkUrl   = $requestUrl[$ind];
            $checkRoute = $routeArray[$ind];
            

            if ($checkRoute === '*') {
                return call_user_func_array($action, $args);
            }
            if ($checkRoute === '@number' && is_numeric($checkUrl)) {
                $args[] = intval($checkUrl);
                continue;
            }
            if ($checkRoute === '@string') {
                $args[] = $checkUrl;
                continue;
            }
            if ($checkUrl !== $checkRoute) {
                return false;
            }
        }

        return ($ind == count($routeArray) ? call_user_func_array($action, $args) : false);
    }
}
