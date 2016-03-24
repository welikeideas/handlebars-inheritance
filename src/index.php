<?php

require_once '../vendor/autoload.php';

use LightnCandy\LightnCandy;

$template = <<<TPL
<h1>This is the Parent Template</h1>
<p>Marker 1 {{name}}</p>
{{#block "outer"}}
  <p>hello {{name}}</p>
{{/block}}
<p>Marker 2 {{name}}</p>
{{#block "other"}}
  <p>hello {{name}}</p>
{{/block}}
TPL;

$child_template = <<<TPL
{{#extends "template"}}
  <h1>This is the Child Template</h1>
  {{#override "other"}}
    OTHER {{name}}
  {{/override}}

  {{#block "foo"}}
    <p>hello {{name}}</p>
  {{/block}}
  {{#override "outer"}}
    Goodbye {{name}}
  {{/override}}
{{/extends}}
TPL;

$compiled = LightnCandy::compile($child_template, [
    'flags' => LightnCandy::FLAG_STANDALONEPHP | LightnCandy::FLAG_HANDLEBARS,
    'helpers' => [
        'extends'  => 'Handlebars\Inheritance\HelperFacade::extendsHelper',
        'block'    => 'Handlebars\Inheritance\HelperFacade::blockHelper',
        'override' => 'Handlebars\Inheritance\HelperFacade::overrideHelper',
    ],
    'partials' => [
      'template' => $template,
      'child' => $child_template
    ]
]);
$callable = LightnCandy::prepare($compiled);

echo $callable(['name' => 'Steve']);
