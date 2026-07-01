<?php
include 'includes/cabecalho.php';
require 'config/conexao.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM imoveis ORDER BY id_imovel DESC");
    $stmt->execute();
    $lista_imoveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar dados: " . $e->getMessage() . "</div>";
}
?>

<div class="row mt-4 mb-4">
    <div class="col-md-8">
        <h2 class="fw-bold text-primary"><i class="bi bi-house-door"></i> Gestão de Imóveis</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="form_imovel.php" class="btn btn-primary fw-bold">
            <i class="bi bi-plus-circle"></i> Novo Imóvel
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
                        <th>Endereço</th>
                        <th>Tipo</th>
                        <th>Valor (R$)</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($lista_imoveis)): ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Nenhum imóvel cadastrado ainda.</td>
                        </tr>
                    <?php else: 
                        foreach($lista_imoveis as $imovel): ?>
                        <tr>
                            <td><?php echo $imovel['id_imovel']; ?></td>
                            <td class="fw-bold"><?php echo $imovel['endereco']; ?></td>
                            <td><?php echo $imovel['tipo']; ?></td>
                            <td>R$ <?php echo number_format($imovel['valor_aluguel'], 2, ',', '.'); ?></td>
                            <td>
                                <?php if($imovel['status'] == 'Disponível'): ?>
                                    <span class="badge bg-success">Disponível</span>
                                <?php elseif($imovel['status'] == 'Alugado'): ?>
                                    <span class="badge bg-danger">Alugado</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><?php echo $imovel['status']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <a href="form_imovel.php?id=<?php echo $imovel['id_imovel']; ?>" class="btn btn-sm btn-outline-primary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="excluir_imovel.php?id=<?php echo $imovel['id_imovel']; ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja excluir este imóvel?');">
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

<?php include 'includes/rodape.php'; ?>