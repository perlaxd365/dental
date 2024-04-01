@extends('layout')

@section('title', 'Contrato')
@section('view', Route::current()->getName())
@section('icon', 'file-text')
@section('date', DateUtil::getFecha($carbon::parse(Date::now())))
@section('content')

    @livewire('contrato.index')

@endsection
