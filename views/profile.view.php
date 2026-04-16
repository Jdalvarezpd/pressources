    
    <div style="height: 8em; background: #232323;">
        <div class="container"> 
            <div class="row">   
                <p class="text-light" style="font-size: 2em; margin-top: 1.2em; text-transform: uppercase;"><?php echo $username . " " . $userlastname;?></p>
            </div>
        </div>
    </div>


    <div style="margin-top: 1%; margin-bottom: 10%; padding-bottom: 3%; padding-left: 5%; border: 2px solid #e8e8e8;" class="container rounded bg-light">

        <div class="row" style="margin-bottom: 2em;">
            <div class="col-6" style="background-color: #e8e8e8; padding-top: 0.5em;">
                <h4 class="" style="font-weight: bold; color: #3A99D9;"><?php echo $user_type; ?></h4>
            </div>
            <div class="col-6" style="text-align: right; padding-top: 0.5em;">
                <a href="<?php  echo RUTA . '/editprofile.php'; ?>" style="color: #111111; margin-right: 1em;">Edit Profile</a>
            </div>
        </div>
    	
        <div class="row">
            <!--FOTO-->	
            <div class="col-md-3 col-6">
                <div class="picture">
    			       <a class="" href="<?php echo RUTA . "/editprofile.php" ?>"><img class="profile_picture" src="<?php echo RUTA . "/images/users/" . $user_image; ?>"></a>
                 <div class="picture_text">
                   <p>Change Profile Picture</p>
                 </div>
               </div>
                <p style="font-weight: bold; margin-top: 1em;">
                <?php foreach($sector_name as $i): ?>
                <?php echo $i[0][0] . ' - '; ?>
                <?php endforeach; ?>

                <?php foreach($posnews_name as $i): ?>
                <?php echo $i[0]; ?>
                <?php endforeach; ?>
                </p> 
                <p><?php echo $newsoutlet[0][0]; ?></p>

                <?php if($user_type == "JOURNALIST" || $user_type == "JOURNALIST/SOURCE"){ if(count($sector_name)<=0){?>
                  <a href="" data-toggle="modal" data-target="#modal_sector" style="font-size: 0.8em;" class="text-primary">Add Your Position In News</a>
                <?php } }?>
    		    </div>

            <!--EMAIL-->
            <div class="col-md-3">
                <p>Email:</p>
                <p><?php echo $email; ?></p>
                <p><?php if(isset($age)){echo $age . " years";} ?></p>

                <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){?>
                <p style="font-size: 0.9em;">Origin: <?php echo $city_origin  . " - " . $country_origin; ?></p>
                <p style="font-size: 0.9em;">Residence: <?php echo $city_residence  . " - " . $country_residence; ?></p>
                <p><?php echo $company; ?></p>
                <?php } ?>
            </div>
        
            <!--ABOUT / IDIOMAS-->
            <div class="col-md-6" style="border-left: 1px solid #e8e8e8; margin-bottom: 2em;">
              <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ ?>
                <p style="font-weight: bold;">About Me</p>
                <p style="padding-right: 5%; margin-bottom: 2em;"><?php echo $user_description;?></p>
                <?php } ?>
                
                <p style="font-weight: bold;"><?php if(empty(!$lang)){echo "Languages";}?></p>
                <p style="font-size: 0.8em; color: #757575;">
                    <?php foreach($lang_name as $i): ?>
                    <?php echo $i[0][1]; ?>
                    <?php endforeach; ?>
                </p>
<!--
                <?php if(count($lang_name)<=4){ ?>
                <a href="" data-toggle="modal" data-target="#modal_lang" style="font-size: 0.8em;" class="text-primary">Add +</a>
                <?php } ?>
-->
            </div>

            <!--INDUSTRIAS-->
            <div class="col-md-6">
              <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ ?>
                <p style="color: #111111; font-weight: bold;">Industry</p>
                <?php } ?>

                <?php foreach($ind_name as $i): ?>
                    <p style="font-size: 0.8em; color: #757575; border-bottom: 2px solid; border-bottom-color: rgba(117, 117, 117, 0.3);"><?php echo $i[0][1]; ?></p>
                <?php endforeach; ?>

<!--
                <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ if(count($ind_name)<=2){ ?>
                <a href="" data-toggle="modal" data-target="#modal_ind" style="font-size: 0.8em; " class="text-primary">Add +</a>
                <?php } }?>
-->
            </div>
        
            <!--AREAS-->
            <div class="col-md-6">
              <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ ?>
                <p style="color: #111111; font-weight: bold;">I'm a source for</p>
                <?php } ?>
                <?php foreach($area_name as $i): ?>
                     <p style="font-size: 0.8em; color: #757575; border-bottom: 2px solid; border-bottom-color: rgba(117, 117, 117, 0.3);"><?php echo $i[0][1]; ?></p>
                <?php endforeach; ?>
<!--
                <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ if(count($area_name)<=2){ ?>
                <a href="" data-toggle="modal" data-target="#exampleModal" style="font-size: 0.8em;" class="text-primary">Add +</a>
                <?php } }?>
-->
            </div>

        </div>
  
        <div class="row">
        <div class="col-md-12">
               <?php if($user_type == "JOURNALIST"){ ?>
                    <a href="<?php echo RUTA . "/register_s_2.php" ?>" class="btn" style="background: #3A99D9; color: #fff; margin-top: 1em;">Sign up as source too</a>
               <?php } ?>
            </div>
        </div>  

        <div class="row">
          <div class="col-md-12">
              <?php if($user_type == "SOURCE" || $user_type == "JOURNALIST/SOURCE"){ ?>

                <?php if($user_data['fullname_quote']=="no"){ ?>
                  <p style="font-weight: bold;">I might ask not to quote my full name.</p>
                <?php }} ?>
          </div>

          <div class="col-md-12">
              <?php if($user_type == "JOURNALIST" || $user_type == "JOURNALIST/SOURCE"){ ?>

                <?php if($user_data['journalink']!=""){ ?>
                  <a href="<?php echo $user_data['journalink']; ?>" target="_blank"><?php echo 'Article link: '. $user_data['journalink']; ?></a>
                <?php }} ?>
          </div>

        </div>

        <!-- Modal Sectors for journalists -->
        <form method="post" action="admin/save_sector.php">
        <div class="modal fade" id="modal_sector" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new Sector</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                    <select id="sector" class="form-control" name="sector" style="margin-bottom: 1em;">
                        <option selected>-</option>
                        <!--CICLO PARA TRAER LAS PROFESIONES DE LA BASE DE DATOS-->
                        <?php foreach($roles as $rol): ?>
                            <option value="<?php echo $rol['id_sector']; ?>"><?php echo $rol['name_sector']; ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label for="inputAddress2" class="col-form-label">Position in the News Outlet</label>
                    <select id="posnews" class="form-control" name="posnews">
                        <option selected>-</option>
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
  

        <div class="modal fade" id="modal_welcome" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title primary-text" id="exampleModalLabel">¡WELCOME TO PRESSOURCES!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>You can complete your profile information now or do it later.</p>
                <p>Remember that your information can help all the journalist to find you and let you tell your story.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn primary-colors" data-dismiss="modal">Go</button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="modal_welcome_journalist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title primary-text" id="exampleModalLabel">¡WELCOME TO PRESSOURCES!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>Now you can start looking for story tellers.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn primary-colors" data-dismiss="modal">Go</button>
              </div>
            </div>
          </div>
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

        });
     
      });

</script>



<?php
//MODAL Modal WELCOME 
      if(isset($_GET['w'])){
        if($_GET['w'] == 1){
          ?>
            <script>
              $("#modal_welcome").modal("show");
            </script>
          <?php
        }

        if($_GET['w'] == 2){
          ?>
            <script>
              $("#modal_welcome_journalist").modal("show");
            </script>
          <?php
        }
      }
?>