<?php

namespace Handlebars\Inheritance;

trait SingletonHelper
{
    protected static $instance;

    protected function __construct()
    {
        parent::__construct();
    }

    public static function getInstance()
    {
        if (!static::$instance) {
            static::$instance = new self;
        }
        return static::$instance;
    }
}