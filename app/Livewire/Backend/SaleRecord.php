<?php

namespace App\Livewire\Backend;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
#[Layout('layouts.app')]

class SaleRecord extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $startDate = '';
    public $endDate = '';
    public $records = [];
    public $total = 00;
    public $isShow = false;
    public function render()
    {
        return view('livewire.backend.sale-record');
    }
    public function submit(){
        $this->records = Order::where('status', 'd');

        try{
            if(isset($this->startDate) && $this->startDate != '' && isset($this->endDate) && $this->endDate != '') {
                $this->records = $this->records->whereBetween('created_at', [$this->startDate . " 00:00:00", $this->endDate . " 23:59:59"])->latest()->get();
                if($this->records){
                    $this->isShow = true;
                }else{
                    $this->records = 'No Data Found';
                }
            }else{
                $this->records = 'No Data Found';
            }
        }catch(\Throwable $e){
            $this->dispatch(
                'alert',
                text : 'Select Date',
                type : 'error'
            );
        }
    }
}
