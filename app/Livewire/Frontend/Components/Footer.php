<?php

namespace App\Livewire\Frontend\Components;


use App\Models\WebsiteInformations;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class Footer extends Component
{
    public function render()
    {
        $WebsiteInformations = WebsiteInformations::first();
        return view('livewire.frontend.components.footer',compact('WebsiteInformations'));
    }
}
