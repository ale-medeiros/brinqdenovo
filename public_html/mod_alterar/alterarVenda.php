<div class="modal fade" id="excluirVendaModal" tabindex="-1" aria-labelledby="excluirVendaModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excluirVendaModalLabel">Cancelar venda #</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="processa.php" method="post">
                    <input type="hidden" name="acao" value="excluirVenda">
                    <input type="hidden" name="venda_id" id="venda_id_modal">
                    <div class="mb-3">
                        <label for="motivo" class="col-form-label">Motivo da exclusão:</label>
                        <textarea class="form-control" id="motivo" name="motivo" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Cancelar venda</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/plugVendaId.js"></script>