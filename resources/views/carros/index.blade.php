@extends('layout/main-layout')
@section('content')
    <main class="container py-4 text-white">
        {{-- Barra navegação página carros --}}
        @include('carros.navbar')
        <hr>
        {{-- Botão adicionar carro --}}
        <div class="text-end mb-4">
            <a href="#" class="btn btn-primary">Adicionar Carro</a>
        </div>
        <hr>
        {{-- lista de carros --}}
        <div class="mt-4">
            <ul class="list-group list-group-flush gap-3">
                @foreach ($carros as $carro)
                    <li class="list-group-item bg-dark text-white border border-secondary rounded-3 shadow-sm p-3">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="fa-solid fa-car-side text-primary"></i>
                                    <h5 class="mb-0">
                                        <a class="text-decoration-none text-white"
                                            href="{{ route('carros.carro', ['id' => $carro->id]) }}">
                                            {{ $carro->marca }} {{ $carro->modelo }}
                                        </a>
                                    </h5>
                                </div>
                                <p class="mb-0 text-light-emphasis">{{ $carro->descricao }}</p>
                            </div>

                            <div class="d-flex gap-2 flex-wrap">
                                <a href="#" class="btn btn-sm btn-outline-light">Editar</a>
                                <a href="#" class="btn btn-sm btn-outline-danger">Remover</a>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </main>
@endsection