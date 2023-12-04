<?php

namespace App\Livewire\Backend;

use App\Models\categorys;
use App\Models\Prakasanis;
use App\Models\Products;
use App\Models\Subjects;
use App\Models\Writers;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class PaddingProduct extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $product_id = '';
    public $name;
    public $price;
    public $discount;
    public $quantity;
    public $writer_id = null;
    public $subject_id = null;
    public $prakasani_id = null;
    public $image;
    public $preview;
    public $previewimage;
    public $description;
    public $oldimageproduct = '';
    public $oldimagepreview = '';
    public $p_id;
    public $search = '';
    public $perPage = 15;
    public $isadd = false;
    public $isedit = false;
    public $isview = false;
    public function mount(){
    }
    public function render()
    {
        $subjects = Subjects::get();
        $prakasanis = Prakasanis::get();
        $writers = Writers::get();
        $Products = Products::search($this->search)->where('status', 1)->latest()->paginate($this->perPage);
        return view('livewire.backend.padding-product', compact('Products', 'writers', 'prakasanis', 'subjects'));
    }
    public function status(Products $products){
        if($products->status == 0){
            $products->status = 1;
            $products->save();
        }else{
            $products->status = 0;
            $products->save();
        }
        $this->mount();
    }
    public function delete($id){
        $productdelete = Products::findOrFail($id);
        $this->oldimageproduct = $productdelete->image;
        $Pimage = public_path('storage\\'.$this->oldimageproduct);
        if(File::exists($Pimage)){
            File::delete($Pimage);
        }


        $this->oldimagepreview = $productdelete->preview;
        $Ppreview = public_path('storage\\'.$this->oldimagepreview);
        if(File::exists($Ppreview)){
            File::delete($Ppreview);
        }

        $done = Products::findOrFail($id)->delete();
        if($done){
            $this->mount();
            session()->flash('error', 'Slider successfully Deleted');
        }
    }
    public function view($id){
        $productEdit = Products::findOrFail($id);
        $this->p_id = $productEdit->id;
        $this->name = $productEdit->name;
        $this->price = $productEdit->price;
        $this->discount = $productEdit->discount;
        $this->quantity = $productEdit->quantity;
        $this->writer_id = $productEdit->prakasanis_id->name;
        $this->subject_id = $productEdit->subjects_id->name;
        $this->prakasani_id = $productEdit->writers_id->name;
        $this->previewimage = $productEdit->image;
        $this->preview = $productEdit->preview;
        $this->description = $productEdit->description;
        $this->isview = true;
    }
    public function showtable(){
        $this->isedit = false;
        $this->isview = false;
    }
    public function showEdit($id)
    {
        $productEdit = Products::findOrFail($id);
        $this->p_id = $productEdit->id;
        $this->name = $productEdit->name;
        $this->price = $productEdit->price;
        $this->discount = $productEdit->discount;
        $this->quantity = $productEdit->quantity;
        $this->writer_id = $productEdit->writer_id ?? "N/A";
        $this->subject_id = $productEdit->subject_id ?? "N/A";
        $this->prakasani_id = $productEdit->prakasani_id ?? "N/A";
        $this->oldimageproduct = $productEdit->image;
        $this->oldimagepreview = $productEdit->preview;
        $this->description = $productEdit->description;
        $this->isedit = true;
    }
    public function update(){
        $validated = $this->validate([
            'name' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'quantity' => 'required',
            'writer_id' => 'required',
            'subject_id' => 'required',
            'prakasani_id' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'preview' => 'nullable|file|mimes:pdf|max:2048'
        ]);

        $name = $this->name;
        $slug = str_replace(" ", "-", $name);

        $Pimage = "";
        $productimage_path = public_path('storage\\'.$this->oldimageproduct);
        if(!empty($this->image)){
            if(File::exists($productimage_path)){
                File::delete($productimage_path);
            }
            $Pimage = $this->image->store('Product','public');
        }else{
            $Pimage = $this->oldimageproduct;
        }

        $Ppreview = "";
        $previewimage_path = public_path('storage\\'.$this->oldimagepreview);
        if(!empty($this->preview)){
            if(File::exists($previewimage_path)){
                File::delete($previewimage_path);
            }
            $Ppreview = $this->preview->store('Preview','public');
        }else{
            $Ppreview = $this->oldimagepreview;
        }
        $done = Products::where('id', $this->p_id)->update([
            'name' => $this->name,
            'price' => $this->price,
            'discount' => $this->discount,
            'quantity' => $this->quantity,
            'writer_id' => $this->writer_id,
            'subject_id' => $this->subject_id,
            'prakasani_id' => $this->prakasani_id,
            'image' => $Pimage,
            'slug' => $slug,
            'preview' => $Ppreview,
            'description' => $this->description,
        ]);

        if($done){
            $this->mount();
            $this->resetform();
            $this->isedit = false;
            session()->flash('success', 'Product successfully updated');
        }
    }
    public function resetform(){
        $this->reset(['name']);
        $this->reset(['price']);
        $this->reset(['discount']);
        $this->reset(['quantity']);
        $this->reset(['writer_id']);
        $this->reset(['subject_id']);
        $this->reset(['prakasani_id']);
        $this->reset(['image']);
        $this->reset(['preview']);
        $this->reset(['description']);
    }
}
