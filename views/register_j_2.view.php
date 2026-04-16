<div class="form_container" style="padding-bottom: 3em;">
<div class="container rounded" style="background-color: #f2f2f2; margin-top: 2%; max-width: 65%;">

  <div class="row upspace bpspace">
    <div class="col-12" style="text-align: center;"> 
        <h3 class="secondary-text">Register as a Journalist</h3>
    </div>
  </div>

<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

      <div class="form-row rounded" style="padding-bottom: 1em;">

        <div class="form-group col-md-6">
            <label for="inputAddress2" class="col-form-label">Media Type</label>
            <select id="sector" class="form-control" name="sector" style="margin-bottom: 1em;">
                <option selected>-</option>
                <!--CICLO PARA TRAER LAS PROFESIONES DE LA BASE DE DATOS-->
                <?php foreach($roles as $rol): ?>
                    <option value="<?php echo $rol['id_sector']; ?>"><?php echo $rol['name_sector']; ?></option>
                <?php endforeach; ?>
            </select>
          </div>
          
          <div class="form-group col-md-6">
            <label for="inputAddress2" class="col-form-label">Position in the News Outlet</label>
            <select id="posnews" class="form-control" name="posnews">
                <option selected>-</option>
            </select>
          </div>

          <!--<div class="form-group col-md-6">
            <input type="text" class="form-control" id="detail" disabled="true" name="detail" placeholder="please specify..." value="">
          </div>-->

      </div>

      <div class="form-group rounded">
        <label for="inputAddress" class="col-form-label">News/Media Outlet</label>
        <input type="text" class="form-control" id="ins" name="newsinst" placeholder="News/Media Outlet..." value="">
      </div>

      <div class="form-row align-items-center rounded" style="margin-top: 2em;">
        <div class="col-auto">
          <label class="mr-sm-2" for="inlineFormCustomSelect">Spoken Languages</label>
          <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="langone">
            <option selected>...</option>
            <!--CICLO PARA TRAER LOS IDIOMAS DE LA BASE DE DATOS-->
            <?php foreach($languages as $lang): ?>
              <option value="<?php echo $lang['id_language']; ?>"><?php echo $lang['name_language']; ?></option>
            <?php endforeach; ?>

          </select>

          <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="langtwo">
            <option selected>...</option>
            <!--CICLO PARA TRAER LOS IDIOMAS DE LA BASE DE DATOS-->
            <?php foreach($languages as $lang): ?>
              <option value="<?php echo $lang['id_language']; ?>"><?php echo $lang['name_language']; ?></option>
            <?php endforeach; ?>
          </select>

          <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="langthree">
            <option selected>...</option>
            <!--CICLO PARA TRAER LOS IDIOMAS DE LA BASE DE DATOS-->
            <?php foreach($languages as $lang): ?>
              <option value="<?php echo $lang['id_language']; ?>"><?php echo $lang['name_language']; ?></option>
            <?php endforeach; ?>
          </select>

        </div>
      </div>

      <div class="form-group rounded" style="margin-top: 2em;">
        <label for="inputAddress" class="col-form-label">Please provide a link to a story featuring your byline or to any other reference to your position</label>
        <input type="text" class="form-control" id="ins" name="journalink" placeholder="http://www.example.com/article" value="">
      </div>

      <button type="submit" class="btn btn-primary" style="margin-top: 5%; margin-bottom: 4em;">Save</button>
</form>

</div>
</div>

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

         /* $('#posnews').change(function(){      
          if(document.getElementById("posnews").value = 51){
            document.getElementById("detail").disabled = false;
            console.log("aja");
            //$('#detail').removeAttr('disabled');
          }else{
            console.log("not");
          }
         
        });*/

        });
      });

      
      /*function habilitar(){
          var ot = document.getElementById("posnews");
          var dos = document.getElementById("detail");

          if(ot.value = "other"){
            dos.disabled = false;
          }else{
            dos.disabled = true;
          }
        }*/

        /*window.onload = function(){
          document.getElementById("posnews").onchange = function(){
            if(document.getElementById("posnews").value = 51){
              //console.log(document.getElementById("posnews").value);
            }
          }
        }*/
      
      

</script>