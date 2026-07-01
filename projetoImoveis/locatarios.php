<?php

include 'includes/cabecalho.php';
require 'config/conexao.php';

try {
    // Busca os locatários ordenados por nome
    $stmt = $pdo->prepare("SELECT * FROM locatarios ORDER BY nome ASC");
    $stmt->execute();
    $lista_locatarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar dados: " . $e->getMessage() . "</div>";
}
?>

<div class="row mt-4 mb-4">
    <div class="col-md-8">
        <h2 class="fw-bold">Gestão de Locatários</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="form_locatario.php" class="btn btn-warning text-dark fw-bold">
            <i class="bi bi-person-plus"></i> Novo Locatário
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
                    <?php if(empty($lista_locatarios)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Nenhum locatário cadastrado ainda.</td>
                        </tr>
                    <?php else: 
                        foreach($lista_locatarios as $locatario): ?>
                        <tr>
                            <td><?php echo $locatario['id_locatario']; ?></td>
                            <td class="fw-bold"><?php echo $locatario['nome']; ?></td>
                            <td><?php echo $locatario['cpf']; ?></td>
                            <td><?php echo $locatario['email']; ?></td>
                            <td><?php echo $locatario['telefone']; ?></td>
                            <td class="text-center">
                                <a href="form_locatario.php?id=<?php echo $locatario['id_locatario']; ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="excluir_locatario.php?id=<?php echo $locatario['id_locatario']; ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este locatário?');">
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