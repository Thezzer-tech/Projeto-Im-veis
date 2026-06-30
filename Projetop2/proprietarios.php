<?php

include 'includes/cabecalho.php';
require 'config/conexao.php';

try {
    // Busca os proprietários ordenados por nome
    $stmt = $pdo->prepare("SELECT * FROM proprietarios ORDER BY nome ASC");
    $stmt->execute();
    $lista_proprietarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar dados: " . $e->getMessage() . "</div>";
}
?>

<div class="row mt-4 mb-4">
    <div class="col-md-8">
        <h2 class="fw-bold">Gestão de Proprietários</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="form_proprietario.php" class="btn btn-success fw-bold">
            <i class="bi bi-plus-circle"></i> Novo Proprietário
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>E-mail</th>
                        <th>Telefone</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($lista_proprietarios)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Nenhum proprietário cadastrado ainda.</td>
                        </tr>
                    <?php else: 
                        foreach($lista_proprietarios as $proprietario): ?>
                        <tr>
                            <td><?php echo $proprietario['id_proprietario']; ?></td>
                            <td class="fw-bold"><?php echo $proprietario['nome']; ?></td>
                            <td><?php echo $proprietario['cpf']; ?></td>
                            <td><?php echo $proprietario['email']; ?></td>
                            <td><?php echo $proprietario['telefone']; ?></td>
                            <td class="text-center">
                                <a href="form_proprietario.php?id=<?php echo $proprietario['id_proprietario']; ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="excluir_proprietario.php?id=<?php echo $proprietario['id_proprietario']; ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php 
                        endforeach; 
                    endif; 
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include 'includes/rodape.php';
?>