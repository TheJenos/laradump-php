<?php

namespace Thejenos\Laradump\Components;

use Illuminate\View\Component;

class CallPath extends Component
{
    public $calledBy;

    public function __construct($calledBy)
    {
        $this->calledBy = $calledBy;
    }

    public function render()
    {
        return view('laradump::components.call_path', [
            'call' => $this->calledBy
        ]);
    }
}
