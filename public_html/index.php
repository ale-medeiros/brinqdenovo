    <?php
    include 'include/conexao.php';
    include 'include/header.php';
    include 'include/side_bar.php';
    ?>
    ola teste 2
    <div class="container">
        <div class="row justify-content-evenly">
            <div class="col-6 my-2 bg-pink-2 rounded-3 px-3 py-2">
                <h3>Últimas vendas</h3>
                <?php include 'tabelas/tabelaVendas.php'; ?>
            </div>
            <div class="col-5 my-2 bg-green-2 rounded-3 px-3 py-2">
                <h3>Produtos</h3>
                <?php include 'tabelas/tabelaProdutos.php'; ?>
            </div>
            <div class="col-6 my-2 bg-blue-2 rounded-3 px-3 py-2">
                <h3>Clientes</h3>
                <?php include 'tabelas/tabelaClientes.php'; ?>
            </div>
            <div class="col-5 my-2 bg-purple rounded-3 px-3 py-2">
                <h3>Fornecedores</h3>
                <?php include 'tabelas/tabelaFornecedores.php'; ?>
            </div>
        </div>
    </div>
    <?php include 'include/footer.php'; ?>