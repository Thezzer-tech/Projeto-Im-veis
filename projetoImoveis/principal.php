<?php
    require("includes/cabecalho.php");
?>
    <style>
    .card-dashboard {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 1rem;
        border: none;
    }
    .card-dashboard:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .icon-circle {
        width: 80px;
        height: 80px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin-bottom: 15px;
    }
</style>

<div class="row mb-5 mt-5 text-center">
    <div class="col-md-12">
        <h2 class="fw-bold display-5">Olá, <?php echo $_SESSION['nome']; ?>!</h2>
        <p class="text-muted lead">Bem-vindo(a) ao painel de controle da ImóvelHost. O que deseja fazer hoje?</p>
    </div>
</div>

<div class="row justify-content-center g-4 mb-5">
    
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card card-dashboard shadow-sm h-100 text-center p-3">
            <div class="card-body d-flex flex-column">
                <div>
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-house-door fs-1"></i>
                    </div>
                </div>
                <h4 class="card-title fw-bold">Imóveis</h4>
                <p class="card-text text-muted mb-4 small">Cadastre e edite as casas e apartamentos.</p>
                <a href="imoveis.php" class="btn btn-outline-primary mt-auto rounded-pill fw-semibold w-100">Acessar</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card card-dashboard shadow-sm h-100 text-center p-3">
            <div class="card-body d-flex flex-column">
                <div>
                    <div class="icon-circle bg-success bg-opacity-10 text-success">
                        <i class="bi bi-person-badge fs-1"></i>
                    </div>
                </div>
                <h4 class="card-title fw-bold">Proprietários</h4>
                <p class="card-text text-muted mb-4 small">Gerencie os donos dos imóveis.</p>
                <a href="proprietarios.php" class="btn btn-outline-success mt-auto rounded-pill fw-semibold w-100">Acessar</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card card-dashboard shadow-sm h-100 text-center p-3">
            <div class="card-body d-flex flex-column">
                <div>
                    <div class="icon-circle bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                </div>
                <h4 class="card-title fw-bold">Locatários</h4>
                <p class="card-text text-muted mb-4 small">Gerencie os clientes que alugam.</p>
                <a href="locatarios.php" class="btn btn-outline-warning mt-auto rounded-pill fw-semibold w-100 text-dark">Acessar</a>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card card-dashboard shadow-sm h-100 text-center p-3">
            <div class="card-body d-flex flex-column">
                <div>
                    <div class="icon-circle bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-file-earmark-text fs-1"></i>
                    </div>
                </div>
                <h4 class="card-title fw-bold">Contratos</h4>
                <p class="card-text text-muted mb-4 small">Crie e gerencie os contratos de locação.</p>
                <a href="contratos.php" class="btn btn-outline-danger mt-auto rounded-pill fw-semibold w-100">Acessar</a>
            </div>
        </div>
    </div>

</div>
<?php
  require("includes/rodape.php");
?>