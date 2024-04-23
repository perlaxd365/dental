@if (Contratoutil::getContrato(auth()->user()->id_empresa))
    @extends('layout')

    @section('title', 'Receta')
    @section('view', Route::current()->getName())
    @section('icon', 'edit')
    @section('date', DateUtil::getFecha($carbon::parse(Date::now())))
    @section('content')

        @livewire('receta.index')

    @endsection
@endif
