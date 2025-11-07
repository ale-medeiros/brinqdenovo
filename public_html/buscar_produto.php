<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_REQUEST['produto_id'])) {
        $produto_id = intval($_REQUEST['produto_id']);

        $sql = "SELECT * FROM produtos WHERE produto_id = '$produto_id'";
        $result = mysqli_query($conn, $sql);
        $produto = mysqli_fetch_assoc($result);
        
        echo json_encode($produto);
    }
}
?>