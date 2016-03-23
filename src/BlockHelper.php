<?php

namespace Handlebars\Inheritance;

class BlockHelper extends AbstractBlockHelper
{
    public function call($blockName, $options)
    {
        if (!$this->blockRegistry->has($blockName)) {
            return $options['fn']();
        }
    }
}