
<div class="col-md-12 search_bar">

           <div class="input-group input-group-lg">

<!--
              <div class="input-group-btn">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding-right: 10em;">Select an Industry</button>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li><a href="#">Separated link</a></li>
                </ul>
              </div>
              <span class="input-group-btn">
                <button class="btn btn-dark" type="button">Find Sources</button>
              </span>
-->

            <form class="form-inline navbar-form navbar-left" action="<?php echo RUTA; ?>/searchprofile.php" method="get">

                <div class="form-group">
                  <input type="text" style="height: 3.5em; width: 30em;" class="form-control" id="cityr" name="residence_city" onFocus="geolocate()" placeholder="City/Country" value="">
                </div>

                <select class="custom-select" name="busqueda" style="padding-right: 10em; height: 3.5em; width: 30em;">
                  <option selected>Select an Industry</option>
                  <?php foreach($industries as $ind): ?>
                        <option value="<?php echo $ind['id_industry']; ?>"><?php echo $ind['name_industry'];?></option>
                    <?php endforeach; ?>
                </select>

                <input type="hidden" name="residence_city_hidden" id="residence_city_hidden" value="">

                <button class="btn primary-colors" style="cursor: pointer; height: 3.5em; width: 10em;">Find Sources</button>
            </form>


            </div>

    </div>
  
    <?php if(!isset($users_found)){ ?>
      <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <img src="images/mapa2.svg" alt="">
        </div>
      </div>
    </div>
    <?php } ?>

    
<div class="container-fluid">

          <?php if(!empty($errores)): ?>

            <div class="row">
              <div class="col-6">
                  <div class="alert alert-danger" role="alert">
                     <?php echo $errores; ?>
                  </div>
                </div>
              </div>

           <?php endif; ?> 

    <div class="row d-flex justify-content-center">
        
        <?php if(isset($users_found)){ ?>
        <?php foreach($users_found as $user): ?>
        <div class="col-md-3 gmd gmd-2">
              <div>
                <img class="" style="border-radius: 5%; height: 7em; margin-bottom: 1em;" src="<?php if($user['img_route'] != ''){ echo RUTA . '/images/users/' . $user['img_route'];}else{ echo 'images/users/user.jpg'; } ?>" alt="">
              </div>
             <div>
                <p style="font-size: 1.2em;"><?php echo $user['name']; ?></p>
            </div>
            <div>
              <p style="color: #848484;">
                  <?php 
                    $ind = obtener_industrias_usuario($conexion, $user['id_user']);
                    for($i=0; $i<count($ind); $i++){
                      $ind_name = obtener_nombre_idustria($conexion, $ind[$i][0]);
                      //print_r($ind_name[0][1] . "<br>");
                    }
                    
                  ?>
                </p>
                <p style="color: #848484;"><?php if(!empty($user['name_industry'])){ echo $user['name_industry']; }?></p>
                <!--<p style="padding-bottom: 0.5em; color: #848484;"><?php echo $user['cityfield_residence'] . " - " . $user['countryfield_residence']; ?></p>-->
                <p style="padding-bottom: 0.5em; color: #848484;">
                  <?php echo eliminar_tildes($user['cityfield_residence']);?></p>
            </div>
            <div class="">
                <a href="userprofile.php?id= <?php echo $user['id_user']; ?>" class="btn primary-colors" style=" width: 100%; margin-bottom: 1em; padding-left: 3.5em; padding-right: 3.5em;">Connect</a>
            </div>
        </div>
        <?php endforeach; }?>
        </div>
</div>

<!--<div class="container">
  <div class="row">
    <div class="col 4">
      <?php echo count($users_found)-1?>
      <button class="btn primary-colors" style="height: 3.5em; width: 10em;">Load more</button>
    </div>
  </div>
</div>
-->
<?php require 'views/footer.php'; ?>

<!--pressources5-->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC89Nw9sD9NAd-zYAYYolQe30XljM6i3ME&libraries=places&language=en"></script>

<script>
  function geolocate() {
      var input = document.getElementById('cityr');

      var autocomplete = new google.maps.places.Autocomplete(input,{types: ['(regions)']});

      ////////////////////////////ciudad 2////////////////////////////////////////////////
      google.maps.event.addListener(autocomplete, 'place_changed', function(){
        
      var place = autocomplete.getPlace();
      
       //ciudad
      //console.log(place2['country-name']);
      console.log(place['address_components']);
      //console.log(place['address_components'].pop());
      //console.log(place['formatted_address']);

      console.log(place['formatted_address'] + ", " + place['address_components'].pop()['long_name']);

      //pais
      var country = place['address_components'].pop();
      //console.log(country['long_name']);
      //console.log(place2.address_components[3]['long_name']);

      document.getElementById('residence_city_hidden').value = place['name'];

      //ANTES
      //document.getElementById('residence_city_hidden').value = place2['name'];
      //document.getElementById('residence_country_hidden').value = country['long_name'];
      });
    }

</script>