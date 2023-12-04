<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Subjects;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class Subject extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $cat_id = '';
    public $name = '';
    public $isEdit = false;
    public function mount(){

    }
    public function render()
    {
        $subjects = Subjects::Where('user_id', Auth::guard('admin')->user()->id)->latest()->paginate(10);
        return view('livewire.backend.subject',compact('subjects'));
    }
    public function submit(){

        $validated = $this->validate([
            'name' => 'required',
        ]);

        $name = $this->name;
        $slug = str_replace(" ", "-", $name);


        $done = Subjects::create([
            'name' => $this->name,
            'slug' => $slug,
            'user_id' => Auth::guard('admin')->user()->id
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            session()->flash('success', 'Subject successfully Inserted.');
        }
    }
    public function resetform(){
        $this->reset(['name']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $categorysEdit = Subjects::findOrFail($id);
        $this->cat_id = $categorysEdit->id;
        $this->name = $categorysEdit->name;
    }
    public function update(){
        $validated = $this->validate([
            'name' => 'required',
        ]);

        $name = $this->name;
        $slug = str_replace(" ", "-", $name);

        $done = Subjects::where('id', $this->cat_id)->update([
            'name' => $this->name,
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
}
