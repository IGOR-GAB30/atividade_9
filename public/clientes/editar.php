<?php

include '../../infra/conexao.php';

$id = $_GET['id'];
$sql = "SELECT * FROM clientes WHERE id = $id";
$stmt = $conn->prepare($sql); 
$stmt->bind_param("i", $id); 
$stmt->execute();

$cliente_editantes = $conn->query($sql);
$cliente = $cliente_editantes->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $sql = "UPDATE clientes SET nome='?', email='?', telefone='?' WHERE id= '?'";
   
    $stmt = $conn->prepare($sql); $stmt->bind_param( "sssi", $nome, $email, $telefone, $id );
      
    if ($stmt->execute()) {
        echo "Cliente atualizado com sucesso!";
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
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="../../styles.css">
</head>

<body>
    <main>
        <h2>Editando o Cliente <?php echo $cliente["nome"]?>!</h2>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $cliente["id"]?>">

            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?php echo $cliente["nome"]?>">
            <br>
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $cliente["email"]?>">
            <br>
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?php echo $cliente["telefone"]?>">
            <br>
            <button type="submit">Atualizar</button>
        </form>

    </main>
<br>
    <button type="button" onclick="window.location.href='../../index.php'">Voltar</button>
</body>

</html>