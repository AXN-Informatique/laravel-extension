<?php

use Collective\Html\HtmlFacade as Html;

/**
 * Marker to indicate a form field is required.
 *
 * @return string
 */
Html::macro('requiredMarker', function () {
    return
        '<span class="required">'.
            str_html(Html::requiredCharacter()).
            '<span class="sr-only">'.
                trans('common::misc.required').
            '</span>'.
        '</span>';
});

/**
 * Typographic character of the marker to indicate that a form field is required.
 *
 * Examples:
 *  - '*'               // UTF-8 character
 *  - '&#42;'           // decimal numeric character reference
 *  - '&#x2a;'          // hexadecimal numeric character reference
 *  - '* required'      // custom string...
 *  - '<i class="fa fa-asterisk"></i>' // HTML custom string
 *
 * @return string
 */
Html::macro('requiredCharacter', function () {
    return '&#x2a;';
});

/**
 * Information about the meaning of the required marker.
 *
 * @return string
 */
Html::macro('infoRequiredFields', function () {
    return trans(
        'common::misc.info_required_fields',
        ['mark' => str_html(Html::requiredMarker())]
    );
});
