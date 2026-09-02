<?php
include "../../infra/conexao.php";

$id = $_GET["id"];

$stmt = $conexao->prepare(
    "DELETE FROM animais WHERE id = ?"
);

$stmt->bind_param("i", $id);

$stmt->execute();

if ($stmt->execute()) {
    echo "Animal excluído com sucesso!<br>";
    echo "<button type='button' onclick=\"window.location.href='../../index.php'\">Voltar</button>";
} else {
    echo "Erro: " . $stmt->error;
}

header("Location: ../../index.php");
?>