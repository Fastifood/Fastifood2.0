// Etapas
document.addEventListener('DOMContentLoaded', function () {
    let currentStep = 1;
    const maxSteps = 4;

    const steps = document.querySelectorAll('.formbold-form-step');
    const stepMenuItems = document.querySelectorAll('.step-menu-item');
    const nextBtn = document.querySelector('.formbold-next-btn');
    const backBtn = document.querySelector('.formbold-back-btn');

    // Função para atualizar a etapa do formulário
    function updateStep(step) {
        steps.forEach((el, index) => {
            el.classList.toggle('active', index + 1 === step);
        });
        stepMenuItems.forEach((item, index) => {
            item.classList.toggle('active', index + 1 === step);
        });

        // Controlar a visibilidade dos botões de "Voltar" e "Próximo"
        backBtn.style.display = step === 1 ? 'none' : 'inline-block';
        nextBtn.style.display = step === maxSteps ? 'none' : 'inline-block';

        // Se for a última etapa (etapa 4), exibir os dados
        if (step === maxSteps) {
            mostrarDados();
        }
    }

    // Avançar para a próxima etapa
    nextBtn.addEventListener('click', function () {
        if (currentStep < maxSteps) {
            currentStep++;
            updateStep(currentStep);
        }
    });

    // Voltar para a etapa anterior
    backBtn.addEventListener('click', function () {
        if (currentStep > 1) {
            currentStep--;
            updateStep(currentStep);
        }
    });

    // Iniciar na etapa 1
    updateStep(currentStep);
});

// Exibir os dados dos inputs na etapa 4
function mostrarDados() {
    // Capturar os valores e adicionar fallback para campos não preenchidos
    const nomeCompleto = document.getElementById('name').value.split(' ')[0] || 'Faltou preencher esse campo.';
    const nomeEstabelecimento = document.getElementById('nomeEstabelecimento').value || 'Faltou preencher esse campo.';
    const cpfResponsavel = document.getElementById('cpfResponsavel').value || 'Faltou preencher esse campo.';
    const cnpj = document.getElementById('cnpj').value.trim() || 'Faltou preencher esse campo.';
    const razaoSocial = document.getElementById('razaoSocial').value || 'Faltou preencher esse campo.';
    const nome = document.getElementById('name').value || 'Faltou preencher esse campo.';
    const emailRestaurante = document.getElementById('emailRestaurante').value || 'Faltou preencher esse campo.';

    const senha = document.getElementById("password").value;
    const confirmarSenha = document.getElementById("password_confirmation").value;

    const primeirosTresCaracteresSenha = senha
        ? senha.substring(0, 3) + '*'.repeat(senha.length - 3)
        : 'Faltou Preencher esse campo.';

    const primeirosTresCaracteresConfirmarSenha = confirmarSenha
        ? confirmarSenha.substring(0, 3) + '*'.repeat(confirmarSenha.length - 3)
        : 'Faltou Preencher esse campo.';

    const emailResponsavel = document.getElementById('emailResponsavel').value || 'Faltou preencher esse campo.';
    const telefone = document.getElementById('telefone').value || 'Faltou preencher esse campo.';
    const cep = document.getElementById('cep').value || 'Faltou preencher esse campo.';
    const rua = document.getElementById('rua').value || 'Faltou preencher esse campo.';
    const numeroCasa = document.getElementById('numero_casa').value || 'Faltou preencher esse campo.';
    const pontoReferencia = document.getElementById('ponto_referencia').value || 'Faltou preencher esse campo.';
    const bairro = document.getElementById('bairro').value || 'Faltou preencher esse campo.';
    const cidade = document.getElementById('cidade').value || 'Faltou preencher esse campo.';
    const estado = document.getElementById('estado').value || 'Faltou preencher esse campo.';
    const url = document.getElementById('url_restaurante').value || 'Faltou preencher a URL.';

    // Capturar o tipo de pessoa selecionado
    const tipoPessoa = document.querySelector('input[name="tipo_pessoa"]:checked').value;

    // Exibir os dados na etapa 4
    document.getElementById('tipoPessoa').innerText = tipoPessoa === 'fisica' ? 'Pessoa Física' : 'Pessoa Jurídica';
    document.getElementById('dadosNomeEstabelecimento').innerText = nomeEstabelecimento;
    document.getElementById('dadosCpf').innerText = cpfResponsavel;
    document.getElementById('dadosCNPJ').innerText = cnpj;
    document.getElementById('dadosRazaoSocial').innerText = razaoSocial;
    document.getElementById('dadosNome').innerText = nome;
    document.getElementById('dadosEmailRestaurante').innerText = emailRestaurante;

    document.getElementById("dadosSenha").innerText = primeirosTresCaracteresSenha;
    document.getElementById("dadosConfirmarSenha").innerText = primeirosTresCaracteresConfirmarSenha;

    document.getElementById('dadosEmailResponsavel').innerText = emailResponsavel;
    document.getElementById('dadosTelefone').innerText = telefone;
    document.getElementById('dadosCep').innerText = cep;
    document.getElementById('dadosRua').innerText = rua;
    document.getElementById('dadosNumeroCasa').innerText = numeroCasa;
    document.getElementById('dadosPontoDeReferencia').innerText = pontoReferencia;
    document.getElementById('dadosBairro').innerText = bairro;
    document.getElementById('dadosCidade').innerText = cidade;
    document.getElementById('dadosEstado').innerText = estado;
    document.getElementById('dadosURL').innerText = `fastifood.com.br/${url}`;
    document.getElementById('retornarNome').innerText = nomeCompleto;
}

// Controle de exibição de campos para Pessoa Física/Jurídica
document.querySelectorAll('input[name="tipo_pessoa"]').forEach((input) => {
    input.addEventListener('change', function () {
        if (this.value === 'juridica') {
            document.getElementById('cnpj').parentElement.style.display = 'block';
            document.getElementById('razaoSocial').parentElement.style.display = 'block';
            document.getElementById('dadosCNPJ-box').style.display = 'flex';
            document.getElementById('dadosRazaoSocial-box').style.display = 'flex';
            document.getElementById('dadosCNPJ-box').classList.add('dadosCNPJ-active-mobile');
            document.getElementById('dadosRazaoSocial-box').classList.add('dadosRazaoSocial-box');
        } else {
            document.getElementById('cnpj').parentElement.style.display = 'none';
            document.getElementById('razaoSocial').parentElement.style.display = 'none';
            document.getElementById('dadosCNPJ-box').style.display = 'none';
            document.getElementById('dadosRazaoSocial-box').style.display = 'none';
            document.getElementById('dadosCNPJ-box').classList.remove('dadosCNPJ-active-mobile');
            document.getElementById('dadosRazaoSocial-box').classList.remove('dadosRazaoSocial-box');
        }
    });
});

document.getElementById('cnpj').parentElement.style.display = 'none';
document.getElementById('razaoSocial').parentElement.style.display = 'none';
document.getElementById('dadosCNPJ-box').style.display = 'none';
document.getElementById('dadosRazaoSocial-box').style.display = 'none';

// Preview da URL na etapa 3
const urlInput = document.getElementById('url_restaurante');
const preview = document.getElementById('previewURL');

urlInput.addEventListener('keyup', function(event) {
    let nome = this.value;

    nome = nome.replace(/ /g, '-');
    nome = nome.trim().toLowerCase().replace(/[^a-z0-9\-]/g, '');

    this.value = nome;
    preview.textContent = `Sua URL será: fastifood.com.br/${nome}`;
});

// Ao colocar CNPJ inserir automaticamente a Razão Social.
document.getElementById('cnpj').addEventListener('blur', function() {
    var cnpj = this.value.replace(/\D/g, '');

    if (cnpj.length === 14) {
        fetch(`https://brasilapi.com.br/api/cnpj/v1/${cnpj}`, { mode: 'cors' })
        .then(response => response.json())
        .then(data => {
            if (data.razao_social) {
                document.getElementById('razaoSocial').value = data.razao_social;
            }
        })
        .catch(error => {
            return null;
        });
    }

    if (this.value === "") {
        document.getElementById('razaoSocial').value = "";
    }
});


// Telefone
function mascaraTelefone(event) {
    let input = event.target;
    let telefone = input.value.replace(/\D/g, '');
    telefone = telefone.replace(/^(\d{2})(\d)/g, '($1) $2');
    telefone = telefone.replace(/(\d)(\d{4})$/, '$1-$2');
    input.value = telefone;
}
function limitarCaracteres(event) {
    let input = event.target;
    if (input.value.length > 15) {
        input.value = input.value.slice(0, 15);
    }
}

//CPF
function mascaraCPF(event) {
    let input = event.target;
    let cpf = input.value.replace(/\D/g, '');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    input.value = cpf;
}

// CNPJ
function mascaraEValidarCNPJ(cnpjInput) {
    let cnpj = cnpjInput.value.replace(/\D/g, '');

    if (cnpj.length <= 2) {
        cnpjInput.value = cnpj;
    } else if (cnpj.length <= 5) {
        cnpjInput.value = cnpj.replace(/^(\d{2})(\d{0,3})/, "$1.$2");
    } else if (cnpj.length <= 8) {
        cnpjInput.value = cnpj.replace(/^(\d{2})(\d{3})(\d{0,3})/, "$1.$2.$3");
    } else if (cnpj.length <= 12) {
        cnpjInput.value = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{0,4})/, "$1.$2.$3/$4");
    } else {
        cnpjInput.value = cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{0,2})/, "$1.$2.$3/$4-$5");
    }
}

// CEP
function buscarCEP() {
    let cep = document.getElementById('cep').value.replace(/\D/g, '');
    if (cep.length === 8) {
        fetch(`https://viacep.com.br/ws/${cep}/json/`)
        .then(response => response.json())
        .then(data => {
            if (!data.erro) {
                document.getElementById('rua').value = data.logradouro;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
            } else {
                alert("CEP não encontrado.");
            }
        })
        .catch(error => {
            console.error("Erro ao buscar o CEP: ", error);
            alert("Erro ao buscar o CEP.");
        });
    } else {
        alert("Por favor, insira um CEP válido.");
    }
}

// Olhinho visualizar senha
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const togglePasswordIcon = document.getElementById('togglePassword');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePasswordIcon.classList.toggle('fa-eye-slash');
}
function togglePasswordVisibilityConfirmation() {
    const passwordInput = document.getElementById('password_confirmation');
    const togglePasswordIcon = document.getElementById('togglePasswordConfirmation');
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    togglePasswordIcon.classList.toggle('fa-eye-slash');
}
