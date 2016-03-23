<?php

namespace Handlebars\Inheritance;

use Symfony\Component\HttpFoundation\ParameterBag;

class AbstractBlockHelper
{
    protected $blockRegistry;

    public function  __construct(ParameterBag $blockRegistry)
    {
        $this->blockRegistry = $blockRegistry;
    }
}