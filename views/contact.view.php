<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
	
	<div class="container-fluid">
      <div class="row justify-content-md-center">
        <div class="col-12" style="text-align: center; margin-top: 2em; margin-bottom: 2em;">
          <h3 class="primary-text">Write us a message</h3>
        </div>
      </div>
    </div>


   <div class="container">
      <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        
        <div class="row bspace">
          <div class="col-md-6">
            <label for="inputName" class="col-form-label">Name</label>
            <input type="text" class="form-control" id="name" name="nombre" placeholder="Name.." value="">
          </div>

          <div class="col-md-6">
            <label for="inputEmail4" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="inputEmail4" name="correo" placeholder="Email" value="">
          </div>
        </div>

        <div class="row bspace">
          <div class="col-md-12">
            <label for="inputEmail4" class="col-form-label">Message</label>
            
            <textarea rows="5" id="mensaje" name="mensaje" class="form-control formualrio-item mensaje" placeholder="Your Message..."></textarea>
          </div>
        </div>

        <?php if(!empty($errores)): ?>
			   <p class="text-danger"><?php echo $errores;; ?></p>
        <?php endif ?>

      <button type="submit" class="btn btn-primary" style="margin-top: 2%; margin-bottom: 10em;">Send</button>
    </form>

  </div>

  <?php require 'views/bottom.php'; ?>
  <?php require 'views/footer.php'; ?>