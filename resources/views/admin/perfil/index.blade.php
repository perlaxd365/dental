@extends('layout')

@section('title', 'Perfil')
@section('view', Route::current()->getName())
@section('icon', 'user')
@section('date', DateUtil::getFecha($carbon::parse(Date::now())))
@section('content')

    @livewire('perfil.index')

@endsection
