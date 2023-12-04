<?php

namespace App\Livewire\Frontend\UserProfile;

use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('frontend.app')]

class AllOrdersShow extends Component
{
    public $id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $orders = Order::with(['customer'])->where('customer_id', Auth::guard("web")->user()->id)->where('id', $this->id)->first();
        $orderDetails = OrderDetails::with(['product'])->where('order_id', $this->id)->latest()->get();
        $title = 'My Orders';
        $url = url()->full();
        return view('livewire.frontend.user-profile.all-orders-show', compact('title','url','orders', 'orderDetails'));
    }
}
