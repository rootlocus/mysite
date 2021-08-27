<?php

namespace App\Http\Livewire\Playground;

use Livewire\Component;

class Index extends Component
{
    public $title = "Playground";

    public function render()
    {
        return view('livewire.playground.index')
            ->layoutData([ 'title' => $this->title]);
    }

}
