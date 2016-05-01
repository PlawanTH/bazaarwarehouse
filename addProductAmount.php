<?php
    session_start();

    // web page permission
    /*if(!isset($_SESSION["sellerID"])){
        header("Location: index.php");
        exit;
    }*/

    // product id GET method check
    if(!isset($_GET["prodID"])){
        echo "<script>alert('Error! No product was choosed.')</script>";
        header("Refresh: 0, URL=index.php");
        exit;
    }

    $prodID = $_GET["prodID"];

?>

<?php 

    // connect to db
    $conn = mysql_connect("localhost", "root", "");

    if(!$conn){
        die("Connection failed: ". mysql_error());
    }
    // select db
    mysql_select_db("csc321");

    // create sql query string
    $sql = "SELECT * FROM Product WHERE ProductID = ".$prodID;
    $result = mysql_query($sql);
        
    $prodName = $prodDetail = $price = $prodAmount = "";
        
    if(mysql_num_rows($result) > 0){
        while($row = mysql_fetch_assoc($result)){
            $prodName = $row["ProductName"];
            $prodDetail = $row["ProductDetail"];
            $price = $row["Price"];
            $prodAmount = $row["Amount"];
        }
    } else {
        echo "<script>alert('Could not find product. Try again.')</script>";
        die("Error: ". mysql_error());
        header("Refresh:0, URL=index.php");
        exit;
    }
        
    mysql_close($conn);

?>

<!DOCTYPE html>
<html>

    <body>
        
        <form method="post">
            Amount of product to add: <input type="number" name="amount" required autofocus />&nbsp;&nbsp;
            <input type="hidden" value="<?php echo $prodID ?>" name="productID" />
            <input type="submit" name="submit" />
        </form>
    
    </body>

</html>

<?php
    
    if(isset($_POST["submit"])){
        if(empty($_POST["amount"])){
            echo "<script>alert('Invalid input. Try again.')</script>";
            header("Refresh:0, URL=addProductAmount.php?prodID=".$prodID);
            exit;
        }
        
        $conn = mysql_connect("localhost", "root", "");

        if(!$conn){
            die("Connection failed: ". mysql_error());
        }
        
        // select db
        mysql_select_db("csc321");
        
        $amount = $_POST["amount"]+$prodAmount;
        
        $sql = "UPDATE Product SET Amount = ".$amount." WHERE ProductID = ".$_POST["productID"];

        if($result = mysql_query($sql)){
            echo "<script>alert('Add Amount of Product Success.')</script>";
        } else {
            echo "<script>alert('Something went wrong. Try again.')</script>";
            die("Error: ". mysql_error());
            header("Refresh:0, URL=addProductAmount.php?prodID=".$prodID);
            exit;
        }

        mysql_close($conn);
        
        header("Refresh:0, URL=index.php");
        
    }
?>