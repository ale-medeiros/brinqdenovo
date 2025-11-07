<?php
include '../include/conexao.php';
include '../include/header.php';
include '../include/side_bar.php';
?>
<!-- <div class="modal fade" id="adicionarFornecedor" tabindex="-1"
    aria-labelledby="adicionarFornecedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adicionarFornecedorLabel">Adicionar fornecedor</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body"> -->
<div class="container my-4">
    <h5>Adicionar fornecedor</h5>
    <form action="/processa.php" method="post">
        <input type="hidden" name="acao" value="adicionarFornecedor">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control">
        <div class="row justify-content-between">
            <div class="col-6">
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefoneFornecedor" class="form-control">
            </div>
            <div class="col-6">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control">
            </div>
        </div>
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" class="form-control">
        <label for="endereco">Endereço</label>
        <input type="text" name="endereco" id="endereco" class="form-control">
        <label for="pix">Chave Pix</label>
        <input type="text" name="pix" id="pix" class="form-control">
        <button type="submit"
            class="bg-green-1 border-0 my-2 px-4 rounded-5">Salvar</button>
    </form>
</div>
<!-- </div>
</div>
</div> -->
<script src="/assets/js/mascaraTel.js"></script>
<script src="/assets/js/mascaraCpf.js"></script>
<script>
    initPhoneMaskById('telefoneFornecedor');
    initCPFMaskById('cpf');
</script>
<?php
include '../include/footer.php';
?>