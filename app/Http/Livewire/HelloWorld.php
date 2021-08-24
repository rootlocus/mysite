<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class HelloWorld extends Component
{

    public $name = 'Jelly';
    public $loud = false;
    public $greeting = ['HELLO'];
    public $hydrated = 'im thirsty';
    public $updated = 'not updated';

    // public function mount(Request $request, $name)
    public function mount($name = "DEFAULT")
    {
        // $this->name = $request->input('name', $name);
        $this->name = $name;
    }

    // updates whenever it refetches the payload again
    public function hydrate()
    {
        $this->hydrated = 'im quenced';
    }

    public function updatedName()
    {
        $this->updated = 'updated';
    }

    public function render()
    {
        return view('livewire.hello-world', [
            'name' => 'Eric'
        ]);
    }

    public function resetName($name = "DEFAULT")
    {
        $this->name = $name;
    }

    public function fuck()
    {
        dd("FUCK");
    }
}
