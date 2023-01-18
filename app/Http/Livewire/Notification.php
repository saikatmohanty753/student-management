<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $counter;
    public $size;
    public function increment()
    {
        // $this->counter = $this->counter + $this->size;
        $this->counter += $this->size;
    }

    public function decrement()
    {
        $this->counter -= $this->size;
    }

    public function mount()
    {
        $this->counter = 0;
        $this->size = 1; //default value
    }
    public function render()
    {
        return view('livewire.notification');
    }


}
