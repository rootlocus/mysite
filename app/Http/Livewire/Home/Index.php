<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;

class Index extends Component
{
    public $years;

    public function mount()
    {
        $this->years = now()->year - 2014;
    }

    public function render()
    {
        return view('livewire.home.index');
    }
}
