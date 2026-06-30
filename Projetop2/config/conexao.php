<?php

    $dominio = "mysql:host=localhost;dbname=projetoImoveis;charset=utf8"; //localhost significa que o banco de dados esta rodando no próprio computador 
    $usuario = "root"; //nome padrão de todo banco de dados local
    $senha = "";

    try { //fala ao php tentar fazer a conexão, sem entrar em pânico e passe a bola ao catch

        $pdo = new PDO($dominio, $usuario, $senha); //a ponte entre o php e o banco de dados sql(também protege contra hackers)

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Ajuda a mostrar erros do banco de dados

    } catch (Exception $e) { //se o try falhar, faz o que ordenado abaixo. o $e é uma variavel que armazena o erro

        die("Erro ao conectar ao banco de dados:".$e->getMessage());
    }

    ?>