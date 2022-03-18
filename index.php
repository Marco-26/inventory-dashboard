<?php
include_once "includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Dashboard</title>
</head>

<body>
  <h1>Detalhes do inventário</h1>
  <a href="create.php" class="btn">ADICIONAR NOVO ITEM</a>

  <table>
    <tr>
      <th>#</th>
      <th>Produto</th>
      <th>Quantidade</th>
      <th>Fornecedor</th>
      <th>Preço</th>
      <th>Opções</th>
    </tr>

    <?php
    $sql = "SELECT * FROM items";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_num_rows($result);

    $gains = 0;
    if ($rows > 0) :
      while ($row = mysqli_fetch_assoc($result)) : ?>

        <?php
        $gains += $row['preço'] * $row['quantidade'];
        ?>

        <tr>
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['produto']; ?></td>
          <td><?php echo $row['quantidade']; ?></td>
          <td><?php echo $row['fornecedor']; ?></td>
          <td><?php echo $row['preço']; ?></td>
          <td><a href="delete.inc.php?id=<?php echo $row['id']; ?>" class="btn-del">Delete</a>
            <a href="create.php?id=<?php echo $row['id']; ?>" class="btn-edit">Update</a>
          </td>
        </tr>
    <?php endwhile;
    endif; ?>
  </table>
  <h2>Valor total do inventário: <?php echo "$gains"; ?>€</h2>
</body>

</html>