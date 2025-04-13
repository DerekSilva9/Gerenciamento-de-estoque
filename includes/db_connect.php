<?php
// Caminho absoluto do banco de dados
$dbPath = __DIR__ . '/../db/estoque.sqlite'; // Ajusta o caminho conforme necessário
$db = new SQLite3($dbPath);

// Verificando se a conexão foi bem-sucedida
if (!$db) {
    die("Erro na conexão com o banco de dados.");
}
?>
