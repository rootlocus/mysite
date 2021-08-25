<?php

namespace App\Http\Livewire\Home;

use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Index extends Component
{
    public $years;
    public $email;
    public $name;
    public $message;
    public $isDisabled = true;

    protected $rules = [
        'message' => 'required|min:6',
        'email' => 'required|email',
        'name' => 'required',
    ];

    public function mount()
    {
        $this->years = now()->year - 2014;
    }
    
    public function submit()
    {
        $this->isDisabled = true;

        Mail::send('emails.contact-me', array(
            'name' => $this->name,
            'email' => $this->email,
            'sentMessage' => $this->message,
        ), function ($build)  {
            $build
                ->subject($this->name . ' has dropped you a mail in your site!')
                ->from(config('mail.from.address'), config('mail.from.name'))
                ->to(config('mail.personal.email'), config('mail.personal.name'));
        });

        return redirect()->to('/');
    }

    public function render()
    {
        return view('livewire.home.index');
    }

    public function updated()
    {
        $this->isDisabled = true;
        $this->validate();
        $this->isDisabled = false;
    }
}
