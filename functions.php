<?php

function load_files($PATH = __DIR__)
{
    $controllers = scandir($PATH);
    $controllers = array_slice($controllers, 2);

    foreach ($controllers as $controller) {
        if (substr_count($controller, '.') == 0) {
            load_files($PATH . '/' . $controller);
            continue;
        }

        require_once $PATH . '/' . $controller;
    }
}
