<?php

require_once '../vendor/autoload.php';

use LightnCandy\LightnCandy;

$template = <<<TPL
<h1>Parent</h1>
{{#block "outer"}}
  hello {{name}}
{{/block}}
TPL;

$child_template = <<<TPL
{{#extends "template"}}
  <h1>Child</h1>
  {{#override "outer"}}
    Goodbye {{name}}
  {{/override}}
{{/extends}}
TPL;

$compiled = LightnCandy::compile($child_template, [
    'flags' => LightnCandy::FLAG_STANDALONEPHP | LightnCandy::FLAG_HANDLEBARS,
    'helpers' => [
        'extends'  => 'Handlebars\Inheritance\HelperFacade::extends',
        'block'    => 'Handlebars\Inheritance\HelperFacade::block',
        'override' => 'Handlebars\Inheritance\HelperFacade::override',
    ]
]);

$callable = LightnCandy::prepare($compiled);

echo $callable(['name' => 'steve']);