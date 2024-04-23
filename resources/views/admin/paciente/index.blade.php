@if (Contratoutil::getContrato(auth()->user()->id_empresa))
@extends('layout')

@section('title', 'Paciente')
@section('view', Route::current()->getName())
@section('icon', 'users')
@section('date', DateUtil::getFecha($carbon::parse(Date::now())))
@section('content')

    @livewire('paciente.index')

@endsection
@endif
