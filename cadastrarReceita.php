<?php

require "./config.php";

if (isset($_GET['descricao']) && !empty($_GET['descricao'])) {
  $descricao = $_GET['descricao'];
}

$valor = $_GET['valor'];
$categoria_id = $_GET['categoria'];
$data_mvto = $_GET['data_mvto'];

$sql = "INSERT INTO receitas (descricao, valor, data_mvto, categoria_id) VALUES 
(:descricao, :valor, :data_mvto, :categoria_id)";
$sql = $pdo->prepare($sql);

$sql->bindValue(":descricao", $descricao);
$sql->bindValue(":valor", $valor);
$sql->bindValue(":data_mvto", $data_mvto);
$sql->bindValue(":categoria_id", 1);

$sql->execute();

header("Location: receitas.php");
exit;
