@extends('layout/main-layout')
@section('content')
    <main class="container py-4 text-white">
        @include('carros.navbar')
        <section class="container mt-4">
            @if (session('success'))
                <div class="alert alert-success" role="status">{{ session('success') }}</div>
            @endif

            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h2 class="mb-1"><i class="fa-solid fa-screwdriver-wrench text-warning"></i> Fila de trabalho</h2>
                    <p class="mb-0 text-light-emphasis">Inicie os serviços abertos ou acompanhe os que estão em andamento.</p>
                </div>
                <a href="{{ route('carros.trabalho.carro') }}" class="btn btn-primary">Nova ordem</a>
            </div>

            <h3 class="h5 mb-3">Aguardando início <span class="badge text-bg-secondary">{{ $ordensAguardando->count() }}</span></h3>
            @forelse ($ordensAguardando as $ordem)
                <article class="card bg-dark text-white border border-secondary rounded-3 shadow-sm mb-3">
                    <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <span class="badge text-bg-secondary mb-2">Aberto</span>
                            <h4 class="h5 mb-1">
                                <a class="text-decoration-none text-white"
                                    href="{{ route('carros.carro', ['id' => $ordem->carro->id]) }}">
                                    {{ $ordem->carro->marca ?? 'Marca não informada' }} {{ $ordem->carro->modelo }}
                                </a>
                            </h4>
                            <p class="mb-1 text-light-emphasis">
                                Placa: {{ $ordem->carro->placa }} &middot;
                                Cliente: {{ $ordem->carro->cliente?->pessoa?->nome ?? 'Não informado' }}
                            </p>
                            <p class="mb-1">{{ $ordem->descricao ?? 'Serviço não informado' }}</p>
                            <p class="mb-0 text-light-emphasis">
                                Ordem #{{ $ordem->numero }} &middot;
                                Aberta em {{ \Carbon\Carbon::parse($ordem->data_abertura)->format('d/m/Y') }} &middot;
                                R$ {{ number_format((float) $ordem->valor_total, 2, ',', '.') }}
                            </p>
                        </div>
                        <form action="{{ route('carros.servico.iniciar', ['id' => $ordem->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-warning">
                                <i class="fa-solid fa-play me-1"></i> Iniciar serviço
                            </button>
                        </form>
                    </div>
                </article>
            @empty
                <p class="text-light-emphasis">Não há serviços aguardando início.</p>
            @endforelse

            <h3 class="h5 mt-5 mb-3">Em andamento <span class="badge text-bg-primary">{{ $ordensEmAndamento->count() }}</span></h3>
            @forelse ($ordensEmAndamento as $ordem)
                <article class="card bg-dark text-white border border-secondary rounded-3 shadow-sm mb-3">
                    <div class="card-body">
                        <span class="badge text-bg-warning text-dark mb-2">Em andamento</span>
                        <h4 class="h5 mb-1">
                            <a class="text-decoration-none text-white"
                                href="{{ route('carros.carro', ['id' => $ordem->carro->id]) }}">
                                {{ $ordem->carro->marca ?? 'Marca não informada' }} {{ $ordem->carro->modelo }}
                            </a>
                        </h4>
                        <p class="mb-1 text-light-emphasis">
                            Placa: {{ $ordem->carro->placa }} &middot;
                            Cliente: {{ $ordem->carro->cliente?->pessoa?->nome ?? 'Não informado' }}
                        </p>
                        <p class="mb-1">{{ $ordem->descricao ?? 'Serviço não informado' }}</p>
                        <p class="mb-0 text-light-emphasis">
                            Ordem #{{ $ordem->numero }} &middot;
                            R$ {{ number_format((float) $ordem->valor_total, 2, ',', '.') }}
                        </p>
                    </div>
                </article>
            @empty
                <p class="text-light-emphasis">Nenhum serviço em andamento no momento.</p>
            @endforelse
        </section>
    </main>
@endsection