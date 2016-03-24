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

    public static function extendsHelper()
    {
        $helper = 'Handlebars\\Inheritance\\ExtendsHelper';
        return Handlebars\Inheritance\HelperFacade::callHelper($helper, func_get_args());
    }

    public static function blockHelper()
    {
        $helper = 'Handlebars\\Inheritance\\BlockHelper';
        return Handlebars\Inheritance\HelperFacade::callHelper($helper, func_get_args());
    }

    public static function overrideHelper()
    {
        $helper = 'Handlebars\\Inheritance\\OverrideHelper';
        return Handlebars\Inheritance\HelperFacade::callHelper($helper, func_get_args());
    }

}
