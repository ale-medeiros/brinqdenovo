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
<div class="container my-4">
    <h5>ID do produto: <strong><?php echo htmlspecialchars($row['produto_id']) ?></strong> | Nome do produto: <strong><?php echo htmlspecialchars($row['nome_produto']) ?></strong></h5>
    <label for="descricao">Descrição</label>
    <p><?php echo htmlspecialchars($row['descricao']) ?></p>
    <div class="row justify-content-between">
        <div class="col-3">
            <label for="custo">Custo</label>
            <p><?php echo htmlspecialchars($row['custo']) ?></p>
        </div>
        <div class="col-3">
            <label for="preco">Preço</label>
            <p><?php echo htmlspecialchars($row['preco']) ?></p>
        </div>
        <div class="col-3">
            <label for="margem">Margem</label>
            <p></p>
        </div>
        <div class="col-3">
            <label for="estoque">Estoque</label>
            <p><?php echo htmlspecialchars($row['estoque']) ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <label for="fornecedor">Fornecedor</label>
            <p><?php
                $forncedor_id = $row['fornecedor_id'];
                $sql_forncedor = "SELECT nome FROM fornecedores WHERE fornecedor_id = $forncedor_id";
                $result_fornecedor = $conn->query($sql_forncedor);

                if ($result_fornecedor->num_rows > 0) {
                    $row_fornecedor = $result_fornecedor->fetch_assoc();
                    echo htmlspecialchars($row_fornecedor['nome']);
                } else {
                    echo "Fornecedor não encontrado.";
                }
                ?></p>
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
    <a class="bg-green-1 border-0 my-2 px-4 rounded-5 text-reset text-decoration-none" href="../mod_alterar/alterarProdutos.php?acao=excluirProduto&produto_id=<?php echo $row['produto_id'] ?>">
        Editar produto
    </a>
</div>