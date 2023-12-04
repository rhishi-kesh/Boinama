<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class UserLogin extends Component
{
    public function render()
    {
        $title = 'Login';
        $url = url()->full();
        return view('livewire.frontend.user-login',compact('title','url'));
    }
}
