<?php

namespace App\Livewire\Backend;

use App\Models\Blogs;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class Blog extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $blog_id = '';
    public $title;
    public $subtitle;
    public $writer_name;
    public $image;
    public $oldimage = '';
    public $isEdit = false;
    protected $paginationTheme = 'bootstrap';

    public function mount(){

    }
    public function render()
    {
        $Blogs = Blogs::latest()->paginate(10);
        return view('livewire.backend.blog', compact('Blogs'));
    }
    public function submit(){

        $validated = $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'writer_name' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $fileName = "";
        if($this->image){
            $fileName = $this->image->store('Blog','public');
        }else{
            $fileName = null;
        }

        $done = Blogs::create([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'writer_name' => $this->writer_name,
            'image' => $fileName
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            session()->flash('success', 'Blog successfully Inserted.');
        }
    }
    public function update(){

        $validated = $this->validate([
            'title' => 'required',
            'subtitle' => 'required',
            'writer_name' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $fileName = "";
        $image_path = public_path('storage\\'.$this->oldimage);
        if(!empty($this->image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $fileName = $this->image->store('Blog','public');
        }else{
            $fileName = $this->oldimage;
        }

        $done = Blogs::where('id', $this->blog_id)->update([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'writer_name' => $this->writer_name,
            'image' => $fileName
        ]);

        if($done){
            $this->mount();
            $this->resetform();
            $this->isEdit = false;
            session()->flash('success', 'Blog successfully updated');
        }
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $blogEdit = Blogs::findOrFail($id);
        $this->blog_id = $blogEdit->id;
        $this->title = $blogEdit->title;
        $this->subtitle = $blogEdit->subtitle;
        $this->writer_name = $blogEdit->writer_name;
        $this->oldimage = $blogEdit->image;
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
    public function delete($id){

        $delete = Blogs::findOrFail($id);
        $this->oldimage = $delete->image;
        $image_path = public_path('storage\\'.$this->oldimage);
        if(File::exists($image_path)){
            File::delete($image_path);
        }
        $done = Blogs::findOrFail($id)->delete();
        if($done){
            $this->mount();
            session()->flash('error', 'Blog successfully Deleted');
        }
    }
    public function resetform(){
        $this->reset(['title']);
        $this->reset(['subtitle']);
        $this->reset(['image']);
        $this->reset(['writer_name']);
    }
}
