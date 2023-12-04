<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Prakasanis;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class AllPrakasanis extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $sub_id = '';
    public $name = '';
    public $image;
    public $oldimage;
    public $isEdit = false;
    public function mount(){

    }
    public function render()
    {
        $prakasanis = Prakasanis::latest()->paginate(10);
        return view('livewire.backend.all-prakasanis', compact('prakasanis'));
    }
    public function resetform(){
        $this->reset(['name']);
        $this->reset(['image']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $categorysEdit = Prakasanis::findOrFail($id);
        $this->sub_id = $categorysEdit->id;
        $this->name = $categorysEdit->name;
        $this->oldimage = $categorysEdit->image;
    }
    public function update(){
        $validated = $this->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $name = $this->name;
        $image = $this->image;
        $slug = str_replace(" ", "-", $name);

        $fileName = "";
        $image_path = public_path('storage\\'.$this->oldimage);
        if(!empty($this->image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $fileName = $this->image->store('AllProkashoni','public');
        }

        $done = Prakasanis::where('id', $this->sub_id)->update([
            'name' => $this->name,
            'image' => $fileName,
            'slug' => $slug
        ]);
        if($done){
            $this->resetform();
            $this->isEdit = false;
            $this->mount();
            session()->flash('success', 'Prakasani successfully updated');
        }
    }
    public function deletecategory($id){
        $done = Prakasanis::findOrFail($id)->delete();
        if($done){
            $this->mount();
            session()->flash('error', 'Prakasani successfully Deleted');
        }
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
    public function status(Prakasanis $prakasanis){
        if($prakasanis->is_nav == 0){
            $prakasanis->is_nav = 1;
            $prakasanis->save();
        }else{
            $prakasanis->is_nav = 0;
            $prakasanis->save();
        }
    }
}
