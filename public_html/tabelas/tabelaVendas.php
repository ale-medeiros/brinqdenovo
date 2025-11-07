<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Data</th>
            <th scope="col">Cliente</th>
            <th scope="col">Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($_GET['msg']) && $_GET['msg'] === 'venda-excluida') {
            echo "<div class='alert alert-success'>Venda excluída com sucesso!</div>";
        }
        $pagina_atual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
        $itens_por_pagina = 10;
        $offset = ($pagina_atual - 1) * $itens_por_pagina;

        $sql = "SELECT vendas.venda_id, vendas.data_venda, vendas.cliente_id, vendas.valor_total, clientes.nome
                FROM vendas
                INNER JOIN clientes ON vendas.cliente_id = clientes.cliente_id
                WHERE vendas.excluida = 0
                ORDER BY vendas.venda_id DESC 
                LIMIT $itens_por_pagina OFFSET $offset";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['venda_id']}</td>
                        <td>" . (new DateTime($row['data_venda']))->format('d/m/Y') . "</td>
                        <td>{$row['nome']}</td>
                        <td>R$ {$row['valor_total']}</td>
                        <td>
                            <a class='' href='mod_visualizar/visualizarVenda.php?venda_id={$row['venda_id']}'>
                                <img src='assets/img/visualizar.svg'>
                            </a>
                            <a class='' href='javascript:avoid(0)' data-bs-toggle='modal' data-bs-target='#excluirVendaModal' data-id='{$row['venda_id']}'>
                                <img src='assets/img/excluir.svg'>
                            </a>
                        </td>
                    </tr>";
            }

            // Paginação
            $sql = "SELECT COUNT(*) AS total FROM vendas";
            $result = $conn->query($sql);
            $total = $result->fetch_assoc()['total'];

            $paginas = ceil($total / $itens_por_pagina);
            $pagina_anterior = $pagina_atual > 1 ? $pagina_atual - 1 : 1;
            $pagina_posterior = $pagina_atual < $paginas ? $pagina_atual + 1 : $paginas;

            echo "<div colspan='5' style='margin-top: 10px;'>";

            echo "</div>";
            echo "<tr><td colspan='5' class='text-center'><a href='?pagina=$pagina_anterior'>Anterior</a>";
            for ($i = 1; $i <= $paginas; $i++) {
                echo "<a href='?pagina=$i' style='margin: 5px;'>" . ($i == $pagina_atual ? "<strong>$i</strong>" : $i) . "</a>";
            }
            echo " <a href='?pagina=$pagina_posterior'>Próxima</a></td></tr>";
        } else {
            echo "<tr><td colspan='4'>Nenhuma venda encontrada.</td></tr>";
        }
        include 'mod_alterar/alterarVenda.php';
        ?>
    </tbody>
</table>
<script>
</script>