<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
  </head>
  <body>


      <input type="text" id="search_term" placeholder="search...">

      <div id="map-canvas"></div>


    <script src="js/jquery.js"></script>

    

    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxja83IPQIZCaz9v49cyZtnDj0KaI73fI&libraries=places$callback=activatePlacesSearch"></script>

<script>
    function activatePlacesSearch(){
      var input = document.getElementById('search_term');
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
      
      var options = {
        bounds: defaultBounds,
        types: ['establishment']
      };


      var autocomplete = new google.maps.places.Autocomplete(input);
    }
  </script>

  </body>
</html>
