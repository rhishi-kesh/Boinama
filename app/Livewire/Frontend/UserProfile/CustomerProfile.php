<?php

namespace App\Livewire\Frontend\UserProfile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
#[Layout('frontend.app')]

class CustomerProfile extends Component
{
    use WithPagination;
    public $id;
    public $image;
    public $oldimage;
    public $name;
    public $email;
    public $number;
    public $address;
    public $old_Password;
    public $new_password;
    public $confirm_password;
    protected $paginationTheme = 'bootstrap';
    public function mount(){

    }
    public function render()
    {
        $userInfo = User::where('id', Auth::guard('web')->user()->id)->first();
        $this->name = $userInfo->name;
        $this->email = $userInfo->email;
        $this->number = $userInfo->number;
        $this->address = $userInfo->address;
        $this->oldimage = $userInfo->profile_photo_path;
        $this->id = $userInfo->id;
        $title = 'My Profile';
        $url = url()->full();
        return view('livewire.frontend.user-profile.customer-profile', compact('title','url'));
    }
    public function informationUpdate(){
        $validated = $this->validate([
            'name' => 'required',
            'number' => 'nullable|regex:/^(?:\+?88)?01[35-9]\d{8}$/',
            'address' => 'nullable',
            'email' => 'required|email',
        ]);
        $done = User::where('id', Auth::guard('web')->user()->id)->update([
            'name' => $this->name,
            'email' => $this->email,
            'number' => $this->number,
            'address' => $this->address,
        ]);
        if($done){
            $this->mount();
            $this->dispatch(
                'alert',
                text : 'Information Updated',
                type : 'success'
            );
        }
    }
    public function changePassword(){
        $validated = $this->validate([
            'new_password' => 'required|string|min:8|same:confirm_password',
        ]);

        if(Hash::check($this->old_Password, Auth::guard('web')->user()->password)){
            $done = User::where('id', Auth::guard('web')->user()->id)->update([
                'password' => Hash::make($this->new_password),
            ]);
            if($done){
                $this->mount();
                $this->resetform();
                $this->dispatch(
                    'alert',
                    text : 'Password Changed',
                    type : 'success'
                );
            }
        }else{
            session()->flash('old','Old Password Not Correct');
        }
    }
    public function resetform(){
        $this->reset(['new_password']);
        $this->reset(['old_Password']);
        $this->reset(['confirm_password']);
    }
}
