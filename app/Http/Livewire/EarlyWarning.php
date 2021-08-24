<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EarlyWarning extends Component
{
    public $identifier;
    public $data;
    public $filter;

    public function render()
    {
        return view('livewire.early-warning');
    }
}
