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
    
    <head>

        <?php 
        include("htmlheader.php");
        ?>
        
    </head>

    <body>
        
        <?php
        
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
        
        <?php
        
        $conn = mysql_connect("localhost", "root", "");
        
        if(!$conn){
            die("Connection failed: " . mysql_error());
        }
        
        mysql_select_db("csc321");
        
        // set character set results ////////
        $cs1 = "SET character_set_results=utf8";
mysql_query($cs1) or die('Error query: ' . mysql_error());
        
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
        ?>
        
        <!----------------------------------->
        <div class="row" style="padding:20px 0">
	    	<div class="col-md-4">
		      	<div class="product-detail">
					<img src="<?php echo $imagePath; ?>" class="img-product img-rounded" width="300">
				</div>
			</div>
			<div class="col-md-5">
		      	<div class="product-detail">
					<h3><b><?php echo $productName; ?></b></h3>
					<h2 class="product-price"><b><?php echo $price ?> Bath</b></h2>
                    <?php if(!isset($_SESSION["sellerID"])): ?>
					Amount<br><br>
                    <form method="post" action="order.php" onsubmit="return confirm('Do you sure to buy this product?');">
                        <input type="hidden" name="prodID" value="<?php echo $prodID; ?>" />
					   <input type="number" class="form-control" min="1" value="1" style="width:100px;" name="amount" required><br>
					   <button type="submit" class="buybtn btn btn-danger" data-toggle="modal" data-target="#exampleModal-product" data-whatever="product" name="submitBuy" <?php if($amount == 0) echo "disabled" ?>>BUY</button>
                    </form>
                    <?php endif; ?>
                    <br>
                    <?php if($amount == 0){ echo "<span style='color:red'>* สินค้าหมดชั่วคราว</span><br/>"; }?>
                    <br>
					<p>Short Detail: <?php echo $productDetail; ?></p<br/>
                    
                    <?php if(isset($_SESSION["sellerID"])): ?>
                    <h3><?php echo "Product Amount: ".$amount ; ?></h3><br/>
            <a class="btn btn-primary" style="font-size:1.4em;" href="editProduct.php?prodID=<?php echo $prodID; ?>">Edit Product Detail</a>
                    <?php endif ?>
				</div>
			</div>
			<div class="col-md-9 product-detail">
				<br>
				<p>Product Name : <?php echo $productName; ?><br>
                    Product Detail : <?php echo $productDetail; ?><br/>
                    Category : <?php echo $category; ?><br/>
				</p>
			</div>
		</div>
        
        
        
        
        <?php include("footer.php"); ?>
        
    </body>

</html>

