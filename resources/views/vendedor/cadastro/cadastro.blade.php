@extends('layouts.layout')
@section('titulo-pagina', 'FastiFood - Registre sua Lanchonete')
@section('head-scripts')
    <link rel="stylesheet" href="./vendor/toastr/css/toastr.min.css">
    <link href="css/mediaqueries-registrar-vendedor.css" rel="stylesheet">
    <link href="css/registrar-vendedor.css" rel="stylesheet">
@endsection
@section('conteudo-principal')
    <div id="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <div id="main-wrapper">
        <div class="content-body registrar-lanchonete-body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-vendedor">
                            <div class="card-header card-vendedor-header">
                                <div class="registrar-vendedor-logo">
                                    <img src="images/logo.png" alt="">
                                </div>
                                <h4 class="card-vendedor-title">Cadastre seu Restaurante</h4>
                            </div>
                            <div class="card-vendedor-body">
                                <form onsubmit="handleSubmit(event)" method="post" action="{{ route('registrar.cadastro-restaurante') }}" id="multi-step-form">
                                    @csrf
                                    <ul class="step-menu">
                                        <li class="step-menu-item active" data-step="1"><span>1</span><br/>Etapa</li>
                                        <li class="step-menu-item" data-step="2"><span>2</span><br/>Etapa</li>
                                        <li class="step-menu-item" data-step="3"><span>3</span><br/>Etapa</li>
                                        <li class="step-menu-item" data-step="4"><span>4</span><br/>Etapa</li>
                                    </ul>

                                    <!-- Etapa 1 -->
                                    <div class="formbold-form-step formbold-form-step-1 active">
                                        <label class="formbold-form-label">Qual tipo de pessoa você é?</label>
                                        <div class="form-wrapper">
                                            <label class="form-label">
                                                <input class="form-input" type="radio" name="tipo_pessoa" value="fisica" checked>
                                                <span class="radio-mark"></span>
                                                <p>Pessoa Física</p>
                                            </label>
                                            <label class="form-label">
                                                <input class="form-input" type="radio" name="tipo_pessoa" value="juridica">
                                                <span class="radio-mark"></span>
                                                <p>Pessoa Jurídica</p>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Etapa 2 -->
                                    <div class="formbold-form-step formbold-form-step-2">
                                        <div class="formbold-info-step">
                                            <h1>Informação do seu restaurante</h1>
                                            <p>Preencha com os dados do seu negócio.</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Nome do Restaurante (como aparecerá no app): *</strong></label>
                                            <input id="nomeEstabelecimento" placeholder="Ex: FastiFood Lanches" type="text" class="form-control @error('nome_estabelecimento') is-invalid @enderror" value="{{ old('nome_estabelecimento') }}" name="nome_estabelecimento" autocomplete="name" autofocus>

                                            @error('nome_estabelecimento')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="erro">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>CPF (do responsável do restaurante): *</strong></label>
                                            <input type="text" placeholder="Ex: 000.000.000-00" id="cpfResponsavel" name="cpf_responsavel" class="form-control @error('cpf_responsavel') is-invalid @enderror" oninput="mascaraCPF(event)" maxlength="14" value="{{ old('cpf_responsavel') }}">

                                            @error('cpf_responsavel')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Email do Restaurante (será usada pra entrar na conta): *</strong></label>
                                            <input id="emailRestaurante" placeholder="Ex: emaildorestaurante@gmail.com" type="text" class="form-control @error('email_restaurante') is-invalid @enderror" value="{{ old('email_restaurante') }}" name="email_restaurante" autocomplete="email" autofocus>

                                            @error('email_restaurante')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong id="erro">{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Senha: *</strong></label>
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
                                            <label class="mb-1 inputs-cadastro-label"><strong>Confirmar Senha (será usada pra entrar na conta):*</strong></label>
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
                                            <label class="mb-1 inputs-cadastro-label"><strong>CNPJ: *</strong></label>
                                            <input
                                                type="text"
                                                id="cnpj"
                                                name="cnpj"
                                                class="form-control @error('cnpj') is-invalid @enderror"
                                                oninput="mascaraEValidarCNPJ(this)"
                                                maxlength="18"
                                                placeholder="Ex: 00.000.000/0000-00"
                                                value="{{ old('cnpj') }}">

                                            @error('cnpj')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Razão Social: *</strong></label>
                                            <input type="text" id="razaoSocial" name="razao_social" class="form-control @error('razao_social') is-invalid @enderror" value="{{ old('razao_social') }}">

                                            @error('razao_social')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="formbold-info-step">
                                            <h1>Suas informações</h1>
                                            <p>Preencha com seus dados.</p>
                                        </div>
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
                                            <label class="mb-1 inputs-cadastro-label"><strong>Email (do responsável do restaurante): *</strong></label>
                                            <input id="emailResponsavel" placeholder="Ex: emailresponsavel@gmail.com" type="text" class="form-control @error('email_responsavel') is-invalid @enderror" value="{{ old('email_responsavel') }}" name="email_responsavel" autocomplete="email" autofocus>

                                            @error('email_responsavel')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Celular (com DDD): *</strong></label>
                                            <input type="tel" id="telefone" placeholder="(00) 00000-0000" name="telefone" class="form-control @error('telefone') is-invalid @enderror" oninput="mascaraTelefone(event); limitarCaracteres(event);" value="{{ old('telefone') }}" maxlength="15">

                                            @error('telefone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <div class="formbold-info-step formbold-info-step-endereco">
                                                <h1>Endereço do seu restaurante</h1>
                                                <p>Preencha os dados do seu restaurante.</p>
                                            </div>
                                            <label class="mb-1 inputs-cadastro-label"><strong>CEP: *</strong></label>
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
                                            <label class="mb-1 inputs-cadastro-label"><strong>Rua: *</strong></label>
                                            <input type="text" id="rua" class="form-control @error('rua') is-invalid @enderror" name="rua" value="{{ old('rua') }}">

                                            @error('rua')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Nº da Casa: *</strong></label>
                                            <input type="text" id="numero_casa" class="form-control @error('numero_casa') is-invalid @enderror" name="numero_casa" value="{{ old('numero_casa') }}">

                                            @error('numero_casa')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Ponto de Referência: *</strong></label>
                                            <input type="text" id="ponto_referencia" class="form-control @error('ponto_referencia') is-invalid @enderror" name="ponto_referencia" value="{{ old('ponto_referencia') }}">

                                            @error('ponto_referencia')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Bairro: *</strong></label>
                                            <input type="text" id="bairro" class="form-control @error('bairro') is-invalid @enderror" name="bairro" value="{{ old('bairro') }}">

                                            @error('bairro')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Cidade: *</strong></label>
                                            <input type="text" class="form-control @error('cidade') is-invalid @enderror" id="cidade" name="cidade" value="{{ old('cidade') }}">

                                            @error('cidade')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="mb-1 inputs-cadastro-label"><strong>Estado: *</strong></label>
                                            <input type="text" class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" value="{{ old('estado') }}">

                                            @error('estado')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- Etapa 3 -->
                                    <div class="formbold-form-step formbold-form-step-3">
                                        <div class="mb-3">
                                            <div class="formbold-info-step">
                                                <h1>URL do seu restaurante</h1>
                                                <p>Defina como será a URL do seu restaurante</p>
                                            </div>
                                            <div class="inputs-step3-url-wrapper">
                                                <div class="inputs-step3-url-box">
                                                    <label class="mb-1 inputs-cadastro-label label-url">
                                                        fastifood.com.br
                                                    </label>
                                                    <div class="effectbar">
                                                        <span>/</span>
                                                    </div>
                                                    <input type="text" placeholder="Ex: FastiFood" class="form-control @error('url_restaurante') is-invalid @enderror" id="url_restaurante" name="url_restaurante" value="{{ old('url_restaurante') }}">
                                                </div>

                                                @error('url_restaurante')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <p id="previewURL"></p>
                                    </div>
                                    <!-- Etapa 4 -->
                                    <div class="formbold-form-step formbold-form-step-4">
                                        <div class="mb-3">
                                            <div class="formbold-info-step formbold-info-step-4">
                                                <h2>Olá, <span id="retornarNome"></span></h2>
                                                <p>Estamos quase finalizando! Confira as suas informações e do seu restaurante abaixo, e conclua o cadastro clicando no botão "Finalizar Cadastro".</p>
                                            </div>
                                            <div class="return-dados-wrapper">
                                                <div class="return-tipo">
                                                    <h2>Tipo de Pessoa:</h2>
                                                    <div>
                                                        <p>Seu tipo de pessoa:&nbsp;</p>
                                                        <div id="tipoPessoa"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="return-informacao-restaurante">
                                                    <h2>Informação do seu Restaurante:</h2>
                                                    <div>
                                                        <p>Nome do Restaurante:&nbsp;</p>
                                                        <div id="dadosNomeEstabelecimento"></div>
                                                    </div>
                                                    <div>
                                                        <p>CPF do responsável:&nbsp;</p>
                                                        <div id="dadosCpf"></div>
                                                    </div>
                                                    <div>
                                                        <p>Email do restaurante:&nbsp;</p>
                                                        <div id="dadosEmailRestaurante"></div>
                                                    </div>
                                                    <div>
                                                        <p>Senha:&nbsp;</p>
                                                        <div id="dadosSenha"></div>
                                                    </div>
                                                    <div>
                                                        <p>Confirmar Senha:&nbsp;</p>
                                                        <div id="dadosConfirmarSenha"></div>
                                                    </div>
                                                    <div id="dadosCNPJ-box">
                                                        <p>CNPJ:&nbsp;</p>
                                                        <div id="dadosCNPJ"></div>
                                                    </div>
                                                    <div id="dadosRazaoSocial-box">
                                                        <p>Razão Social:&nbsp;</p>
                                                        <div id="dadosRazaoSocial"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="return-suas-informacoes">
                                                    <h2>Suas informações:</h2>
                                                    <div>
                                                        <p>Nome Completo:&nbsp;</p>
                                                        <div id="dadosNome"></div>
                                                    </div>
                                                    <div>
                                                        <p>Email do Responsável:&nbsp;</p>
                                                        <div id="dadosEmailResponsavel"></div>
                                                    </div>
                                                    <div>
                                                        <p>Celular (com DDD):&nbsp;</p>
                                                        <div id="dadosTelefone"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="return-endereco-restaurante">
                                                    <h2>Endereço do Restaurante:</h2>
                                                    <div>
                                                        <p>CEP:&nbsp;</p>
                                                        <div id="dadosCep"></div>
                                                    </div>
                                                    <div>
                                                        <p>Rua:&nbsp;</p>
                                                        <div id="dadosRua"></div>
                                                    </div>
                                                    <div>
                                                        <p>Número da Casa:&nbsp;</p>
                                                        <div id="dadosNumeroCasa"></div>
                                                    </div>
                                                    <div>
                                                        <p>Ponto de Referência:&nbsp;</p>
                                                        <div id="dadosPontoDeReferencia"></div>
                                                    </div>
                                                    <div>
                                                        <p>Bairro:&nbsp;</p>
                                                        <div id="dadosBairro"></div>
                                                    </div>
                                                    <div>
                                                        <p>Cidade:&nbsp;</p>
                                                        <div id="dadosCidade"></div>
                                                    </div>
                                                    <div>
                                                        <p>Estado:&nbsp;</p>
                                                        <div id="dadosEstado"></div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="return-url">
                                                    <h2>URL do Restaurante:</h2>
                                                    <div>
                                                        <p>URL definido:&nbsp;</p>
                                                        <div id="dadosURL"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="confirm-button" onclick="mostrarDados()">Finalizar Cadastro</button>
                                    </div>
                                    <div class="formbold-form-btn-wrapper">
                                        <button type="button" class="formbold-back-btn">
                                            <i class="fa-solid fa-arrow-left"></i>
                                            Voltar
                                        </button>
                                        <button type="button" class="formbold-next-btn" onclick="mostrarDados()">Próximo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('outros-scripts')
    <script src="js/custom.js"></script>
    <script src="js/scriptPageRegistrarVendedor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@latest/build/toastr.min.js"></script>
    <script>
        @if (session('endereco-invalido'))
            Toastify({
                text: `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 400px;">
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
        @elseif (session('tipo-invalido'))
            Toastify({
                text: `
                    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; width: 400px;">
                        <img src="images/erro.svg" alt="Erro" style="width: 20px; height: 20px; margin-bottom: 5px;">
                        <div style="color: #fff; text-align: center; max-width: 100%;">
                            {!! session('tipo-invalido') !!}
                        </div>
                    </div>
                `,
                duration: 10000,
                gravity: "top",
                position: 'right',
                escapeMarkup: false,
                style: {
                    width: "auto",
                    alignItems: "center",
                    display: "flex",
                    background: "rgba(220, 53, 69, 0.8)",
                    margin: "0 auto"
                }
            }).showToast();
        @endif
    </script>
@endsection
