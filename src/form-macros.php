<?php

use Collective\Html\FormFacade as Form;
use Collective\Html\HtmlFacade as Html;

/**
 * Create a form label element with the required marker.
 *
 * @param  string $name
 * @param  string|null $value
 * @param  array $options
 * @param  bool $espaceHtml
 * @return string
 */
Form::macro(
    'labelRequired',
    function ($name, $value = null, $options = [], $escapeHtml = true) {
        if ($escapeHtml) {
            $value = e($value);
        }

        $value = $value.'&nbsp;'.Html::requiredMarker();

        return Form::label($name, $value, $options, false);
    }
);
