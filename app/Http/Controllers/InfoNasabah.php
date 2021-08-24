<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;

class InfoNasabah extends Controller
{
    private $filterInfo = [
        'daftarNasabah' => [
            'nama', 'nik', 'pekerjaan', 'usia', 'besarPinjaman'
        ],
        'klasifikasiNasabah' => [
            'besarPinjaman', 'pekerjaan', 'usia'
        ],
    ];


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function klasifikasiNasabah(){
        return view('info-nasabah',[
            'vcont' => 'klasifikasi-nasabah',
            'filter' => 'pekerjaan',
            'data' => Nasabah::getGroup('pekerjaan','pekerjaan'),
        ]);
    }

    public function getKlasifikasiData(Request $request){
        $filter = $request->input('filter');
        if(in_array($filter, config('app.filterInfo.klasifikasiNasabah'))){
            $data = Nasabah::getGroup($filter,$filter);
            if($filter == 'besar_pinjaman'){
                foreach($data as &$dt){
                    $dt['label'] ='Rp. ' . number_format(
                        $dt['label'],
                        0, ',','.'
                    ). ',-';
                }
            }
            $json = [
                'data'=> $data,
                'filter' => $filter,
            ];
            return json_encode($json);
        }
        return $filter;
    }


    public function daftarNasabah($filter = false, Request $request){
        if(!$filter){
            return view('info-nasabah',[
                'vcont' => 'daftar-nasabah',
                'filter' => 'id',
            ]);
        }

        $validated = $request->validate([
            'filter' => 'alpha_dash'
        ]);

        if(in_array($validated['filter'], $this->filterInfo['daftarNasabah'])){
            return view('info-nasabah',[
                'vcont' => 'daftar-nasabah',
                'filter' => $filter,
            ]);
        }
        return;
    }

    public function filterKlasifikasiNasabah($filter){
        if(in_array($filter,$this->filterInfo['klasifikasiNasabah'])){
            return view('klasifikasi-nasabah',[
                'dataKlasifikasi' => '',
            ]);
        }
        return;
    }
}
