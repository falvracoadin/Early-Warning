<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nasabah;

class DaftarNasabah extends Component
{
    public $filter;
    public $off;
    public $limit;
    public $page;
    public $total;
    public $current;
    public $data;

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

    public function getPage($page){
        if($page >= 1 and $page <= $this->page){
            $this->off = ($page-1)*$this->limit;
            $this->current = $page;
            $this->getData();
        }
    }

    public function next(){
        if($this->current < $this->page){
            $this->current += 1;
            $this->off += $this->limit;
            $this->getData();
        }
    }

    public function prev(){
        if($this->current > 0){
            $this->current -=1;
            $this->off -= $this->limit;
            $this->getData();
        }
    }
    public function getData(){
        $this->data = Nasabah::getNasabah(
            $this->off,
            $this->limit,
            $this->filter
        );
    }


    public function updated($property){
        $this->validateOnly($property);
        if($property == 'filter'){
            if(!in_array($this->filter, config('app.filterInfo')['daftarNasabah'])){
                $this->filter = 'id';
            }
            $this->getData();
        }
    }


    public function mount($filter){
        $this->fill([
            'filter' => $filter,
            'off' => 0,
            'limit' => 3,
            'total' => Nasabah::count(),
            'current' => 1,
        ]);
        $this->page = ceil($this->total/$this->limit);
        $this->getData();
    }


    public function render()
    {
        return view('livewire.daftar-nasabah');
    }
}
