@extends('layouts.layout')
@section('titulo-pagina', 'FastiFood - Fazer Login')
@section('head-scripts')
    <link rel="stylesheet" href="css/mediaqueries-login.css">
    <link rel="stylesheet" href="css/login.css">
@endsection
@section('body-class', 'body')
@section('conteudo-principal')
    <div class="container mt-0">
        <div class="row align-items-center justify-contain-center">
            <div class="col-xl-12 mt-5">
                <div class="card border-0">
                    <div class="card-body login-bx">
                        <div class="row  mt-5">
                            <div class="col-xl-8 col-md-6 sign text-center">
                                <div>
                                    <img src="images/login-img/banner-login.jpg" class="food-img" alt="">
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-6 pe-0">
                                <div class="sign-in-your">
                                    <div class="text-center mb-3">
                                        <div class="logo-login">
                                            <img src="images/logo.png" alt="Logo">
                                        </div>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1"><strong>Senha</strong></label>
                                            <div class="input-wrapper">
                                                <input id="password" type="password" class="form-control @error('email') is-invalid @enderror" name="password" autocomplete="current-password">
                                                <span class="toggle-password" onclick="togglePasswordVisibility()">
                                                    <i class="fas fa-eye" id="togglePassword"></i>
                                                </span>
                                            </div>
                                        </div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert" style="display: block">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <div class="row d-flex justify-content-between mt-4 mb-2">
                                            <div>
                                                <div class="form-check custom-checkbox ms-1">
                                                    <input class="form-check-input" id="basic_checkbox_1" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="basic_checkbox_1">Lembrar-me</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                @if (Route::has('password.request'))
                                                    <a href="{{ route('password.request') }}">Esqueceu sua senha?</a>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary btn-block shadow">Fazer Login</button>
                                        </div>
                                    </form>
                                    <div class="text-center my-3">
                                        <span class="dlab-sign-up style-1">Ou</span>
                                    </div>
                                    <div class="dlab-signup-icon text-center">
                                        <button class="btn btn-outline-light"><i
                                                class="fa-brands fa-facebook me-2 facebook"></i>Facebook</button>
                                        <button class="btn btn-outline-light"><i
                                                class="fa-brands fa-google me-2 google"></i>Google</button>
                                    </div>
                                    <div class="text-center btn-convidado">
                                        Entrar como <span class="text-convidado">convidado</span>
                                    </div>
                                    <div class="text-center">
                                        <span>Você não tem uma conta?
                                            <a href="{{ route('registrar') }}" class="text-primary">
                                                Registrar-se
                                            </a>
                                        </span>
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
    <script type="text/javascript" src="js/scriptPageLogin.js"></script>
    <script src="./vendor/global/global.min.js"></script>
    <script src="./vendor/swiper/js/swiper-bundle.min.js"></script>
    <script src="./js/dlabnav-init.js"></script>
    <script>
        @if (session('conta-criada'))
            Toastify({
                text: `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 250px;">
                        <img src="images/erro.svg" alt="Erro" style="width: 20px; height: 20px; margin-bottom: 5px;">
                        <div style="color: #fff; text-align: center; max-width: 100%;">
                            {!! session('conta-criada') !!}
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
                    background: "rgba(40, 167, 69, 0.8)",
                    margin: "0 auto" // Centraliza a caixa
                }
            }).showToast();
        @elseif (session('conta-criada-restaurante'))
            Toastify({
                text: `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 300px;">
                        <img src="images/erro.svg" alt="Erro" style="width: 20px; height: 20px; margin-bottom: 5px;">
                        <div style="color: #fff; text-align: center; max-width: 100%;">
                            {!! session('conta-criada-restaurante') !!}
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
                    background: "rgba(40, 167, 69, 0.8)",
                    margin: "0 auto" // Centraliza a caixa
                }
            }).showToast();
        @endif
    </script>
@endsection
