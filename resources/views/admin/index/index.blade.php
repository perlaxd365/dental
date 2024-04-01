@extends('layout')

@section('title', 'Página principal')
@section('view', Route::current()->getName())
@section('icon', 'home')
@section('date', DateUtil::getFecha($carbon::parse(Date::now())))

@section('content')

    @livewire('admin.index')

@endsection
