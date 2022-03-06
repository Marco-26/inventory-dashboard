<?php
    include_once "db.php";
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM items WHERE id=$id";
        
        if(mysqli_query($conn, $sql)){
			header("Location: ../index.php");
		}
		else{
			echo "mysqli_error($conn, $sql)";
		}
    
    }

