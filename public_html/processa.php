<?php
include 'include/conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" || $_SERVER["REQUEST_METHOD"] == "GET") {
    $acao = $_REQUEST['acao'] ?? '';

    switch ($acao) {
        //-- Ações para fornecedores --//
        case 'adicionarFornecedor':
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $endereco = $_POST['endereco'];

            $sql = "INSERT INTO fornecedores (nome, telefone, cpf, email, endereco)
                VALUES ('$nome', '$telefone', '$cpf', '$email', '$endereco')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Novo fornecedor adicionado com sucesso'); window.location.href='https://brinqdenovo.com.br/index.php';</script>";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;

        case 'alterarFornecedor':
            $fornecedor_id = $_POST['fornecedor_id'];
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];
            $endereco = $_POST['endereco'];

            $sql = "UPDATE fornecedores SET 
                        nome='$nome', 
                        telefone='$telefone', 
                        cpf='$cpf', 
                        email='$email', 
                        endereco='$endereco' 
                        WHERE fornecedor_id='$fornecedor_id'";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Fornecedor alterado com sucesso'); window.location.href='https://brinqdenovo.com.br/index.php';</script>";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }

        case 'excluirFornecedor':
            $fornecedor_id = $_GET['fornecedor_id'] ?? null;

            if ($fornecedor_id) {
                $fornecedor_id = intval($fornecedor_id);
                $sql = "DELETE FROM fornecedores WHERE fornecedor_id = '$fornecedor_id'";

                if ($conn->query($sql) === TRUE) {
                    // Redireciona para a lista após exclusão
                    header("Location: index.php?msg=fornecedor-excluido");
                    exit;
                } else {
                    echo "Erro ao excluir: " . $conn->error;
                }
            } else {
                echo "ID não informado.";
            }
            break;
        //-- Ações para produtos --//
        case 'adicionarProduto':
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $custo = $_POST['custo'];
            $preco = $_POST['preco'];
            $estoque = $_POST['estoque'];
            $fornecedor_id = $_POST['fornecedor_id'];
            $consignado = isset($_POST['consignado']) ? (int) $_POST['consignado'] : 0;

            $sql = "INSERT INTO produtos (nome_produto, descricao, custo, preco, estoque, fornecedor_id, consignado)
            VALUES ('$nome', '$descricao', '$custo', '$preco', '$estoque', '$fornecedor_id', '$consignado')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Produto adicionado com sucesso'); window.location.href='https://brinqdenovo.com.br/index.php';</script>";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
        case 'alterarProduto':
            $produto_id = $_POST['produto_id'];
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $custo = $_POST['custo'];
            $preco = $_POST['preco'];
            $estoque = $_POST['estoque'];
            $fornecedor_id = $_POST['fornecedor_id'];
            $consignado = isset($_POST['consignado']) ? (int) $_POST['consignado'] : 0;

            $sql = "UPDATE produtos SET 
                        nome_produto='$nome', 
                        descricao='$descricao', 
                        custo='$custo', 
                        preco='$preco', 
                        estoque='$estoque', 
                        fornecedor_id='$fornecedor_id',
                        consignado='$consignado' 
                        WHERE produto_id='$produto_id'";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Produto alterado com sucesso'); window.location.href='https://brinqdenovo.com.br/index.php';</script>";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
        case 'excluirProduto':
            $produto_id = $_GET['produto_id'] ?? null;
            if ($produto_id) {
                $produto_id = intval($produto_id);
                $sql = "DELETE FROM produtos WHERE produto_id = '$produto_id'";

                if ($conn->query($sql) === TRUE) {
                    // Redireciona para a lista após exclusão
                    header("Location: index.php?msg=produto-excluido");
                    exit;
                } else {
                    echo "Erro ao excluir: " . $conn->error;
                }
            } else {
                echo "ID não informado.";
            }
            break;


        //-- Ações para vendas --//
        case 'adicionarVenda':
            $cliente_id = $_POST['cliente_id'];
            $desconto = $_POST['desconto'];
            $valor_total = $_POST['valor_total'];
            $forma_pagamento = $_POST['forma_pagamento'];

            $sqlVenda = "INSERT INTO vendas (cliente_id, desconto, valor_total, forma_pagamento)
            VALUES ('$cliente_id', '$desconto', '$valor_total', '$forma_pagamento')";

            if (mysqli_query($conn, $sqlVenda)) {
                $venda_id = mysqli_insert_id($conn);

                if (!empty($_POST['produto_id'])) {
                    $stmt = mysqli_prepare($conn, "INSERT INTO vendas_itens (venda_id, produto_id, quantidade, preco_unitario) VALUES (?,?,?,?)");
                    mysqli_stmt_bind_param($stmt, 'iiid', $venda_id, $produto_id, $quantidade, $preco_unitario);
                    foreach ($_POST['produto_id'] as $index => $produto_id) {
                        $quantidade = $_POST['quantidade'][$index];
                        $preco_unitario = str_replace(',', '.', $_POST['preco_unitario'][$index]);
                        mysqli_stmt_execute($stmt);
                    }
                    mysqli_stmt_close($stmt);
                }
                echo "<script>alert('Venda registrada com sucesso'); window.location.href='https://brinqdenovo.com.br/index.php';</script>";
            } else {
                echo "Erro:" . mysqli_error($conn);
            }
            break;
        case 'excluirVenda':
            $venda_id = $_POST['venda_id'] ?? null;
            $motivo = $_POST['motivo'] ?? '';
            if ($venda_id && $motivo != '') {
                $sql = "UPDATE vendas 
                        SET 
                            excluida = 1,
                            motivo_exclusao = '$motivo'
                            data_exclusao = NOW()
                        WHERE venda_id = '$venda_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Venda excluída com sucesso'); window.location.href='https://brinqdenovo.com.br/index.php?msg=venda-excluida';</script>";
                    exit;
                } else {
                    echo "Erro ao excluir: " . $conn->error;
                }
            } else {
                echo "ID não informado.";
            }
            break;
        //-- Ações para clientes --//
        case 'adicionarCliente':
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];

            $sql = "INSERT INTO clientes (nome, telefone, email)
            VALUES ('$nome', '$telefone', '$email')";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Novo cliente adicionado com sucesso'); window.location.href='https://brinqdenovo.com.br/index.php';</script>";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
        case 'alterarCliente':
            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];

            $sql = "UPDATE clientes SET 
                        nome='$nome', 
                        telefone='$telefone', 
                        email='$email' 
                        WHERE cliente_id='$cliente_id'";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Cliente alterado com sucesso'); window.location.href='https://brinqdenovo.com.br/index.php';</script>";
            } else {
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
            break;
        case 'excluirCliente':
            $cliente_id = $_GET['cliente_id'] ?? null;

            if ($cliente_id) {
                $cliente_id = intval($cliente_id);
                $sql = "DELETE FROM clientes WHERE cliente_id = '$cliente_id'";

                if ($conn->query($sql) === TRUE) {
                    header("Location: index.php?msg=cliente-excluido");
                    exit;
                } else {
                    echo "Erro ao excluir:" . $conn->server;
                }
            } else {
                echo "ID não informado.";
            }
            break;
    }
}
$conn->close();
