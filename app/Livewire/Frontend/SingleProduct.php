<?php

namespace App\Livewire\Frontend;

use App\Models\Products;
use App\Models\WebsiteInformations;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class SingleProduct extends Component
{
    public $id;
    public $quentity = 1;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $product = Products::where('id', $this->id)->where('status', 0)->where('is_active', 0)->first();
        $releteds = Products::where('subject_id', $product->subject_id)->where('is_active', 0)->where('status', 0)->inRandomOrder()->take(10)->get();
        $WebsiteInformations = WebsiteInformations::first();
        $title = $product->name;
        $discription = $product->description;
        $image = $product->image;
        $url = url()->full();
        $shareComponent = \Share::page(
            url()->full(),
            'Best Book Seller',
        )
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
        return view('livewire.frontend.single-product',compact('shareComponent','title','url','image','discription','product', 'WebsiteInformations', 'releteds'));
    }
    public function singleCart($id){
        $Products = Products::find($id);

        if($Products->quantity > 0){
            $cart = session()->get('cart', []);
            if(isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    "id" => $Products->id,
                    "name" => $Products->name,
                    "quantity" => 1,
                    "price" => $Products->price,
                    "writer" => $Products->writers_id->name ?? 'N/A',
                    "writer_id" => $Products->writer_id ?? 'N/A',
                    "image" => $Products->image,
                ];
            }
            session()->put('cart', $cart);
            $this->dispatch(
                'alert',
                text : 'Cart Successfull',
                type : 'success'
            );
        }
        else{
            $this->dispatch(
                'alert',
                text : 'This Book is stock out',
                type : 'error'
            );
        }
    }
    public function incrementCart(){
        $this->quentity++;
    }
    public function decrementCart(){
        $this->quentity--;
    }
    public function singlepagecart($id){
        $Products = Products::find($id);
        if($Products->quantity > 0){
            $cart = session()->get('cart', []);
            if(isset($cart[$id])) {
                $cart[$id]['quantity'] += $this->quentity;
            } else {
                $cart[$id] = [
                    "id" => $Products->id,
                    "name" => $Products->name,
                    "quantity" => $this->quentity,
                    "price" => $Products->price,
                    "writer" => $Products->writers_id->name ?? 'N/A',
                    "writer_id" => $Products->writer_id ?? 'N/A',
                    "image" => $Products->image,
                ];
                $this->dispatch('updateCartCount');
            }
            session()->put('cart', $cart);
            $this->dispatch(
                'alert',
                text : 'Cart Successfull',
                type : 'success'
            );
        }
        else{
            $this->dispatch(
                'alert',
                text : 'This Book is stock out',
                type : 'error'
            );
        }
    }
}
