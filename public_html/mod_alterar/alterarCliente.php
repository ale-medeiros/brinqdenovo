<?php
include '../include/conexao.php';
include '../include/header.php';
include '../include/side_bar.php';

$id = $_GET['cliente_id'] ?? null;
if ($id) {
    $id = intval($id);

    $sql = "SELECT * FROM clientes WHERE cliente_id  = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Cliente não encontrado.";
        exit;
    }
} else {
    echo "ID não informado.";
    exit;
}
?>
<div class="container my-2 p-4 border rounded-3 bg-white">
    <h5>Alterar cliente</h5>
    <form action="/processa.php" method="post">
        <input type="hidden" name="acao" value="alterarCliente">
        <input type="hidden" name="cliente_id" id="cliente_id" value="<?php echo htmlspecialchars($row['cliente_id']) ?>">
        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($row['nome']) ?>">
        <div class="row justify-content-between">
            <div class="col-6">
                <label for="telefone">Telefone</label>
                <input type="tel" name="telefone" id="telefoneCliente" class="form-control" value="<?php echo htmlspecialchars($row['telefone']) ?>">
            </div>
            <div class="col-6">
                <label for="email">E-mail</label>
                <input type="text" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($row['email']) ?>">
            </div>
        </div>
        <button type="submit"
            class="bg-green-1 border-0 my-2 px-4 rounded-5">Alterar</button>
    </form>
</div>