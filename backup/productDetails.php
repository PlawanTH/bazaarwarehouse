<?php

    session_start();

    if(! isset($_GET["prodID"]) || empty($_GET["prodID"]) ){
        echo "<script>alert('Something went wrong.')</script>";
        header("Refresh:0, URL=index.php");
        exit;
    }

    $prodID = $_GET["prodID"];

?>

<!DOCTYPE html>
<html>

    <body>
        
        <?php
        
        $conn = mysql_connect("localhost", "root", "");
        
        if(!$conn){
            die("Connection failed: " . mysql_error());
        }
        
        mysql_select_db("csc321");
        
        $sql = "SELECT * FROM Product WHERE ProductID = ".$prodID;
        $result = mysql_query($sql);
        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){
                $productName = $row["ProductName"];
                $productDetail = $row["ProductDetail"];
                $category = $row["Category"];
                $imagePath = $row["ImagePath"];
                $amount = $row["Amount"];
                $price = $row["Price"];
            }
        }
        else {
            echo "<script>alert('Unknown product.')</script>";
            die;
            header("Refresh:0, URL=index.php");
        }
        
        mysql_close($conn);
        
        echo "<img src='$imagePath' width='250px'/>";
        echo "<hr/>";
        echo "<p>Product Name: $productName</p>";
        echo "<p>Product Detail: $productDetail</p>";
        echo "<p>Category: $category</p>";
        echo "<p>Amount: $amount</p>";
        echo "<p>Price: $price</p>";
        
        ?>
        
        <?php if(isset($_SESSION["sellerID"])): ?>
            <a href="editProduct.php?prodID=<?php echo $prodID; ?>">Edit Product Detail</a>
        <?php endif ?>
        
        <?php if(isset($_SESSION["custID"])): ?>
        <form method="post" action="order.php">
            <input type="hidden" name="prodID" value="<?php echo $prodID; ?>" />
            Amount: <input type="number" name="amount" min="1" value="1" required />
            <input type="submit" name="submit" value="Order" />
        </form>
        <?php endif ?>
        
    </body>

</html>