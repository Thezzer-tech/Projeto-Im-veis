<?php
session_start();
if(!isset($_SESSION['acesso'])){
    header('location: index.php');
    exit; // Para a execução do código aqui se não estiver logado
}

require 'config/conexao.php';

//Verifica se o ID foi enviado na URL (ex: excluir_proprietario.php?id=3)
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    try {
        // Prepara e executa o comando DELETE
        // Usamos id_proprietario
        $stmt = $pdo->prepare("DELETE FROM proprietarios WHERE id_proprietario = ?");
        $stmt->execute([$id]);
        
    } catch(Exception $e) {
        // Se der erro (ex: proprietário atrelado a um contrato)
    }
}

//Redireciona imediatamente de volta para a lista de proprietários
header('location: proprietarios.php');
exit;
?>