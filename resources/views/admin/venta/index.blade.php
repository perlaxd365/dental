@if (Contratoutil::getContrato(auth()->user()->id_empresa))
    @extends('layout')

    @section('title', 'Venta')
    @section('view', Route::current()->getName())
    @section('icon', 'shopping-cart')
    @section('date', DateUtil::getFecha($carbon::parse(Date::now())))
    @section('content')

        @livewire('venta.index')

    @endsection
@endif
