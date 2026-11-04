@extends('layout/main-layout')
@section('content')
    <main class="container py-4 text-white">
        @include('carros.navbar')
        <section class="container mt-4">
            <h3 class="h5 mt-5 mb-3">Finalizados
                <span class="badge text-bg-primary">
                    {{ $ordensFinalizadas->count() }}
                </span>
            </h3>
            @foreach ($ordensFinalizadas as $finalizado)
                <article class="card bg-dark text-white border border-secondary rounded-3 shadow-sm mb-3">
                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h4 class="h5 mb-1">
                                <a class="text-decoration-none text-white"
                                    href="{{ route('carros.carro', ['id' => $finalizado->carro->id]) }}">
                                    {{ $finalizado->carro->marca ?? 'Marca não informada' }} {{ $finalizado->carro->modelo }}
                                </a>
                            </h4>
                            <p class="mb-1 text-light-emphasis">
                                Placa: {{ $finalizado->carro->placa }} &middot;
                                Cliente: {{ $finalizado->carro->cliente?->pessoa?->nome ?? 'Não informado' }}
                            </p>
                            <p class="mb-1">{{ $finalizado->descricao ?? 'Serviço não informado' }}</p>
                            <p class="mb-0 text-light-emphasis">
                                Ordem #{{ $finalizado->numero }} &middot;
                                Aberta em {{ \Carbon\Carbon::parse($finalizado->data_abertura)->format('d/m/Y') }} &middot;
                                R$ {{ number_format((float) $finalizado->valor_total, 2, ',', '.') }}
                            </p>
                        </div>
                    </div>
                    </div>
                </article>
            @endforeach
        </section>
    </main>
@endsection