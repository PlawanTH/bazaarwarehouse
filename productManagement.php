<?php

    echo "<table class='table table-hover'>";
    echo "<thead>";
    echo "<tr><th>Product Name</th><th>Product Detial</th><th>Category</th><th>Amount</th><th>Price</th><th></th><th></th></tr>";
    echo "</thead>";
    
    $conn = mysql_connect("localhost", "root", "");

    if(!$conn){
        die("Connection failed: " . mysql_error());
    }

    mysql_select_db("csc321");

// set character set results ////////
        $cs1 = "SET character_set_results=utf8";
mysql_query($cs1) or die('Error query: ' . mysql_error());

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

    if(mysql_num_rows($result) > 0){
        while($row = mysql_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row["ProductName"]."</td>";
            echo "<td style='text-overflow: ellipsis'>".$row["ProductDetail"]."</td>";
            echo "<td>".$row["Category"]."</td>";
            echo "<td>".$row["Amount"]."</td>";                
            echo "<td>".$row["Price"]."</td>";
            echo "<td><a href='editProduct.php?prodID=".$row["ProductID"]."'>Edit</a></td>";
            echo "<td><a href='addProductAmount.php?prodID=".$row["ProductID"]."'>Add Amount</a></td>";
            echo "</tr>";
        }
    }   
    

    echo "</table>";

    mysql_close($conn);

?>