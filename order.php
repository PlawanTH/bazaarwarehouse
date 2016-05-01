<?php
        
    session_start();

    if(!isset($_SESSION["custID"])){
        echo "<script>alert('You have to log in first.')</script>";
        //header("Refresh:0, URL=login.php");
        header("Refresh:0, URL=productDetails.php?prodID=".$_POST["prodID"]);
        exit;
    }

    $amount = $price = "";

    if(isset($_POST["submit"]) && !empty($_POST["amount"])){

        $conn = mysql_connect("localhost", "root", "");
        if(!$conn){
            die("Connection failed: ".mysql_error());
        }
        
        mysql_select_db("csc321");

        $sql = "SELECT * FROM Product WHERE ProductID = ".$_POST["prodID"];
        $result = mysql_query($sql);
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){
                $amount = $row["Amount"];
                $price = $row["Price"];
            }
        }
        else {
            echo "<script>alert('Unknown product. Error:".mysql_error()."')</script>";
            header("Refresh:0, URL=login.php");
            die;
        }
        
        if($amount <= 0 || $amount < $_POST["amount"]){
            echo "<script>alert('Cannot make an order. Product is not enough for order.')</script>";
            header("Refresh:0, URL=index.php");
            die;
        }

        $sql = "INSERT INTO `order`(`customerID`, `productID`, `Amount`, `status`, `orderDate`, `Price`) VALUES ("
            .$_SESSION["custID"].","
            .$_POST["prodID"].","
            .$_POST["amount"].","
            ."'Ordering','"
            .date("Y-m-d")."',"
            .($_POST["amount"]*$price)
            .")";

        if($result = mysql_query($sql)){
            $sql = "UPDATE Product SET Amount = ".($amount-$_POST["amount"])." WHERE ProductID = ".$_POST["prodID"]; 
            if($result = mysql_query($sql)){
                echo "<script>alert('Order Success.\nYou can track order status on track order page.')</script>";
            } else {
                die("Something went wrong. Error:".mysql_error());
            }
        }
        else {
            die("Something went wrong. Error:".mysql_error());
        }

        mysql_close($conn);
        header("Refresh:0, URL=index.php");

    }

?>