<?php

include "../../infra/conexao.php"

$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];

$stmt = $conexao->prepare(
    "INSERT INTO clientes (nome, email, telefone) VALUES (?,?,?)"
);

$stmt -> bind_param ("sss", $nome, $email, $telefone);
$stmt -> execute();

if ($stmt->execute()) {
        echo "Novo cliente cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Cliente</title>
</head>

<body>
    <h2>Adicionar Novo Cliente</h2>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br><br>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone">
        <br><br>
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>

</html>