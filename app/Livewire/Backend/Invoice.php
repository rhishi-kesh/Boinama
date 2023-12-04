<?php

namespace App\Livewire\Backend;

use App\Models\Order;
use App\Models\WebsiteInformations;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]


class Invoice extends Component
{
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $order = Order::with('orderDetails')->where('id', $this->id)->first();
        $content = WebsiteInformations::first();
        return view('livewire.backend.invoice', compact('order', 'content'));
    }
}
