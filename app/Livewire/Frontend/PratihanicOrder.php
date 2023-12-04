<?php

namespace App\Livewire\Frontend;

use App\Models\Corporates;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class PratihanicOrder extends Component
{
    public function render()
    {
        $corporates = Corporates::first();
        $title = 'Corporate Order';
        $url = url()->full();
        return view('livewire.frontend.pratihanic-order', compact('title','url','corporates'));
    }
}
