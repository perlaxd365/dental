@extends('layout')

@section('title', 'Receta')
@section('view', Route::current()->getName())
@section('icon', 'edit')
@section('date', Date::now())

@section('content')

    @livewire('receta.index')

@endsection
