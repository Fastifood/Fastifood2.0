document.getElementById("rejeitarPedidoBtn").addEventListener("click", function() {
    var myModal = new bootstrap.Modal(document.getElementById('rejeitarPedidoModal'));
    myModal.show();
});

document.getElementById("confirmarRejeicao").addEventListener("click", function() {
    alert('Pedido rejeitado com sucesso!');
});