<?php

namespace Controller;

use Controllers\WLBlade;

class Page
{
    protected static $hasHeader      = true;
    protected static $hasFooter      = true;
    protected static $mustBeLoggedIn = false;

    protected static $mainStylesheets = [
        'public/styles/variables.css',
        'public/styles/main.css',
        'public/styles/layouts/row.css',
        'public/styles/layouts/font-icons.css',
        'public/styles/layouts/content-line.css',
        'public/styles/layouts/box.css',
        'public/styles/layouts/table.css',
        'public/styles/segments/segment-header.css',
        'public/styles/segments/segment-footer.css'
    ];
    protected static $mainScripts     = [
        'public/scripts/libs/component.js',
        'public/scripts/libs/font-icons.js',
        'public/scripts/main.js',
    ];

    /* Append Scripts needed at page */
    protected static function getScripts() {
        return [];
    }

    /* Append Stylesheets needed at page */
    protected static function getStylesheets() {
        return [];
    }

    /* Default MetaData */
    protected static function getMetadata() {
        return [
            '<meta charset="UTF-8">',
            '<meta name="viewport" content="width=device-width, initial-scale=1.0">',
            '<meta http-equiv="X-UA-Compatible" content="ie=edge">'
        ];
    }

    public static function buildPage()
    {
        $page = new \stdClass();
        $page->metadata    = implode("\n",static::getMetadata());
        $page->stylesheets = array_merge(self::$mainStylesheets, static::getStylesheets());
        $page->scripts     = array_merge(self::$mainScripts, static::getScripts());

        $page->content     = static::render();

        $page->hasHeader   = static::$hasHeader;
        $page->hasFooter   = static::$hasFooter;

        return WLBlade::render('base-layout',['page'=>$page]);
    }

    // Override
    protected static function render(){}
}
