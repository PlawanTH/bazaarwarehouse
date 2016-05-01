<div class="modal fade" id="exampleModal-login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
         <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel">&nbsp;&nbsp;&nbsp;&nbsp;LOG IN</h4>
               </div>
               <div class="modal-body">
                  <form action="login.php" method="post">
                     <div class="input-group">
                        <span class="log-pic input-group-addon"><img src="image/user_log.png" width="23"></span>
                        <input type="text" class="form-control" id="login_user" placeholder="Username" required data-validation-required-message="Please Enter Username" name="user">
                     </div>
                     <br>
                     <div class="input-group">
                        <span class="log-pic input-group-addon"><img src="image/lock_log.png" width="23"></span>
                        <input type="password" class="form-control" id="login_pass" placeholder="Password" required data-validation-required-message="" name="pwd">
                     </div>
               <div class="modal-footer">
               <input class="log btn btn-primary" type="submit" value="LOG IN" name="submit"/>
               </div>
               </form>
            </div>
         </div>
      </div>
</div>
        
        <div class="modal fade" id="exampleModal-signup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SIGN UP</h4>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <form action="register.php" method="post" class="form-horizontal">
                        <div class="in more form-group">
                           <label for="firstname" class="col-sm-4 control-label">Firstname</label>
                           <div class="col-sm-8">
                              <input type="text" class="space form-control" id="firstname" required data-validation-required-message="" name="firstname">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="lastname" class="col-sm-4 control-label">Lastname</label>
                           <div class="col-sm-8">
                              <input type="text" class="space form-control" id="lastname" required data-validation-required-message="" name="lastname">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="address" class="col-sm-4 control-label">Address</label>
                           <div class="col-sm-8">
                              <textarea type="text" class="space form-control" id="address" name="address" required data-validation-required-message=""></textarea>
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="email" class="col-sm-4 control-label">Email</label>
                           <div class="col-sm-8">
                              <input type="email" class="space form-control" id="email" required data-validation-required-message="" name="email">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="tel" class="col-sm-4 control-label">Phone Number</label>
                           <div class="col-sm-8">
                              <input type="tel" class="space form-control" id="tel" required data-validation-required-message="" name="tel">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="user" class="col-sm-4 control-label">Username</label>
                           <div class="col-sm-8">
                              <input type="text" class="space form-control" id="user" required data-validation-required-message="" name="user">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="pass" class="col-sm-4 control-label">Password</label>
                           <div class="col-sm-8">
                              <input type="password" class="space form-control" id="pass" required data-validation-required-message="" name="pwd">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="con-pass" class="col-sm-4 control-label">Confirm Password</label>
                           <div class="col-sm-8">
                              <input type="password" class="space form-control" id="con-pass" required data-validation-required-message="" name="pwdconfirm">
                           </div>
                        </div>
               <div class="modal-footer">
               <input class="sig btn btn-primary" type="submit" value="SIGN UP" onclick="" name="submit"/>
               </div>
               </form>
            </div>
         </div>
      </div>
            </div>
</div>

<div class="modal fade" id="exampleModal-createAccount" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="exampleModalLabel">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create New Seller Account</h4>
               </div>
               <div class="modal-body">
                  <div class="row">
                     <form action="createSellerAccount.php" method="post" class="form-horizontal">
                        <div class="in more form-group">
                           <label for="user" class="col-sm-4 control-label">Username</label>
                           <div class="col-sm-8">
                              <input type="text" class="space form-control" id="user" required data-validation-required-message="" name="user">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="pass" class="col-sm-4 control-label">Password</label>
                           <div class="col-sm-8">
                              <input type="password" class="space form-control" id="pass" required data-validation-required-message="" name="pwd">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="con-pass" class="col-sm-4 control-label">Confirm Password</label>
                           <div class="col-sm-8">
                              <input type="password" class="space form-control" id="con-pass" required data-validation-required-message="" name="pwdConfirm">
                           </div>
                        </div>
                        <div class="in more form-group">
                           <label for="con-pass" class="col-sm-4 control-label">Current Seller's Password</label>
                           <div class="col-sm-8">
                              <input type="password" class="space form-control" id="con-pass" required data-validation-required-message="" name="pwdCurrent">
                           </div>
                        </div>
               <div class="modal-footer">
               <input class="sig btn btn-primary" type="submit" value="SIGN UP" onclick="" name="submit"/>
               </div>
               </form>
            </div>
         </div>
      </div>
            </div>
</div>