<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Subjects;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class AllSubjects extends Component
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
        $subjects = Subjects::latest()->paginate(10);
        return view('livewire.backend.all-subjects', compact('subjects'));
    }
    public function resetform(){
        $this->reset(['name']);
        $this->reset(['image']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $categorysEdit = Subjects::findOrFail($id);
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
            $fileName = $this->image->store('AllSubject','public');
        }

        $done = Subjects::where('id', $this->sub_id)->update([
            'name' => $this->name,
            'image' => $fileName,
            'slug' => $slug
        ]);
        if($done){
            $this->resetform();
            $this->isEdit = false;
            $this->mount();
            session()->flash('success', 'Subject successfully updated');
        }
    }
    public function deletecategory($id){
        $done = Subjects::findOrFail($id)->delete();
        if($done){
            $this->mount();
            session()->flash('error', 'Subject successfully Deleted');
        }
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
    public function status(Subjects $subjects){
        if($subjects->is_nav == 0){
            $subjects->is_nav = 1;
            $subjects->save();
        }else{
            $subjects->is_nav = 0;
            $subjects->save();
        }
    }
}
