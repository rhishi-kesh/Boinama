<?php

namespace App\Livewire\Frontend\UserProfile;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('frontend.app')]

class AllDeliveredOrder extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $orders = Order::where('customer_id', Auth::guard("web")->user()->id)->where('status', 'd')->latest()->get();
        $title = 'My Orders';
        $url = url()->full();
        return view('livewire.frontend.user-profile.all-delivered-order', compact('title','url','orders'));
    }
}
