<?php

namespace App\Livewire\Frontend;

use App\Models\Products;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class Shop extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $products = Products::where('subject_id', $this->id)->get();
        $title = 'Shop';
        $url = url()->full();
        return view('livewire.frontend.shop', compact('title','url','products'));
    }
}
