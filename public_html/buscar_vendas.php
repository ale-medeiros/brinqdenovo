<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_REQUEST['venda_id'])) {
        $venda_id = intval($_REQUEST['venda_id']);

        $sql = "SELECT * FROM vendas WHERE venda_id = '$venda_id'";
        $result = mysqli_query($conn, $sql);
        $venda = mysqli_fetch_assoc($result);
        
        echo json_encode($produto);
    }
}
?>