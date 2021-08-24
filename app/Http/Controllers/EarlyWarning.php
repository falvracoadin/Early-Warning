<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EarlyWarning extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function statisticsView(){
        return view('early-warning',[
            'vcont' => 'statistics',
            'data' => [],
        ]);
    }
    public function statistics(){
        return [];
    }

    public function warningView(){
        return view('early-warning',[
            'vcont' => 'warning'
        ]);
    }
}
