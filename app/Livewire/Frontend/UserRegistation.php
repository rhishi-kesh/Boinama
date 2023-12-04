<?php

namespace App\Livewire\Frontend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class UserRegistation extends Component
{
    public $name;
    public $email;
    public $password;
    public $confirm_password;
    public function mount(){

    }
    public function render()
    {
        $title = 'Register';
        $url = url()->full();
        return view('livewire.frontend.user-registation', compact('title','url',));
    }
    public function submit(){

        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8|same:confirm_password',
        ]);

        $done = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            Auth::login($done);
            return redirect('/')->with('success','Registation Successfull');
        }
    }
    public function resetform(){
        $this->reset(['name']);
        $this->reset(['email']);
        $this->reset(['password']);
        $this->reset(['confirm_password']);
    }
}
