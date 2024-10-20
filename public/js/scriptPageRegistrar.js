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
