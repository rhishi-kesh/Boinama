<?php

namespace App\Livewire\Backend;

use App\Models\Admins;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class Viewvendors extends Component
{
    public function render()
    {
        $vendors = Admins::where('role', 1)->latest()->paginate(10);
        return view('livewire.backend.viewvendors', compact('vendors'));
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
