
@extends('layout')

@section('title', 'Citas')
@section('view', Route::current()->getName())
@section('icon', 'calendar')
@section('date', Date::now())

@section('content')

    @livewire('cita.cita-index')

@endsection
