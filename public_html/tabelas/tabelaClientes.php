<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col" class="col-4">Nome</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === 'cliente-excluido') {
            echo "<div class='alert alert-success'>Cliente excluído com sucesso!</div>";
        }

        $sql = "SELECT * FROM clientes";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['nome']}</td>
                        <td>
                            <a class='text-decoration-none' href='mod_visualizar/visualizarCliente.php?cliente_id={$row['cliente_id']}'>
                                <img src='assets/img/visualizar.svg'>
                            </a>
                            <a class='text-decoration-none' href='mod_alterar/alterarCliente.php?cliente_id={$row['cliente_id']}'>
                                <img src='assets/img/editar.svg'>
                            </a>
                            <a class='text-decoration-none' href='processa.php?acao=excluirCliente&cliente_id={$row['cliente_id']}' onclick=\"return confirm('Tem certeza que deseja excluir este cliente?');\">
                                <img src='assets/img/excluir.svg'>
                            </a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhum cliente encontrado.</td></tr>";
        }
        ?>
    </tbody>
</table>