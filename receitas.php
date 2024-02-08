<?php
require "./config.php";

$sql = "SELECT 
          receitas.id AS receita_id,
          receitas.descricao AS receita_descricao,
          receitas.valor AS receita_valor,
          receitas.data_mvto AS receita_data_mvto,
          categorias.id AS categoria_id,
          categorias.descricao AS categoria_descricao
        FROM receitas
        INNER JOIN categorias ON receitas.categoria_id = categorias.id";
$sql = $pdo->prepare($sql);
$sql->execute();


$dados = $sql->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT SUM(valor) as valor FROM receitas";
$sql = $pdo->prepare($sql);
$sql->execute();
$totalReceita = $sql->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/style.css">
  <title>Receitas</title>
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="#">Categorias</a></li>
        <li><a href="#">Receitas</a></li>
        <li><a href="#">Despesas</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <span class="total">
      <p>Total de Receitas: R$<?= $totalReceita['valor'] ?></p>
    </span>
    <form action="cadastrarReceita.php" method="get">
      <label>
        Descrição
        <input type="text" name="descricao" required>
      </label>

      <label>
        Valor
        <input type="number" name="valor" required>
      </label>

      <label>
        Categoria
        <select name="categoria">
          <option value="salario">Salário</option>
          <option value="bonus">Bônus</option>
          <option value="rendimento">Rendimento</option>
        </select>
      </label>

      <label>
        Data
        <input type="date" name="data_mvto" required>
      </label>

      <button type="submit">Adicionar</button>

    </form>

    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Descrição</th>
          <th>Valor</th>
          <th>Data</th>
          <th>Categoria</th>
          <th>Opções</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($dados as $dado) : ?>
          <tr>
            <td><?= $dado['receita_id'] ?></td>
            <td><?= $dado['receita_descricao'] ?></td>
            <td><?= $dado['receita_valor'] ?></td>
            <td><?= $dado['receita_data_mvto'] ?></td>
            <td><?= $dado['categoria_descricao'] ?></td>
            <td>
              <a href="./deletarReceita.php?id=<?= $dado['receita_id'] ?>"><i class="btn-deletar fa-solid fa-trash"></i></a>
              <a href="./editarReceita.php?id=<?= $dado['receita_id'] ?>" class="btn-editar"><i class="fa-solid fa-pen-to-square"></i></a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  </main>
  <script src="https://kit.fontawesome.com/561265e797.js" crossorigin="anonymous"></script>
</body>

</html>