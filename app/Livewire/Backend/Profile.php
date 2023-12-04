<?php

namespace App\Livewire\Backend;

use App\Models\Admins;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
#[Layout('layouts.app')]
class Profile extends Component
{

    use WithFileUploads;
    public $id;
    public $image;
    public $oldimage;
    public $name;
    public $email;
    public $old_Password;
    public $new_password;
    public $confirm_password;
    public function mount(){
    }
    public function render()
    {
        $userInfo = Admins::where('id', Auth::guard('admin')->user()->id)->first();
        $this->name = $userInfo->name;
        $this->email = $userInfo->email;
        $this->oldimage = $userInfo->profile_photo_path;
        $this->id = $userInfo->id;
        return view('livewire.backend.profile');
    }
    public function imageUpdate(){

        $userInfo = Admins::where('id', Auth::guard('admin')->user()->id)->first();
        $this->oldimage = $userInfo->profile_photo_path;

        $validated = $this->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $fileName = "";
        $image_path = public_path('storage\\'.$this->oldimage);
        if(!empty($this->image)){
            if(File::exists($image_path)){
                File::delete($image_path);
            }
            $fileName = $this->image->store('profile-photos','public');
        }else{
            $fileName = $this->oldimage;
        }

        $done = Admins::where('id', Auth::guard('admin')->user()->id)->update([
            'profile_photo_path' => $fileName
        ]);

        if($done){
            $this->mount();
            $this->resetform();
            session()->flash('success', 'Profile Image successfully updated');
        }
    }
    public function informationUpdate(){

        $validated = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $done = Admins::where('id', Auth::guard('admin')->user()->id)->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);
        if($done){
            $this->mount();
            session()->flash('success', 'Profile Information successfully updated');
        }
    }
    public function changePassword(){
        $validated = $this->validate([
            'new_password' => 'required|string|min:8|same:confirm_password',
        ]);

        if(Hash::check($this->old_Password, Auth::guard('admin')->user()->password)){
            $done = Admins::where('id', Auth::guard('admin')->user()->id)->update([
                'password' => Hash::make($this->new_password),
            ]);
            if($done){
                $this->mount();
                $this->resetform();
                session()->flash('success', 'User Password successfully updated');
            }
        }else{
            session()->flash('old','Old Password Not Correct');
        }
    }
    public function resetform(){
        $this->reset(['image']);
        $this->reset(['new_password']);
        $this->reset(['old_Password']);
        $this->reset(['confirm_password']);
    }
}
