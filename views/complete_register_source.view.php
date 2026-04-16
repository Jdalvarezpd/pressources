

<div class="container" style="margin-top: 2%;">

  <div class="row" style="margin-bottom: 2%;"> 
        <h3>Register as a Source</h3>
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
        <label for="inputAddress2" class="col-form-label">Industry<a style="color: red"><?php echo($needed); ?></a></label>
          <div class="form-row">
            <div class="col-md-6">
              <select id="inputState" class="form-control" name="indone">
                <option selected>-</option>
                 <!--CICLO PARA TRAER LOS IDIOMAS DE LA BASE DE DATOS-->
                <?php foreach($professions as $prof): ?>
                    <option value="<?php echo $prof['id_industry']; ?>"><?php echo $prof['name_industry']; ?></option>
                <?php endforeach; ?>

              </select>
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" id="" name="detailone" placeholder="Profession...">
            </div>

        </div>

        <br>

      </div>

      <div class="form-group box rounded">     
        <label for="inputAddress2" class="col-form-label">I'm a source for</label>
          <div class="form-row">
            <div class="col-md-7">
              <select id="inputState" class="form-control" name="areaone">
                <option selected>-</option>
                <!--CICLO PARA TRAER LAS PROFESIONES DE LA BASE DE DATOS-->
                <?php foreach($areas as $area): ?>
                    <option value="<?php echo $area['id_area']; ?>"><?php echo $area['name_area']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
        <br>
        <div class="form-row">
            <div class="col-md-7">
              <select id="inputState" class="form-control" name="areatwo">
                <option selected>-</option>
                <!--CICLO PARA TRAER LAS PROFESIONES DE LA BASE DE DATOS-->
                <?php foreach($areas as $area): ?>
                    <option value="<?php echo $area['id_area']; ?>"><?php echo $area['name_area']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
      </div>

      <br>

      <button type="submit" class="btn btn-primary" style="margin-top: 5%;">Complete</button>
    </form>

</div>
<br>
<br>



<?php require 'views/footer.php'; ?>