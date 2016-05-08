<?php
    session_start();

    // web page permission
    if(!isset($_SESSION["sellerID"])){
        header("Location: index.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    
    <head>
        
        <?php 
        include("htmlheader.php");
        ?>

    </head>

    <body>
        <?php

            /*
            if(isset($_SESSION["user"])){
                echo "Welcome ".$_SESSION["user"];
                echo '<a href="logout.php">Logout</a>';
            }
            else {
                echo '<a href="login.php">Login</a>';
            }
            */
        
            $login = "";

            if(isset($_SESSION["user"])){
                $login = "LOG OUT";
            }
            else {
                $login = "LOG IN";
            }
        
            include("menuheader.php");
            include("modal.php");

        ?>    
        
        <!--
        <a href="index.php">Home</a>
        <a href="addProduct.php">Add New Product</a>
        <a href="addProductAmount.php?prodID=2">Add Amount</a>
        <a href="editProduct.php?prodID=2">Edit Product</a>
        <a href="createSellerAccount.php">Create seller account</a>
        <a href="order.php">Make an Order</a> 
        
        <br/>
        -->
        <div class="container">
            <div class="row" style="padding:50px 0;">
                <div class="col-xs-12" style="text-align:center;">
                    <form method="post">
                        Search: <input type="text" name="keyword" />
                        Category: <input type="text" name="category" />
                        <input type="submit" name="submit" />
                    </form>
                </div>
                <div class="col-xs-12" style="padding: 50px 0;">
                    <?php include("productManagement.php"); ?>
                </div>
            </div>
        </div>
        
        <?php include("footer.php"); ?>
        
    </body>

</html>