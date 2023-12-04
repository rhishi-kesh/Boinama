<?php

namespace App\Livewire\Backend;

use App\Models\Subjects;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class ControllContent extends Component
{
    public function render()
    {
        $subjects = Subjects::latest()->get();
        return view('livewire.backend.controll-content', compact('subjects'));
    }
    public function status(Subjects $subject){
        if($subject->status == 0){
            $subject->status = 1;
            $subject->save();
        }else{
            $subject->status = 0;
            $subject->save();
        }
    }
}
