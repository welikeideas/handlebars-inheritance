<?php

namespace Handlebars\Inheritance;

class OverrideHelper extends AbstractBlockHelper
{
    public function call($blockName, $options)
    {
        if (!$this->blockRegistry->has($blockName)) {
            $this->blockRegistry->set($blockName, $options['fn']);
        }
    }
}
