<div class="row header" style="box-shadow: 0px 0px 5px #888;">
         <div class="col-md-3 logo">
            <a class="navbar-brand" href="index.php">
            <img alt="Brand" src="image/logo2.png" width="200">
            </a>
         </div>
         
            <?php 
             $welcome = "Hello, "; 
             if(!isset($_SESSION["user"])){
                 $welcome .= "GUESS";
             } else {
                 $welcome .= $_SESSION["user"];
             }
             ?>
             <?php if(isset($_SESSION["sellerID"])): ?>
            <div class="col-md-6 btn-log col-md-offset-3">
                <?php echo $welcome; ?>
                
             <a href="productManager.php" class="btn btn-outline btn-default">Manage Product</a>
             
             <button type="submit" class="btn btn-outline btn-default" data-toggle="modal" data-target="#exampleModal-createAccount" data-whatever="createaccount">Create New Seller</button>
             
             <a href="updateOrderStatus.php" class="btn btn-outline btn-default">Order Status</a>
             
             <a href="logout.php" class="btn btn-outline btn-default" >LOG OUT</a>
             
             <?php elseif(isset($_SESSION["custID"])): ?>
                
            <div class="col-md-3 btn-log col-md-offset-6">
                <?php echo $welcome; ?>
             
             <a href="customerProfile.php" class="btn btn-outline btn-default">Profile</a>
             
             <a href="logout.php" class="btn btn-outline btn-default" >LOG OUT</a>
             
             <?php else: ?>
                
            <div class="col-md-3 btn-log col-md-offset-6">
                <?php echo $welcome; ?>
             
            <button type="submit" class="btn btn-outline btn-default" data-toggle="modal" data-target="#exampleModal-signup" data-whatever="signup">SIGN UP</button>
             
             <button type="submit" class="btn btn-outline btn-default" data-toggle="modal" data-target="#exampleModal-login" data-whatever="login">LOG IN</button>
             
             <?php endif ?>
             
            
         </div>
      </div>