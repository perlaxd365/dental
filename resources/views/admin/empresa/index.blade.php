@extends('layout')

@section('title', 'Empresas')
@section('view', Route::current()->getName())
@section('icon', 'users')
@section('date', Date::now())

@section('content')

    @livewire('empresa.index-empresa')

@endsection
