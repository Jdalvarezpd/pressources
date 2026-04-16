<div class="form_container" style="">

<div class="container rounded" style="max-width: 65%; background-color: #f2f2f2;">

  <div class="row upspace bpspace">
    <div class="col-12" style="text-align: center; margin-bottom: 2em;"> 
        <h3 class="primary-text">Register as a Journalist</h3>
    </div>
    <div class="col-12">
      <p>Do you work for a newspaper, a radio, a TV show anywhere in the world? Join Pressources to access a wide range of services crafted for you!</p> 
      <p>Sign up for free, use our search tool to find the area and the profiles you are interested in, and we will do the rest. Because something is happening in the world right now. We give you the best tools to report about it.</p>
    </div>
  </div>

<?php if(!empty($errores)): ?>

  <div class="row">
    <div class="col-12">
        <div class="alert alert-danger" role="alert">
           <?php echo $errores; ?>
        </div>
      </div>
    </div>

 <?php endif; ?>   

    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        
        <div class="row bspace">
          <div class="col-md-6">
            <label for="inputName" class="col-form-label">Name <a style="color: red"><?php echo($needed); ?></a></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name.." value="<?php if(!$enviado && isset($name)) echo $name ?>">
          </div>

          <div class="col-md-6">
            <label for="inputName" class="col-form-label">Last Name <a style="color: red"><?php echo($needed); ?></a></label>
          <input type="text" class="form-control" id="name" name="last" placeholder="Last Name.." value="<?php if(!$enviado && isset($last)) echo $last ?>">
          </div>
        </div>

        <div class="row bspace">
          <div class="col-md-6">
            <label for="inputEmail4" class="col-form-label">Email <a style="color: red"><?php echo($needed); ?></a></label>
            <input type="email" class="form-control" id="inputEmail4" name="mail" placeholder="Email" value="<?php if(!$enviado && isset($mail)) echo $mail ?>">
          </div>

          <div class="col-md-6">
            <label for="inputPassword4" class="col-form-label">Password<a style="color: red"><?php echo($needed); ?></a></label>
            <input type="password" class="form-control" id="inputPassword4" name="pass" placeholder="Password">
            <p style="color: red; margin-bottom: 0; font-size: 0.8em;">8 characters.</p>
          </div>

          <div class="col-md-6 bmspace">
            <label for="inputPassword4" class="col-form-label">Confirm Password<a style="color: red"><?php echo($needed); ?></a></label>
            <input type="password" class="form-control" id="inputPassword4" name="pass2" placeholder="Password">
          </div>
        </div>

        <div class="row bspace">
          <div class="col-12">
            <label class="form-check-label">
            <input class="form-check-input" type="checkbox" name="terms">I accept the <a href="<?php echo RUTA . "/ethics.php" ?>" target="_blank">Code of Ethics </a>and <a href="<?php echo RUTA . "/privacy.php" ?>" target="_blank">Terms and Conditions.</a>
            </label>
          </div>
        </div>

      <button type="submit" class="btn btn-primary" style="margin-top: 2em; margin-bottom: 3em;">Sign Up</button>
    </form>
</div>

<div class="container">
    <div class="row umspace" style="padding-bottom: 1em; text-align: center;">
      <div class="col-12">
        <a href="<?php echo RUTA . "/register_s.php" ?>">You are not a journalist? Register as a source</a>
      </div>
      <div class="col-12 bmspace">
        <a href="<?php echo RUTA . "/login.php" ?>">Already registered? Log in</a>
      </div>
    </div>
</div>
</div>
<?php require 'views/footer.php'; ?>