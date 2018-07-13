<?php

use Collective\Html\HtmlFacade as Html;

/**
 * Marker to indicate a form field is required.
 *
 * @return string
 */
$html->macro('requiredMarker', function() {
    return
        '<span class="required">'.
            '<i class="fa fa-asterisk"></i>'.
            '<span class="sr-only">'.
                trans('common::misc.required').
            '</span>'.
        '</span>';
});

/**
 * Information about the meaning of the required marker.
 *
 * @return string
 */
$html->macro('infoRequiredFields', function() {
    return trans(
        'common::misc.info_required_fields',
        ['mark' => Html::requiredMarker()]
    );
});
