<!DOCTYPE html>
<html>
    <head>
    
    </head>
    
    <body>
        
        <form method="post">
            Username: <input type="text" name="user" maxlength="12" required /><br/>
            Password: <input type="password" name="pwd" maxlength="25" required /><br/>
            Confirm Password: <input type="password" name="pwdConfirm" maxlength="25" required /><br/><br/>
            Current Seller's Password: <input type="password" name="pwdCurrent" maxlength="25" required /><br/>
            <input type="submit" name="submit" value="Create account"/>
        </form>
        
    </body>
</html>
        
<?php

    session_start();

    // web page permission
    if(!isset($_SESSION["sellerID"])){
        header("Location: index.php");
        exit;
    }

    // check is submit and all field do not empty.
    if(isset($_POST["submit"])){
        if(!empty($_POST)){
            foreach($_POST as $value){
                if(empty($value)){
                    echo "<script>alert('Invalid input. Try again.')</script>";
                    header("Refresh:0, URL=createSellerAccount.php");
                    exit;
                }
            }
        }
        
        // check matched confirm password.
        if( $_POST["pwd"] != $_POST["pwdConfirm"] ){
            echo "<script>alert('Your password is not matched. Try again.')</script>";
            header("Refresh:0, URL=index.php");
            exit;
        }
        
        
        // create db connection
        $conn = mysql_connect("localhost", "root", "");
        
        if(!$conn){
            die("Connection failed: ". mysql_error());
        }
        
        mysql_select_db("csc321");
        
        // check current seller password is true.
        // create sql query string
        $sql = "SELECT * FROM Seller WHERE sellerID = ".$_SESSION["sellerID"];
        
        // execute query
        $result = mysql_query($sql);
        if(!$result){
            die("Could not get data: ". mysql_error());
        }
        
        $sellerPwd = "";
        
        if(mysql_num_rows($result) > 0){
            while($row = mysql_fetch_assoc($result)){
                $sellerPwd = $row["Password"];
            }
        }
        
        if(($_POST["pwdCurrent"]) != $sellerPwd){ //md5
            echo "<script>alert('Current Seller Password is wrong. Try again.')</script>";
            header("Refresh:0, URL=index.php");
            exit;
        }
        
        // create sql query string for create seller account
        $sql = "INSERT INTO Seller (Username, Password) VALUES ("
            ."'".$_POST["user"]."',"
            ."'".($_POST["pwd"])."'" // md5
        .")";
        
        if($result = mysql_query($sql)){
            echo "<script>alert('Create Seller Account Success.')</script>";
        } else {
            echo "<script>alert('Something went wrong. Try again.')</script>";
            die("Error: ". mysql_error());
            header("Refresh:0, URL=index.php");
            exit;
        }
        
        // close db connection
        mysql_close($conn);
        
        header("Refresh:0, URL=index.php");
        exit;
        
    }

?>