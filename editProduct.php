<!DOCTYPE html>
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

<html>

    <body>
        
        <?php
        
            // connect to db
            $conn = mysql_connect("localhost", "root", "");

            if(!$conn){
                die("Connection failed: ". mysql_error());
            }
            // select db
            mysql_select_db("csc321");
        
            /*$cs1 = "SET character_set_results=utf8";
mysql_query($cs1) or die('Error query: ' . mysql_error());*/
        
        mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'") or die('Error query: ' . mysql_error());

            // create sql query string
            $sql = "SELECT * FROM Product WHERE ProductID = ".$prodID;
            $result = mysql_query($sql);
        
            $prodName = $prodDetail = $price = $category = "";
        
            if(mysql_num_rows($result) > 0){
                while($row = mysql_fetch_assoc($result)){
                    $prodName = $row["ProductName"];
                    $prodDetail = $row["ProductDetail"];
                    $category = $row["Category"];
                    $price = $row["Price"];
                }
            } else {
                echo "<script>alert('Could not find product. Try again.')</script>";
                die("Error: ". mysql_error());
                header("Refresh:0, URL=index.php");
                exit;
            }
        
            mysql_close($conn);
        
        ?>
        
        <form method="post" enctype="multipart/form-data">
            Product Name: <input type="text" name="productName" value="<?php echo $prodName ?>" required /><br/>
            Product Detail: <textarea name="productDetail" maxlength="255" required><?php echo $prodDetail ?></textarea><br/>
            Category: <input type="text" name="category" value="<?php echo $category ?>" required  /><br/>
            Price: <input type="number" name="price" min="0" step="any" value="<?php echo $price ?>" required  /><br/>
            Set New Image: <input type="file" name="fileToUpload" accept="image/*" /> 
            <input type="submit" name="submit" value="Edit Product" /><br/>
        </form>
        
        <?php
        
            if(isset($_POST["submit"])){
                if(!empty($_POST)){
                    foreach($_POST as $value){
                        if(empty($value)){
                            echo "<script>alert('Invalid input. Try again.')</script>";
                            header("Refresh:0, URL=editProduct.php?prodID=".$prodID);
                            exit;
                        }
                    }
                }
                
                $sql = "UPDATE Product"
                    ." SET ProductName = '".$_POST["productName"]."',"
                    ." ProductDetail = '".$_POST["productDetail"]."',"
                    ." Category = '".$_POST["category"]."',"
                    ." Price = ".$_POST["price"];
                
                $uploadComplete = 0;
                
                if(!empty($_FILES["fileToUpload"]["name"])){
                
                    $uploadOk = 1;
                    $target_file = setUploadImage();
                    if($target_file == null){
                        echo "<script>alert('File is not an image.')</script>";
                        $uploadOk = 0;
                        header("Refresh:0, URL=editProduct.php?prodID=".$prodID);
                        exit;
                    }


                    // Check if file already exists
                    if(checkFileIsExists($target_file)){
                        $uploadOk = 0;
                        echo "<script>alert('Sorry, file already exists.')</script>";
                        header("Refresh:0, URL=editProduct.php?prodID=".$prodID);
                        exit;
                    }


                    // Allow certain file formats
                    if(checkNotImageType(pathinfo($target_file,PATHINFO_EXTENSION))){
                        $uploadOk = 0;
                        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
                        header("Refresh:0, URL=editProduct.php?prodID=".$prodID);
                        exit;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo "<script>alert('Sorry, your file was not uploaded.')</script>";
                        header("Refresh:0, URL=editProduct.php?prodID=".$prodID);
                        exit;
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                            $uploadComplete = 1;
                            $sql .= ", ImagePath = '".$target_file."'";
                        } else {
                            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
                            header("Refresh:0, URL=editProduct.php?prodID=".$prodID);
                            exit;
                        }
                    }
                    
                    
                }
                else {
                    $uploadComplete = 1;
                }
                
                $sql .= " WHERE ProductID = ".$prodID;
                
                if($uploadComplete){
                    // connect to db
                    $conn = mysql_connect("localhost", "root", "");

                    if(!$conn){
                        die("Connection failed: ". mysql_error());
                    }
                        // select db
                        mysql_select_db("csc321");
                    
                    

                // create sql query string
                mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'") or die('Error query: ' . mysql_error());

                    if($result = mysql_query($sql)){
                        echo "<script>alert('Edit Product Success.')</script>";
                    } else {
                        echo "<script>alert('Something went wrong. Try again.')</script>";
                        die("Error: ". mysql_error());
                        header("Refresh:0, URL=editProduct.php?prodID=".$prodID); 
                        exit;
                    }

                    mysql_close($conn);
                }

                header("Refresh:0, URL=editProduct.php?prodID=".$prodID); // link to product detail
            }
        
            function setUploadImage(){
                $file_extension = explode(".", $_FILES["fileToUpload"]["name"]);
                $target_file = "productImages/".$_POST["productName"]."_".time().".".end($file_extension);
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                if(isset($_POST["submit"])) {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if($check !== false) {
                        // echo "File is an image - " . $check["mime"] . ".";
                    } else {
                        return null;
                    }
                }
                
                return $target_file;
            }
        
            function checkFileIsExists($file_name){
                if (file_exists($file_name)) {
                    return true;
                }
                return false;
            }
        
            function checkNotImageType($imageFileType){
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                    return true;
                }
                return false;
            }
        ?>
    
    </body>

</html>