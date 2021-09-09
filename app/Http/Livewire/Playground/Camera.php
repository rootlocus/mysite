<?php

namespace App\Http\Livewire\Playground;

use Livewire\Component;

class Camera extends Component
{
    public $title = "Camera";
    public $isLive = false;

    public function render()
    {
        return view('livewire.playground.camera')
            ->layoutData([ 'title' => $this->title]);
    }

    public function onCamera()
    {
        $this->isLive = true;
    }

}
