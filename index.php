<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    
    <head>

        <?php 
        include("htmlheader.php");
        ?>
        
    </head>

    <body>
        
        <?php
        
            $login = "";

            if(isset($_SESSION["user"])){
                $login = "LOG OUT";
            }
            else {
                $login = "LOG IN";
            }
        
            include("menuheader.php");
            include("modal.php");

        ?>
            
        <div class="row">
         <div class="col-xs-12 tab-menu">
            <a class="sale" href="#">
            <img alt="Brand" src="image/promotion.jpg" width="800">
            </a>
         </div>
      </div>
        
        <br/>
        <div style="margin:auto; text-align:center; padding: 20px 0">
            <form method="post">
                Search: <input type="text" name="keyword" /> 
                Category: <input type="text" name="category" />
                <input type="submit" name="submit" />
            </form>
        </div>
        <?php //include("showProductList.php"); ?>
        <?php include("productListTable.php"); ?>
        <?php include("footer.php"); ?>

        
    </body>

</html>