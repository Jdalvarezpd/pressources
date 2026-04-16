
  <div class="container" style="margin-top: 2%;">
    <div class="row" style="margin-bottom: 2%;"> 
        <h3>Register as a Journalist</h3>
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

      <div class="form-group box rounded">
        <label for="inputAddress" class="col-form-label">News outlet/Institution</label>
        <input type="text" class="form-control" id="ins" name="newsinst" placeholder="News outlet/Institution..." value="<?php if(!$enviado && isset($newsinst)) echo $newsinst ?>">
      </div>


      <div class="form-row box rounded" style="padding-bottom: 2em;">

        <div class="form-group col-md-6">
            <label for="inputAddress2" class="col-form-label">Sector<a style="color: red;"><?php echo($needed); ?></a></label>
            <select id="sector" class="form-control" name="sector" style="margin-bottom: 1em;">
                <option selected>-</option>
                <!--CICLO PARA TRAER LAS PROFESIONES DE LA BASE DE DATOS-->
                <?php foreach($roles as $rol): ?>
                    <option value="<?php echo $rol['id_sector']; ?>"><?php echo $rol['name_sector']; ?></option>
                <?php endforeach; ?>
            </select>
          </div>
          
          <div class="form-group col-md-6">
            <label for="inputAddress2" class="col-form-label">Position in the News Outlet<a style="color: red;"><?php echo($needed); ?></a></label>
            <select id="posnews" class="form-control" name="posnews">
                <option selected>-</option>
            </select>
          </div>

      </div>


      <div class="form-check mb-2 mb-sm-0">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="terms">I accept the <a href="<?php echo RUTA . "/privacy.php" ?>" target="_blank">Terms and Conditions</a>
        </label>
      </div>

      <button type="submit" class="btn btn-primary" style="margin-top: 5%;">Sign in</button>
    </form>


  
  <div class="row" style="margin-top: 2%;"> 
          <a href="<?php echo RUTA . "/source.php" ?>">Go to see Source description</a>
    </div>

  </div>

    

<br>
<br> 
    

<?php require 'views/footer.php'; ?>


<script>
      $(document).ready(function(){

        $('#sector').change(function(){

          var sector_id = $(this).val();

          $.ajax({
            url:"<?php echo RUTA . "/fetch_posnews.php" ?>",
            method: "POST",
            data:{idsector:sector_id},
            dataType:"text",
            success:function(data)
            {
              $('#posnews').html(data);
            }

          });

        });
     
      });

</script>