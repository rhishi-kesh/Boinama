<?php

namespace App\Livewire\Backend;

use App\Models\Sliders;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class Slider extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $slider_id = '';
    public $image;
    public $oldimage = '';
    public $link = '';
    public $isEdit = false;
    protected $paginationTheme = 'bootstrap';

    public function mount(){

    }
    public function render()
    {
        $Sliders = Sliders::latest()->paginate(10);
        return view('livewire.backend.slider',[
            'Sliders' => $Sliders
        ]);
    }
    public function submit(){

        $image = $this->image;
        $link = $this->link;

        $validated = $this->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $fileName = "";
        if($this->image){
            $fileName = $this->image->store('Sliders','public');
        }else{
            $fileName = null;
        }

        $done = Sliders::create([
            'image' => $fileName,
            'link' => $this->link
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            session()->flash('success', 'Slider successfully Inserted.');
        }
    }
    public function resetform(){
        $this->reset(['image']);
        $this->reset(['link']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $sliderEdit = Sliders::findOrFail($id);
        $this->slider_id = $sliderEdit->id;
        $this->oldimage = $sliderEdit->image;
        $this->link = $sliderEdit->link;
    }
    public function update(){

        $image = $this->image;
        $link = $this->link;

        $validated = $this->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $fileName = "";
        $image_path = public_path('storage\\'.$this->oldimage);
        if(!empty($this->image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $fileName = $this->image->store('Sliders','public');
        }else{
            $fileName = $this->oldimage;
        }

        $done = Sliders::where('id', $this->slider_id)->update([
            'image' => $fileName,
            'link' => $this->link
        ]);

        if($done){
            $this->mount();
            $this->resetform();
            $this->isEdit = false;
            session()->flash('success', 'Slider successfully updated');
        }
    }
    public function deletecategory($id){

        $slidedelete = Sliders::findOrFail($id);
        $this->oldimage = $slidedelete->image;
        $image_path = public_path('storage\\'.$this->oldimage);
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        $done = Sliders::findOrFail($id)->delete();
        if($done){
            $this->mount();
            session()->flash('error', 'Slider successfully Deleted');
        }
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
    public function status(Sliders $sliders){
        if($sliders->status == 0){
            $sliders->status = 1;
            $sliders->save();
        }else{
            $sliders->status = 0;
            $sliders->save();
        }
    }
}
