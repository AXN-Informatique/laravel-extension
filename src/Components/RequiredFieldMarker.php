<?php

declare(strict_types=1);

namespace Axn\ToolKit\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Blade component to display a required field marker.
 */
class RequiredFieldMarker extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  string  $symbol  The symbol to display (default: asterisk)
     */
    public function __construct(
        public string $symbol = '&#x2a;'
    ) {}

    /**
     * Get the view that represents the component.
     */
    public function render(): View
    {
        return view('tool-kit::components.required-field-marker');
    }
}
