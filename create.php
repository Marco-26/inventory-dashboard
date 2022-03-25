<?php 
	include_once "includes/db.php";

	$updating = false;

	$row['produto'] = NULL;
	$row['quantidade'] = NULL;
	$row['fornecedor'] = NULL;
	$row['preço'] = NULL;
	
	// get information based on id
	if(isset($_GET['id'])){
		$id_to_edit = $_GET['id'];

		$sql = "SELECT * FROM items WHERE id=?;";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt,$sql)){
			echo "SQL Error";
		}
		else{
			$updating = true;
			mysqli_stmt_bind_param($stmt, "i", $id_to_edit);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			$row = mysqli_fetch_assoc($result);
		}
	}

	// when submit button is clicked
	if (isset($_POST['submit'])) {
		$product = $_POST['product'];
		$quantity = $_POST['product-quantity'];
		$supplier = $_POST['product-supplier'];
		$price = $_POST['product-price'];

		if(empty($product) || empty($quantity) || empty($supplier) || empty($price)){
			header("Location: ../create.php?fields=empty");
			exit();
		}
		
		if($updating){
			// edit item based on id
			$sql = "UPDATE items SET produto=?,quantidade=?,fornecedor=?,preco=? WHERE id=?;";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL error";
			}
			else{
				mysqli_stmt_bind_param($stmt, "i", $id_to_edit);
				mysqli_stmt_execute($stmt);
				header("Location: ../index.php");
			}
		}
		else{
			// create one more item
			// more safer way to work with database
			$sql = "INSERT INTO items(produto, quantidade, fornecedor, preço) VALUES(?,?,?,?);";
			$stmt = mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL error";
			}
			else{
				mysqli_stmt_bind_param($stmt, "sisi", $product,$quantity,$supplier,$price);
				mysqli_stmt_execute($stmt);
				header("Location: ../index.php");
			}
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css">
	<title>Adicionar Produto</title>
</head>
<body>
	<div class="wrapper">
	
	<h1><?php if($updating) echo "Atualizar produto"; else echo "Adicionar produto"?></h1>
	
	<form method="post" class="create-form">
		<div class="create-form-input">
			<label>Nome do produto:</label>
			<input type="text" name="product" value="<?php echo $row['produto']?>">
		</div>
		<div class="create-form-input">
			<label for="product-quantity">Quantidade:</label>
			<input type="number" name="product-quantity" value="<?php echo $row['quantidade']?>">
		</div>
		<div class="create-form-input">
			<label for="product-supplier">Fornecedor:</label>
			<input type="text" name="product-supplier" value="<?php echo $row['fornecedor']?>">
		</div>
		<div class="create-form-input">
			<label for="product-price">Preço:</label>
			<input type="number" name="product-price" value="<?php echo $row['preço']?>">
		</div>
		<button type="submit" name="submit" class="btn"><?php if($updating) echo "ATUALIZAR"; else echo "ADICIONAR"?></button>
	</form>
	<?php
		$URL = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		if(strpos($URL, "fields=empty")){
			echo "<p class='error'>Todos os campos têm de ser preenchidos</p>";
		}
	?>
	</div>
</body>
</html>