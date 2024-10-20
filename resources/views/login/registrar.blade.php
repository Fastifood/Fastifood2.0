@extends('layouts.layout')
@section('titulo-pagina', 'FastiFood - Registrar-se')
@section('head-scripts')
    <link href="css/mediaqueries-toastify.css" rel="stylesheet">
    <link href="css/mediaqueries-cadastro.css" rel="stylesheet">
    <link href="css/cadastro.css" rel="stylesheet">
@endsection
@section('conteudo-principal')
    <div class="authincation">
        <div class="container">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <div class="registrar-logo">
                                            <img src="images/logo.png" alt="">
                                        </div>
                                    </div>
                                    <h4 class="text-center mb-4">Registre sua conta</h4>
                                    <form id="form" method="POST" action="{{ route('create') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Nome Completo: *</strong></label>
                                            <input id="name" type="text" class="form-control @error('nome_completo') is-invalid @enderror" value="{{ old('nome_completo') }}" name="nome_completo" autocomplete="name" autofocus>

                                            @error('nome_completo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Telefone: *</strong></label>
                                            <input type="tel" id="telefone" placeholder="(00) 00000-0000" name="telefone" class="form-control @error('telefone') is-invalid @enderror" oninput="mascaraTelefone(event); limitarCaracteres(event);" value="{{ old('telefone') }}" maxlength="15">

                                            @error('telefone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email: (será usado pra entrar na conta):*</strong></label>
                                            <input id="email" type="email" placeholder="seuemail@gmail.com" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Senha: *</strong></label>
                                            <div class="input-wrapper">
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                                <span class="toggle-password" onclick="togglePasswordVisibility()">
                                                    <i class="fas fa-eye" id="togglePassword"></i>
                                                </span>
                                            </div>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Confirmar Senha (será usada pra entrar na conta):*</strong></label>
                                            <div class="input-wrapper">
                                                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="new-password">
                                                <span class="toggle-password" onclick="togglePasswordVisibilityConfirmation()">
                                                    <i class="fas fa-eye" id="togglePasswordConfirmation"></i>
                                                </span>
                                            </div>
                                            @error('password_confirmation')
                                                <span class="invalid-feedback" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>CPF: *</strong></label>
                                            <input type="text" id="cpf" name="cpf" class="form-control @error('cpf') is-invalid @enderror" oninput="mascaraCPF(event)" maxlength="14" value="{{ old('cpf') }}">

                                            @error('cpf')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>CEP: *</strong></label>
                                            <div class="cep-group">
                                                <input type="text" id="cep" class="form-control @error('cep') is-invalid @enderror" name="cep" maxlength="8" value="{{ old('cep') }}">
                                                <button type="button" onclick="buscarCEP()">Localizar</button>
                                            </div>
                                            @error('cep')
                                                <span class="invalid-feedback" role="alert" style="display: block;">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Rua: *</strong></label>
                                            <input type="text" id="rua" class="form-control @error('rua') is-invalid @enderror" name="rua" value="{{ old('rua') }}">

                                            @error('rua')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Nº da Casa: *</strong></label>
                                            <input type="text" id="numero_casa" class="form-control @error('numero_casa') is-invalid @enderror" name="numero_casa" value="{{ old('numero_casa') }}">

                                            @error('numero_casa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Ponto de Referência: *</strong></label>
                                            <input type="text" id="ponto_referencia" class="form-control @error('ponto_referencia') is-invalid @enderror" name="ponto_referencia" value="{{ old('ponto_referencia') }}">

                                            @error('ponto_referencia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Bairro: *</strong></label>
                                            <input type="text" id="bairro" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ old('bairro') }}">

                                            @error('bairro')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Cidade: *</strong></label>
                                            <input type="text" id="cidade" class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade" value="{{ old('cidade') }}">

                                            @error('cidade')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Estado: *</strong></label>
                                            <input type="text" id="estado" class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" value="{{ old('estado') }}">

                                            @error('estado')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-block">{{ __('Cadastre-se') }}</button>
                                        </div>
                                    </form>
                                    <div class="new-account mt-3">
                                        <p>Já tem uma conta? <a class="text-primary" href="{{ route('login') }}">Faça login</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('outros-scripts')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.js"></script>

    <script type="text/javascript" src="js/scriptPageLogin.js"></script>
    <script type="text/javascript" src="js/scriptPageRegistrar.js"></script>
    <script>
        @if (session('endereco-invalido'))
            Toastify({
                text: `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 350px;">
                        <img src="images/erro.svg" alt="Erro" style="width: 20px; height: 20px; margin-bottom: 5px;">
                        <div style="color: #fff; text-align: center; max-width: 100%;">
                            {!! session('endereco-invalido') !!}
                        </div>
                    </div>
                `,
                duration: 10000,
                gravity: "top",
                position: 'right',
                escapeMarkup: false,
                style: {
                    width: "auto", // Permite que a largura se ajuste ao texto
                    alignItems: "center",
                    display: "flex",
                    background: "rgba(220, 53, 69, 0.8)",
                    margin: "0 auto" // Centraliza a caixa
                }
            }).showToast();
        @endif
    </script>
@endsection
