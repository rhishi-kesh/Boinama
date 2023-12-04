<?php

namespace App\Livewire\Backend;

use App\Models\Admins;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class ViewCustomer extends Component
{
    public function mount(){

    }
    public function render()
    {
        $Customers = User::latest()->paginate(30);
        return view('livewire.backend.view-customer', compact('Customers'));
    }
}
