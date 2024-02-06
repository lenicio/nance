<?php
require "./config.php";

$id = $_GET['id'];
$descricao = $_GET['descricao'];
$valor = $_GET['valor'];
$categoria = $_GET['categoria'];
$data_mvto = $_GET['data_mvto'];


$sql = "UPDATE receitas SET
descricao = :descricao,
valor = :valor,
categoria_id = :categoria,
data_mvto = :data_mvto
WHERE id = :id";

$sql = $pdo->prepare($sql);
$sql->bindValue(":id", $id);
$sql->bindValue(":descricao", $descricao);
$sql->bindValue(":valor", $valor);
$sql->bindValue(":categoria", 1);
$sql->bindValue(":data_mvto", $data_mvto);
$sql->execute();

header("Location: receitas.php");
exit;
