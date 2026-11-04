<main class="container py-4">
    @include('carros.navbar')

    <div class="card bg-dark text-white border border-secondary rounded-3 shadow-sm mx-auto"
        style="max-width: 900px;">
        <div class="card-body p-4">
            @php
                $isEdit = isset($carro);
                $clienteExistente = old('cliente_existente', $isEdit && $carro->cliente_id ? '1' : '0') === '1';
            @endphp
            <h1 class="h3 mb-1">{{ $isEdit ? 'Editar carro' : 'Cadastrar carro' }}</h1>
            <p class="text-light-emphasis mb-4">{{ $isEdit ? 'Atualize os dados do veículo e do proprietário.' : 'Preencha os dados do veículo e do proprietário.' }}</p>

            <form action="{{ $isEdit ? route('carros.update', ['id' => $carro->id]) : route('carros.store') }}" method="POST">
                @csrf
                @if ($isEdit)
                    @method('PUT')
                @endif
                <input type="hidden" name="cliente_existente" id="cliente_existente"
                    value="{{ $clienteExistente ? '1' : '0' }}">

                <fieldset class="mb-4">
                    <legend class="h5 border-bottom border-secondary pb-2 mb-3">Dados do carro</legend>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="marca" class="form-label">Marca</label>
                            <input type="text" id="marca" name="marca"
                                class="form-control @error('marca') is-invalid @enderror"
                                value="{{ old('marca', $isEdit ? $carro->marca : '') }}" maxlength="255">
                            @error('marca')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="modelo" class="form-label">Modelo</label>
                            <input type="text" id="modelo" name="modelo"
                                class="form-control @error('modelo') is-invalid @enderror"
                                value="{{ old('modelo', $isEdit ? $carro->modelo : '') }}" maxlength="255" required>
                            @error('modelo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="ano" class="form-label">Ano</label>
                            <input type="number" id="ano" name="ano"
                                class="form-control @error('ano') is-invalid @enderror"
                                value="{{ old('ano', $isEdit ? $carro->ano : '') }}" min="1000" max="9999" step="1" required>
                            @error('ano')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-2">
                            <label for="placa" class="form-label">Placa</label>
                            <input type="text" id="placa" name="placa"
                                class="form-control text-uppercase @error('placa') is-invalid @enderror"
                                value="{{ old('placa', $isEdit ? $carro->placa : '') }}" maxlength="7" required>
                            @error('placa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-12">
                            <label for="descricao" class="form-label">Descrição</label>
                            <textarea id="descricao" name="descricao" rows="3"
                                class="form-control @error('descricao') is-invalid @enderror" maxlength="1000">{{ old('descricao', $isEdit ? $carro->descricao : '') }}</textarea>
                            @error('descricao')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </fieldset>

                <fieldset class="mb-4">
                    <legend class="h5 border-bottom border-secondary pb-2 mb-3">Dados do cliente</legend>
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button type="button" id="novo-cliente-btn"
                            class="btn {{ $clienteExistente ? 'btn-outline-light' : 'btn-primary' }}"
                            aria-pressed="{{ $clienteExistente ? 'false' : 'true' }}">
                            Cadastrar novo cliente
                        </button>
                        <button type="button" id="cliente-existente-btn"
                            class="btn {{ $clienteExistente ? 'btn-primary' : 'btn-outline-light' }}"
                            aria-pressed="{{ $clienteExistente ? 'true' : 'false' }}">
                            Cliente já cadastrado
                        </button>
                    </div>

                    <div id="cliente-existente-campos" class="mb-3" {{ $clienteExistente ? '' : 'hidden' }}>
                        <label for="cliente_id" class="form-label">Selecione o cliente</label>
                        <select id="cliente_id" name="cliente_id"
                            class="form-select @error('cliente_id') is-invalid @enderror"
                            {{ $clienteExistente ? 'required' : 'disabled' }}>
                            <option value="">Escolha um cliente cadastrado</option>
                            @foreach ($clientes as $cliente)
                                <option value="{{ $cliente->id }}" @selected(old('cliente_id', $isEdit ? $carro->cliente_id : null) == $cliente->id)>
                                    {{ $cliente->pessoa?->nome ?? 'Cliente #' . $cliente->id }}
                                    — CPF: {{ $cliente->cpf }}
                                </option>
                            @endforeach
                        </select>
                        @error('cliente_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($clientes->isEmpty())
                            <div class="form-text text-light-emphasis">Ainda não há clientes cadastrados.</div>
                        @endif
                    </div>

                    <div id="novo-cliente-campos" {{ $clienteExistente ? 'hidden' : '' }}>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome completo</label>
                                <input type="text" id="nome" name="nome"
                                    class="form-control @error('nome') is-invalid @enderror"
                                    value="{{ old('nome', $isEdit && $carro->cliente?->pessoa ? $carro->cliente->pessoa->nome : '') }}" maxlength="255" required>
                                @error('nome')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="tel" id="telefone" name="telefone"
                                    class="form-control @error('telefone') is-invalid @enderror"
                                    value="{{ old('telefone', $isEdit && $carro->cliente?->pessoa ? $carro->cliente->pessoa->telefone : '') }}" maxlength="255" required>
                                @error('telefone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" id="cpf" name="cpf"
                                    class="form-control @error('cpf') is-invalid @enderror"
                                    value="{{ old('cpf', $isEdit && $carro->cliente ? $carro->cliente->cpf : '') }}" maxlength="255" required>
                                @error('cpf')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $isEdit && $carro->cliente ? $carro->cliente->email : '') }}" maxlength="255" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </fieldset>

                @unless ($isEdit)
                    <fieldset class="mb-4">
                        <legend class="h5 border-bottom border-secondary pb-2 mb-3">Serviço inicial</legend>
                        <p class="text-light-emphasis">O serviço será criado como aberto e aparecerá na fila da página de trabalho.</p>
                        <div class="row g-3">
                            <div class="col-md-6">
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
                            <div class="col-md-6">
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
                            <div class="col-12">
                                <label for="ordem_descricao" class="form-label">Serviço solicitado</label>
                                <textarea id="ordem_descricao" name="ordem_descricao" rows="3" maxlength="1000"
                                    class="form-control @error('ordem_descricao') is-invalid @enderror"
                                    required>{{ old('ordem_descricao') }}</textarea>
                                @error('ordem_descricao')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="valor_total" class="form-label">Valor estimado (R$)</label>
                                <input id="valor_total" name="valor_total" type="number" step="0.01" min="0"
                                    value="{{ old('valor_total', '0.00') }}"
                                    class="form-control @error('valor_total') is-invalid @enderror" required>
                                @error('valor_total')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        @if ($funcionarios->isEmpty() || $oficinas->isEmpty())
                            <div class="alert alert-warning mt-3 mb-0" role="alert">
                                Cadastre ao menos um funcionário e uma oficina antes de registrar o veículo com serviço.
                            </div>
                        @endif
                    </fieldset>
                @endunless

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('carros.index') }}" class="btn btn-outline-light">Cancelar</a>
                    <button type="submit" class="btn btn-primary"
                        @disabled(!$isEdit && ($funcionarios->isEmpty() || $oficinas->isEmpty()))>
                        <i class="fa-solid fa-floppy-disk me-1"></i> {{ $isEdit ? 'Salvar alterações' : 'Cadastrar carro' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    (() => {
        const modeInput = document.getElementById('cliente_existente');
        const existingFields = document.getElementById('cliente-existente-campos');
        const newFields = document.getElementById('novo-cliente-campos');
        const existingSelect = document.getElementById('cliente_id');
        const existingButton = document.getElementById('cliente-existente-btn');
        const newButton = document.getElementById('novo-cliente-btn');

        const setClientMode = (useExisting) => {
            modeInput.value = useExisting ? '1' : '0';
            existingFields.hidden = !useExisting;
            newFields.hidden = useExisting;
            existingSelect.disabled = !useExisting;
            existingSelect.required = useExisting;
            existingButton.classList.toggle('btn-primary', useExisting);
            existingButton.classList.toggle('btn-outline-light', !useExisting);
            existingButton.setAttribute('aria-pressed', String(useExisting));
            newButton.classList.toggle('btn-primary', !useExisting);
            newButton.classList.toggle('btn-outline-light', useExisting);
            newButton.setAttribute('aria-pressed', String(!useExisting));
            newFields.querySelectorAll('input').forEach((input) => {
                input.disabled = useExisting;
                input.required = !useExisting;
            });
        };

        existingButton.addEventListener('click', () => setClientMode(true));
        newButton.addEventListener('click', () => setClientMode(false));
        setClientMode(modeInput.value === '1');
    })();
</script>
