<?php
    namespace Controllers;
    Use eftec\bladeone\BladeOne;

    class WLBlade {
        static protected $VIEW_DIR  = 'public/views';
        static protected $CACHE_DIR = 'cache';

        static public function render($view,$args=[]) {
            $blade = new BladeOne(self::$VIEW_DIR,self::$CACHE_DIR);
            $blade->setMode(BladeOne::MODE_DEBUG);
            return $blade->run($view,$args);
        }
    }
?>