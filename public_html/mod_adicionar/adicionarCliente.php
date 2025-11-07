<?php
include '../include/conexao.php';
include '../include/header.php';
include '../include/side_bar.php';
?>
<!-- <div class="modal fade" id="adicionarCliente" tabindex="-1" aria-labelledby="adicionarClienteLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
                <h5 class="modal-title" id="adicionarClienteLabel">Adicionar cliente</h5>-->
<!-- <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true"></span>
                </button>
            <div class="modal-body"> -->
<div class="container my-4">
    <h5>Adicionar cliente</h5>
    <form action="/processa.php" method="post">
        <input type="hidden" name="acao" value="adicionarCliente">
        <div class="row justify-content-between">
            <div class="col-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="col-6">
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefone" class="form-control" required>
            </div>
        </div>
        <div class="row justify-content-between">
            <div class="col-6">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="col-6">
                <label for="instagram">Instagram</label>
                <input type="text" name="instagram" id="instagram" class="form-control">
            </div>
        </div>
        <button type="submit"
            class="bg-green-1 border-0 my-2 px-4 rounded-5">Adicionar</button>
    </form>
</div>
<!-- </div>
    </div>
</div> -->
<script src="../assets/js/mascaraTel.js"></script>
<script>
    initPhoneMaskById('telefone');
</script>
<?php
include '../include/footer.php';
?>