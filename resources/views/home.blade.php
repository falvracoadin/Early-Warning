@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Home</h1>
@stop

@section('content')
<div>
    <div class="card" id="daftar-nasabah">
        <div class="card-header">
            <h3>Informasi Aplikasi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0 content-home">
            <div class="desc">
                <p>
                    Aplikasi Sistem Early Warning System dibuat untuk membantu para pihak Bank dalam mendeteksi kemacetan kredit yaitu bertujuan untuk memperkecil resiko kredit.
                </p>
            </div>
            <div class="count">
                <ul>
                    <li>
                        Jumlah Nasabah <span>1000</span>
                    </li>
                    <li>
                        Jumlah Pengguna Hari ini <span>999</span>
                    </li>
                    <li>
                        Jumlah Pengguna Kemarin <span>888</span>
                    </li>
                    <li>
                        Total Pengguna <span>12000</span>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@stop

