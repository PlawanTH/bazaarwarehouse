<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    
    <head>

    </head>

    <body>
        <?php

            if(isset($_SESSION["user"])){
                echo "Welcome ".$_SESSION["user"];
                echo '<a href="logout.php">Logout</a>';
            }
            else {
                echo '<a href="login.php">Login</a>';
            }

        ?>    
        
        <a href="index.php">Home</a>
        <a href="addProduct.php">Add New Product</a>
        <a href="addProductAmount.php?prodID=2">Add Amount</a>
        <a href="editProduct.php?prodID=2">Edit Product</a>
        <a href="createSellerAccount.php">Create seller account</a>
        <a href="order.php">Make an Order</a>
        
        <br/>
        <form method="post">
            Search: <input type="text" name="keyword" />
            Category: <input type="text" name="category" />
            <input type="submit" name="submit" />
        </form>
        <?php include("productManagement.php"); ?>
        
    </body>

</html>