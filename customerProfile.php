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
            <div class="row" style="padding:50px;">
                <div class="col-xs-6" style="font-size:1.1em;">
                <h1>Personal Information</h1>
                <hr/>
                
                    Firstname: <?php echo $firstname ?><br/><br/>
                    Lastname: <?php echo $lastname ?><br/><br/>
                    Address: <?php echo $address ?><br/><br/>
                    E-mail: <?php echo $email ?><br/><br/>
                    Phone Number: <?php echo $phone ?><br/><br/>
                    <a class="btn btn-primary" href="editCustomerProfile.php">Edit Profile</a>
                 </div>
                <div class="col-xs-6">
                    <h1>Order List</h1>
                    <hr/>
                    <?php include("trackOrder.php"); ?>
                 </div>
            </div>
        </div>
        
        
        <?php include("footer.php"); ?>
            </div>
    
    </body>

</html>