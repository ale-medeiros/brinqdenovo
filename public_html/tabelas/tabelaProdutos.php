<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Descrição</th>
            <th scope="col">Estoque</th>
            <th scope="col">Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['msg'])&& $_GET['msg'] === 'produto-excluido') {
            echo "<div class='alert alert-success'>Produto excluído com sucesso!</div>";
        }
        $sql = "SELECT produto_id, nome_produto, estoque, custo FROM produtos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['produto_id']}</td>
                        <td>{$row['nome_produto']}</td>
                        <td>{$row['estoque']}</td>
                        <td>R$ {$row['custo']}</td>
                        <td>
                            <a class='' href='mod_visualizar/visualizarProduto.php?produto_id={$row['produto_id']}'>
                                <img src='assets/img/visualizar.svg'>
                            </a>
                            <a class='' href='mod_alterar/alterarProduto.php?produto_id={$row['produto_id']}'>
                                <img src='assets/img/editar.svg'>
                            </a>
                            <a class='' href='processa.php?acao=excluirProduto&produto_id={$row['produto_id']}' onclick=\"return confirm('Tem certeza que deseja excluir este produto?');\">
                                <img src='assets/img/excluir.svg'>
                            </a>
                            </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum produto encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>