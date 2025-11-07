<?php
include '../include/conexao.php';
include '../include/header.php';
include '../include/side_bar.php';

$produto_id = $_GET['produto_id'] ?? null;
if ($produto_id) {
    $produto_id = intval($produto_id);

    $sql = "SELECT * FROM produtos WHERE produto_id = $produto_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Produto não encontrado.";
        exit;
    }
} else {
    echo "ID não informado.";
    exit;
}
?>
<!-- <div class="modal fade" id="modalProduto" tabindex="-1" aria-labelledby="modalProdutoLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalProdutoLabel">Detalhes do produto</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Fechar">
                </button>
            </div>
            <div class="modal-body"> -->
<div class="container my-4 p-4 border rounded-3 bg-white">
    <h5>Alterar produto</h5>
    <div class="row justify-content-center">
        <form action="processa.php" method="post" id="formProduto">
            <input type="hidden" name="acao" value="alterarProduto">
            <input type="hidden" name="produto_id" value="<?php echo htmlspecialchars($row['produto_id']) ?>">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($row['nome_produto']) ?>">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" class="form-control" value="<?php echo htmlspecialchars($row['descricao']) ?>">
            <div class="row justify-content-between">
                <div class="col-3">
                    <label for="custo">Custo</label>
                    <input type="number" name="custo" id="custo" class="form-control" value="<?php echo htmlspecialchars($row['custo']) ?>">
                </div>
                <div class="col-3">
                    <label for="preco">Preço</label>
                    <input type="number" name="preco" id="preco" class="form-control" value="<?php echo htmlspecialchars($row['preco']) ?>">
                </div>
                <div class="col-3">
                    <label for="margem">Margem</label>
                    <input type="text" name="margem" id="margem" class="form-control" value="0%" readonly>
                </div>
                <div class="col-3">
                    <label for="estoque">Estoque</label>
                    <input type="number" name="estoque" id="estoque" class="form-control" value="<?php echo htmlspecialchars($row['estoque']) ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <label for="fornecedor">Fornecedor</label>
                    <?php
                    $forncedor_id = $row['fornecedor_id'];
                    $sql_forncedor = "SELECT nome FROM fornecedores WHERE fornecedor_id = $forncedor_id";
                    $result_fornecedor = $conn->query($sql_forncedor);
                    if ($result_fornecedor->num_rows > 0) {
                        $row_fornecedor = $result_fornecedor->fetch_assoc();
                        echo "<select name='fornecedor_id' id='fornecedor' class='form-control' value='" . htmlspecialchars($row_fornecedor['nome']) . "'>
                                <option value='" . htmlspecialchars($forncedor_id) . "'>" . htmlspecialchars($row_fornecedor['nome']) . "</option>
                              </select>";
                    } else {
                        echo "<input type='text' class='form-control' value='Fornecedor não encontrado' readonly>";
                    }
                    ?>
                </div>
                <div class="col-4 text-center">
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
    function carregarProduto(produto_id) {
        $.ajax({
            url: 'buscar_produto.php?produto_id=' + produto_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data);
                $('#nome').val(data.nome_produto);
                $('#descricao').val(data.descricao);
                $('#custo').val(data.custo);
                $('#preco').val(data.preco);
                $('#estoque').val(data.estoque);
                $('#fornecedor').val(data.fornecedor_id);
                if (data.consignado == 1) {
                    $('#sim').prop('checked', true);
                } else {
                    $('#nao').prop('checked', true);
                }
            }
        });
    }
</script>