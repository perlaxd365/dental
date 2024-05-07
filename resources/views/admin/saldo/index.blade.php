@if (Contratoutil::getContrato(auth()->user()->id_empresa))
    @extends('layout')

    @section('title', 'Saldos')
    @section('view', Route::current()->getName())
    @section('icon', 'watch')
    @section('date', DateUtil::getFecha($carbon::parse(Date::now())))
    @section('content')

        @livewire('saldo.index')

    @endsection
@endif
