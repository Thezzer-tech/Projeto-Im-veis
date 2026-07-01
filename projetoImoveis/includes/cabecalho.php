<?php
  session_start(); // AVISA SERVIDOR QUE VAI UTILIZAR SUAS SESSÕES
  if(!isset($_SESSION['acesso'])) //PERGUNTA SE A VARIÁVEL DA SESSÃO EXISTE
    header('location: index.php'); // PESSOA SEM ACESSO, REDIRECIONA AO index
?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    @media print {
      .no-print{
        display: none !important; /*usuário não imprime a pagina */
      }
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark no-print"> <!-- cria a barra de menu superior, aplica o menu em tela grande e pinta o fundo de escuro -->
    <div class="container">
      <a class="navbar-brand" href="principal.php">ImóvelHost</a> <!--Nome empresa barra-->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
        <!-- navbar-toggler: formata o botão para ter o tamanho certo e ficar invisivel
         data-bs-toggle="collapse" faz o botao ativar o efeito de colapso
         data-bs-target = o botao abre a caixa que tem o ID "navbarSupportedContent-->

        <span class="navbar-toggler-icon"></span> <!--navbar-toggler-icon = span que desenha as três linhas do menu -->
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">  <!--Caixa que coloca todos os botões do inicio, até o toggler mandar aparecer
        id de cima do target-->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0"> <!--navbar-nav = transforma lista em botões de menu clicaveis
            me-auto = ele empurra a lista de links para esquerda -->

            

          <li class="nav-item"> <!--Trabalha o em conjunto com o nav-link, iten avisa que aquele espaço na lista li é um item do menu, e o nav-link tira o azul padão do link -->
            <a class="nav-link" aria-current="page" href="principal.php">Início</a> <!--arria-current="page" para acessibilidade pessoas usando leitor de tela -->
          </li>

          <li class="nav-item dropdown"> <!-- dropdown = avisa o bootstrap que este item não é um link, mas o "pai" de um menu-->
            <a class="nav-link dropdown-toggle" href="#" id="dropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <!--dropdown-toggle = coloca automaticamente a setinha ao lado de Cadastros
                data-bs-toggle="dropdown" ele diz quando clicar, faça uma lista abaixo aparecer-->
              Cadastros
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdown2"> <!--dropdown-menu: caixa branca que fica invisivel e só desce quando você você clica em cadastro-->
              <li><a class="dropdown-item" href="imoveis.php">Imóveis</a></li> <!-- dropdown-item formata cada link dentro, ao passar o mouse em cima (como o hover) -->
              <li><a class="dropdown-item" href="proprietarios.php">Proprietários</a></li>
              <li><a class="dropdown-item" href="locatarios.php">Locátarios</a></li>
              <li><hr class="dropdown-divider"></li> <li><a class="dropdown-item" href="contratos.php">Contratos de Locação</a></li> <!-- dropdown-divider com hr cria linha horizontal para separar dos casdastros. --> 
            </ul>
          </li>
          </ul> <ul class="navbar-nav ms-auto">
          <li class="nav-item"> 
            <a class="nav-link text-danger fw-bold" href="logout.php"> <!--logout-->
              Sair
            </a>
          </li>
        </ul>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container py-3"></div>