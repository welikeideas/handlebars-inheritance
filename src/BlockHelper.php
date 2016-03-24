<?php

namespace Handlebars\Inheritance;

class BlockHelper extends AbstractBlockHelper
{
    public function call($blockName, $options)
    {
        if ($this->blockRegistry->has($blockName)) {
            $blockTemplate = $this->blockRegistry->get($blockName);
            return $blockTemplate();
        }
    }
}
