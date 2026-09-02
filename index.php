<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de Petshop</title>
</head>

<body>
    <h2>Pet Shop!</h2>

    <button type="button" onclick="window.location.href='public/cliente/cadastrar_cliente.php'">Cadastrar Cliente</button>
    <button type="button" onclick="window.location.href='public/animai/cadastrar_animal.php'">Cadastrar Animal</button>

    <br>
    <h2>Lista de Clientes</h2>

    <table>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Ações</th>
        <?php
        include 'infra/conexao.php';
        $sql = "SELECT * FROM clientes";
        $clientes = $conn->query($sql);
        while ($cliente = $clientes->fetch_assoc()) {
        ?>

            <tr>
                <td><?php echo $cliente['id']; ?></td>
                <td><?php echo $cliente['nome']; ?></td>
                <td><?php echo $cliente['email']; ?></td>
                <td><?php echo $cliente['telefone']; ?></td>
                <td>
                    <button type="button" onclick="window.location.href='public/cliente/editar_cliente.php?id=<?php echo $cliente['id']; ?>'">Editar</button>
                    <button type="button" onclick="if (confirm('Tem certeza que deseja excluir este cliente?')) { window.location.href='public/cliente/excluir_cliente.php?id=<?php echo $cliente['id']; ?>'; }">Excluir</button>
                </td>
            </tr>

        <?php
        }
        ?>
    </table>

    <h2>Lista de Animais</h2>
    <table>
        <th>ID</th>
        <th>Nome</th>
        <th>Espécie</th>
        <th>Raça</th>
        <th>Idade</th>
        <th>ID do Cliente</th>
        <th>Ações</th>
        <?php
        $sql = "SELECT * FROM animais";
        $animais = $conn->query($sql);
        while ($animal = $animais->fetch_assoc()) {
        ?>

            <tr>
                <td><?php echo $animal['id']; ?></td>
                <td><?php echo $animal['nome']; ?></td>
                <td><?php echo $animal['especie']; ?></td>
                <td><?php echo $animal['raca']; ?></td>
                <td><?php echo $animal['idade']; ?></td>
                <td><?php echo $animal['cliente_id']; ?></td>
                <td>
                    <button type="button" onclick="window.location.href='public/animal/editar_animal.php?id=<?php echo $animal['id']; ?>'">Editar</button>
                    <button type="button" onclick="if (confirm('Tem certeza que deseja excluir este animal?')) { window.location.href='public/animal/excluir_animal.php?id=<?php echo $animal['id']; ?>'; }">Excluir</button>
                </td>
            </tr>

        <?php
        }
        ?>

</body>

</html>