<?php
require_once '../includes/db_connect.php'; 

// analisando requisição

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $id = $_POST['id'];

// Verificando se os campos obrigatórios estão preenchidos
// e sanitizando os dados

    if(!empty($nome) && !empty($quantidade) && !empty($preco) && !empty($categoria)){
        $nome = htmlspecialchars($nome, ENT_QUOTES, 'UTF-8');
        $descricao = htmlspecialchars($descricao, ENT_QUOTES, 'UTF-8');
        $quantidade = (int)$quantidade;
        $preco = (float)$preco;
        $categoria = htmlspecialchars($categoria, ENT_QUOTES, 'UTF-8');

// Atualizando os dados no banco de dados

        $stmt = $db->prepare("UPDATE produtos SET nome = ?, descricao = ?, quantidade = ?, preco = ?, categoria = ? WHERE id = ?");
        $stmt -> bindValue(1, $nome, SQLITE3_TEXT);
        $stmt -> bindValue(2, $descricao, SQLITE3_TEXT);
        $stmt -> bindValue(3, $quantidade, SQLITE3_INTEGER);
        $stmt -> bindValue(4, $preco, SQLITE3_FLOAT);
        $stmt -> bindValue(5, $categoria, SQLITE3_TEXT);
        $stmt -> bindValue(6, $id, SQLITE3_INTEGER);

        if ($stmt->execute()) {
            echo "<script>alert('Produto atualizado com sucesso!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar produto: " . $db->lastErrorMsg() . "'); window.location.href='../index.php';</script>";
        }
    }else {
        echo "<script>alert('Todos os campos obrigatórios devem ser preenchidos!'); window.location.href='../index.php';</script>";
    }
}

?>