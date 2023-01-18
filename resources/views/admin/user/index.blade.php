
@extends('layout')

@section('title', 'Usuarios')
@section('view', Route::current()->getName())
@section('icon', 'user')
@section('date', Date::now())

@section('content')

    @livewire('user.user-index')

@endsection
