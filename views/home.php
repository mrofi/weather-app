
<?php

return <<<HTML
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/map-icons/dist/css/map-icons.min.css">

    <title>YourWeather App!</title>
    <style>
       /* Set the size of the div element that contains the map */
        #map {
            height: 600px;  /* The height is 400 pixels */
            width: 100%;  /* The width is the width of the web page */
           }
    </style>
  </head>
  <body>
    <h1>YourWeather App!</h1>
    <!--The div element for the map -->
    <div id="map"></div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6H3TWN6x4GNTHm9hHhkSkTMp5xQXuvM4"></script>

    <script src="/map-icons/dist/js/map-icons.js"></script>

    <script>
        function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
            initMap(latitude, longitude);
        }

         function errorHandler(err) {
            if(err.code == 1) {
               alert("Error: Access is denied!");
            } else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }
        }

        function startup() {
            if(navigator.geolocation) {
                var options = {timeout:60000};
                navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
            } else {
                alert("Sorry, browser does not support geolocation!");
            }
        }
        // Initialize and add the map
        function initMap(lat, lng) {
          var location = {lat: lat, lng: lng};
          var map = new google.maps.Map(
              document.getElementById('map'), {zoom: 14, center: location});
          var marker = new mapIcons.Marker({
                map: map,
                position: location,
                icon: {
                    path: mapIcons.shapes.SQUARE_PIN,
                    fillColor: '#00CCBB',
                    fillOpacity: 1,
                    strokeColor: '',
                    strokeWeight: 0
                },
                map_icon_label: '<span class="map-icon map-icon-point-of-interest"></span>'
            });
          // var marker = new google.maps.Marker({position: location, map: map});
        }

        google.maps.event.addDomListener(window, 'load', startup);

    </script>
            <!--Load the API from the specified URL
            * The async attribute allows the browser to render the page while the API loads
            * The key parameter will contain your own API key (which is not needed for this tutorial)
            * The callback parameter executes the initMap() function
            -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
  </body>
</html>
HTML;
