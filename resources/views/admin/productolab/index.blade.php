@extends('layout')

@section('title', 'Productos de Laboratorio')
@section('view', Route::current()->getName())
@section('icon', 'codepen')
@section('date', DateUtil::getFecha($carbon::parse(Date::now())))

@section('content')

    @livewire('producto-lab.index')

@endsection
