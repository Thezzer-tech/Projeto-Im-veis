<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body{
            background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url(assets/cred-imobiliaria-scaled.jpg); /*Colocar imagem*/ 
            background-size: cover; /* imagem cobrir tela*/
            background-position: center; /* centraliza imagem */
            background-repeat: no-repeat; /* evita imagem repetir*/
            background-attachment: fixed; /*Deixa a imagem fixa*/

        }
    </style>
    <script>
        function alternarSenha() {
            let a = document.getElementById("senhaLogin"); //o document é uma função do navegador que contem todo arquivo html
            a.type === "password" ? a.type = "text" : a.type = "password";
            
        }
    </script>
</head>
<body class="bg-light"> 

    <div class="container mt-5">
        <?php
            if(isset($_GET['cadastro'])){
                $cadastro = $_GET['cadastro'];
                if ($cadastro == 'true'){
                    echo '
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <strong>Sucesso!</strong> Cadastro realizado com sucesso.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }else if($cadastro == 'false'){
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <strong>Erro!</strong> Não foi possível realizar o cadastro.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                require('config/conexao.php');
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                try {
                    $stmt = $pdo->prepare("SELECT*FROM usuarios WHERE email = ?"); //guarda instrução preparada
                    $stmt->execute([$email]);
                    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($usuario && password_verify($senha, $usuario['senha'])){
                        session_start();
                        $_SESSION['acesso'] = true;
                        $_SESSION['nome'] = $usuario['nome'];
                        header('location: principal.php');
                    }else{
                        echo "<p class='text-danger'>Credenciais inválidas!</p>";
                    }
                
                } catch(\Exception $e){
                    echo "Erro: ".$e->getMessage();
                }
            }
        ?>

    </div>
    
    <div class="container min-vh-100 d-flex align-items-center justify-content-center">

        <div class="row justify-content-center w-100">

            <div class="col-md-8">

                <div class="card shadow-sm" style="min-height: 450px;">

                    <div class="card-body p-4 d-flex flex-column justify-content-center">

                        <form action="index.php" method="POST">
                            <h2 class="text-center mb-5">Login</h2>
                            
                            <div class="row mb-3">
                                <label for="emailLogin" class="col-md-2 col-form-label text-end fw-bold text-nowrap">Email:</label>
                                <div class="col-md-9">
                                    <input type="email" class="form-control" id="emailLogin" name="email" placeholder="Digite Email" required />
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="senhaLogin" class="col-md-2 col-form-label text-end fw-bold text-nowrap">Senha:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="senhaLogin" name="senha" placeholder="Digite senha" required />
                                        <button class="btn btn-outline-secondary" type="button" onclick="alternarSenha()"> <!--Precisarei utilizar javascript -->
                                            <i class="bi bi-eye" id="iconeOlho"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-2 offset-md-9 text-start">
                                    <button type="submit" class="btn btn-primary px-4">Entrar</button>
                                </div>
                            </div>

                            <p class="mt-4 ms-5">
                                Ainda não tem uma conta?
                                <a href="cadastro.php">Cadastre-se aqui</a>
                            </p>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>