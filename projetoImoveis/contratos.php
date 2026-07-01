<?php
include 'includes/cabecalho.php';
require 'config/conexao.php';

try {
    // Usando os nomes exatos da sua tabela: imoveis_id_imovel, etc.
    $sql = "SELECT c.*, i.endereco, p.nome AS proprietario, l.nome AS locatario 
            FROM contratos c
            INNER JOIN imoveis i ON c.imoveis_id_imovel = i.id_imovel
            INNER JOIN proprietarios p ON c.proprietarios_id_proprietario = p.id_proprietario
            INNER JOIN locatarios l ON c.locatarios_id_locatario = l.id_locatario
            ORDER BY c.data_inicio DESC";
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $lista_contratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(Exception $e) {
    echo "<div class='alert alert-danger'>Erro ao buscar dados: " . $e->getMessage() . "</div>";
}
?>

<div class="row mt-4 mb-4">
    <div class="col-md-8">
        <h2 class="fw-bold text-danger"><i class="bi bi-file-earmark-text"></i> Gestão de Contratos</h2>
    </div>
    <div class="col-md-4 text-end">
        <a href="form_contrato.php" class="btn btn-danger fw-bold">
            <i class="bi bi-plus-circle"></i> Novo Contrato
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
                        <th>Imóvel</th>
                        <th>Proprietário</th>
                        <th>Locatário</th>
                        <th>Período</th>
                        <th>Valor Mensal</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($lista_contratos)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Nenhum contrato gerado ainda.</td>
                        </tr>
                    <?php else: 
                        foreach($lista_contratos as $contrato): ?>
                        <tr>
                            <td><?php echo $contrato['id_contrato']; ?></td>
                            <td><?php echo $contrato['endereco']; ?></td>
                            <td><?php echo $contrato['proprietario']; ?></td>
                            <td><?php echo $contrato['locatario']; ?></td>
                            <td class="text-nowrap">
                                <?php echo date('d/m/Y', strtotime($contrato['data_inicio'])); ?> a <br>
                                <?php echo date('d/m/Y', strtotime($contrato['data_fim'])); ?>
                            </td>
                            <td class="text-success fw-bold">R$ <?php echo number_format($contrato['valor_mensal'], 2, ',', '.'); ?></td>
                            <td>
                                <?php if($contrato['status'] == 'Ativo'): ?>
                                    <span class="badge bg-success">Ativo</span>
                                <?php elseif($contrato['status'] == 'Encerrado'): ?>
                                    <span class="badge bg-secondary">Encerrado</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark"><?php echo $contrato['status']; ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center text-nowrap">
                                <a href="excluir_contrato.php?id=<?php echo $contrato['id_contrato']; ?>" class="btn btn-sm btn-outline-danger" title="Excluir" onclick="return confirm('Tem certeza que deseja apagar este contrato?');">
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