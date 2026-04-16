<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/bootstrap.min.css">
  </head>
  <body>

    <div class="container-fluid d-flex justify-content-center fondo_inicial">

        <div class="card" style="width: 20rem; margin-top: 10em;">
          <div class="card-body">
            <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email" style="margin-bottom: 1em;" required autofocus>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Continue</button>
            </form><!-- /form -->
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