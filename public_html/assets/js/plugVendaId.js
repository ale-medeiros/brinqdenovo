
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('excluirVendaModal');
    modal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var id = button.getAttribute('data-id');
        document.getElementById('venda_id_modal').value = id;
        document.getElementById('excluirVendaModalLabel').innerText = "Cancelar venda #" + id;
    });
});