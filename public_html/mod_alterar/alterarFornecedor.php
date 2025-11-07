<?php
include '../include/conexao.php';
include '../include/header.php';
include '../include/side_bar.php';

$id = $_GET['fornecedor_id'] ?? null;
if ($id) {
    $id = intval($id);

    $sql = "SELECT * FROM fornecedores WHERE fornecedor_id  = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Fornecedor não encontrado.";
        exit;
    }
} else {
    echo "ID não informado.";
    exit;
}
?>
<!-- <div class="modal fade" id="modalFornecedor" tabindex="-1"
    aria-labelledby="modalFornecedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alterarFornecedorLabel">Editar fornecedor</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body"> -->
<div class="container my-2 p-4 border rounded-3 bg-white">
    <h5>Alterar fornecedor</h5>
    <form action="/processa.php" method="post">
        <input type="hidden" name="acao" value="alterarFornecedor">
        <input type="hidden" name="fornecedor_id" id="fornecedor_id" value="<?php echo htmlspecialchars($row['fornecedor_id']) ?>">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($row['nome']) ?>">
        <div class="row justify-content-between">
            <div class="col-6">
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefoneFornecedor" class="form-control" value="<?php echo htmlspecialchars($row['telefone']) ?>">
            </div>
            <div class="col-6">
                <label for="cpf">CPF</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="<?php echo htmlspecialchars($row['cpf']) ?>">
            </div>
        </div>
        <label for="email">E-mail</label>
        <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($row['email']) ?>">
        <label for="endereco">Endereço</label>
        <input type="text" name="endereco" id="endereco" class="form-control" value="<?php echo htmlspecialchars($row['endereco']) ?>">
        <button type="submit"
            class="bg-green-1 border-0 my-2 px-4 rounded-5">Alterar</button>
    </form>
</div>
<!-- </div>
</div>
</div> -->