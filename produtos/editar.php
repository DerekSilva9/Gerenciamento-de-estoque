<?php
require_once '../includes/db_connect.php'; 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];

    if(!empty($nome) && !empty(!$quantidade) && !empty($preco) && !empty($categoria)){
        $nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
        $descricao = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
        $quantidade = (int)$quantidade;
        $preco = (float)$preco;
        $categoria = htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8');
    }
}

?>