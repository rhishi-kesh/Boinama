<?php

namespace App\Livewire\Frontend\Components;

use App\Models\categorys;
use App\Models\Prakasanis;
use App\Models\Subcategorys;
use App\Models\Subjects;
use App\Models\User;
use App\Models\WebsiteInformations;
use App\Models\Writers;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout('frontend.app')]

class Header extends Component
{
    public $cart_total = 0;
    protected $listeners = ['updateCartCount' => 'cartCount'];
    public function render()
    {
        $this->cartCount();
        $Subjects = Subjects::get();
        $Prakasanis = Prakasanis::get();
        $SubjectsIsNav = Subjects::where('is_nav', 0)->get();
        $PrakasanisIsNav = Prakasanis::where('is_nav', 0)->get();
        $Writers = Writers::get();
        $WebsiteInformations = WebsiteInformations::first();
        return view('livewire.frontend.components.header',compact('Subjects','Prakasanis','Writers','WebsiteInformations','SubjectsIsNav','PrakasanisIsNav'));
    }
    public function cartCount(){
        $cart = session()->get('cart');
        if (is_array($cart)) {
            $this->cart_total = count($cart);
        } else {

        }
    }
}
