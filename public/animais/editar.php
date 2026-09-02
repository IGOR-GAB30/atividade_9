<?php

include '../../infra/conexao.php';

$id = $_GET['id'];
$sql = "SELECT * FROM animais WHERE id = ?";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $id); 
$stmt->execute();

$animal_editantes = $conn->query($sql);
$animal = $animal_editantes->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $especie = $_POST['especie'];
    $raca = $_POST['raca'];
    $idade = $_POST['idade'];
    $cliente_id = $_POST['cliente_id'];

    $sql = "UPDATE animais SET nome= ?, especie= ?, raca= ?, idade= ?, cliente_id= ? WHERE id= ?";
   
    $stmt = $conn->prepare($sql); $stmt->bind_param( "sssiii", $nome, $especie, $raca, $idade, $cliente_id, $id );

    if ($stmt->execute()) {
        echo "Animal atualizado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Animal</title>
    <link rel="stylesheet" href="../../styles.css">
</head>

<body>
    <main>
        <h2>Editando o Animal <?php echo $animal["nome"]?>!</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $animal["id"]?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $animal["nome"]?>">
            <br>
            <label for="especie">Espécie:</label>
            <input type="text" name="especie" value="<?php echo $animal["especie"]?>">
            <br>
            <label for="raca">Raça:</label>
            <input type="text" name="raca" value="<?php echo $animal["raca"]?>">
            <br>
            <label for="idade">Idade:</label>
            <input type="number" name="idade" value="<?php echo $animal["idade"]?>">
            <br>
            <select name="cliente_id" required>
            <option value="" >Selecione o Cliente</option>
            <?php
                $sql = "SELECT id, nome FROM clientes";
                $clientes = $conn->query($sql);
                while ($cliente = $clientes->fetch_assoc()) {
            ?>

            <option value="<?php echo $cliente['id'];?>" <?php if ($animal['cliente_id'] == $cliente['id']) echo 'selected'; ?>>
                <?php echo $cliente['nome'];?>
            </option>


            <?php
                } 
            ?>
        </select>
            <button type="submit">Atualizar</button>
        </form>

    </main>
<br>
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>

</html>