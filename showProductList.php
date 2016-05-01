<?php

    echo "<table>";

    echo "<tr><td>Product Name</td><td>Product Detial</td><td>Category</td><td>Amount</td><td>Price</td></tr>";

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

    if(mysql_num_rows($result) > 0){
        while($row = mysql_fetch_assoc($result)){
            echo "<tr>";
            echo "<td><a href='productDetails.php?prodID=".$row["ProductID"]."'>".$row["ProductName"]."</a></td>";
            echo "<td style='text-overflow: ellipsis'>".$row["ProductDetail"]."</td>";
            echo "<td>".$row["Category"]."</td>";
            echo "<td>".$row["Amount"]."</td>";
            echo "<td>".$row["Price"]."</td>";
            echo "</tr>";
        }
    }

    echo "</table>";

    mysql_close($conn);

?>