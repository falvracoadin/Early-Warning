<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Account;

class RiwayatPembayaran extends Component
{
    public $data;
    public $filter;
    public $off;
    public $limit;
    public $page;
    public $total;
    public $current;

    protected $rules = [
        'off' => 'numeric|required',
        'limit' => 'numeric|required',
        'total' => 'numeric|required',
        'filter' => 'alpha_dash|required',
        'page' => 'numeric|required',
        'current' => 'numeric|required',
        'data' => 'required',
    ];

    protected $listeners = [
        'next',
        'prev',
        'getPage'
    ];

    public function next(){
        if($this->current < $this->page and $this->current >= 1){
            $this->off += $this->limit;
            $this->current +=1;
            $this->getData();
        }
    }

    public function prev(){
        if($this->current <= $this->page and $this->current > 1){
            $this->off -= $this->limit;
            $this->current -=1;
            $this->getData();
        }
    }

    public function getPage($page){
        if($page >=1 and $page <= $this->page){
            $this->off = ($page-1)*$this->limit;
            $this->current = $page;
            $this->getData();
        }
    }

    public function updated($property){
        $this->validateOnly($property);
        if($property == 'filter'){
            $this->getData();
        }
    }

    public function getData(){
        $this->data = Account::getData(
            $this->off,
            $this->limit,
            $this->filter
        );
    }

    public function mount(){
        $this->fill([
            'off' => 0,
            'limit' => 1,
            'total' => Account::count(),
            'current' => 1,
            'filter' => 'customer_identifier'
        ]);
        $this->page = ceil($this->total/$this->limit);
        $this->getData();

    }
    public function render()
    {
        return view('livewire.riwayat-pembayaran');
    }
}
