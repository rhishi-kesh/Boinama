<?php

namespace App\Livewire\Backend;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class OrderList extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $pendingOrders = Order::latest()->where('status', 'p')->get();
        $confirmOrders = Order::latest()->where('status', 'c')->get();
        $processOrders = Order::latest()->where('status', 'pr')->get();
        $shippingOrders = Order::latest()->where('status', 's')->get();
        $deliveredOrders = Order::latest()->where('status', 'd')->get();
        $cancelOrders = Order::latest()->where('status', 'ca')->get();
        return view('livewire.backend.order-list' , compact('pendingOrders', 'confirmOrders', 'processOrders', 'shippingOrders', 'deliveredOrders', 'cancelOrders'));
    }
    public function cancelOrder($id){
        $order = Order::find($id);
        $order->status = 'ca';
        $order->save();
        session()->flash('success', 'Order Canceled.');
    }
    public function confirmOrder($id){
        $order = Order::find($id);
        $order->status = 'c';
        $order->save();
        session()->flash('success', 'Order Confirmed.');
    }
    public function processOrder($id){
        $order = Order::find($id);
        $order->status = 'pr';
        $order->save();
        session()->flash('success', 'Order Processing.');
    }
    public function shippingOrder($id){
        $order = Order::find($id);
        $order->status = 's';
        $order->save();
        session()->flash('success', 'Order Shipping.');
    }
    public function deliveredOrder($id){
        $order = Order::find($id);
        $order->status = 'd';
        $order->save();
        session()->flash('success', 'Order Delivered.');
    }
}
