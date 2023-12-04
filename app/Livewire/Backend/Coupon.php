<?php

namespace App\Livewire\Backend;

use App\Models\Coupon as ModelsCoupon;
use Illuminate\Support\Facades\File;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class Coupon extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $coupon_id = '';
    public $code = '';
    public $amount = '';
    public $expire = '';
    public $isEdit = false;
    protected $paginationTheme = 'bootstrap';

    public function mount(){

    }
    public function render()
    {
        $coupons = ModelsCoupon::latest()->paginate(4);
        return view('livewire.backend.coupon', compact('coupons'));
    }
    public function submit(){

        $validated = $this->validate([
            'code' => 'required|unique:coupons',
            'amount' => 'required|numeric|min:1|max:100',
            'expire' => 'required',
        ]);


        $done = ModelsCoupon::create([
            'code' => $this->code,
            'amount' => $this->amount,
            'expire_date' => $this->expire,
        ]);

        if($done){
            $this->resetform();
            $this->mount();
            session()->flash('success', 'Coupon successfully Inserted.');
        }
    }
    public function resetform(){
        $this->reset(['code']);
        $this->reset(['amount']);
        $this->reset(['expire']);
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
    public function status(ModelsCoupon $sliders){
        if($sliders->status == 0){
            $sliders->status = 1;
            $sliders->save();
        }else{
            $sliders->status = 0;
            $sliders->save();
        }
    }
    public function delete($id){
        $done = ModelsCoupon::findOrFail($id)->delete();
        if($done){
            $this->mount();
            session()->flash('error', 'Coupon successfully Deleted');
        }
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $categorysEdit = ModelsCoupon::findOrFail($id);
        $this->coupon_id = $categorysEdit->id;
        $this->code = $categorysEdit->code;
        $this->amount = $categorysEdit->amount;
        $this->expire = $categorysEdit->expire_date;
    }
    public function update(){
        $validated = $this->validate([
            'code' => 'required',
            'amount' => 'required',
            'expire' => 'required',
        ]);

        $done = ModelsCoupon::where('id', $this->coupon_id)->update([
            'code' => $this->code,
            'amount' => $this->amount,
            'expire_date' => $this->expire,
        ]);

        if($done){
            $this->resetform();
            $this->isEdit = false;
            $this->mount();
            session()->flash('success', 'Coupon successfully updated');
        }
    }
}
