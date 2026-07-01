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
        $stmt = $pdo->prepare("DELETE FROM imoveis WHERE id_imovel = ?");
        $stmt->execute([$id]);
    } catch(Exception $e) {
        // Ignora erros de exclusão (como chaves estrangeiras)
    }
}

header('location: imoveis.php');
exit;
?>