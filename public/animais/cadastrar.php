<?php

include "../../infra/conexao.php"

$nome = $_POST["nome"];
$especie = $_POST["especie"];
$raca = $_POST["raca"];
$idade = $_POST["idade"];
$cliente_id = $_POST["cliente_id"];

$stmt = $conexao->prepare(
    "INSERT INTO animais (nome, especie, raca, idade, cliente_id) VALUES (?,?,?,?,?)"
);

$stmt -> bind_param ("sssii", $nome, $especie, $raca, $idade, $cliente_id);
$stmt -> execute();

if ($stmt->execute()) {
        echo "Novo animal cadastrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Novo Animal</title>
</head>

<body>
    <h2>Adicionar Novo Animal</h2>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="especie">Espécie:</label>
        <input type="text" id="especie" name="especie" required>
        <br><br>
        <label for="raca">Raça:</label>
        <input type="text" id="raca" name="raca">
        <br><br>
        <label for="idade">Idade:</label>
        <input type="number" id="idade" name="idade">
        <br><br>

        <select name="cliente_id" required>
            <option value="">Selecione o Cliente</option>
            <?php
                $sql = "SELECT id, nome FROM clientes";
                $clientes = $conn->query($sql);
                while ($cliente = $clientes->fetch_assoc()) {
            ?>

            <option value="<?php echo $cliente['id'];?>"><?php echo $cliente['nome'];?></option>


            <?php
                } 
            ?>
        </select>
        <button type="submit">Cadastrar</button>
    </form>
    <br>
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>

</html>