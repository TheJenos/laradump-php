<?php

namespace Thejenos\Laradump\Components;

use Illuminate\View\Component;

class Badge extends Component
{
    public $badge;

    public function __construct($badge)
    {
        $this->badge = $badge;
    }

    public function render()
    {
        return view('laradump::components.badge', [
            'call' => $this->badge,
        ]);
    }
}
