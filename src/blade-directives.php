<?php

use Illuminate\Support\Facades\Blade;

/**
 * Indicates if a view section has been defined.
 *
 * @deprecated 7.5.2 will be removed in 8.0.0 Use native @hasSection instead
 * @param  string $expression
 * @return string
 */
Blade::directive('hassection', function ($expression) {
    return "<?php if (array_key_exists($expression, \$__env->getSections())): ?>";
});

/**
 * End of @hassection directive
 *
 * @deprecated 7.5.2 will be removed in 8.0.0 Use native @endif instead
 * @return string
 */
Blade::directive('endhassection', function ($expression) {
    return '<?php endif; ?>';
});

/**
 * Indicates if a view section does not have been defined.
 *
 * @deprecated 7.5.2 will be removed in 8.0.0 Use native @sectionMissing instead
 * @param  string $expression
 * @return string
 */
Blade::directive('doesnthavesection', function ($expression) {
    return "<?php if (!array_key_exists($expression, \$__env->getSections())): ?>";
});

/**
 * End of @enddoesnthavesection directive
 *
 * @deprecated 7.5.2 will be removed in 8.0.0 Use native @endif instead
 * @return string
 */
Blade::directive('enddoesnthavesection', function ($expression) {
    return '<?php endif; ?>';
});

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
