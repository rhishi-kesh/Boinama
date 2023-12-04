<?php

namespace App\Livewire\Backend;


use App\Models\Prakasanis;
use App\Models\Writers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Products;
use App\Models\Subjects;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class AllProducts extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $product_id = '';
    public $name;
    public $price;
    public $discount;
    public $quantity;
    public $writer_id = '';
    public $subject_id = '';
    public $prakasani_id = '';
    public $image;
    public $previewimage;
    public $preview;
    public $description;
    public $oldimageproduct = '';
    public $oldimagepreview = '';
    public $p_id;
    public $search = '';
    public $perPage = 15;
    public $isadd = false;
    public $isedit = false;
    public $isview = false;
    protected $paginationTheme = 'bootstrap';
    public function mount(){

    }
    public function render()
    {
        $Products = Products::search($this->search)->where('status', 0)->latest()->paginate($this->perPage);
        $subjects = Subjects::get();
        $prakasanis = Prakasanis::get();
        $writers = Writers::get();
        return view('livewire.backend.all-products', compact('Products','subjects','prakasanis','writers'));
    }
    public function removeadd()
    {
        $this->isadd = true;
        $this->resetform();
    }
    public function showtable(){
        $this->isadd = false;
        $this->isedit = false;
        $this->isview = false;
    }
    public function showview($id){
        $productEdit = Products::findOrFail($id);
        $this->p_id = $productEdit->id;
        $this->name = $productEdit->name;
        $this->price = $productEdit->price;
        $this->discount = $productEdit->discount;
        $this->quantity = $productEdit->quantity;
        $this->writer_id = $productEdit->prakasanis_id->name ?? "N/A";
        $this->subject_id = $productEdit->subjects_id->name ?? "N/A";
        $this->prakasani_id = $productEdit->writers_id->name ?? "N/A";
        $this->previewimage = $productEdit->image;
        $this->description = $productEdit->description;
        $this->preview = $productEdit->preview;
        $this->isview = true;
    }
    public function showEdit($id)
    {
        $productEdit = Products::findOrFail($id);
        $this->p_id = $productEdit->id;
        $this->name = $productEdit->name;
        $this->price = $productEdit->price;
        $this->discount = $productEdit->discount;
        $this->quantity = $productEdit->quantity;
        $this->writer_id = $productEdit->writer_id;
        $this->subject_id = $productEdit->subject_id;
        $this->prakasani_id = $productEdit->prakasani_id;
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
    public function status(Products $sliders){
        if($sliders->is_active == 0){
            $sliders->is_active = 1;
            $sliders->save();
        }else{
            $sliders->is_active = 0;
            $sliders->save();
        }
    }
}
