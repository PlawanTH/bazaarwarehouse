<?php

    $conn = mysql_connect("localhost", "root", "");

    if(!$conn){
        die("Connection failed: " . mysql_error());
    }

    mysql_select_db("csc321");

    $sql = "SELECT * FROM Product";

    if(isset($_POST["submit"])){

        if(!empty($_POST["keyword"]) && !empty($_POST["category"])){
            $sql .= " WHERE ProductName LIKE '%".$_POST["keyword"]."%' AND Category LIKE '%".$_POST["category"]."%'";
        }
        else if(!empty($_POST["keyword"])){
            $sql .= " WHERE ProductName LIKE '%".$_POST["keyword"]."%'";
        } else if(!empty($_POST["category"])){
            $sql .= " WHERE Category LIKE '%".$_POST["category"]."%'";
        }
        
    }

    $result = mysql_query($sql);
    if(!$result){
        die("Could not find data". mysql_error());
    }

    $rowcount = 0;

?>
    
<?php if(mysql_num_rows($result) > 0): ?>

<div class="container">
    <?php while($row = mysql_fetch_assoc($result)): ?>
    <?php if($rowcount % 4 == 0): ?>
         <div class="row">
            <div class="col-xs-12">
                <?php endif; ?>
               <div class="col-xs-3">
                  <a class="product-seller" href="<?php echo "productDetails.php?prodID=".$row["ProductID"]; ?>">
                        <img src="<?php echo $row["ImagePath"] ?>" class="img-product img-rounded" width="160">
                        <p class="product_name">Product name: <br><?php echo $row["ProductName"]; ?></p>
                        <p class="price"><?php echo $row["Price"]; ?> bath</p>
                  </a>
               </div>
            <?php $rowcount++; ?>
             <?php if($rowcount % 4 == 0): ?>
             </div>
    </div>
    <?php endif; ?>
    <?php endwhile; ?>
    
    <!-- for the row that not has 4 products -->
    <?php if($rowcount % 4 != 0): ?>
             </div>
    </div>
    <?php endif; ?>

</div>

<?php endif; ?>

<?php

    mysql_close($conn);

?>

