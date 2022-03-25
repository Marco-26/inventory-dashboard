<?php
    include_once "db.php";
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM items WHERE id=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "SQL Error";
        }
        else{
          mysqli_stmt_bind_param($stmt, "i", $id);
          mysqli_stmt_execute($stmt);
          header("Location: ../index.php");
        }
    }

