<?php
include 'includes/cabecalho.php';
require 'config/conexao.php';

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $endereco = $_POST['endereco'];
    $tipo = $_POST['tipo'];
    $valor_aluguel = $_POST['valor_aluguel'];
    $status = $_POST['status'];

    try {
        $stmt = $pdo->prepare("INSERT INTO imoveis (endereco, tipo, valor_aluguel, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$endereco, $tipo, $valor_aluguel, $status]);
        
        $mensagem = "<div class='alert alert-success mt-3'>Imóvel cadastrado com sucesso! <a href='imoveis.php' class='alert-link'>Voltar para a lista</a>.</div>";
    } catch (Exception $e) {
        $mensagem = "<div class='alert alert-danger mt-3'>Erro ao cadastrar: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="row mt-4 mb-3">
    <div class="col-md-12">
        <h2 class="fw-bold text-primary">
            <i class="bi bi-house-add"></i> Cadastrar Novo Imóvel
        </h2>
    </div>
</div>

<?php echo $mensagem; ?>

<div class="card shadow-sm border-0 mt-3">
    <div class="card-body p-4">
        
        <form action="" method="POST">
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="endereco" class="form-label fw-bold">Endereço Completo</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Ex: Rua das Flores, 123 - Centro" required>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-4">
                    <label for="tipo" class="form-label fw-bold">Tipo de Imóvel</label>
                    <select class="form-select" id="tipo" name="tipo" required>
                        <option value="">Selecione...</option>
                        <option value="Casa">Casa</option>
                        <option value="Apartamento">Apartamento</option>
                        <option value="Sala Comercial">Sala Comercial</option>
                        <option value="Terreno">Terreno</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="valor_aluguel" class="form-label fw-bold">Valor do Aluguel (R$)</label>
                    <input type="number" step="0.01" min="0" class="form-control" id="valor_aluguel" name="valor_aluguel" placeholder="0.00" required>
                </div>

                <div class="col-md-4">
                    <label for="status" class="form-label fw-bold">Status Atual</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Disponível">Disponível</option>
                        <option value="Alugado">Alugado</option>
                        <option value="Em Manutenção">Em Manutenção</option>
                    </select>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="imoveis.php" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary fw-bold">
                        <i class="bi bi-save"></i> Salvar Imóvel
                    </button>
                </div>
            </div>
            
        </form>
        
    </div>
</div>

<?php include 'includes/rodape.php'; ?>