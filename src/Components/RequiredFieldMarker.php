<?php

declare(strict_types=1);

namespace Axn\ToolKit\Components;

use Illuminate\View\Component;

class RequiredFieldMarker extends Component
{
    public function __construct(
        public string $symbol = '&#x2a;'
    ) {}

    public function render()
    {
        return view('tool-kit::components.required-field-marker.blade');
    }
}
