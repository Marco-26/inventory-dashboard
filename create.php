<?php 
	include_once "includes/db.php";

	$updating = false;

	$row['produto'] = NULL;
	$row['quantidade'] = NULL;
	$row['fornecedor'] = NULL;
	$row['preço'] = NULL;
	
	// edit
	if(isset($_GET['id'])){
		$id = $_GET['id'];

		$sql = "SELECT * FROM items WHERE id=$id";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
	
		$updating = true;
	}

	// create
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
			$sql = "UPDATE items SET produto='$product',quantidade='$quantity',fornecedor='$supplier',preco='$price' WHERE id=$id";
		}
		else{
			$sql = "INSERT INTO items(produto, quantidade, fornecedor, preço) VALUES('$product', '$quantity', '$supplier', '$price')";
		}

		if(mysqli_query($conn, $sql)){
			header("Location: ../index.php");
		}
		else{
			echo 'Error';
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