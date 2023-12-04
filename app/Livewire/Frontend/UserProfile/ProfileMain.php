<?php

namespace App\Livewire\Frontend\UserProfile;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('frontend.app')]

class ProfileMain extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $allOrders = Order::where('customer_id', Auth::guard("web")->user()->id)->latest()->take(8)->get();
        $title = 'My Profile';
        $url = url()->full();
        return view('livewire.frontend.user-profile.profile-main', compact('title','url','allOrders'));
    }
    public function viewProduct($id){
        dd($id);
    }
}
