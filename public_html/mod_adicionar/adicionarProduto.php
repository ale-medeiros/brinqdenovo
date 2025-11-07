<?php
include '../include/conexao.php';
include '../include/header.php';
include '../include/side_bar.php';
?>
<!-- <div class="modal fade" id="adicionarProduto" tabindex="-1" aria-labelledby="adicionarProdutoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adicionarProdutoLabel">Adicionar produto</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body"> -->
<div class="container my-4">
    <h5>Adicionar produto</h5>
    <form action="/processa.php" method="post">
        <input type="hidden" name="acao" value="adicionarProduto">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" required>
        <label for="descricao">Descrição</label>
        <input type="text" name="descricao" id="descricao" class="form-control"
            placeholder="Cor, tamanho, etc." required>
        <div class="row justify-content-between">
            <div class="col-3">
                <label for="preco">Preço de venda</label>
                <input type="number" name="preco" id="preco" class="form-control" required step="0.01">
            </div>
            <div class="col-3">
                <label for="custo">Repasse</label>
                <input type="number" name="custo" id="custo" class="form-control" readonly step="0.01">
            </div>
            <div class="col-3">
                <label for="estoque">Quantidade</label>
                <input type="number" name="estoque" id="estoque" class="form-control" required>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <label for="fornecedor">Fornecedor</label>
                <select name="fornecedor_id" id="fornecedor" class="form-control" required>
                    <option value="">Selecione um fornecedor</option>
                    <?php
                    include 'conexao.php';
                    $sql = "SELECT fornecedor_id, nome FROM fornecedores";
                    $result = mysqli_query($conn, $sql);
                    while ($fornecedor = mysqli_fetch_array($result)) {
                        echo "<option value='{$fornecedor['fornecedor_id']}'>{$fornecedor['nome']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-4 text-center" style="display: none;">
                <h5 for="consigando">Consigando</h5>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                        <input type="radio" name="consignado" id="sim" class="form-control" value="1" hidden checked>
                        <label for="sim" class="radio-consignado">Sim</label>
                    </div>
                    <div class="col-5">
                        <input type="radio" name="consignado" id="nao" class="form-control" value="0" hidden>
                        <label for="nao" class="radio-consignado">Não</label>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="bg-green-1 border-0 my-2 px-4 rounded-5">Salvar</button>
    </form>
</div>
<!-- </div>
</div>
</div> -->

<script>
    window.onload = function() {
        const preco = document.getElementById("preco");
        const custo = document.getElementById("custo");
        const margem = 60;

        function calcularMargemDeLucro() {
            const precoValue = parseFloat(preco.value) || 0;
            const custoFinal = precoValue + ((precoValue * margem) / 100);
            custo.value = custoFinal.toFixed(2);
        }
        preco.addEventListener("input", calcularMargemDeLucro);
    };
</script>