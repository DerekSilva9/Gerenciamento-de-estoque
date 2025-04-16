<?php
require_once '../includes/db_connect.php'; 


//analisando requisição

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $id = $_GET['id'];

// consulta sql para excluir o produto

    if (filter_var($id, FILTER_VALIDATE_INT)) {
        $stmt = $db->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->bindValue(1, $id, SQLITE3_INTEGER);
        if ($stmt->execute()) {
            echo "<script>alert('Produto excluído com sucesso!'); window.location.href='../index.php';</script>";
        } else {
            echo "<script>alert('Erro ao excluir produto: " . $db->lastErrorMsg() . "'); window.location.href='../index.php';</script>";
        }
    } else {
        echo "<script>alert('ID inválido!'); window.location.href='../index.php';</script>";
    }
}
?>
