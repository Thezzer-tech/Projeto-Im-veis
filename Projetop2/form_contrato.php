<?php
include 'includes/cabecalho.php';
require 'config/conexao.php';

$mensagem = "";

$imoveis = $pdo->query("SELECT id_imovel, endereco, valor_aluguel FROM imoveis WHERE status = 'Disponível'")->fetchAll(PDO::FETCH_ASSOC);
$proprietarios = $pdo->query("SELECT id_proprietario, nome FROM proprietarios ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);
$locatarios = $pdo->query("SELECT id_locatario, nome FROM locatarios ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_imovel = $_POST['id_imovel'];
    $id_proprietario = $_POST['id_proprietario'];
    $id_locatario = $_POST['id_locatario'];
    $data_inicio = $_POST['data_inicio'];
    $data_fim = $_POST['data_fim'];
    $valor_mensal = $_POST['valor_mensal'];
    $status = $_POST['status'];

    try {
        // Ajustado para inserir nas colunas corretas da sua tabela
        $stmt = $pdo->prepare("INSERT INTO contratos (imoveis_id_imovel, proprietarios_id_proprietario, locatarios_id_locatario, data_inicio, data_fim, valor_mensal, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_imovel, $id_proprietario, $id_locatario, $data_inicio, $data_fim, $valor_mensal, $status]);
        
        if($status == 'Ativo'){
            $atualiza_imovel = $pdo->prepare("UPDATE imoveis SET status = 'Alugado' WHERE id_imovel = ?");
            $atualiza_imovel->execute([$id_imovel]);
        }
        
        $mensagem = "<div class='alert alert-success mt-3'>Contrato gerado com sucesso! <a href='contratos.php' class='alert-link'>Voltar para a lista</a>.</div>";
    } catch (Exception $e) {
        $mensagem = "<div class='alert alert-danger mt-3'>Erro ao gerar contrato: " . $e->getMessage() . "</div>";
    }
}
?>

<div class="row mt-4 mb-3">
    <div class="col-md-12">
        <h2 class="fw-bold text-danger">
            <i class="bi bi-file-earmark-plus"></i> Gerar Novo Contrato
        </h2>
    </div>
</div>

<?php echo $mensagem; ?>

<div class="card shadow-sm border-0 mt-3">
    <div class="card-body p-4">
        
        <form action="" method="POST">
            
            <div class="row mb-3">
                <div class="col-md-12">
                    <label for="id_imovel" class="form-label fw-bold">Imóvel (Apenas Disponíveis)</label>
                    <select class="form-select" id="id_imovel" name="id_imovel" required onchange="preencherValorAutomagicamente()">
                    <option value="" data-valor="">Selecione o imóvel...</option>
                    <?php foreach($imoveis as $imovel): ?>
                    <option value="<?php echo $imovel['id_imovel']; ?>" data-valor="<?php echo $imovel['valor_aluguel']; ?>">
                    <?php echo $imovel['endereco']; ?>
                </option>
        <?php endforeach; ?>
    </select>
</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_proprietario" class="form-label fw-bold">Proprietário (Locador)</label>
                    <select class="form-select" id="id_proprietario" name="id_proprietario" required>
                        <option value="">Selecione o proprietário...</option>
                        <?php foreach($proprietarios as $prop): ?>
                            <option value="<?php echo $prop['id_proprietario']; ?>"><?php echo $prop['nome']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-6">
                    <label for="id_locatario" class="form-label fw-bold">Locatário (Inquilino)</label>
                    <select class="form-select" id="id_locatario" name="id_locatario" required>
                        <option value="">Selecione o inquilino...</option>
                        <?php foreach($locatarios as $loc): ?>
                            <option value="<?php echo $loc['id_locatario']; ?>"><?php echo $loc['nome']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-3">
                    <label for="data_inicio" class="form-label fw-bold">Data de Início</label>
                    <input type="date" class="form-control" id="data_inicio" name="data_inicio" required>
                </div>

                <div class="col-md-3">
                    <label for="data_fim" class="form-label fw-bold">Data de Fim</label>
                    <input type="date" class="form-control" id="data_fim" name="data_fim" required>
                </div>

                <div class="col-md-3">
                    <label for="valor_mensal" class="form-label fw-bold">Valor Mensal (R$)</label>
                    <input type="number" step="0.01" min="0" class="form-control" id="valor_mensal" name="valor_mensal" placeholder="0.00" required>
                </div>

                <div class="col-md-3">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="Ativo">Ativo</option>
                        <option value="Encerrado">Encerrado</option>
                        <option value="Rescindido">Rescindido</option>
                    </select>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12 text-end">
                    <a href="contratos.php" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-danger fw-bold">
                        <i class="bi bi-save"></i> Gerar Contrato
                    </button>
                </div>
            </div>
            
        </form>
        
    </div>
</div>

<script>
function preencherValorAutomagicamente() {
    // Pega a caixa de seleção do imóvel
    var selectImovel = document.getElementById('id_imovel');
    // Descobre qual opção foi clicada e pega o 'data-valor' dela
    var valorOriginal = selectImovel.options[selectImovel.selectedIndex].getAttribute('data-valor');
    
    // Se achou um valor, joga ele dentro da caixinha de R$ do contrato
    if(valorOriginal) {
        document.getElementById('valor_mensal').value = valorOriginal;
    } else {
        document.getElementById('valor_mensal').value = '';
    }
}
</script>

<?php include 'includes/rodape.php'; ?>