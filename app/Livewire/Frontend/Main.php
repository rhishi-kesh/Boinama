<?php

namespace App\Livewire\Frontend;


use App\Models\MiniBanners;
use App\Models\Products;
use App\Models\Sliders;
use App\Models\Subjects;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class Main extends Component
{
    public function render()
    {
        $sliders = Sliders::where('status', 0)->get();
        $miniBanners = MiniBanners::where('status', 0)->get();
        $latest = Products::where('status', 0)->where('is_active', 0)->latest()->take(10)->get();
        $subjects = Subjects::where('status', 0)->get();
        $top_sales = DB::table('products')
            ->leftJoin('order_details','products.id','=','order_details.product_id')
            ->selectRaw('products.id, SUM(order_details.quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(10)
            ->get();
            $topProducts = [];
        foreach ($top_sales as $s){
            $p = Products::findOrFail($s->id);
            $p->totalQty = $s->total;
            $topProducts[] = $p;
        }
        $url = url()->full();
        return view('livewire.frontend.main', compact('url','sliders','miniBanners','latest','subjects','topProducts'));
    }
    public function singleCart($id){
        $Products = Products::findOrFail($id);

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
