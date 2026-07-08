<?php

    /*
    $dominio = "mysql:host=localhost;dbname=projetoImoveis;charset=utf8"; //localhost significa que o banco de dados esta rodando no próprio computador 
    $usuario = "root"; //nome padrão de todo banco de dados local
    $senha = "";

    try { //fala ao php tentar fazer a conexão, sem entrar em pânico e passe a bola ao catch

        $pdo = new PDO($dominio, $usuario, $senha); //a ponte entre o php e o banco de dados sql(também protege contra hackers)

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Ajuda a mostrar erros do banco de dados

    } catch (Exception $e) { //se o try falhar, faz o que ordenado abaixo. o $e é uma variavel que armazena o erro

        die("Erro ao conectar ao banco de dados:".$e->getMessage());
    }

    rodar em máquina local
    */

    // Em vez de colocar a senha direto aqui, o PHP vai puxar da nuvem
    $host = getenv('DB_HOST');
    $user = getenv('DB_USER');
    $pass = getenv('DB_PASS');
    $dbname = getenv('DB_NAME');
    $port = getenv('DB_PORT');

    // O PDO exige a montagem de um DSN (Data Source Name)
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";

    // Configurações extras para o PDO (opcional, mas muito recomendado)
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Força erros a caírem no Catch
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna dados como array associativo
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Mais segurança contra SQL Injection
    ];


    try{

        $pdo = new PDO($dsn, $user, $pass, $options);

    }catch (PDOException $e) {

        die("Falha na conexão com o banco de dados: " .$e->getMessage());

    }
   
?>
