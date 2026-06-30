<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        const alternarSenha = () => {
            let a = document.getElementById("senhaCad");
            a.type === "password" ? a.type = "text" : a.type = "password";
        }
    </script>

    <style>
        body{
            background-image:linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),url(assets/cred-imobiliaria-scaled.jpg); /*Colocar imagem*/ 
            background-size: cover; /* imagem cobrir tela*/
            background-position: center; /* centraliza imagem */
            background-repeat: no-repeat; /* evita imagem repetir*/
            background-attachment: fixed; /*Deixa a imagem fixa*/

        }
    </style>
</head>
<body class="bg-light"> 

    <div class="container min-vh-100 d-flex align-items-center justify-content-center">

        <div class="row justify-content-center w-100">

            <div class="col-md-8">

                <div class="card shadow-sm" style="min-height: 450px;">

                    <div class="card-body p-4 d-flex flex-column justify-content-center">

                        <form action="cadastro.php" method="POST">

                            <div class="col-md-12">
                                    <label class="form-label fw-bold" for="nome">Nome:</label>
                                    <input type="text" class="form-control" placeholder="Informe o nome completo" id="nome" name="nome">
                                </div>
                                <div class="col-md-12 pt-2">
                                    <label for="emailCad" class="form-label fw-bold">E-Mail:</label>
                                    <input type="email" id="emailCad" class="form-control" placeholder="Informe o E-mail" name="email">
                                </div>
                                <div class="col-md-12 pt-2">
                                    <label for="senhaCad" class="form-label fw-bold">Senha:</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Informe senha" id="senhaCad" name="senha">
                                        <button class="btn btn-outline-secondary" type="button" onclick="alternarSenha()">
                                            <i class="bi bi-eye" id="iconeOlho"></i>
                                        </button>
                                    </div>
                                </div>

                                
                                <div class="row mt-5">
                                <div class="col-md-2 offset-md-9 text-start">
                                    <button type="submit" class="btn btn-success px-4">Cadastrar</button>
                                </div>
                                </div>

                                <p class="mt-3 ms-5">
                                Já tem uma conta? 
                                <a href="index.php">Faça login aqui</a>
                                </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            require("config/conexao.php");
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT); //usado para proteger senha de usuário antes de salvar no banco, transformando em um string complexa
            try{
                $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
                if($stmt->execute([$nome, $email, $senha])){
                    header("location: index.php?cadastro=true"); //redirecionamento a página caso cadastro = true
                } else{
                    header("location: index.php?cadastro=false"); 
                }
            } catch(Exception $e){
                echo "Erro ao executar o comando SQL: ".$e->getMessage();
            }
        }    
    ?>
</body>
</html>



