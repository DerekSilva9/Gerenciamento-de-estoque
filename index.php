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

                    <label for="categoria">Categoria:</label>
                    <select name="categoria">
                        <option value="vestuario">vestuario</option>
                        <option value="eletronicos">eletronicos</option>
                    </select>

                    <label for="preco">Preço (R$):</label>
                    <input type="number" step="0.01" name="preco" required>

                    <button type="submit" class="btn-modal">Salvar</button>
                </form>
            </div>
        </div>

        <!-- Modal de Edição -->
        <div id="modalEditar" class="modal">
            <div class="modal-content">
                <span class="close" id="closeModalEditar">&times;</span>
                <h2>Editar Produto</h2>
                <form action="produtos/editar.php" method="POST">
                    <input type="hidden" name="id" id="editar-id">

                    <label for="editar-nome">Nome do Produto:</label>
                    <input type="text" name="nome" id="editar-nome" required>

                    <label for="editar-descricao">Descrição:</label>
                    <textarea name="descricao" id="editar-descricao"></textarea>

                    <label for="editar-quantidade">Quantidade:</label>
                    <input type="number" name="quantidade" id="editar-quantidade" required>

                    <label for="editar-categoria">Categoria:</label>
                    <select name="categoria" id="editar-categoria">
                        <option value="vestuario">vestuario</option>
                        <option value="eletronicos">eletronicos</option>
                    </select>

                    <label for="editar-preco">Preço (R$):</label>
                    <input type="number" step="0.01" name="preco" id="editar-preco" required>

                    <button type="submit" class="btn-modal">Atualizar</button>
                </form>
            </div>
        </div>

        <!-- Tabela de Produtos -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Preço (R$)</th>
                    <th>Categoria</th>
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
                            <td>{$produto['categoria']}</td>
                            <td>
                                <a href='#' class='btn-edit openEditModal'
                                    data-id='{$produto['id']}'
                                    data-nome='{$produto['nome']}'
                                    data-descricao='{$produto['descricao']}'
                                    data-quantidade='{$produto['quantidade']}'
                                    data-categoria='{$produto['categoria']}'
                                    data-preco='{$produto['preco']}'
                                >Editar</a>
                                <a href='produtos/excluir.php?id={$produto['id']}' class='btn-delete' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Erro ao obter os dados: " . $db->lastErrorMsg() . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="assets/js/script.js"></script>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
