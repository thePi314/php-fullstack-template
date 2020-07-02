<?php
    namespace Controllers;

    class Component {
        /* Append Scripts needed at page */
        protected static function getScripts() {
            return [];
        }

        /* Append Stylesheets needed at page */
        protected static function getStylesheets() {
            return [];
        }

        public static function buildPage()
        {
            $component = new \stdClass();
            $component->stylesheets = static::getStylesheets();
            $component->scripts     = static::getScripts();

            $component->content     = static::render();

            return WLBlade::render('components.base-layout',['component'=>$component]);
        }

        // Override
        protected static function render(){}
    }
?>