<div class="form_container" style="padding-bottom: 3em;">

<div class="container rounded" style="margin-top: 2%; max-width: 65%; background-color: #f2f2f2;">

  <div class="row upspace bpspace" style="margin-bottom: 2em; text-align: center;">
    <div class="col-md-12">
      <h3>Register as a Source</h3>
    </div>  
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

          <div class="form-group rounded">
            <label for="inputAddress2" class="col-form-label">Birth Date</label>
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
            <input type="text" class="form-control" id="year" name="year" placeholder="1990" value="">
          </div>

        </div>
      </div>

      <div class="form-row rounded">

        <div class="form-group col-md-8">
          <label for="inputState" class="col-form-label">City of Origin</label>
          <input type="text" class="form-control" id="cityo" name="origin_city" placeholder="-" value="">
        </div>  

      </div>

      <div class="form-row rounded">

        <div class="form-group col-md-8">
          <label for="inputState" class="col-form-label">City of Residence</label>
          <input type="text" class="form-control" id="cityr" name="residence_city" placeholder="-" value="">
        </div>  

      </div>

      <?php if($user_type == "SOURCE"){ ?>
      <div class="form-row align-items-center rounded">
        <div class="col-auto">
          <label class="mr-sm-2" for="inlineFormCustomSelect">Spoken Languages</label>
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
      <?php } ?>
      
      <?php if($user_type = $t[0][0] == "SOURCE"){ ?>
      <div class="form-group rounded">     
        <label for="inputAddress2" class="col-form-label">Industry</label>
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
                <input type="text" class="form-control" id="" name="detailone" placeholder="Profession..." value="">
            </div>

        </div>
        <br>
      </div>
      <?php } ?>
      
      <?php if($user_type = $t[0][0] == "SOURCE"){ ?>
      <div class="form-row rounded">
        <div class="col-md-6">
          <label for="inputAddress2" class="col-form-label">Company/Organization/Institution</label>
            <input type="text" class="form-control" id="" name="company" placeholder="Company/Organization/Institution...">
        </div>
      </div>
      <?php } ?>

      <!--<div class="form-group rounded">     
        <label for="inputAddress2" class="col-form-label">Ask me about</label>
          <div class="form-row">
            <div class="col-md-7">
              <select id="inputState" class="form-control" name="areaone">
                <option selected>-</option>
                
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
                
                <?php foreach($areas as $area): ?>
                    <option <?php if($areatwo == $area['id_area']){ echo "selected"; } ?> value="<?php echo $area['id_area']; ?>"><?php echo $area['name_area']; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
        </div>
      </div>
    -->
      
      <p class="upspace">Ask me About</p>
      <div class="row bspace">
        
         <?php foreach($areas as $area): ?>
          <div class="col-6">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="<?php echo $area['id_area']; ?>" value="<?php echo $area['id_area']; ?>">
                <?php echo $area['name_area']; ?>
            </label>
          </div>
          <?php endforeach; ?>
        </div>



      <div class="col-md-12 upspace">
          <div class="form-group">
            <label for="exampleFormControlTextarea1">About me</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="desc"></textarea>
          </div>
      </div>

      <div class="col-md-12 upspace">
          <div class="form-group">
            <label class="form-check-label" style="font-family: Arial; font-weight: bold;" >
                <input class="form-check-input" type="checkbox" name="quote" value="quote">
                I might ask not to quote my full name.
            </label>
          </div>
      </div>

      <br>

      <input type="hidden" name="origin_city_hidden" id="origin_city_hidden" value="">
      <input type="hidden" name="origin_country_hidden" id="origin_country_hidden" value="">

      <input type="hidden" name="residence_city_hidden" id="residence_city_hidden" value="">
      <input type="hidden" name="residence_country_hidden" id="residence_country_hidden" value="">

      <input type="hidden" name="place_origin" id="place_origin" value="">
      <input type="hidden" name="place_residence" id="place_residence" value="">


      <button type="submit" class="btn btn-primary" style="margin-top: 5%; margin-bottom: 2em;">Save</button>
    </form>

</div>
</div>

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