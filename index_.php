<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    
    <head>

    </head>

    <body>
        
        Both: 
        
        <?php

            if(isset($_SESSION["user"])){
                echo "Welcome ".$_SESSION["user"];
                echo '<a href="logout.php">Logout</a>';
            }
            else {
                echo '<a href="login.php">Login</a>';
            }

        ?>
        
        <br/>Seller: 
        
        <?php

            if(isset($_SESSION["sellerID"])){
                echo '<a href="addProduct.php">Add New Product</a>';
                echo '<a href="createSellerAccount.php">Create seller account</a>';
                echo '<a href="productManager.php">Product Manager</a>';
                echo '<a href="updateOrderStatus.php">Update Order Status</a>';
            }

        ?>
        
        <br/>Customer: 
        
        <?php

            if(isset($_SESSION["custID"])){
                echo '<a href="editCustomerProfile.php">Edit Profile</a>';
                echo '<a href="trackOrder.php">Track Order Status</a>';
            }

        ?>
        
        
        <br/>
        <form method="post">
            Search: <input type="text" name="keyword" /> 
            Category: <input type="text" name="category" />
            <input type="submit" name="submit" />
        </form>
        <?php include("showProductList.php"); ?>
        
    </body>

</html>