<?php

namespace App\Livewire\Backend;

use Livewire\Component;
use App\Models\Prakasanis;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class Prakasani extends Component
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
        $prakasanis = Prakasanis::Where('user_id', Auth::guard('admin')->user()->id)->latest()->paginate(10);
        return view('livewire.backend.prakasani', compact('prakasanis'));
    }
    public function submit(){

        $validated = $this->validate([
            'name' => 'required',
        ]);

        $name = $this->name;
        $slug = str_replace(" ", "-", $name);


        $done = Prakasanis::create([
            'name' => $this->name,
            'slug' => $slug,
            'user_id' => Auth::guard('admin')->user()->id
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            session()->flash('success', 'Prakasani successfully Inserted.');
        }
    }
    public function resetform(){
        $this->reset(['name']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $categorysEdit = Prakasanis::findOrFail($id);
        $this->cat_id = $categorysEdit->id;
        $this->name = $categorysEdit->name;
    }
    public function update(){
        $validated = $this->validate([
            'name' => 'required',
        ]);

        $name = $this->name;
        $slug = str_replace(" ", "-", $name);

        $done = Prakasanis::where('id', $this->cat_id)->update([
            'name' => $this->name,
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

}
