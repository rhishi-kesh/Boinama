<?php

namespace App\Livewire\Backend;

use App\Models\ShippingFee as ModelsShippingFee;
use Livewire\Component;
use Livewire\Attributes\Layout;
#[Layout('layouts.app')]

class ShippingFee extends Component
{
    public $fee_id = '';
    public $fee = '';
    public $isEdit = false;
    protected $paginationTheme = 'bootstrap';
    public function mount(){

    }
    public function render()
    {
        $shippingFees = ModelsShippingFee::latest()->get();
        return view('livewire.backend.shipping-fee', compact('shippingFees'));
    }
    public function resetform(){
        $this->reset(['fee']);
    }
    public function changeEdit($id){
        $this->isEdit = true;
        $shippingFee = ModelsShippingFee::findOrFail($id);
        $this->fee_id = $shippingFee->id;
        $this->fee = $shippingFee->fee;
    }
    public function removeedit(){
        $this->isEdit = false;
        $this->resetform();
    }
    public function update(){

        $validated = $this->validate([
            'fee' => 'required',
        ]);

        $done = ModelsShippingFee::where('id', $this->fee_id)->update([
            'fee' => $this->fee
        ]);

        if($done){
            $this->mount();
            $this->resetform();
            $this->isEdit = false;
            session()->flash('success', 'Shipping Fee Successfully Updated');
        }
    }
}
