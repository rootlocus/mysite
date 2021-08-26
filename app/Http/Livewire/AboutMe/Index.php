<?php

namespace App\Http\Livewire\AboutMe;

use Livewire\Component;

class Index extends Component
{
    public $title = "About Me";

    public function render()
    {
        return view('livewire.about-me.index')
            ->layoutData([ 'title' => $this->title]);
    }
}
