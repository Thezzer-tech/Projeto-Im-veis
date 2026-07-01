<?php
session_start();
if(!isset($_SESSION['acesso'])){
    header('location: index.php');
    exit;
}

require 'config/conexao.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    try {
        // Deleta usando o id_locatario
        $stmt = $pdo->prepare("DELETE FROM locatarios WHERE id_locatario = ?");
        $stmt->execute([$id]);
        
    } catch(Exception $e) {
        // Se houver erro, ignora e volta (ex: restrição de chave estrangeira)
    }
}

// Redireciona de volta
header('location: locatarios.php');
exit;
?>