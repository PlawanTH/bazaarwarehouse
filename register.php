<!DOCTYPE html>
<!-- <html>
    <head>
    
    </head>
    
    <body>
        
        <form method="post">
            Username: <input type="text" name="user" maxlength="12" required /><br/>
            Password: <input type="password" name="pwd" maxlength="25" required /><br/>
            Firstname: <input type="text" name="firstname" maxlength="25" required /><br/>
            Lastname: <input type="text" name="lastname" maxlength="25" required  /><br/>
            Address: <textarea name="address" maxlength="255" required></textarea><br/>
            E-mail: <input type="email" name="email" required /><br/>
            Phone Number: <input type="tel" name="tel" maxlength="10" /><br/>
            <input type="submit" name="submit" value="Register" /><br/>
        </form>
        
    </body>
</html> -->
        
<?php
    /*
    session_start();

    if(isset($_SESSION["user"])){
        header("Location: index.php");
        exit;
    }
    */

    if(isset($_POST["submit"])){
        if(!empty($_POST)){
            foreach($_POST as $value){
                if(empty($value)){
                    echo "<script>alert('Invalid input. Try again.')</script>";
                    header("Refresh:0, URL=index.php");
                    exit;
                }
            }
        }
        
        if($_POST["pwd"] != $_POST["pwdconfirm"]){
            echo "<script>alert('Mismatch Password. Try again.')</script>";
            header("Refresh:0, URL=index.php");
            exit;
        }
        
        // create db connection
        $conn = mysql_connect("localhost", "root", "");
        
        if(!$conn){
            die("Connection failed: ". mysql_error());
        }
        
        mysql_select_db("csc321");
        
        // create sql query string
        //INSERT INTO Customer (Username, Password, Firstname, Lastname, Address, Email, Phone) VALUES ('ccc', 'ccc', 'CCC', 'DDD', 'ABCD', 'ccc@example.com', '0123456789');
        $sql = "INSERT INTO Customer (Username, Password, Firstname, Lastname, Address, Email, Phone) VALUES ("
            ."'".$_POST["user"]."',"
            ."'".$_POST["pwd"]."'," // md5
            ."'".$_POST["firstname"]."',"
            ."'".$_POST["lastname"]."',"
            ."'".$_POST["address"]."',"
            ."'".$_POST["email"]."',"
            ."'".$_POST["tel"]."'"
        .")";
        
        if($result = mysql_query($sql)){
            echo "<script>alert('Thank you for register. Log in to continue.')</script>";
        } else {
            echo "<script>alert('Something went wrong. Try again.')</script>";
            die("Error: ". mysql_error());
            header("Refresh:0, URL=register.php");
            exit;
        }
        
        // close db connection
        mysql_close($conn);
        
        header("Refresh:0, URL=index.php");
        exit;
        
    }

?>