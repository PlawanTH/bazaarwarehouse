<!DOCTYPE html>
<?php
    session_start();

    // web page permission
    if(!isset($_SESSION["custID"])){
        header("Location: index.php");
        exit;
    }

?>

<html>
    
    <head>

        <?php 
        include("htmlheader.php");
        ?>
        
    </head>

    <body>
        <div class="container-fluid">
        
        <?php
        
            $login = "";

            if(isset($_SESSION["user"])){
                $login = "LOG OUT";
            }
            else {
                $login = "LOG IN";
            }
        
            include("menuheader.php");
            //include("modal.php");
        
            // connect to db
            $conn = mysql_connect("localhost", "root", "");

            if(!$conn){
                die("Connection failed: ". mysql_error());
            }
            // select db
            mysql_select_db("csc321");

            // create sql query string
            $sql = "SELECT * FROM Customer WHERE CustomerID = ".$_SESSION["custID"];
            $result = mysql_query($sql);
        
            $firstname = $lastname = $address = $email = $phone = "";
        
            if(mysql_num_rows($result) > 0){
                while($row = mysql_fetch_assoc($result)){
                    $firstname = $row["Firstname"];
                    $lastname = $row["Lastname"];
                    $address = $row["Address"];
                    $email = $row["Email"];
                    $phone = $row["Phone"];
                }
            } else {
                echo "<script>alert('Could not find product. Try again.')</script>";
                die("Error: ". mysql_error());
                header("Refresh:0, URL=index.php");
                exit;
            }
        
            mysql_close($conn);
        
        ?>
        <div class="container">
            <div class="row" style="padding: 50px;">
                <h1>Edit Profile</h1>
                <hr/>
                <form method="post">
                    Firstname: <input type="text" name="firstname" maxlength="25" value="<?php echo $firstname ?>" required /><br/><br/>
                    Lastname: <input type="text" name="lastname" maxlength="25" value="<?php echo $lastname ?>" required  /><br/><br/>
                    Address: <textarea name="address" maxlength="255" required><?php echo $address ?></textarea><br/><br/>
                    E-mail: <input type="email" name="email" required value="<?php echo $email ?>" /><br/><br/>
                    Phone Number: <input type="tel" name="tel" maxlength="10" value="<?php echo $phone ?>" /><br/><br/>
                    <input type="submit" name="editSubmit" /><br/>
                </form>
            </div>
        </div>
        
        <?php
        
            if(isset($_POST["editSubmit"])){
                if(!empty($_POST)){
                    foreach($_POST as $value){
                        if(empty($value)){
                            echo "<script>alert('Invalid input. Try again.')</script>";
                            header("Refresh:0, URL=editProduct.php?prodID=".$prodID);
                            exit;
                        }
                    }
                }
                
                // connect to db
                $conn = mysql_connect("localhost", "root", "");

                if(!$conn){
                    die("Connection failed: ". mysql_error());
                }
                // select db
                mysql_select_db("csc321");
                

                // create sql query string
                $sql = "UPDATE Customer"
                    ." SET Firstname = '".$_POST["firstname"]."',"
                    ." Lastname = '".$_POST["lastname"]."',"
                    ." Address = '".$_POST["address"]."',"
                    ." Email = '".$_POST["email"]."',"
                    ." Phone = '".$_POST["tel"]."'"
                    ." WHERE CustomerID = ".$_SESSION["custID"];
                
                if($result = mysql_query($sql)){
                    echo "<script>alert('Edit Profile Success.')</script>";
                } else {
                    echo "<script>alert('Something went wrong. Try again.')</script>";
                    die("Error: ". mysql_error());
                    header("Refresh:0, URL=editCustomerProfile.php"); 
                    exit;
                }

                mysql_close($conn);
                

                header("Refresh:0, URL=customerProfile.php"); // link to customer detail
            }
        ?>
        
        
        <?php include("footer.php"); ?>
            </div>
    
    </body>

</html>