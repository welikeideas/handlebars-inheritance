<?php

namespace Handlebars\Inheritance;

use LightnCandy\LightnCandy;

class ExtendsHelper extends AbstractBlockHelper
{
    public function call($parentName, $options)
    {
        // populate the block registery
        $options['fn']();

        // find parent template
        $handlebarsContext = LightnCandy::getContext();
        $template = $handlebarsContext['partials'][$parentName];

        // compile the partial
        $compiled = LightnCandy::compile($template, $handlebarsContext);
        $render = LightnCandy::prepare($compiled);

        // render parent template
        return $render($options['data']['root']);
    }
}
