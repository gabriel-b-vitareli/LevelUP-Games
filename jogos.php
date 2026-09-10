<?php 

// CABEÇALHO: \\
header("Content-Type: application/json");

// "Importa" o arquivo conexao.php para o $pdo
require "conexao.php";

// Guarda o tipo de método de requisição que o servidor receber na variavel $metodo
$metodo = $_SERVER["REQUEST_METHOD"];

// Se o método recebido for POST:
if ($metodo == "POST"){
    $json = file_get_contents("php://input");

    $dados = json_decode($json,true);

    $sql = "INSERT INTO jogos (titulo,plataforma,genero,desenvolvedora,ano_lancamento,preco,estoque) VALUES (?,?,?,?,?,?,?)";
    
    $comando = $pdo -> prepare($sql);

    $comando -> execute([
        $dados['titulo'],
        $dados['plataforma'],
        $dados['genero'],
        $dados['desenvolvedora'],
        $dados['ano_lancamento'],
        $dados['preco'],
        $dados['estoque']
        ]);

    echo json_encode([
        "Mensagem"=>"Jogo cadastrado com sucesso!"
    ]);
}

// Se o método recebido for GET:
if ($metodo == "GET"){
    $sql = "SELECT * FROM jogos ORDER BY titulo";

    $comando = $pdo -> query($sql);

    $produtos = $comando -> fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($produtos);
}