<?php

use Illuminate\Support\Facades\Blade;

/**
 * Alias of nl_to_p() helper.
 *
 * @param  string $expression
 * @return string
 */
Blade::directive('nltop', function ($expression) {
    return "<?php echo nl_to_p(e($expression)); ?>";
});

/**
 * Alias of nl_to_br() helper.
 *
 * @param  string $expression
 * @return string
 */
Blade::directive('nltobr', function ($expression) {
    return "<?php echo nl_to_br(e($expression)); ?>";
});
