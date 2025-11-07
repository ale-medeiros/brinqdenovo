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

<!-- <div class="modal fade" id="modalVisualizarFornecedor" tabindex="-1"
    aria-labelledby="modalVisualizarFornecedorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alterarFornecedorLabel">Editar fornecedor</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true"></span>
                </button>
            </div> 
            <div class="modal-body">-->
<div class="container my-2 p-4 border rounded-3 bg-white">
    <h5><?php echo htmlspecialchars($row['nome']) ?></h5>
    <div class="row justify-content-between">
        <div class="col-6">
            <label for="telefone">Telefone</label>
            <p name="telefone"><?php echo htmlspecialchars($row['telefone']) ?></p>
        </div>
        <div class="col-6">
            <label for="cpf">CPF</label>
            <p name="cpf"><?php echo htmlspecialchars($row['cpf']) ?></p>
        </div>
    </div>
    <label for="email">E-mail</label>
    <p name="email"><?php echo htmlspecialchars($row['email']) ?></p>
    <label for="endereco">Endereço</label>
    <p name="endereco"><?php echo htmlspecialchars($row['endereco']) ?></p>
</div>
<!-- </div>
</div>
</div> -->