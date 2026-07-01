<?php
session_start();
if(!isset($_SESSION['acesso'])){
    header('location: index.php');
    exit;
}

require 'config/conexao.php';

if(isset($_GET['id'])){
    $id_contrato = $_GET['id'];
    
    try {
        // Descobrir qual é o imóvel antes de apagar o contrato
        // Usamos o nome exato da sua coluna: imoveis_id_imovel
        $stmt_busca = $pdo->prepare("SELECT imoveis_id_imovel FROM contratos WHERE id_contrato = ?");
        $stmt_busca->execute([$id_contrato]);
        $contrato_encontrado = $stmt_busca->fetch(PDO::FETCH_ASSOC);
        
        if($contrato_encontrado) {
            $id_imovel = $contrato_encontrado['imoveis_id_imovel'];
            
            // Apagar o contrato da base de dados
            $stmt_del = $pdo->prepare("DELETE FROM contratos WHERE id_contrato = ?");
            $stmt_del->execute([$id_contrato]);
            
            // Libertar o imóvel, mudando o status de volta para "Disponível"
            $stmt_upd = $pdo->prepare("UPDATE imoveis SET status = 'Disponível' WHERE id_imovel = ?");
            $stmt_upd->execute([$id_imovel]);
        }
        
    } catch(Exception $e) {
        // Se houver algum erro, apenas voltamos para a lista
    }
}

// Redireciona de volta para a tabela de contratos
header('location: contratos.php');
exit;
?>