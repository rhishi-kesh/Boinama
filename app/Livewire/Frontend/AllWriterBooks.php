<?php

namespace App\Livewire\Frontend;

use App\Models\Prakasanis;
use App\Models\Products;
use App\Models\Subjects;
use App\Models\Writers;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('frontend.app')]

class AllWriterBooks extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $id;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        $products = Products::where('writer_id', $this->id)->where('status', 0)->where('is_active', 0)->latest()->paginate(20);
        $Subjects = Subjects::get();
        $Prakasanis = Prakasanis::get();
        $Writers = Writers::get();
        $alllwriter = Writers::where('id', $this->id)->first();
        $title = $alllwriter->name;
        $url = url()->full();
        return view('livewire.frontend.all-writer-books', compact('title','url','alllwriter','products','Subjects','Prakasanis','Writers'));
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
