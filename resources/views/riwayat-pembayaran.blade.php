@extends('adminlte::page')

@section('title','Riwayat Pembayaran')

@section('content_header')
    <h1>Riwayat Pembayaran</h1>
@stop

@section('content')
    @livewire('riwayat-pembayaran')
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/paginator.css') }}">
@stop
