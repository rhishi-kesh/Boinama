<?php

namespace App\Livewire\Frontend;

use App\Models\Coupon;
use App\Models\coupon_user;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Products;
use App\Utils;
use App\Models\ShippingFee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class Checkout extends Component
{
    use Utils;
    public $name = '';
    public $email = '';
    public $phone = '';
    public $address = '';
    public $payment_type = '';
    public $subtotal = 0;
    public $total = 0;
    public $totalWithdiscount = null;
    public $discount = 0;
    public $discountpercent = 0;
    public $coupon_code = '';
    public function mount(){

    }
    public function render()
    {
        $this->name = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->number;
        $this->address = auth()->user()->address;
        $this->subtotal = 0;
        $this->total = 0;
        if(session('cart')){
            foreach(session('cart') as $cart){
                $this->subtotal += $cart['price'] * $cart['quantity'];
            }
        }
        $shipingFee = ShippingFee::first()->fee;
        $this->total = $this->subtotal + $shipingFee;
        $title = 'Checkout';
        $url = url()->full();
        return view('livewire.frontend.checkout', compact('title','url','shipingFee'));
    }
    public function coupon(){
        $coupon = Coupon::where('code', $this->coupon_code)->first();
        $couponuser = coupon_user::where('user_id', Auth::guard("web")->user()->id)->where('status', 0)->first();
        $user = auth()->user();
        if(empty($this->coupon_code)){
            return Session()->flash('not_match','Enter Your Coupon Code.');
        }else{
            if (!$coupon) {
                $this->discount = 0;
                $this->discountpercent = 0;
                $this->totalWithdiscount = null;
                return Session()->flash('not_match', 'Invalid coupon code.');
            }else{
                if($coupon->expire_date < date('Y-m-d')){
                    return Session()->flash('not_match', 'Coupon code Expired.');
                }else{
                    if ($user->coupons->contains($coupon) && $couponuser) {
                        $this->discount = 0;
                        $this->discountpercent = 0;
                        $this->totalWithdiscount = null;
                        return Session()->flash('not_match','You have already used this coupon.');
                    }else{
                        $shipingFee = ShippingFee::first()->fee;
                        $this->discount = round($this->subtotal * $coupon->amount / 100);
                        $this->discountpercent =  $coupon->amount;
                        $this->totalWithdiscount = ($this->subtotal - $this->discount) + $shipingFee;
                        $user->coupons()->attach($coupon->id);
                        return Session()->flash('not_match', 'Coupon Used Successfully.');
                    }
                }
            }
        }
    }
    public function checkout(){

        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^(?:\+?88)?01[35-9]\d{8}$/',
            'address' => 'required',
            'payment_type' => 'required',
        ]);

        DB::beginTransaction();
        try{
            //order entry
            $shipingFee = ShippingFee::first()->fee;
            $data = new Order();

            $data->shipping_phone = $this->phone;
            $data->shipping_email = $this->email;
            $data->shipping_address = $this->address;

            $data->billing_phone = $this->phone;
            $data->billing_email = $this->email;
            $data->billing_address = $this->address;

            $data->invoice = $this->generateCode('Order', 'O-');
            $data->customer_id = Auth::guard("web")->user()->id;
            $data->order_date = date("d-m-Y");
            $data->payment_type = $this->payment_type;
            $data->ip_address = request()->ip();
            $data->shipping_cost = $shipingFee;
            $data->discount = $this->discount;
            $data->sub_total = $this->subtotal;
            $data->total = empty($this->totalWithdiscount) ? $this->total : $this->totalWithdiscount;
            $data->save();

            //order_details_entry
            $cart = session()->get('cart', []);
            if ($cart) {
                foreach ($cart as $id => $cartDetails) {
                    $details = new OrderDetails();

                    $details->order_id = $data->id;
                    $details->product_id = $cartDetails['id'];
                    $details->quantity = $cartDetails['quantity'];
                    $details->price = $cartDetails['price'];
                    $details->writer_name = $cartDetails['writer'];
                    $details->save();
                }
            }
            //decrement quantity
            if ($cart) {
                foreach ($cart as $id => $product_quantity) {
                    Products::where('id', $product_quantity['id'])->decrement('quantity',$product_quantity['quantity']);
                }
            }
            //coupon
            $coupon = Coupon::where('code', $this->coupon_code)->first();
            if(!empty($this->coupon_code)){
                coupon_user::where('coupon_id', $coupon->id)->update([
                    'status' => 0,
                ]);
            }

            DB::commit();
            session()->forget('cart');

            return redirect('/')->with('success','Success! Order Place');

        }catch(\Throwable $e){
            DB::rollBack();
            $this->dispatch(
                'alert',
                text : 'Opps! something went wrong',
                type : 'error'
            );
        }
    }
}
