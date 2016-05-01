<!DOCTYPE html>
<!-- <html>
    <head>
    </head>

    <body>
        
        <form method="post">
            <input type="text" name="user" />
            <input type="password" name="pwd" />
            <input type="submit" name="submit" value="Login" />
        </form>
        <a href="register.php">Register</a>
    
    </body>

</html>
-->
<?php

    session_start();
/*
    if(isset($_SESSION["user"])){
        header("Location: index.php");
        exit;
    }
*/
    
    $user = $pwd = "";

    if(isset($_POST["submit"])){
        if(!( empty($_POST["user"]) || empty($_POST["pwd"]) )){
            $user = $_POST["user"];
            $pwd = $_POST["pwd"];
            //$pwd = md5($_POST["pwd"]);
            
            // create connection
            $conn = mysql_connect("localhost", "root", "");
            mysql_select_db("csc321", $conn);
            
            // check connection
            if(!$conn){
                die("Connection failed: " . mysql_error());
            }
            
            // create sql query string
            $sql = "SELECT * FROM Customer WHERE Username='".$user."' AND Password='".$pwd."'";
            $result = mysql_query($sql);
            
            if(!$result){
                die('Could not get data: ' . mysql_error());
            }
            
            if(mysql_num_rows($result) > 0){
                while($row = mysql_fetch_assoc($result)){
                    $_SESSION["custID"] = $row["CustomerID"];
                    $_SESSION["user"] = $row["Username"];
                    // $_SESSION["type"] = "customer";
                }
            }
            else {
                $sql = "SELECT * FROM Seller WHERE Username='".$user."' AND Password='".$pwd."'";
                $result = mysql_query($sql);

                if(!$result){
                    die('Could not get data: ' . mysql_error());
                }

                if(mysql_num_rows($result) > 0){
                    while($row = mysql_fetch_assoc($result)){
                        $_SESSION["sellerID"] = $row["SellerID"];
                        $_SESSION["user"] = $row["Username"];
                        // $_SESSION["type"] = "seller";
                    }
                }
                else {
                    authorizeFailedAlert();
                }
            }
            
            mysql_close($conn);
            
            header("Refresh:0, URL=".$_SERVER['HTTP_REFERER']);
            exit;
        }
        else {
            authorizeFailedAlert();
        }
        
    }

    function authorizeFailedAlert(){
        echo "<script>alert('Username or Password is Wrong.')</script>";
        #header("Location: login.php");
        header("Refresh:0, URL=index.php");
        exit;
    }

    

?>