<?php
require_once 'includes/db_connect.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Estoque</title>
    <link rel="stylesheet" href="Assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
        <h1>Gerenciamento de Produtos</h1>
        <a href="#" class="btn" id="openModal">+ Adicionar Produto</a>

        <!-- Modal de Adição -->
        <div id="modalAdicionar" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModal">&times;</span>
                <h2>Adicionar Produto</h2>
                <form action="produtos/adicionar.php" method="POST">
                    <label for="nome">Nome do Produto:</label>
                    <input type="text" name="nome" required>

                    <label for="descricao">Descrição:</label>
                    <textarea name="descricao"></textarea>

                    <label for="quantidade">Quantidade:</label>
                    <input type="number" name="quantidade" required>

                    <label for="preco">Preço (R$):</label>
                    <input type="number" step="0.01" name="preco" required>

                    <button type="submit" class="btn-modal">Salvar</button>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Preço (R$)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM produtos ORDER BY id DESC";
                $result = $db->query($query);
                
                if ($result instanceof SQLite3Result) {
                    while ($produto = $result->fetchArray(SQLITE3_ASSOC)) {
                        echo "<tr>
                            <td>{$produto['id']}</td>
                            <td>{$produto['nome']}</td>
                            <td>{$produto['descricao']}</td>
                            <td>{$produto['quantidade']}</td>
                            <td>" . number_format($produto['preco'], 2, ',', '.') . "</td>
                            <td>
                                <a href='produtos/editar.php?id={$produto['id']}' class='btn-edit'>Editar</a>
                                <a href='produtos/excluir.php?id={$produto['id']}' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "Erro ao obter os dados: " . $db->lastErrorMsg();
                }
                
                ?>
            </tbody>
        </table>
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="assets/js/script.js"></script>
</body>
</html>
