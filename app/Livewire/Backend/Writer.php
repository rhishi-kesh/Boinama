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

class Writer extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $cat_id = '';
    public $name = '';
    public $writer_image;
    public $old_writer_image;
    public $description;
    public $isEdit = false;
    public function mount(){

    }
    public function render()
    {
        $writers = Writers::Where('user_id', Auth::guard('admin')->user()->id)->latest()->paginate(10);
        return view('livewire.backend.writer', compact('writers'));
    }
    public function submit(){

        $validated = $this->validate([
            'name' => 'required|unique:writers',
            'description' => 'required',
            'writer_image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $name = $this->name;
        $slug = str_replace(" ", "-", $name);

        $fileName = "";
        if($this->writer_image){
            $fileName = $this->writer_image->store('Writer','public');
        }else{
            $fileName = null;
        }

        $done = Writers::create([
            'name' => $this->name,
            'description' => $this->description,
            'writer_image' => $fileName,
            'slug' => $slug,
            'user_id' => Auth::guard('admin')->user()->id
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            session()->flash('success', 'Writer successfully Inserted.');
        }
    }
    public function resetform(){
        $this->reset(['name']);
        $this->reset(['description']);
        $this->reset(['writer_image']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $writer = Writers::findOrFail($id);
        $this->cat_id = $writer->id;
        $this->name = $writer->name;
        $this->description = $writer->description;
        $this->old_writer_image = $writer->writer_image;
    }
    public function update(){
        $validated = $this->validate([
            'name' => 'required',
            'description' => 'required',
            'writer_image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $name = $this->name;
        $slug = str_replace(" ", "-", $name);

        $fileName = "";
        $image_path = public_path('storage\\'.$this->old_writer_image);
        if(!empty($this->writer_image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $fileName = $this->writer_image->store('Writer','public');
        }else{
            $fileName = $this->old_writer_image;
        }

        $done = Writers::where('id', $this->cat_id)->update([
            'name' => $this->name,
            'description' => $this->description,
            'writer_image' => $fileName,
            'slug' => $slug,
        ]);
        if($done){
            $this->resetform();
            $this->isEdit = false;
            $this->mount();
            session()->flash('success', 'Writer successfully updated');
        }
    }
    public function deletecategory($id){

        $slidedelete = Writers::findOrFail($id);
        $this->old_writer_image = $slidedelete->writer_image;
        $image_path = public_path('storage\\'.$this->old_writer_image);
        if(File::exists($image_path)){
            File::delete($image_path);
        }
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
