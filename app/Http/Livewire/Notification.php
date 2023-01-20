<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Notification extends Component
{
    public $counter;

    public  function read()
    {

        $this->counter = Auth::user()->unreadNotifications->count();
        $this->mount();
    }

    public function mount()
    {
        $this->counter = Auth::user()->unreadNotifications->count();
    }
    public function render()
    {
        return view('livewire.notification');
    }
}
