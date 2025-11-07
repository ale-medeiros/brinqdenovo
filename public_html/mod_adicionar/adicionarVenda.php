<?php
include '../include/conexao.php';
include '../include/header.php';
include '../include/side_bar.php';
?>
<div class="container my-4">
    <h5>Nova venda</h5>
    <form action="/processa.php" method="post" id="formVenda">
        <input type="hidden" name="acao" value="adicionarVenda">
        <label for="cliente">Cliente</label>
        <select name="cliente_id" id="cliente" class="form-control">
            <option value="">Selecione um cliente</option>
            <?php
            $sql = "SELECT cliente_id, nome FROM clientes";
            $result = mysqli_query($conn, $sql);
            while ($cliente = mysqli_fetch_array($result)) {
                echo "<option value='{$cliente['cliente_id']}'>{$cliente['nome']}</option>";
            }
            ?>
        </select>
        <table id="tabela-produtos">
            <thead>
                <tr>
                    <th class="w-10">ID</th>
                    <th class="w-50">Produto</th>
                    <th class="w-5">Qtde</th>
                    <th class="w-15">Valor un</th>
                    <th class="w-15">Total</th>
                    <th class="w-2"></th>
                    <th class="w-2"></th>
                </tr>
            </thead>
            <tbody>
                <tr class="produto-item">
                    <td>
                        <?php
                        $sql = "SELECT produto_id, nome_produto, preco, estoque FROM produtos";
                        $result = mysqli_query($conn, $sql);
                        ?>
                        <select name='produto_id[]' class='form-control produto-id' required>
                            <option value=''>Selecione um produto</option>
                            <?php while ($produto = mysqli_fetch_array($result)) { ?>
                                <option value='<?= $produto['produto_id']; ?>' data-nome='<?= $produto['nome_produto'] ?>' data-preco='<?= $produto['preco'] ?>'><?= $produto['produto_id']; ?></option>
                            <?php } ?>
                        </select>
                    </td>
                    <td><span class="form-control produtoNome">Nome do produto</span></td>
                    <td><input type="number" name="quantidade[]" class="form-control quantidade" value="0" required></td>
                    <td><input type="number" name="preco_unitario[]" class="form-control produto-valor" readonly></td>
                    <td><span class="form-control total-produto">0</span></td>
                    <td><button type="button" class="bg-pink-1 border-0 px-2 rounded-5 removerProduto">x</button></td>
                    <td><button type="button" class="bg-green-1 border-0 px-2 rounded-5 adicionarProduto">+</button></td>
                </tr>
            </tbody>
        </table>
        <div class="row justify-content-end">
            <div class="col-3 align-self-end">
                <label for="desconto">Valor de desconto</label>
                <input type="number" name="desconto" id="desconto" class="form-control" value="0">
            </div>
            <div class="col-3 align-self-end">
                <label for="valor_total">Valor total</label>
                <input type="text" name="valor_total" id="valor_total" class="form-control" placeholder="R$0,00" value="0" readonly>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-8">
                <label for="forma_pagamento">Forma de pagamento</label>
                <select name="forma_pagamento" id="forma_pagamento" class="form-control">
                    <option value="">Selecione uma forma de pagamento</option>
                    <option value="1">Dinheiro</option>
                    <option value="2">Pix</option>
                    <option value="3">Cartão de débito</option>
                    <option value="4">Cartão de crédito</option>
                </select>
            </div>
            <div class="col-4 text-end align-self-end">
                <button type="submit" class="bg-green-1 border-0 px-4 rounded-5">Finalizar venda</button>
            </div>
        </div>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tabelaProdutos = document.getElementById('tabela-produtos');
        const tbody = tabelaProdutos.querySelector('tbody');
        const botaoAdicionar = document.querySelector('.adicionarProduto');
        const inputDesconto = document.getElementById('desconto');

        // ------------------------------------------------
        // 1. Funções de Cálculo
        // ------------------------------------------------

        // 1.1 Calcula o total do item (Qtde * Valor unitário) e atualiza o total geral
        function atualizarTotalProduto(row) {
            const quantidade = parseFloat(row.querySelector('.quantidade').value) || 0;
            const preco = parseFloat(row.querySelector('.produto-valor').value) || 0;
            const total = quantidade * preco;
            row.querySelector('.total-produto').textContent = total.toFixed(2);
            calcularTotalGeral();
        }

        // 1.2 Calcula o total final da venda (Subtotal - Desconto)
        function calcularTotalGeral() {
            let subtotal = 0;
            // Seleciona todos os totais de produto para somar
            document.querySelectorAll('#tabela-produtos .total-produto').forEach(span => {
                subtotal += parseFloat(span.textContent) || 0;
            });

            const desconto = parseFloat(inputDesconto.value) || 0;
            const valorTotal = subtotal - desconto;

            // Atualiza o campo de valor total, garantindo que não seja negativo
            document.getElementById('valor_total').value = Math.max(0, valorTotal).toFixed(2);
        }

        // ------------------------------------------------
        // 2. Funções de Manipulação do DOM (Adicionar/Remover)
        // ------------------------------------------------

        // 2.1 Encontra a linha template a ser clonada
        const linhaTemplate = tbody.querySelector('.produto-item');

        // 2.2 Função para limpar a linha clonada
        function limparLinha(novaLinha) {
            // Zera todos os campos e spans para o novo item
            novaLinha.querySelector('.produto-id').selectedIndex = 0; // Seleciona a primeira opção ("Selecione um produto")
            novaLinha.querySelector('.produtoNome').textContent = 'Nome do produto';
            novaLinha.querySelector('.quantidade').value = 0;
            novaLinha.querySelector('.produto-valor').value = '';
            novaLinha.querySelector('.total-produto').textContent = '0.00';

            // Remove o botão de adicionar (ele só deve existir na última linha)
            const btnAdicionar = novaLinha.querySelector('.adicionarProduto');
            if (btnAdicionar) {
                btnAdicionar.remove();
            }
        }

        // 2.3 Função ADICIONAR PRODUTO
        function adicionarProduto() {
            // Clona a linha original para criar uma nova
            const novaLinha = linhaTemplate.cloneNode(true);

            // Remove o botão de adicionar da LINHA ANTERIOR
            const ultimaLinha = tbody.lastElementChild;
            const btnAdicionarAnterior = ultimaLinha.querySelector('.adicionarProduto');
            if (btnAdicionarAnterior) {
                btnAdicionarAnterior.remove();
            }

            // Limpa a nova linha antes de anexar
            limparLinha(novaLinha);

            // Adiciona um novo botão de adicionar na NOVA linha (para que a funcionalidade possa continuar)
            const celulaAcoes = novaLinha.querySelector('tr > td:last-child');
            const novoBotaoAdicionar = document.createElement('button');
            novoBotaoAdicionar.type = 'button';
            novoBotaoAdicionar.className = 'bg-green-1 border-0 px-2 rounded-5 adicionarProduto';
            novoBotaoAdicionar.textContent = '+';
            celulaAcoes.appendChild(novoBotaoAdicionar);

            // Anexa a nova linha ao corpo da tabela
            tbody.appendChild(novaLinha);

            // Adiciona um listener ao novo botão de adicionar
            novoBotaoAdicionar.addEventListener('click', adicionarProduto);

            // Recalcula o total geral (embora seja 0, é bom para manter o estado)
            calcularTotalGeral();
        }

        // 2.4 Função REMOVER PRODUTO
        function removerProduto(e) {
            const row = e.target.closest('tr');
            // Impede a remoção se for a última linha
            if (tbody.children.length === 1) {
                alert("A venda deve ter pelo menos um produto.");
                return;
            }

            const isLastRow = row === tbody.lastElementChild;

            // Remove a linha
            row.remove();

            // Se a linha removida for a ÚLTIMA, precisamos colocar o botão '+' na nova última linha
            if (isLastRow) {
                const novaUltimaLinha = tbody.lastElementChild;
                const celulaAcoes = novaUltimaLinha.querySelector('tr > td:last-child');

                // Cria e anexa o botão de adicionar
                const novoBotaoAdicionar = document.createElement('button');
                novoBotaoAdicionar.type = 'button';
                novoBotaoAdicionar.className = 'bg-green-1 border-0 px-2 rounded-5 adicionarProduto';
                novoBotaoAdicionar.textContent = '+';
                celulaAcoes.appendChild(novoBotaoAdicionar);

                // Adiciona o listener para o novo botão
                novoBotaoAdicionar.addEventListener('click', adicionarProduto);
            }

            // Recalcula o total após a remoção
            calcularTotalGeral();
        }

        // ------------------------------------------------
        // 3. Delegação e Inicialização de Eventos
        // ------------------------------------------------

        // 3.1 Delegação de eventos para a tabela
        // Isso garante que eventos 'change' e 'click' funcionem em linhas novas e existentes.
        tabelaProdutos.addEventListener('change', function(e) {
            const row = e.target.closest('tr');

            if (e.target.classList.contains('produto-id')) {
                const produtoSelect = e.target;
                const selectedOption = produtoSelect.options[produtoSelect.selectedIndex];

                // Atualiza nome, preço e valor total do item
                const produtoNome = selectedOption.getAttribute('data-nome') || 'Nome do produto';
                const produtoPreco = selectedOption.getAttribute('data-preco') || 0;

                row.querySelector('.produtoNome').textContent = produtoNome;
                row.querySelector('.produto-valor').value = produtoPreco;

                // Define a quantidade para 1 ao selecionar um produto, se for 0
                if (parseFloat(row.querySelector('.quantidade').value) === 0) {
                    row.querySelector('.quantidade').value = 1;
                }

                atualizarTotalProduto(row);

            } else if (e.target.classList.contains('quantidade')) {
                // Recalcula o total se a quantidade mudar
                atualizarTotalProduto(row);
            }
        });

        tabelaProdutos.addEventListener('click', function(e) {
            if (e.target.classList.contains('removerProduto')) {
                removerProduto(e);
            }
        });

        // 3.2 Event Listeners para o botão Adicionar e Desconto
        botaoAdicionar.addEventListener('click', adicionarProduto);
        inputDesconto.addEventListener('input', calcularTotalGeral);

        // 3.3 Inicialização (Garante que o total inicial de 0 seja exibido)
        calcularTotalGeral();
    });
</script>