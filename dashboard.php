<?php
require_once 'includes/db_connect.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - E-commerce</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <div class="container">
    <!-- Barra de pesquisa -->
    <div class="search-bar-wrapper">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Pesquisar produtos..." />
        </div>
    </div>

    <!-- Categorias -->
    <div class="categories">
        <button class="btn-category" data-category="todos">Todos os Produtos</button>
        <button class="btn-category" data-category="vestuario">Vestuário</button>
        <button class="btn-category" data-category="eletronicos">Eletrônicos</button>
        <button class="btn-category" data-category="alimento">Alimento</button>
        <button class="btn-category" data-category="jogos">Jogos</button>
    </div>

    <!-- Produtos -->
    <div id="productGrid" class="product-grid">
        <?php
        $query = "SELECT * FROM produtos ORDER BY id DESC";
        $result = $db->query($query);

        if ($result instanceof SQLite3Result) {
            while ($produto = $result->fetchArray(SQLITE3_ASSOC)) {
                echo "<div class='product-card' data-category='{$produto['categoria']}' data-name='" . strtolower($produto['nome']) . "'>
                    <h3>{$produto['nome']}</h3>
                    <p class='description'>{$produto['descricao']}</p>
                    <p class='price'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>
                    <p class='category'>Categoria: {$produto['categoria']}</p>
                    <p class='code'>Código: {$produto['codigo']}</p>
                    <button class='btn-buy'>Comprar</button>
                </div>";
            }
        } else {
            echo "<p>Erro ao carregar os produtos: " . $db->lastErrorMsg() . "</p>";
        }
        ?>
    </div>
</div>

    <script>
        // Filtragem de produtos por categoria
        document.querySelectorAll('.btn-category').forEach(button => {
            button.addEventListener('click', () => {
                const category = button.getAttribute('data-category');
                const products = document.querySelectorAll('.product-card');

                products.forEach(product => {
                    if (category === 'todos' || product.getAttribute('data-category') === category) {
                        product.style.display = 'block';
                    } else {
                        product.style.display = 'none';
                    }
                });
            });
        });

        // Filtragem de produtos por nome
        const searchInput = document.getElementById('searchInput');
        searchInput.addEventListener('input', () => {
            const searchValue = searchInput.value.toLowerCase();
            const products = document.querySelectorAll('.product-card');

            products.forEach(product => {
                const productName = product.getAttribute('data-name');
                if (productName.includes(searchValue)) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    </script>

    <?php include 'includes/footer.php'; ?>
</body>
</html>