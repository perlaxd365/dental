@extends('layout')

@section('title', 'Trabajos de Laboratorio')
@section('view', Route::current()->getName())
@section('icon', 'triangle')
@section('date', Date::now())

@section('content')

    @livewire('laboratorio.index')

@endsection
