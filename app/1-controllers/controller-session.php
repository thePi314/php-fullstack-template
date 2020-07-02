<?php
    namespace Controllers;

    class Session {
        protected static $PATH = './session_data/';
        protected static $NAME = 'session';

        public static function start(){
            session_start([
                'save_path' => self::$PATH,
                'name'      => self::$NAME
            ]);

            self::setDefaultData();
        }

        protected static function setDefaultData(){
            $_SESSION['user'] = null;
        }

        public static function get($arg){
            return $_SESSION[$arg];
        }

        public static function set($arg,$value) {
            $_SESSION[$arg] = $value;
        }
    }

?>