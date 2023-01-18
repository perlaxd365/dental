@extends('layout')

@section('title', 'Página principal')
@section('view', Route::current()->getName())
@section('icon', 'home')
@section('date', Date::now())

@section('content')

    @livewire('admin.index')

@endsection
