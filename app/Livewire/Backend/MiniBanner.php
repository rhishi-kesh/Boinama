<?php

namespace App\Livewire\Backend;

use App\Models\MiniBanners;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class MiniBanner extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $banner_id = '';
    public $image;
    public $oldimage = '';
    public $link = '';
    public $isEdit = false;
    protected $paginationTheme = 'bootstrap';

    public function mount(){

    }
    public function render()
    {
        $Banners = MiniBanners::latest()->paginate(8);
        return view('livewire.backend.mini-banner',[
            'Banners' => $Banners
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
            $fileName = $this->image->store('MiniBanners','public');
        }else{
            $fileName = null;
        }

        $done = MiniBanners::create([
            'image' => $fileName,
            'link' => $this->link
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            session()->flash('success', 'MiniBanner successfully Inserted.');
        }
    }
    public function resetform(){
        $this->reset(['image']);
        $this->reset(['link']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $bannerEdit = MiniBanners::findOrFail($id);
        $this->banner_id = $bannerEdit->id;
        $this->oldimage = $bannerEdit->image;
        $this->link = $bannerEdit->link;
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
            $fileName = $this->image->store('MiniBanners','public');
        }else{
            $fileName = $this->oldimage;
        }

        $done = MiniBanners::where('id', $this->banner_id)->update([
            'image' => $fileName,
            'link' => $this->link
        ]);

        if($done){
            $this->mount();
            $this->resetform();
            $this->isEdit = false;
            session()->flash('success', 'Banner successfully updated');
        }
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
    public function deletecategory($id){

        $slidedelete = MiniBanners::findOrFail($id);
        $this->oldimage = $slidedelete->image;
        $image_path = public_path('storage\\'.$this->oldimage);
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        $done = MiniBanners::findOrFail($id)->delete();
        if($done){
            $this->mount();
            session()->flash('error', 'MiniBanner successfully Deleted');
        }
    }
    public function status(MiniBanners $sliders){
        if($sliders->status == 0){
            $sliders->status = 1;
            $sliders->save();
        }else{
            $sliders->status = 0;
            $sliders->save();
        }
    }
}
