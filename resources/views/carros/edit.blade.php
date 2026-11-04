@extends('layout.main-layout')
@section('content')
    @include('carros.form', ['carro' => $carro, 'clientes' => $clientes])
@endsection