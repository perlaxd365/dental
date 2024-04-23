@if (Contratoutil::getContrato(auth()->user()->id_empresa))
    @extends('layout')

    @section('title', 'Historia')
    @section('view', Route::current()->getName())
    @section('icon', 'book')
    @section('date', DateUtil::getFecha($carbon::parse(Date::now())))
    @section('content')

        @livewire('historia.index')

    @endsection
@endif
