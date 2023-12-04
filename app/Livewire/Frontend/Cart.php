<?php

namespace App\Livewire\Frontend;

use App\Models\Coupon;
use App\Models\Products;
use App\Models\ShippingFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class Cart extends Component
{
    public $subtotal = 0;
    public $total = 0;
    public $coupon_code = '';
    public function render()
    {
        $this->subtotal = 0;
        $this->total = 0;
        if(session('cart')){
            foreach(session('cart') as $cart){
                $this->subtotal += $cart['price'] * $cart['quantity'];
            }
        }
        $shipingFee = ShippingFee::first()->fee;
        $this->total = $this->subtotal + $shipingFee;
        $title = 'Cart';
        $url = url()->full();
        return view('livewire.frontend.cart', compact('title','url','shipingFee'));
    }
    public function singleCartDelete($id){
        if($id)
        {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
                $this->dispatch('updateCartCount');
            }
            $this->dispatch(
                'alert',
                text : 'Cart Delete Successfull',
                type : 'error'
            );
        }
    }
    public function deleteAllCart(){
        session()->forget('cart');

        $this->dispatch('updateCartCount');

        $this->dispatch(
            'alert',
            text : 'Cart Cleard Successfull',
            type : 'error'
        );
    }
    public function increment($id){
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }
        session()->put('cart', $cart);
        $this->dispatch(
            'alert',
            text : 'Cart updated',
            type : 'success'
        );
    }
    public function decrement($id){
        $cart = session()->get('cart', []);
        if(isset($cart[$id])) {
            if($cart[$id]['quantity'] > 1){
                $cart[$id]['quantity']--;
                session()->put('cart', $cart);
                $this->dispatch(
                    'alert',
                    text : 'Cart updated',
                    type : 'success'
                );
            }
        }
    }
    public function checkout(){
        $cart = session()->get('cart', []);

        if ($cart) {
            $outOfStockProducts = [];

            foreach ($cart as $id => $details) {
                $product = Products::where('id', $details['id'])->first();

                if ($product && $product->quantity < $details['quantity']) {
                    $outOfStockProducts[] = $details['name'];
                }
            }

            if (!empty($outOfStockProducts)) {
                // If there are out-of-stock products, show an alert
                $this->dispatch(
                    'alert',
                    text : implode(', ', $outOfStockProducts) . " is out of stock",
                    type : 'error'
                );
            } else {
                // If all products are in stock, redirect to checkout
                return redirect('checkout');
            }
        } else {
            // If the cart is empty, show an alert
            $this->dispatch(
                'alert',
                text : 'Please add something in the cart',
                type : 'error'
            );
        }

    }
}
