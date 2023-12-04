<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Writers;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Livewire\WithFileUploads;
#[Layout('layouts.app')]

class AllWriters extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $cat_id = '';
    public $name = '';
    public $writer_image;
    public $old_writer_image;
    public $description;
    public $image;
    public $oldimage;
    public $isEdit = false;
    public function mount(){

    }
    public function render()
    {
        $writers = Writers::latest()->paginate(10);
        return view('livewire.backend.all-writers', compact('writers'));
    }
    public function resetform(){
        $this->reset(['name']);
        $this->reset(['description']);
        $this->reset(['writer_image']);
        $this->reset(['image']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $writerEdit = Writers::findOrFail($id);
        $this->cat_id = $writerEdit->id;
        $this->name = $writerEdit->name;
        $this->description = $writerEdit->description;
        $this->old_writer_image = $writerEdit->writer_image;
        $this->oldimage = $writerEdit->image;
    }
    public function update(){
        $validated = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'writer_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $name = $this->name;
        $image = $this->image;
        $slug = str_replace(" ", "-", $name);

        $writerimagefile = "";
        $image_path = public_path('storage\\'.$this->old_writer_image);
        if(!empty($this->writer_image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $writerimagefile = $this->writer_image->store('Writer','public');
        }else{
            $writerimagefile = $this->old_writer_image;
        }

        $bannerimagefile = "";
        $image_path = public_path('storage\\'.$this->oldimage);
        if(!empty($this->image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $bannerimagefile = $this->image->store('AllSubject','public');
        }
        $done = Writers::where('id', $this->cat_id)->update([
            'name' => $this->name,
            'description' => $this->description,
            'writer_image' => $writerimagefile,
            'image' => $bannerimagefile,
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
        $done = Writers::findOrFail($id)->delete();
        if($done){
            $this->mount();
            session()->flash('error', 'Prakasani successfully Deleted');
        }
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
}
