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
<div class="container my-4">
    <h5><?php echo htmlspecialchars($row['nome'])?></h5>
        <div class="row justify-content-between">
            <div class="col-6">
                <label for="nome">Nome</label>
                <p name="nome"><?php echo htmlspecialchars($row['nome']) ?></p>
            </div>
            <div class="col-5">
                <label for="telefone">Telefone</label>
                <p name="telefone"><?php echo htmlspecialchars($row['telefone']) ?></p>
            </div>
        </div>
        <label for="email">E-mail</label>
        <p name="email"><?php echo htmlspecialchars($row['email']) ?></p>
</div>