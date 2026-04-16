   <?php if(!empty($errores)): ?>

    <div class="row">
      <div class="col-12">
          <div class="alert alert-danger" role="alert">
             <?php echo $errores; ?>
          </div>
        </div>
      </div>

   <?php endif; ?> 


    <form method="post" enctype="multipart/form-data" calss="form-group" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

    <div style="margin-top: 1%; margin-bottom: 2%; padding-top: 2%; padding-bottom: 3%; padding-left: 5%; border: 2px solid #e8e8e8;" class="container rounded bg-light">

        <div class="row" style="margin-bottom: 2em;">
            <div class="col-6">
                <h4 class="" style="font-weight: bold; color: #3A99D9;"><?php echo $user_type; ?></h4>
            </div>
            <div class="col-6" style="text-align: right;">
                <input class="btn btn-primary" type="submit" value="Save Changes" style="background: #3A99D9; color: #fff; margin-right: 1em;">
            </div>
        </div>

    	<div class="row" style="margin-bottom: 2em;">
    		<div class="col-md-3">
    			<img class="img-thumbnail" style="max-height: 15em; width: 100%;" src="<?php echo RUTA . "/images/users/" . $user_image; ?>">
                <input type="file" name="thumb" value="Put">
                <input type="hidden" name="thumb_saved" value="<?php echo $user_image; ?>">
    		</div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Write something about yourself</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="desc"><?php if(isset($desc)){ echo $desc;}else{ echo $user_description; } ?></textarea>
                </div>
            </div>
    	</div>
        
        <div class="row">
            <!--INDUSTRIAS-->
            <div class="col-md-6">
              <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ ?>
                <p style="color: #111111; font-weight: bold;">Industries</p>
                <?php } ?>
                  
                <?php foreach($ind_name as $i): ?>
                    <p style="font-size: 0.8em; color: #757575; border-bottom: 2px solid; border-bottom-color: rgba(117, 117, 117, 0.3);"><?php echo $i[0][1]; ?>  <a class="text-danger" href="admin/delete_industry.php?id=<?php echo $i[0][0]; ?>">Delete</a></p>    
                <?php endforeach; ?>
                <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ if(count($ind_name)<=2){ ?>
                <a href="" data-toggle="modal" data-target="#modal_ind" style="font-size: 0.8em; " class="text-primary">Add +</a>
                <?php } }?>

            </div>


            <div class="col-md-6" style="margin-bottom: 2em;">
                <p style="font-weight: bold;">Languages</p>
                <p style="font-size: 0.8em; color: #757575;">
                    <?php foreach($lang_name as $i): ?>
                    <?php echo $i[0][1]; ?>
                    <a class="text-danger" href="admin/delete_language.php?id=<?php echo $i[0][0]; ?>">Delete</a>
                    <?php endforeach; ?>
                </p>

                <?php if(count($lang_name)<=4){ ?>
                <a href="" data-toggle="modal" data-target="#modal_lang" style="font-size: 0.8em;" class="text-primary">Add +</a>
                <?php } ?>
            </div>


        <!--AREAS-->
        <div class="col-md-6">
            <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ ?>
            <p style="color: #111111; font-weight: bold;">Ask me about</p>
            <?php } ?>
            <?php foreach($area_name as $i): ?>
                 <p style="font-size: 0.8em; color: #757575; border-bottom: 2px solid; border-bottom-color: rgba(117, 117, 117, 0.3);"><?php echo $i[0][1]; ?>  <a class="text-danger" href="admin/delete_area.php?id=<?php echo $i[0][0]; ?>">Delete</a></p>
            <?php endforeach; ?>

            <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ if(count($area_name)<=10){ ?>
            <a href="" data-toggle="modal" data-target="#exampleModal" style="font-size: 0.8em;" class="text-primary">Add +</a>
            <?php } }?>

            </div>

        </div>

    <?php if($user_data['type'] != 'JOURNALIST'){ ?>
            <div class="col-md-12 upspace">
              <div class="form-group">
                <label class="form-check-label" style="font-family: Arial; font-weight: bold;" >
                  <?php if($user_data['fullname_quote'] == "no"){ ?>
                    <input class="form-check-input" type="checkbox" name="quote" checked="yes">
                    I might ask not to quote my full name.
                    <?php }else{ ?>
                    <input class="form-check-input" type="checkbox" name="quote">
                    I might ask not to quote my full name.
                    <?php } ?>
                </label>
              </div>
          </div>
    <?php } ?>

    </div>

    </form>


    <div style="margin-bottom: 2%; padding-top: 2%; padding-bottom: 3%; padding-left: 5%; border: 2px solid #e8e8e8;" class="container rounded bg-light">
      
      <div class="col-12">
        <form method="post" calss="form-group" action="admin/save_city.php">
          
          <div class="row" style="margin-bottom: 2em;">
            <div class="col-6">
              <p style="font-size: 1.3em;">Update your City of Origin or Residence</p>
            </div>
            <div class="col-6" style="text-align: right;">
                <input class="btn btn-primary" type="submit" value="Save Changes" style="background: #3A99D9; color: #fff; margin-right: 1em;">
            </div>
        </div>
        
        <div class="form-row rounded">
          <div class="form-group col-md-6">
            <label for="inputState" class="col-form-label">City of Origin</label>
            <input type="text" class="form-control" id="cityo" name="origin_city" placeholder="-" value="">
            <p style="color: #a5a5a5;"><?php echo $user_data[17]; ?></p>
          </div>  

          <div class="form-group col-md-6">
            <label for="inputState" class="col-form-label">City of Residence</label>
            <input type="text" class="form-control" id="cityr" name="residence_city" placeholder="-" value="">
            <p style="color: #a5a5a5;"><?php echo $user_data[18]; ?></p>
          </div>
        </div>

        <input type="hidden" name="origin_city_hidden" id="origin_city_hidden" value="">
        <input type="hidden" name="origin_country_hidden" id="origin_country_hidden" value="">

        <input type="hidden" name="residence_city_hidden" id="residence_city_hidden" value="">
        <input type="hidden" name="residence_country_hidden" id="residence_country_hidden" value="">

        <input type="hidden" name="place_origin" id="place_origin" value="">
        <input type="hidden" name="place_residence" id="place_residence" value="">

      </form>
        
      </div>
      
    </div>

    <div style="margin-bottom: 10%; padding-top: 2%; padding-bottom: 3%; padding-left: 5%; border: 2px solid #e8e8e8;" class="container rounded bg-light">
      
      <div class="col-12">
        <form method="post" calss="form-group" action="admin/save_link.php">
          
          <div class="row" style="margin-bottom: 2em;">
            <div class="col-6">
              <p style="font-size: 1.3em;">Update your Article Link</p>
            </div>
            <div class="col-6" style="text-align: right;">
                <input class="btn btn-primary" type="submit" value="Save Changes" style="background: #3A99D9; color: #fff; margin-right: 1em;">
            </div>
        </div>
        
        <div class="form-row rounded">
          <div class="form-group col-md-6">
            <label for="inputState" class="col-form-label">Article Link</label>
            <input type="text" class="form-control" id="cityo" name="journalink" placeholder="-" value="<?php echo  $user_data[21]; ?>">
          </div>  
        </div>

      </form>
        
      </div>
      
    </div>

    <!-- Modal -->
        <form method="post" action="admin/save_area.php">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <select id="inputState" class="form-control" name="area_new">
                    <?php foreach($areas_of_exp as $area): ?>
                        <option value="<?php echo $area['id_area']; ?>"><?php echo $area['name_area']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <input type="hidden" name="id_user" value="<?php echo $user_id[0][0]; ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        </form>


        <!-- Modal Industries -->
        <form method="post" action="admin/save_industry.php">
        <div class="modal fade" id="modal_ind" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new Industry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <select id="inputState" class="form-control" name="ind_new">
                    <?php foreach($industrias_usuario as $prof): ?>
                        <option value="<?php echo $prof['id_industry']; ?>"><?php echo $prof['name_industry']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <input type="text" style="margin-top: 1em;" class="form-control" name="detail_prof" placeholder="Profession...">

                  <input type="hidden" name="id_user" value="<?php echo $user_id[0][0]; ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        </form>
        
        <!--Delete industries-->
        <form method="post" action="admin/delete_industry.php">
        <div class="modal fade" id="modal_ind_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sure you want to delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <input type="hidden" name="id_user" value="<?php echo $user_id[0][0]; ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete</button>
              </div>
            </div>
          </div>
        </div>
        </form>



        <!-- Modal languages -->
        <form method="post" action="admin/save_language.php">
        <div class="modal fade" id="modal_lang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new Language</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="lang_new">
                    <?php foreach($lenguajes_usuario as $lang): ?>
                      <option value="<?php echo $lang['id_language']; ?>"><?php echo $lang['name_language']; ?></option>
                    <?php endforeach; ?>

                  </select>

                  <input type="hidden" name="id_user" value="<?php echo $user_id[0][0]; ?>">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
        </form>

<?php require 'views/footer.php'; ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBccCadgdMhaLb9QVLFcbCksmSUj870H4c&libraries=places&language=en"></script>

<script>
      var input = document.getElementById('cityo');
      var input2 = document.getElementById('cityr');

      var autocomplete = new google.maps.places.Autocomplete(input,{types: ['(cities)']});
      var autocomplete2 = new google.maps.places.Autocomplete(input2,{types: ['(cities)']});

      google.maps.event.addListener(autocomplete, 'place_changed', function(){
        
      var place = autocomplete.getPlace();
      
       //ciudad
      //console.log(place['name']);

      //pais
      var country = place['address_components'].pop();
      //console.log(country['long_name']);

      document.getElementById('origin_city_hidden').value = place['name'];
      document.getElementById('origin_country_hidden').value = country['long_name'];

      document.getElementById('place_origin').value = place['formatted_address'] + ", " + country['long_name'];

      });

      ////////////////////////////ciudad 2////////////////////////////////////////////////
      google.maps.event.addListener(autocomplete2, 'place_changed', function(){
        
      var place2 = autocomplete2.getPlace();
      
       //ciudad
      //console.log(place2['name']);

      //pais
      var country = place2['address_components'].pop();
      //console.log(country['long_name']);

      document.getElementById('residence_city_hidden').value = place2['name'];
      document.getElementById('residence_country_hidden').value = country['long_name'];

      document.getElementById('place_residence').value = place2['formatted_address'] + ", " + country['long_name'];
      });

</script>