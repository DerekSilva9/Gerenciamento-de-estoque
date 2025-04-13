<?php
require_once '../includes/db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

if(!empty($nome) && !empty($quantidade) && !empty($preco)) {
    $nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
    $descricao = htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8');
    $quantidade = (int)$quantidade;
    $preco = (float)$preco;

    $stmt = $db->prepare("INSERT INTO produtos (nome, descricao, quantidade, preco) VALUES (?, ?, ?, ?)");
    $stmt->bindValue(1, $nome, SQLITE3_TEXT);
    $stmt->bindValue(2, $descricao, SQLITE3_TEXT);
    $stmt->bindValue(3, $quantidade, SQLITE3_INTEGER);
    $stmt->bindValue(4, $preco, SQLITE3_FLOAT);

    if ($stmt->execute()) {
        echo "<script>alert('Produto adicionado com sucesso!'); window.location.href='../index.php';</script>";
    } else {
        echo "<script>alert('Erro ao adicionar produto: " . $db->lastErrorMsg() . "'); window.location.href='../index.php';</script>";
    }
} else {
    echo "<script>alert('Todos os campos obrigatórios devem ser preenchidos!'); window.location.href='../index.php';</script>";
}
}

?>