

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

      <div class="form-row box rounded">
        <div class="form-group col-md-6">
          <label for="inputName" class="col-form-label">Name <a style="color: red"><?php echo($needed); ?></a></label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Name.." value="<?php if(!$enviado && isset($name)) echo $name ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="inputName" class="col-form-label">Last Name <a style="color: red"><?php echo($needed); ?></a></label>
          <input type="text" class="form-control" id="name" name="last" placeholder="Last Name.." value="<?php if(!$enviado && isset($last)) echo $last ?>">
        </div>
      </div>

      <div class="form-row box rounded">
        <div class="form-group col-md-12" style="padding-right: 50%;">
          <label for="inputEmail4" class="col-form-label">Email <a style="color: red"><?php echo($needed); ?></a></label>
          <input type="email" class="form-control" id="inputEmail4" name="mail" placeholder="Email" value="<?php if(!$enviado && isset($mail)) echo $mail ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="inputPassword4" class="col-form-label">Password<a style="color: red"><?php echo($needed); ?></a></label>
          <input type="password" class="form-control" id="inputPassword4" name="pass" placeholder="Password">
          <p style="color: red; margin-bottom: 0; font-size: 0.8em;">8 characters.</p>
        </div>

        <div class="form-group col-md-6">
          <label for="inputPassword4" class="col-form-label">Confirm Password<a style="color: red"><?php echo($needed); ?></a></label>
          <input type="password" class="form-control" id="inputPassword4" name="pass2" placeholder="Password">
        </div>

      </div>

      
      
      <div class="form-row box rounded">
          <div class="form-group col-md-4">
            <label for="inputAddress2">Gender <a style="color: red"><?php echo($needed); ?></a></label>
            <select class="form-control" name="gender">
              <option <?php if(isset($gender) & $gender == "Male"){ echo "selected"; } ?> value="Male">Male</option>
              <option <?php if(isset($gender) & $gender == "Female"){ echo "selected"; } ?> value="Female">Female</option>
              <option <?php if(isset($gender) & $gender == "Other"){ echo "selected"; } ?> value="Other">Other</option>
              <option <?php if(isset($gender) & $gender == "Rather not say"){ echo "selected"; } ?> value="Rather not say">Rather not say</option>
          </select>
          </div>
      </div>

      

          <div class="form-group box rounded">
            <label for="inputAddress2" class="col-form-label">Birth Date <a style="color: red"><?php echo($needed); ?></a></label>
            <div class="form-row">

              <div class="col-2">
                <p style="margin-bottom: 0;">Day</p>
                <select class="form-control" id="day" name="day">
                  <option <?php if(isset($day) & $day == "1"){ echo "selected"; } ?> value="1">1</option>
                  <option <?php if(isset($day) & $day == "2"){ echo "selected"; } ?> value="2">2</option>
                  <option <?php if(isset($day) & $day == "3"){ echo "selected"; } ?> value="3">3</option>
                  <option <?php if(isset($day) & $day == "4"){ echo "selected"; } ?> value="4">4</option>
                  <option <?php if(isset($day) & $day == "5"){ echo "selected"; } ?> value="5">5</option>
                  <option <?php if(isset($day) & $day == "6"){ echo "selected"; } ?> value="6">6</option>
                  <option <?php if(isset($day) & $day == "7"){ echo "selected"; } ?> value="7">7</option>
                  <option <?php if(isset($day) & $day == "8"){ echo "selected"; } ?> value="8">8</option>
                  <option <?php if(isset($day) & $day == "9"){ echo "selected"; } ?> value="9">9</option>
                  <option <?php if(isset($day) & $day == "10"){ echo "selected"; } ?> value="10">10</option>
                  <option <?php if(isset($day) & $day == "11"){ echo "selected"; } ?> value="11">11</option>
                  <option <?php if(isset($day) & $day == "12"){ echo "selected"; } ?> value="12">12</option>
                  <option <?php if(isset($day) & $day == "13"){ echo "selected"; } ?> value="13">13</option>
                  <option <?php if(isset($day) & $day == "14"){ echo "selected"; } ?> value="14">14</option>
                  <option <?php if(isset($day) & $day == "15"){ echo "selected"; } ?> value="15">15</option>
                  <option <?php if(isset($day) & $day == "16"){ echo "selected"; } ?> value="16">16</option>
                  <option <?php if(isset($day) & $day == "17"){ echo "selected"; } ?> value="17">17</option>
                  <option <?php if(isset($day) & $day == "18"){ echo "selected"; } ?> value="18">18</option>
                  <option <?php if(isset($day) & $day == "19"){ echo "selected"; } ?> value="19">19</option>
                  <option <?php if(isset($day) & $day == "20"){ echo "selected"; } ?> value="20">20</option>
                  <option <?php if(isset($day) & $day == "21"){ echo "selected"; } ?> value="21">21</option>
                  <option <?php if(isset($day) & $day == "22"){ echo "selected"; } ?> value="22">22</option>
                  <option <?php if(isset($day) & $day == "23"){ echo "selected"; } ?> value="23">23</option>
                  <option <?php if(isset($day) & $day == "24"){ echo "selected"; } ?> value="24">24</option>
                  <option <?php if(isset($day) & $day == "25"){ echo "selected"; } ?> value="25">25</option>
                  <option <?php if(isset($day) & $day == "26"){ echo "selected"; } ?> value="26">26</option>
                  <option <?php if(isset($day) & $day == "27"){ echo "selected"; } ?> value="27">27</option>
                  <option <?php if(isset($day) & $day == "28"){ echo "selected"; } ?> value="28">28</option>
                  <option <?php if(isset($day) & $day == "29"){ echo "selected"; } ?> value="29">29</option>
                  <option <?php if(isset($day) & $day == "30"){ echo "selected"; } ?> value="30">30</option>
                  <option <?php if(isset($day) & $day == "31"){ echo "selected"; } ?> value="31">31</option>
                </select>
              </div>

            <div class="col-md-3">
              <p style="margin-bottom: 0;">Month</p>
                <select class="form-control" id="month" name="month">
                  <option <?php if(isset($month) & $month == "01"){ echo "selected"; } ?> value="01">January</option>
                  <option <?php if(isset($month) & $month == "02"){ echo "selected"; } ?> value="02">February</option>
                  <option <?php if(isset($month) & $month == "03"){ echo "selected"; } ?> value="03">March</option>
                  <option <?php if(isset($month) & $month == "04"){ echo "selected"; } ?> value="04">April</option>
                  <option <?php if(isset($month) & $month == "05"){ echo "selected"; } ?> value="05">May</option>
                  <option <?php if(isset($month) & $month == "06"){ echo "selected"; } ?> value="06">June</option>
                  <option <?php if(isset($month) & $month == "07"){ echo "selected"; } ?> value="07">July</option>
                  <option <?php if(isset($month) & $month == "08"){ echo "selected"; } ?> value="08">August</option>
                  <option <?php if(isset($month) & $month == "09"){ echo "selected"; } ?> value="09">September</option>
                  <option <?php if(isset($month) & $month == "10"){ echo "selected"; } ?> value="10">October</option>
                  <option <?php if(isset($month) & $month == "11"){ echo "selected"; } ?> value="11">November</option>
                  <option <?php if(isset($month) & $month == "12"){ echo "selected"; } ?> value="12">December</option>
                </select>
          </div>
          <div class="col-md-3">
            <p style="margin-bottom: 0;">Year</p>
            <input type="text" class="form-control" id="year" name="year" placeholder="1990" value="<?php if(!$enviado && isset($year)) echo $year ?>">
          </div>

        </div>
      </div>


      <div class="form-group box rounded">     
        <label for="inputAddress2" class="col-form-label">Industry<a style="color: red"><?php echo($needed); ?></a></label>
          <div class="form-row">
            <div class="col-md-6">
              <select id="inputState" class="form-control" name="indone">
                <option selected>-</option>
                 <!--CICLO PARA TRAER LOS IDIOMAS DE LA BASE DE DATOS-->
                <?php foreach($professions as $prof): ?>
                    <option <?php if($indone == $prof['id_industry']){ echo "selected"; } ?> value="<?php echo $prof['id_industry']; ?>"><?php echo $prof['name_industry']; ?></option>
                <?php endforeach; ?>

              </select>
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" id="" name="detailone" placeholder="Profession..." value="<?php if(!$enviado && isset($detailone)) echo $detailone ?>">
            </div>

        </div>
        <br>
 <!--       
        <div class="form-row">
            <div class="col-md-6">
              <select id="inputState" class="form-control" name="indtwo">
                <option selected>-</option>
                <?php foreach($professions as $prof): ?>
                    <option value="<?php echo $prof['id_industry']; ?>"><?php echo $prof['name_industry']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" id="" name="detailtwo" placeholder="Detail...">
            </div>
        </div>
-->
      </div>

      <div class="form-group box rounded">     
        <label for="inputAddress2" class="col-form-label">I'm a source for</label>
          <div class="form-row">
            <div class="col-md-7">
              <select id="inputState" class="form-control" name="areaone">
                <option selected>-</option>
                <!--CICLO PARA TRAER LAS PROFESIONES DE LA BASE DE DATOS-->
                <?php foreach($areas as $area): ?>
                    <option <?php if($areaone == $area['id_area']){ echo "selected"; } ?> value="<?php echo $area['id_area']; ?>"><?php echo $area['name_area']; ?></option>
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
                    <option <?php if($areatwo == $area['id_area']){ echo "selected"; } ?> value="<?php echo $area['id_area']; ?>"><?php echo $area['name_area']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
      </div>

<!--
      <div class="form-row box rounded">
        <div class="form-group col-md-6">
          <label for="inputCity" class="col-form-label">Country of Residence <a style="color: red"><?php echo($needed); ?></a></label>
            <select id="inputState" class="form-control" name="countryres">
                <option selected>-</option>
                <?php foreach($countries as $count): ?>
                    <option value="<?php echo $count['id_country']; ?>"><?php echo $count['name_country']; ?></option>
                <?php endforeach; ?>
            </select>
        </div> 

        <div class="form-group col-md-4">
          <label for="inputState" class="col-form-label">City of Residence</label>
          <input type="text" class="form-control" id="" name="cityfield_res" placeholder="-" value="">
        </div>

        <div class="form-group col-md-4">
          <label for="inputState" class="col-form-label">City</label>
          <select id="inputState" class="form-control" name="cityres">
            <option selected>empty</option>
                <?php foreach($cities as $cit): ?>
                    <option value="<?php echo $cit['id_city']; ?>"><?php echo $cit['name_city']; ?></option>
                <?php endforeach; ?>
          </select>
        </div>

      </div>
-->

<!--

      <div class="form-row box rounded">
        <div class="form-group col-md-6">
          <label for="inputCity" class="col-form-label">Country of Origin <a style="color: red"><?php echo($needed); ?></a></label>
            <select id="inputState" class="form-control" name="countryorig">
                <option selected>-</option>
                <?php foreach($countries as $count): ?>
                    <option value="<?php echo $count['id_country']; ?>"><?php echo $count['name_country']; ?></option>
                <?php endforeach; ?>
            </select>
        </div> 

        <div class="form-group col-md-4">
          <label for="inputState" class="col-form-label">City of Origin</label>
          <input type="text" class="form-control" id="" name="cityfield_orig" placeholder="-" value="">
        </div>


        <div class="form-group col-md-4">
          <label for="inputState" class="col-form-label">City</label>
          <select id="inputState" class="form-control" name="cityorig">
            <option selected>empty</option>
                <?php foreach($cities as $cit): ?>
                    <option value="<?php echo $cit['id_city']; ?>"><?php echo $cit['name_city']; ?></option>
                <?php endforeach; ?>
          </select>
        </div>

      </div>
-->

      <div class="form-row box rounded">

        <div class="form-group col-md-8">
          <label for="inputState" class="col-form-label">City of Origin</label>
          <input type="text" class="form-control" id="cityo" name="origin_city" placeholder="-" value="">
        </div>  

      </div>

      <div class="form-row box rounded">

        <div class="form-group col-md-8">
          <label for="inputState" class="col-form-label">City of Residence</label>
          <input type="text" class="form-control" id="cityr" name="residence_city" placeholder="-" value="">
        </div>  

      </div>



      <div class="form-row align-items-center box rounded">
        <div class="col-auto">
          <label class="mr-sm-2" for="inlineFormCustomSelect">Spoken Languages <a style="color: red"><?php echo($needed); ?></a></label>
          <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="langone">
            <option selected>...</option>
            <!--CICLO PARA TRAER LOS IDIOMAS DE LA BASE DE DATOS-->
            <?php foreach($languages as $lang): ?>
              <option <?php if($langone == $lang['id_language']){ echo "selected"; } ?> value="<?php echo $lang['id_language']; ?>"><?php echo $lang['name_language']; ?></option>
            <?php endforeach; ?>

          </select>

          <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="langtwo">
            <option selected>...</option>
            <!--CICLO PARA TRAER LOS IDIOMAS DE LA BASE DE DATOS-->
            <?php foreach($languages as $lang): ?>
              <option <?php if($langtwo == $lang['id_language']){ echo "selected"; } ?> value="<?php echo $lang['id_language']; ?>"><?php echo $lang['name_language']; ?></option>
            <?php endforeach; ?>
          </select>

          <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelect" name="langthree">
            <option selected>...</option>
            <!--CICLO PARA TRAER LOS IDIOMAS DE LA BASE DE DATOS-->
            <?php foreach($languages as $lang): ?>
              <option <?php if($langthree == $lang['id_language']){ echo "selected"; } ?> value="<?php echo $lang['id_language']; ?>"><?php echo $lang['name_language']; ?></option>
            <?php endforeach; ?>
          </select>

        </div>
      </div>

      <br>


<!--
      <div class="custom-controls-stacked">
        <label class="mr-sm-2" for="inlineFormCustomSelect">Do I want to be quoted with:</label>
        <label class="custom-control custom-radio">
          <input id="radioStacked3" name="radio-stacked" type="radio" class="custom-control-input">
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description">Full Name</span>
        </label>
        <label class="custom-control custom-radio">
          <input id="radioStacked4" name="radio-stacked" type="radio" class="custom-control-input">
          <span class="custom-control-indicator"></span>
          <span class="custom-control-description">First Name</span>
        </label>
      </div>
-->

      <div class="form-check mb-2 mb-sm-0">
        <label class="form-check-label">
          <input class="form-check-input" type="checkbox" name="terms">I accept the <a href="<?php echo RUTA . "/privacy.php" ?>" target="_blank">Terms and Conditions</a>
        </label>
      </div>

      <input type="hidden" name="origin_city_hidden" id="origin_city_hidden" value="">
      <input type="hidden" name="origin_country_hidden" id="origin_country_hidden" value="">

      <input type="hidden" name="residence_city_hidden" id="residence_city_hidden" value="">
      <input type="hidden" name="residence_country_hidden" id="residence_country_hidden" value="">


      <button type="submit" class="btn btn-primary" style="margin-top: 5%;">Source too</button>
    </form>

   <div class="row" style="margin-top: 2%;"> 
          <a href="<?php echo RUTA . "/journalist.php" ?>">Go to see Journalist description</a>
    </div>

</div>
<br>
<br>



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
      console.log(place['name']);

      //pais
      var country = place['address_components'].pop();
      console.log(country['long_name']);

      document.getElementById('origin_city_hidden').value = place['name'];
      document.getElementById('origin_country_hidden').value = country['long_name'];

      });

      ////////////////////////////ciudad 2////////////////////////////////////////////////
      google.maps.event.addListener(autocomplete2, 'place_changed', function(){
        
      var place2 = autocomplete2.getPlace();
      
       //ciudad
      console.log(place2['name']);

      //pais
      var country = place2['address_components'].pop();
      console.log(country['long_name']);

      document.getElementById('residence_city_hidden').value = place2['name'];
      document.getElementById('residence_country_hidden').value = country['long_name'];
      });

</script>