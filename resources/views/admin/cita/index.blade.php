

@if (Contratoutil::getContrato(auth()->user()->id_empresa))
@extends('layout')

@section('title', 'Citas')
@section('view', Route::current()->getName())
@section('icon', 'calendar')
@section('date', DateUtil::getFecha($carbon::parse(Date::now())))

@section('content')

    @livewire('cita.cita-index')

@endsection
@endif