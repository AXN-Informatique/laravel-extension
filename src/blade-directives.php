<?php

/**
 * Indicates if a view section has been defined.
 *
 * @param  string $expression
 * @return string
 */
$blade->directive('hassection', function($expression) {
    return "<?php if (array_key_exists($expression, \$__env->getSections())): ?>";
});

// End of @hassection directive
$blade->directive('endhassection', function($expression) {
    return "<?php endif; ?>";
});

/**
 * Indicates if a view section does not have been defined.
 *
 * @param  string $expression
 * @return string
 */
$blade->directive('doesnthavesection', function($expression) {
    return "<?php if (!array_key_exists($expression, \$__env->getSections())): ?>";
});

// End of @enddoesnthavesection directive
$blade->directive('enddoesnthavesection', function($expression) {
    return "<?php endif; ?>";
});

/**
 * Alias of nl_to_p() helper.
 *
 * @param  string $expression
 * @return string
 */
$blade->directive('nltop', function($expression) {
    return "<?php echo nl_to_p(e($expression)); ?>";
});

/**
 * Alias of nl_to_br() helper.
 *
 * @param  string $expression
 * @return string
 */
$blade->directive('nltobr', function($expression) {
    return "<?php echo nl_to_br(e($expression)); ?>";
});
