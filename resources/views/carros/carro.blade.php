@extends('layout.main-layout')
@section('content')
    <main class="container py-4 text-white">
        {{-- Barra navegação página carros --}}
        @include('carros.navbar')
        <hr>
        {{-- Detalhes do carro --}}
        <div class="container mt-4 col-span-2">
            <div class="card bg-dark text-white border border-secondary rounded-3 shadow-sm p-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $carro->marca }} {{ $carro->modelo }}</h5>
                    <p class="card-text">{{ $carro->descricao }}</p>
                    <p class="card-text"><small class="text-light-emphasis">Ano: {{ $carro->ano }}</small></p>
                    <p class="card-text"><small class="text-light-emphasis">Placa:
                            {{ $carro->placa }}</small></p>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Dados do cliente</h6>
                    <p class="card-text">Nome: {{ $carro->cliente?->pessoa?->nome ?? 'Não informado' }}</p>
                    <p class="card-text">CPF: {{ $carro->cliente?->cpf ?? 'Não informado' }}</p>
                    <p class="card-text">E-mail: {{ $carro->cliente?->email ?? 'Não informado' }}</p>
                    <p class="card-text">Telefone: {{ $carro->cliente?->pessoa?->telefone ?? 'Não informado' }}</p>
                </div>
            </div>
            <a href="javascript:history.back()" class="btn btn-secondary bg-dark">Voltar</a>
        </div>
    </main>

@endsection