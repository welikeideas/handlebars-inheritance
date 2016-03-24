<?php

namespace Handlebars\Inheritance;

class ExtendsHelper extends AbstractBlockHelper
{
    public function call($parentName, $options)
    {
        echo '<pre>'.var_dump($this->blockRegistry).'</pre>';
        $options['fn']();
        echo '<pre>'.var_dump($this->blockRegistry).'</pre>';

        // find parent template
        $parentTpl = '{{> '.$parentName.'}}';
        $compiled =  LightnCandy::compile($parentTpl, $sameOptions);
        
        // render parent template
        return LightnCandy::prepare($comopiled)($options['data']);
    }
}
