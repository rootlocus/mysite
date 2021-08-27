<?php

namespace App\Http\Livewire\AboutMe;

use Livewire\Component;

class Index extends Component
{
    public $title = "About Me";

    public $images = ['eric_food.png', 'monk.png'];

    public $currentImage = 'eric_food.png';

    public function render()
    {
        return view('livewire.about-me.index')
            ->layoutData([ 'title' => $this->title]);
    }

    public function swapImage($image)
    {
        $this->currentImage = $image;
    }
}
