<?php

include 'includes/cabecalho.php';
require 'config/conexao.php';

$mensagem = ""; // Variável para mostrar sucesso ou erro

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];

    try {
        // Prepara a instrução de INSERT
        $stmt = $pdo->prepare("INSERT INTO proprietarios (nome, email, telefone, cpf) VALUES (?, ?, ?, ?)");
        
        // Executa trocando as interrogações pelos dados digitados
        $stmt->execute([$nome, $email, $telefone, $cpf]);
        
        $mensagem = "<div class='alert alert-success mt-3'>Proprietário cadastrado com sucesso! <a href='proprietarios.php' class='alert-link'>Voltar para a lista</a>.</div>";
    } catch (Exception $e) {
        $mensagem = "<div class='alert alert-danger mt-3'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="row mt-4 mb-3">
    <div class="col-md-12">
        <h2 class="fw-bold">
            <i class="bi bi-person-plus text-success"></i> Cadastrar Novo Proprietário
        </h2>
    </div>
</div>

<?php echo $mensagem; ?>

<div class="card shadow-sm border-0 mt-3">
    <div class="card-body p-4">
        
        <form action="" method="POST">
            
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="nome" class="form-label fw-bold">Nome Completo:</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: João da Silva" required>
                </div>
                
                <div class="col-md-6">
                    <label for="email" class="form-label fw-bold">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ex: joao@email.com" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="telefone" class="form-label fw-bold">Telefone / WhatsApp:</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" placeholder="00 00000-0000" required>
                </div>
                <div class="col-md-4">
                    <label for="cpf" class="form-label fw-bold">CPF:</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="00000000000" required>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="proprietarios.php" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Salvar Proprietário
                    </button>
                </div>
            </div>
            
        </form>
        
    </div>
</div>

<?php
include 'includes/rodape.php';
?>