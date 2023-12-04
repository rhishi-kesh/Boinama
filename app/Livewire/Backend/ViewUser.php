<?php

namespace App\Livewire\Backend;

use App\Models\Admins;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class ViewUser extends Component
{
    public function mount(){

    }
    public function render()
    {
        $admins = Admins::where('role', 0)->latest()->paginate(5);
        $users = Admins::where('role', 2)->latest()->paginate(10);
        return view('livewire.backend.view-user',compact('admins','users'));
    }
    public function status(Admins $user){
        if($user->status == 0){
            $user->status = 1;
            $user->save();
        }else{
            $user->status = 0;
            $user->save();
        }
    }
}
