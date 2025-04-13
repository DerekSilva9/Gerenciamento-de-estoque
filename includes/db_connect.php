<?php
$db = new SQLite3('db/estoque.sqlite');

// Verificando se a conexão foi bem-sucedida
if (!$db) {
    die("Erro na conexão com o banco de dados.");
} else {
    echo "Conexão bem-sucedida!";
}
?>
