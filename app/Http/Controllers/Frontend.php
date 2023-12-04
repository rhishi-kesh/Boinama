<?php

namespace App\Http\Controllers;

use App\Models\Prakasanis;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Subjects;
use App\Models\Writers;
use Livewire\Attributes\Layout;
#[Layout('frontend.app')]

class Frontend extends Controller
{
    public function main(){
        return view("frontend.app");
    }
    public function search(Request $request){
        $type = $request->book;
        if(isset($type) && trim($type) !== '') {
            $products = Products::where('name','LIKE','%'.$type.'%')
                ->where('status', 0)
                ->where('is_active', 0)
                ->latest()
                ->paginate(20);
            $Subjects = Subjects::get();
            $Prakasanis = Prakasanis::get();
            $Writers = Writers::get();
            return view('livewire.frontend.search', compact('Subjects','Prakasanis', 'Writers', 'products'));
        } else {
            return redirect('/');
        }
    }
}
