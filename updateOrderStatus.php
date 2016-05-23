<?php

session_start();
if(!isset($_SESSION["sellerID"])){
    header("Location: index.php");
    exit;
}

?>



<?php

if(isset($_POST["submit"])){
    // connect to db
    $conn = mysql_connect("localhost", "root", "");

    if(!$conn){
        die("Connection failed: ". mysql_error());
    }
    // select db
    mysql_select_db("csc321");
                

    // create sql query string
    $sql = "UPDATE `Order`"
        ." SET status = '".$_POST["status"]."'"
        ." WHERE orderID = ".$_POST["orderID"];
                
    if($result = mysql_query($sql)){
         header("Refresh:0, URL=updateOrderStatus.php");
        echo "<script>alert('Update Status Success.')</script>";
    } else {
        header("Refresh:0, URL=updateOrderStatus.php"); 
        echo "<script>alert('Something went wrong. Try again.')</script>";
        die("Error: ". mysql_error());
        exit;
    }

    mysql_close($conn);
                

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
        <input type="submit" name="search" value="Search by status" />
    </form>

    <?php
    
        $conn = mysql_connect("localhost", "root", "");

        if(!$conn){
            die("Connection failed: ".mysql_error());
        }

        mysql_select_db("csc321", $conn);

        $sql = "SELECT orderID, orderDate, Customer.CustomerID, Firstname, Lastname, Email, ProductName, Order.Amount, status, Product.ProductID"
        ." FROM `Order`, `Product`, `Customer`"
        ." WHERE Order.productID = Product.ProductID"
        ." AND Order.customerID = Customer.customerID";
            
        if(isset($_POST["search"])){
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
            echo "<td>Order ID</td><td>Order Date</td><td>Customer ID</td><td>Customer Name</td><td>Customer Email</td><td>Product ID</td><td>Product Name</td><td>Amount</td><td>Order Status</td>";
            echo "</tr>";
            while($row = mysql_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row["orderID"]."</td>";
                echo "<td>".$row["orderDate"]."</td>";
                echo "<td>".$row["CustomerID"]."</td>";
                echo "<td>".$row["Firstname"]." ".$row["Lastname"]."</td>";
                echo "<td>".$row["Email"]."</td>";
                echo "<td>".$row["ProductID"]."</td>";
                echo "<td>".$row["ProductName"]."</td>";
                echo "<td>".$row["Amount"]."</td>";
                // echo "<td>".$row["status"]."</td>";
                $status = $row["status"];
                echo "<td>";
                echo "<form method='post'>";
                echo "<select name='status'>";
                echo "<option value='Ordering'";
                if($status == "Ordering") echo " selected";
                echo ">Ordering</option>";
                echo "<option value='Ready'";
                if($status == "Ready") echo " selected";
                echo ">Ready</option>";
                echo "<option value='Complete'";
                if($status == "Complete") echo " selected";
                echo ">Complete</option>";
                echo "</select>";
                echo "<input type='hidden' name='orderID' value='".$row["orderID"]."'/>";
                echo " <input type='submit' name='submit' value='Update'/>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else {
            echo "You have no order.";
        }

        mysql_close($conn);
    
    ?>

</html>