@extends('layout.ghost_layout')
@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Acesso de funcionários</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Não foi possível entrar. Verifique seu e-mail e senha.
                            </div>
                        @endif

                        <form action="{{ route('login.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email"><i class="fa-solid fa-at"></i> E-mail</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" autocomplete="username" required autofocus>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="fa-solid fa-lock"></i> Senha</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    autocomplete="current-password" required>
                            </div>
                            <div class="form-check my-3">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" value="1">
                                <label class="form-check-label" for="remember">Manter conectado</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar <i class="fa-solid fa-right-to-bracket"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection