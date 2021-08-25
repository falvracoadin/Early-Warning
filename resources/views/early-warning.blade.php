@extends('adminlte::page')

@section('title','Early Warning System')

@section('content_header')
    <h1>Early Warning System</h1>
@stop

@section('content')
    @if ($vcont == 'warning')
        @livewire('early-warning')
    @else
        @includeIf('statistic-warning')
    @endif

@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/chart.css') }}">
@endsection

@section('js')

@stop
