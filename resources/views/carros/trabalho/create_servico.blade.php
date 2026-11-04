@extends('layout/main-layout')
@section('content')
    <main class="container py-4 text-white">
        @include('carros.navbar')
        <section class="container mt-4">
            <div class="mb-4">
                <h2 class="mb-1"><i class="fa-solid fa-screwdriver-wrench text-warning"></i> Nova ordem de serviço</h2>
                <p class="mb-0 text-light-emphasis">Preencha os dados do veículo e do serviço a ser realizado.</p>
            </div>

            <form action="{{ route('carros.servico.store') }}" method="POST"
                class="card bg-dark text-white border border-secondary rounded-3 shadow-sm">
                @csrf
                <div class="card-body">
                    <div class="mb-3">
                        <label for="carro_id" class="form-label">Veículo</label>
                        <select id="carro_id" name="carro_id"
                            class="form-select @error('carro_id') is-invalid @enderror" required>
                            <option value="">Selecione um veículo</option>
                            @foreach ($carros as $carro)
                                <option value="{{ $carro->id }}" @selected(old('carro_id') == $carro->id)>
                                    {{ $carro->marca ?? 'Marca não informada' }} {{ $carro->modelo }}
                                    — {{ $carro->placa }}
                                    ({{ $carro->cliente?->pessoa?->nome ?? 'Cliente não informado' }})
                                </option>
                            @endforeach
                        </select>
                        @error('carro_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="funcionario_id" class="form-label">Responsável</label>
                            <select id="funcionario_id" name="funcionario_id"
                                class="form-select @error('funcionario_id') is-invalid @enderror" required>
                                <option value="">Selecione um funcionário</option>
                                @foreach ($funcionarios as $funcionario)
                                    <option value="{{ $funcionario->id }}" @selected(old('funcionario_id') == $funcionario->id)>
                                        {{ $funcionario->email }} — {{ $funcionario->cargo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('funcionario_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="oficina_id" class="form-label">Oficina</label>
                            <select id="oficina_id" name="oficina_id"
                                class="form-select @error('oficina_id') is-invalid @enderror" required>
                                <option value="">Selecione uma oficina</option>
                                @foreach ($oficinas as $oficina)
                                    <option value="{{ $oficina->id }}" @selected(old('oficina_id') == $oficina->id)>
                                        {{ $oficina->nome }}
                                    </option>
                                @endforeach
                            </select>
                            @error('oficina_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descricao" class="form-label">Serviço a realizar</label>
                        <textarea id="descricao" name="descricao" rows="4" maxlength="1000"
                            class="form-control @error('descricao') is-invalid @enderror"
                            placeholder="Descreva o serviço que será realizado" required>{{ old('descricao') }}</textarea>
                        @error('descricao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="valor_total" class="form-label">Valor estimado (R$)</label>
                        <input id="valor_total" name="valor_total" type="number" step="0.01" min="0"
                            value="{{ old('valor_total', '0.00') }}"
                            class="form-control @error('valor_total') is-invalid @enderror" required>
                        @error('valor_total')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if ($carros->isEmpty() || $funcionarios->isEmpty() || $oficinas->isEmpty())
                        <div class="alert alert-warning" role="alert">
                            Cadastre ao menos um veículo, funcionário e oficina antes de abrir uma ordem de serviço.
                        </div>
                    @endif

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('carros.trabalho') }}" class="btn btn-outline-light">Cancelar</a>
                        <button type="submit" class="btn btn-primary"
                            @disabled($carros->isEmpty() || $funcionarios->isEmpty() || $oficinas->isEmpty())>
                            Cadastrar serviço
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection