<?php

namespace Axn\Illuminate\View;

use Collective\Html\FormBuilder;
use Collective\Html\HtmlBuilder;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Blade directives
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {

            $bladeCompiler->directive('hasyield', function ($expression) {
                return "<?php if (array_key_exists($expression, \$__env->getSections())): ?>";
            });

            $bladeCompiler->directive('endhasyield', function ($expression) {
                return "<?php endif; ?>";
            });

            $bladeCompiler->directive('doesnthaveyield', function ($expression) {
                return "<?php if (!array_key_exists($expression, \$__env->getSections())): ?>";
            });

            $bladeCompiler->directive('enddoesnthaveyield', function ($expression) {
                return "<?php endif; ?>";
            });

            $bladeCompiler->directive('nltop', function ($expression) {
                return "<?php echo nl_to_p(e($expression)); ?>";
            });

            $bladeCompiler->directive('nltobr', function ($expression) {
                return "<?php echo nl2br(e($expression)); ?>";
            });
        });

        $requiredMark = '<span class="required"><i class="fa fa-asterisk"></i><span class="sr-only">'.
            trans('common::misc.required').'</span></span>';

        // HTML macros
        $this->app->afterResolving('html', function (HtmlBuilder $html) use ($requiredMark) {

            $html->macro('infoRequiredFields', function () use ($requiredMark) {
                return trans('common::misc.required_notice', ['mark' => $requiredMark]);
            });

        });

        // Form macro
        $this->app->afterResolving('form', function (FormBuilder $form) use ($requiredMark) {

            $form->macro(
                'labelRequired',
                function (
                    $name,
                    $value = null,
                    $options = [],
                    $escape_html = true
                ) use (
                    $form,
                    $requiredMark
                ) {
                    if ($escape_html) {
                        $value = e($value);
                    }

                    $value = $value.' '.$requiredMark;

                    return $form->label($name, $value, $options, false);
                }
            );
        });
    }
}
