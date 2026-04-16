  <style>
    body{
     background: 
     linear-gradient(
     rgba(0,0,0,0.2), 
     rgba(0,0,0,0.2)), 
     url("images/urban-compressor.jpg") #49d3a6;

    background-size: cover;
    padding-top: 0;
    padding-left: 0;
    padding-right: 0;
    padding-bottom: 0em; 
    margin: 0; 
    }
  </style>

    <div class="container-fluid d-flex justify-content-center">
        <div class="card login_box">
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" required autofocus>
                <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Login</button>
            </form><!-- /form -->
              <div class="forgot_pass">
              <a class="primary-text" href="resetpassword.php">Forgot your password?</a>
              </div>
            <?php if(!empty($errores)): ?>

                <div class="row">
                  <div class="col-12">
                      <div class="alert alert-danger" role="alert" style="margin-top: 1em;">
                         <?php echo $errores; ?>
                      </div>
                    </div>
                  </div>

               <?php endif; ?>
          </div>
        </div>
    </div><!-- /container -->
    
    <?php require 'views/footer.php'; ?>