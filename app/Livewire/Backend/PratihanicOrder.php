<?php

namespace App\Livewire\Backend;

use App\Models\Corporates;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class PratihanicOrder extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $corporate_id = '';
    public $title;
    public $subtitle;
    public $number;
    public $gmail;
    public $image;

    public $oldimage = '';
    public $isEdit = false;
    protected $paginationTheme = 'bootstrap';

    public function mount(){

    }
    public function render()
    {
        $corporates = Corporates::first();
        return view('livewire.backend.pratihanic-order', compact('corporates'));
    }
    public function update(){

        $validated = $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'number' => 'required',
            'gmail' => 'required|email',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $fileName = "";
        $image_path = public_path('storage\\'.$this->oldimage);
        if(!empty($this->image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $fileName = $this->image->store('Corporates','public');
        }else{
            $fileName = $this->oldimage;
        }

        $done = Corporates::where('id', $this->corporate_id)->update([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'number' => $this->number,
            'gmail' => $this->gmail,
            'image' => $fileName
        ]);

        if($done){
            $this->mount();
            $this->resetform();
            $this->isEdit = false;
            session()->flash('success', 'successfully updated');
        }
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $corporateEdit = Corporates::findOrFail($id);
        $this->corporate_id = $corporateEdit->id;
        $this->title = $corporateEdit->title;
        $this->subtitle = $corporateEdit->subtitle;
        $this->number = $corporateEdit->number;
        $this->gmail = $corporateEdit->gmail;
        $this->oldimage = $corporateEdit->image;
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
    public function resetform(){
        $this->reset(['title']);
        $this->reset(['subtitle']);
        $this->reset(['number']);
        $this->reset(['gmail']);
        $this->reset(['image']);
    }
}
