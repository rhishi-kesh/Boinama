<?php

namespace App\Livewire\Backend;

use App\Models\WebsiteInformations;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
#[Layout('layouts.app')]

class WebsiteInformation extends Component
{
    public $webinfo_id = '';
    public $image;
    public $address = '';
    public $number = '';
    public $gmail = '';
    public $facebook = '';
    public $linkedin = '';
    public $youtube = '';
    public $twitter = '';
    public $fabout = '';
    public $instragram = '';
    public $oldimage = '';

    use WithFileUploads;

    public function mount(){

    }
    public function render()
    {
        $webinformation = WebsiteInformations::first();
        $this->webinfo_id = $webinformation->id;
        $this->oldimage = $webinformation->image;
        $this->address = $webinformation->address;
        $this->number = $webinformation->number;
        $this->gmail = $webinformation->gmail;
        $this->facebook = $webinformation->facebook;
        $this->linkedin = $webinformation->linkedin;
        $this->youtube = $webinformation->youtube;
        $this->twitter = $webinformation->twitter;
        $this->instragram = $webinformation->instragram;
        $this->fabout = $webinformation->fabout;
        return view('livewire.backend.website-information');
    }

    public function update(){
        $fileName = "";
        $image_path = public_path('storage\\'.$this->oldimage);
        if(!empty($this->image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $fileName = $this->image->store('Logo','public');
        }else{
            $fileName = $this->oldimage;
        }

        $done = WebsiteInformations::where('id', $this->webinfo_id)->update([
            'image' => $fileName,
            'address' => $this->address,
            'number' => $this->number,
            'gmail' => $this->gmail,
            'facebook' => $this->facebook,
            'linkedin' => $this->linkedin,
            'youtube' => $this->youtube,
            'twitter' => $this->twitter,
            'instragram' => $this->instragram,
            'fabout' => $this->fabout,
        ]);

        if($done){
            $this->mount();
            session()->flash('success', 'Website Information successfully updated');
        }
    }
}
