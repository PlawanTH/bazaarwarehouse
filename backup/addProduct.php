<!DOCTYPE html>
<?php
    session_start();

    // web page permission
    /*if(!isset($_SESSION["sellerID"])){
        header("Location: index.php");
        exit;
    }*/

?>

<html>

    <body>
        
        <form method="post" enctype="multipart/form-data">
            Product Name: <input type="text" name="productName" required /><br/>
            Product Detail: <textarea name="productDetail" maxlength="255" required></textarea><br/>
            Category: <input type="text" name="category" required /><br/>
            Price: <input type="number" name="price" min="0" step="any" required  /><br/>
            Amount: <input type="number" name="amount" min="0" required  /><br/>
            Image: <input type="file" name="fileToUpload" accept="image/*" required /> 
            <input type="submit" name="submit" value="Add Product" /><br/>
        </form>
        
        <?php
        
            if(isset($_POST["submit"])){
                if(!empty($_POST)){
                    foreach($_POST as $value){
                        if(empty($value)){
                            echo "<script>alert('Invalid input. Try again.')</script>";
                            header("Refresh:0, URL=addProduct.php");
                            exit;
                        }
                    }
                }
                
                $uploadOk = 1;
                $uploadComplete = 0;
                $target_file = setUploadImage();
                if($target_file == null){
                    echo "<script>alert('File is not an image.')</script>";
                    $uploadOk = 0;
                    header("Refresh:0, URL=addProduct.php");
                    exit;
                }
                
                
                // Check if file already exists
                if(checkFileIsExists($target_file)){
                    $uploadOk = 0;
                    echo "<script>alert('Sorry, file already exists.')</script>";
                    header("Refresh:0, URL=addProduct.php");
                    exit;
                }

                
                // Allow certain file formats
                if(checkNotImageType(pathinfo($target_file,PATHINFO_EXTENSION))){
                    $uploadOk = 0;
                    echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
                    header("Refresh:0, URL=addProduct.php");
                    exit;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "<script>alert('Sorry, your file was not uploaded.')</script>";
                    header("Refresh:0, URL=addProduct.php");
                    exit;
                // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                        $uploadComplete = 1;
                    } else {
                        echo "<script>alert('Sorry, there was an error uploading your file. /nError: ".$_FILES["fileToUpload"]["error"]."')</script>";
                        header("Refresh:0, URL=addProduct.php");
                        exit;
                    }
                }
                
                if($uploadComplete){
                    // connect to db
                    $conn = mysql_connect("localhost", "root", "");

                    if(!$conn){
                        die("Connection failed: ". mysql_error());
                    }
                        // select db
                        mysql_select_db("csc321");

                        // create sql query string
                    $sql = "INSERT INTO Product (ProductName, ProductDetail, Category, ImagePath, Amount, Price) VALUES('"
                        .$_POST["productName"]."','"
                        .$_POST["productDetail"]."','"
                        .$_POST["category"]."','"
                        .$target_file."',"
                        .$_POST["amount"].","
                        .$_POST["price"]
                        .")";

                    if($result = mysql_query($sql)){
                        echo "<script>alert('Add Product Success.')</script>";
                    } else {
                        echo "<script>alert('Something went wrong. Try again.')</script>";
                        die("Error: ". mysql_error());
                        header("Refresh:0, URL=addProduct.php");
                        exit;
                    }

                    mysql_close($conn);

                    header("Refresh:0, URL=addProduct.php");
                }
            }
        
            function setUploadImage(){
                $file_extension = explode(".", $_FILES["fileToUpload"]["name"]);
                $target_file = "productImages/".$_POST["productName"]."_".time().".".end($file_extension);
                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                // Check if image file is a actual image or fake image
                
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    // echo "File is an image - " . $check["mime"] . ".";
                } else {
                    return null;
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