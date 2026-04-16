    <div class="container-fluid fondo_inicial">
      <div class="row justify-content-md-center">
        <div class="col-12">
          <h2 class="slogan">Where the best journalists find the best voices</h2>
        </div>
      </div>

      <?php if(!isset($_SESSION['user'])){ ?>
        <div class="row justify-content-center landing-icons">
            <div class="col-md-3 col-6 landing_shadow" id="journ" onclick="location.href='<?php echo RUTA . "/register_j.php" ?>';">
              <a href="<?php echo RUTA . "/register_j.php" ?>"><img src="images/journalist_sblue.svg"></a>
              <p class="description-icon">Looking for a story?</p>
              <p class="description-icon">Sign up as a</p>
              <p class="title-icon">JOURNALIST</p>        
            </div> 

            <div class="col-md-3 col-6 landing_shadow" id="journ" onclick="location.href='<?php echo RUTA . "/register_s.php" ?>';">
              <a href="<?php echo RUTA . "/register_s.php" ?>"><img src="images/source_sblue.svg"></a>
              <p class="description-icon">Looking to tell your story?</p>
              <p class="description-icon">Sign up as a</p>
              <p class="title-icon">SOURCE</p>
              
          </div>
        </div>

        <div class="row justify-content-md-center already">
          <div class="col-12">
            <a href="login.php"><p>Already registered? Log in</p></a>
          </div>
        </div>
      <?php }else{ if($typeuser[0]["type"] == "JOURNALIST" || $typeuser[0]["type"] == "JOURNALIST/SOURCE"){ ?>
        <div class="row justify-content-md-center">
          <div class="col-md-10 rounded" style="text-align: center; color: #fff; margin-top: 1em; background-color: rgba(0,0,0,.8); padding: 3em;">
            <p>Thank you for joining us, you can now search out database.</p>
            <p>Here are sources who already registered in the system</p>
            <div class="row justify-content-md-center already">
          <?php foreach($users_index as $user): ?>
              <div class="col-md-3 gmd gmd-2">
                   <div>
                      <p style="color: #000; font-size: 1em;"><?php echo $user['name']; ?></p>
                  </div>
                  <div>
                    <p style="font-size: .8em; color: #848484;">
                        <?php 
                          $ind = obtener_industrias_usuario($conexion, $user['id_user']);
                          for($i=0; $i<count($ind); $i++){
                            $ind_name = obtener_nombre_idustria($conexion, $ind[$i][0]);
                            print_r($ind_name[0][1] . "<br>");
                          }
                          
                        ?>
                      </p>
                      <p style="font-size: .8em; color: #848484;"><?php if(!empty($user['name_industry'])){ echo $user['name_industry']; }?></p>
                      <!--<p style="padding-bottom: 0.5em; color: #848484;"><?php echo $user['cityfield_residence'] . " - " . $user['countryfield_residence']; ?></p>-->
                      <p style="font-size: .8em; padding-bottom: 0.5em; color: #848484;"><?php echo $user['cityfield_residence'] . " - " . $user['countryfield_residence']; ?></p>
                  </div>
                  <div class="">
                      <a href="userprofile.php?id= <?php echo $user['id_user']; ?>" class="btn primary-colors" style="padding-left: 3.5em; padding-right: 3.5em;">Connect</a>
                  </div>
              </div>
            <?php endforeach; ?>
        </div>
            <a href="searchprofile.php">Go to Search</a>
          </div>
        </div>

      <?php }else{ ?>
        <div class="row justify-content-md-center" style="padding-bottom: 8em;">
          <div class="col-md-6 rounded" style="text-align: center; color: #fff; margin-top: 3em; background-color: rgba(0,0,0,.8); padding: 3em;">
            <p>Thank you for joining us!</p>
            <p>Don´t forget to complete your profile, to let the journalists know how much you have to offer as a source.</p>
            <a href="editprofile.php">Complete your profile</a>
          </div>
        </div>
      <?php }} ?>

    </div>

    <div class="container-fluid" style="padding-top: 3em; padding-bottom: 5em;">
      <div class="row" style="text-align: center; margin-bottom: 3em;">
        <div class="col-12">
      <h3 class="secondary-text" style="font-family: 'Roboto-Slab-Regular';">HUMANS OF PRESSOURCES</h3>
      </div>
      </div>
    <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
        <div class="carousel-inner row w-100 mx-auto" role="listbox">
            <div class="carousel-item col-md-3  active">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=5" title="image 1" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/simon.jpg?h=5" alt="slide 1">
                      </a>
                      <a href="humans?h=5" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Simon</p></a>
                    
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=1" title="image 3" style="text-align: center;">
                     <img class="img-fluid mx-auto d-block" src="images/jhon.jpg?h=1" alt="slide 2">
                     </a>
                     <a href="humans?h=1" style="text-align: center;"><p style="margin-top: 1em; color: #000;">John</p></a>
                    
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=2" title="image 4" style="text-align: center;">
                     <img class="img-fluid mx-auto d-block" src="images/josephine.jpg?h=2" alt="slide 3">
                     </a>
                     <a href="humans?h=2" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Josephine</p></a>
                    
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
                <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=4" title="image 5" style="text-align: center;">
                     <img class="img-fluid mx-auto d-block" src="images/mariantonia.jpg?h=4" alt="slide 4">
                     </a>
                     <a href="humans?h=4" style="text-align: center;"><p style="margin-top: 1em; color: #000;">María Antónia</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
              <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=3" title="image 6" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/menachem.jpg?h=3" alt="slide 5">
                      </a>
                      <a href="humans?h=3" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Menachem</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=0" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/esteban.jpg?h=0" alt="slide 6">
                      </a>
                      <a href="humans?h=0" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Esteban</p></a>
                    
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=8" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/julio.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=8" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Julio</p></a>
                    
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=9" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/milcent.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=9" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Milcent</p></a>
                    
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=6" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/adam.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=6" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Adam</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=7" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/alessia.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=7" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Alessia</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=10" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/daniel.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=10" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Daniel</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=11" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/brenda.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=11" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Brenda</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=12" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/emanuela.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=12" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Emanuela</p></a>
                  </div>
                </div>
            </div>

            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=13" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/jd.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=13" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Juan David</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=14" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/galina.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=14" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Galya</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=15" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/tal.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=15" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Tal</p></a>
                  </div>
                </div>
            </div>
            <div class="carousel-item col-md-3 ">
               <div class="panel panel-default">
                  <div class="panel-thumbnail">
                    <a href="humans?h=16" title="image 7" style="text-align: center;">
                      <img class="img-fluid mx-auto d-block" src="images/pablo.jpg" alt="slide 6">
                      </a>
                      <a href="humans?h=16" style="text-align: center;"><p style="margin-top: 1em; color: #000;">Pablo</p></a>
                  </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next text-faded" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

    <!--ONLINE NEWS ASSISTANT
    <?php if(isset($_SESSION['user'])){ ?>
    <?php if($typeuser[0]["type"] == "JOURNALIST" || $typeuser[0]["type"] == "JOURNALIST/SOURCE"){ ?>
    <div class="container-fluid" style="background-color: #f2f2f2;">
      <br>
      <h3 class="primary-text assistant_title">Online News Assistant</h3>
      <div class="row d-flex justify-content-center">
        <div class="col-md-4">
          <img src="images/handstyping2.jpg" class="assistant_image">
        </div>
        <div class="col-md-4">
          <p>Are you working on a story? Would like some help with the preparatory work? Are you researching numbers, sources, explanations, relevant materials, quotes, and/or translations? Pressources can provide you with all of these and more.</p>
          <p>We currently provide services for stories related to Italy, Israel, and Colombia and are always expanding our coverage. Expect Pressources to arrive in your country soon!</p>
            <p>Questions? Comments? Suggestions? Drop us a line at <a href="<?php echo RUTA . "/contact" ?>">info@pressources.com</a> to find out more.</p>
        </div>
      </div>

      <div class="row as_flags">
        <div class="col-md-12">
          <a href="<?php echo RUTA . "/colombianewsast.php"?>"><img src="images/colombia3.png"></a>
          <a href="<?php echo RUTA . "/israelnewsast.php"?>"><img src="images/israel3.png"></a>
          <a href="<?php echo RUTA . "/italynewsast.php"?>"><img src="images/italy3.png"></a>
        </div>
      </div>
    </div>
    <?php }else{ ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 upspace bmspace">
            <h6>Any feedback or question? Send us a message.</h6>
            <div class="container" style="margin-top: 2em;">
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
          </div>
        </div>
      </div>
    <?php }}else{ ?>
      <div class="container-fluid" style="background-color: #f2f2f2;">
      <br>
      <h3 class="primary-text assistant_title">Online News Assistant</h3>
      <div class="row d-flex justify-content-center">
        <div class="col-md-4">
          <img src="images/handstyping2.jpg" class="assistant_image">
        </div>
        <div class="col-md-4">
          <p>Are you working on a story? Would like some help with the preparatory work? Are you researching numbers, sources, explanations, relevant materials, quotes, and/or translations? Pressources can provide you with all of these and more.</p>
          <p>We currently provide services for stories related to Italy, Israel, and Colombia and are always expanding our coverage. Expect Pressources to arrive in your country soon!</p>
            <p>Questions? Comments? Suggestions? Drop us a line at <a href="<?php echo RUTA . "/contact" ?>">info@pressources.com</a> to find out more.</p>
        </div>
      </div>

      <div class="row as_flags">
        <div class="col-md-12">
          <a href="<?php echo RUTA . "/colombianewsast.php"?>"><img src="images/colombia3.png"></a>
          <a href="<?php echo RUTA . "/israelnewsast.php"?>"><img src="images/israel3.png"></a>
          <a href="<?php echo RUTA . "/italynewsast.php"?>"><img src="images/italy3.png"></a>
        </div>
      </div>
    </div>
    <?php } ?>

-->

<div class="container-fluid" style="background: 
     linear-gradient(
     rgba(0,0,0,0.7), 
     rgba(0,0,0,0.7)), 
     url('images/map.jpg') #49d3a6;

    background-size: cover;
    padding-top: 0;
    padding-left: 0;
    padding-right: 0;
    padding-bottom: 0em; 
    margin: 0; ">
  <div class="row justify justify-content-center" style="text-align: center;">
    <h3 class="primary-text assistant_title">VOICE IN THE PRESS, a project for the NGOs</h3>
  </div>

  <div class="row" style="padding-left: 3em; padding-right: 3em;">
        <div class="col-12">
          <div style="margin-left: 3em; margin-right: 3em; color: #fff">
            <p>Pressources is excited to launch the program VOICE IN THE PRESS in order to help NGOs to increase their media exposure.</p>
            <p>Non-governmental organizations in all fields, with the preference for those in the education sector, are welcome to join VOICE IN THE PRESS to have their stories selected and pitch to a growing network of journalists from all over the world.</p>
            <p>In order to join or for further information, please send an email to <a href="contact">info@pressources.com</a></p>
            <br>
          </div>
        </div>
        <br>


        
        <div class="col-12" style="color: #fff;">
          <p style="font-size: 1.2em;">We are already working with:</p>
        </div>

        <div class="col-md-4" style="color: #fff; margin-top: 1.3em;">
          <p style="font-size: 1.2em; font-weight: bold;" class="primary-text">SOÑAR DESPIERTO</p>
          <p>Focuses on improving the quality of life of underprivileged kids</p>
          <img style="width: 100%; height: 65%;" src="<?php echo RUTA . '/images/sonar.jpg' ?>" alt="">
          <p style="font-size: .7em;">Courtesy: Soñar Despierto</p>
        </div>

        <div class="col-md-4" style="color: #fff; margin-top: 1.3em;">
          <p style="font-size: 1.2em; font-weight: bold;" class="primary-text">TECHO</p>
          <p>Aims at eliminating poverty in Latin America through building houses</p>
          <img style="width: 100%; height: 65%;" src="<?php echo RUTA . '/images/techo.jpg' ?>" alt="">
          <p style="font-size: .7em;">Courtesy: Techo, Facebook page</p>
        </div>

        <div class="col-md-4" style="color: #fff; margin-top: 1.3em;">
          <p style="font-size: 1.2em; font-weight: bold;" class="primary-text">COSA VOSTRA</p>
          <p>Researches the communication dynamics in the anti-mafia initiative fields in Italy</p>
          <img style="width: 100%; height: 65%;" src="<?php echo RUTA . '/images/vostra.png' ?>" alt="">
          <p style="font-size: .7em;">Courtesy: Cosa Vostra, Facebook page</p>
        </div>
        
      </div>
</div>
  
  <?php require 'views/bottom.php'; ?>
  <?php require 'views/footer.php'; ?>

  <script>
  
$('#carouselExample').on('slide.bs.carousel', function (e) {

  
    var $e = $(e.relatedTarget);
    var idx = $e.index();
    var itemsPerSlide = 4;
    var totalItems = $('.carousel-item').length;
    
    if (idx >= totalItems-(itemsPerSlide-1)) {
        var it = itemsPerSlide - (totalItems - idx);
        for (var i=0; i<it; i++) {
            // append slides to end
            if (e.direction=="left") {
                $('.carousel-item').eq(i).appendTo('.carousel-inner');
            }
            else {
                $('.carousel-item').eq(0).appendTo('.carousel-inner');
            }
        }
    }
});


  $('#carouselExample').carousel({ 
                interval: 2000
        });


  $(document).ready(function() {
/* show lightbox when clicking a thumbnail */
    $('a.thumb').click(function(event){
      event.preventDefault();
      var content = $('.modal-body');
      content.empty();
        var title = $(this).attr("title");
        $('.modal-title').html(title);        
        content.html($(this).html());
        $(".modal-profile").modal({show:true});
    });

  });
</script>