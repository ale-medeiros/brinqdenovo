<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === 'fornecedor-excluido') {
            echo "<div class='alert alert-success'>Fornecedor excluído com sucesso!</div>";
        }
        $sql = "SELECT fornecedor_id, nome, telefone, valor_pagar FROM fornecedores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['fornecedor_id']}</td>
                        <td>{$row['nome']}</td>
                        <td>{$row['telefone']}</td>
                        <td>
                            <a class='' href='mod_visualizar/visualizarFornecedor.php?fornecedor_id={$row['fornecedor_id']}'>
                                <img src='assets/img/visualizar.svg'>
                            </a>
                            <a class='' href='mod_alterar/alterarFornecedor.php?fornecedor_id={$row['fornecedor_id']}'>
                                <img src='assets/img/editar.svg'>
                            </a>
                            <a class='' href='processa.php?acao=excluirFornecedor&fornecedor_id={$row['fornecedor_id']}' onclick=\"return confirm('Tem certeza que deseja excluir este fornecedor?');\">
                                <img src='assets/img/excluir.svg'>
                            </a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum fornecedor encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>