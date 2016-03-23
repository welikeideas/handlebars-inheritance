<?php

namespace Handlebars\Inheritance;

use Symfony\Component\HttpFoundation\ParameterBag;

class HelperFacade
{
    use SingletonHelper;

    private static $blockRegistry;

    private static function getBlockRegistry()
    {
        if (!self::$blockRegistry) {
            self::$blockRegistry = new ParameterBag;
        }
        return self::$blockRegistry;
    }

    public static function callHelper($helperName, $args)
    {
        $helper = new $helperName(self::getBlockRegistry());
        return call_user_func_array([$helper, 'call'], $args);
    }

    public static function extends()
    {
        $helper = 'Handlebars\\Inheritance\\ExtendsHelper';
        Handlebars\Inheritance\HelperFacade::callHelper($helper, func_get_args());
    }

    public static function block()
    {
        $helper = 'Handlebars\\Inheritance\\BlockHelper';
        Handlebars\Inheritance\HelperFacade::callHelper($helper, func_get_args());
    }

    public static function override()
    {
        $helper = 'Handlebars\\Inheritance\\OverrideHelper';
        Handlebars\Inheritance\HelperFacade::callHelper($helper, func_get_args());
    }

}
