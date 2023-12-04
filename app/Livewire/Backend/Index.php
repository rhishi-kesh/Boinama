<?php

namespace App\Livewire\Backend;

use App\Models\Order;
use App\Models\Products;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class Index extends Component
{
    public function render()
    {
        $data = [
            'allPaddingProduct' => Order::where('status','p')->count(),
            'allDeliveredProduct' => Order::where('status','d')->count(),
            'allCencelProduct' => Order::where('status','ca')->count(),
            'allProduct' => Order::count(),
        ];
        return view('livewire.backend.index')->with($data);
    }
}
