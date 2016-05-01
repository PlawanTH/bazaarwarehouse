<?php

    session_start();
    if(!isset($_SESSION["custID"])){
        header("Location: index.php");
        exit;
    }

?>
<html>
    
    <form method="post">
        <select name="status">
            <option value="Incomplete">No Comlete</option>
            <option value="Ordering">Ordering</option>
            <option value="Ready">Ready</option>
            <option value="Complete">Complete</option>
            <option value="All">All</option>
        </select>
        <input type="submit" name="submit" value="Search by status" />
    </form>
    
    <?php

        $conn = mysql_connect("localhost", "root", "");

        if(!$conn){
            die("Connection failed: ".mysql_error());
        }

        mysql_select_db("csc321", $conn);

        $sql = "SELECT ProductName, Order.Price, orderDate, orderID, Order.Amount, status FROM `Order`, `Product` WHERE Order.productID = Product.ProductID AND customerID =".$_SESSION["custID"];
    
        if(isset($_POST["submit"])){
            if($_POST["status"] == "Ordering"){
                $sql .= " AND status = 'Ordering'";
            } 
            elseif($_POST["status"] == "Ready"){
                $sql .= " AND status = 'Ready'";
            }
            elseif($_POST["status"] == "Complete"){
                $sql .= " AND status = 'Complete'";
            }
            elseif($_POST["status"] == "All"){
                
            }
            else {
                $sql .= " AND (status = 'Ordering' OR status = 'Ready')";
            }
        } else {
            $sql .= " AND (status = 'Ordering' OR status = 'Ready')";
        }
            
        $sql .= " ORDER BY orderID";
        $result = mysql_query($sql);

        if(mysql_num_rows($result) > 0){
            echo "<table>";
            echo "<tr>";
            echo "<td>No.</td><td>Product Name</td><td>Amount</td><td>Price</td><td>Order Date</td><td>Order Status</td>";
            echo "</tr>";
            $count = 1;
            while($row = mysql_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>$count</td>";
                echo "<td>".$row["ProductName"]."</td>";
                echo "<td>".$row["Amount"]."</td>";
                echo "<td>".$row["Price"]."</td>";
                echo "<td>".$row["orderDate"]."</td>";
                echo "<td>".$row["status"]."</td>";
                echo "</tr>";
                $count++;
            }
            echo "</table>";
        }
        else {
            echo "You have no order.";
        }

        mysql_close($conn);

    ?>
    
</html>