@extends('adminlte::page')

@section('title', $vcont)

@section('content_header')
    @if($vcont == 'daftar-nasabah')
        <h1>Daftar Nasabah</h1>
    @else
        <h1>Klasifikasi Nasabah</h1>
    @endif
@stop

@section('content')
    @if ($vcont == 'klasifikasi-nasabah')
        @includeIf($vcont,[
            'filter' => $filter,
            'data' => $data,
            ])
    @else
        @livewire($vcont, [
            'filter' => $filter,
        ])
    @endif
@stop

@section('css')
    @if ($vcont == 'daftar-nasabah')
        <link rel="stylesheet" href="{{ asset('css/paginator.css') }}">
    @elseif ($vcont == 'klasifikasi-nasabah')
        <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
    @endif
@stop

@section('js')
    @if ($vcont == 'daftar-nasabah')
        <script src="{{ asset('js/paginator.js') }}"></script>
    @endif
@stop
