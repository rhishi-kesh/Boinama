<?php

namespace App\Livewire\Backend;

use App\Models\Admins;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public $confirm_password;
    public $role;
    public function mount(){

    }
    public function render()
    {
        return view('livewire.backend.user-create');
    }
    public function submit(){

        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8|same:confirm_password',
            'role' => 'required'
        ]);

        $done = Admins::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            session()->flash('success', 'User successfully Created.');
        }
    }
    public function resetform(){
        $this->reset(['name']);
        $this->reset(['email']);
        $this->reset(['password']);
        $this->reset(['confirm_password']);
        $this->reset(['role']);
    }
}
