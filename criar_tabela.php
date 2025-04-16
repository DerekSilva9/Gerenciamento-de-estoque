<?php
require_once 'includes/db_connect.php';

try {
    // Tabela de usuários
    $db->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            usuario TEXT NOT NULL UNIQUE,
            senha TEXT NOT NULL
        );
    ");

    // Tabela de produtos
    $db->exec("
        CREATE TABLE IF NOT EXISTS produtos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nome TEXT NOT NULL,
            descricao TEXT,
            quantidade INTEGER NOT NULL,
            preco REAL NOT NULL,
            categoria TEXT,
            codigo TEXT NOT NULL UNIQUE
        );
    ");

    // Usuário padrão (senha: admin123)
    $senha = password_hash('admin123', PASSWORD_DEFAULT);
    $db->exec("INSERT INTO usuarios (usuario, senha) VALUES ('admin', '$senha')");

    echo "Tabelas criadas com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
