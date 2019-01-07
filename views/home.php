
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
    <link rel="stylesheet" type="text/css" href="/weather-icons/css/weather-icons.min.css">

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

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6H3TWN6x4GNTHm9hHhkSkTMp5xQXuvM4"></script>
    <script src="/map-icons/dist/js/map-icons.js"></script>

    <script>
        var map;
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
            map = new google.maps.Map(document.getElementById('map'), {zoom: 11, center: location});
            // Create a <script> tag and set the USGS URL as the source.
            var script = document.createElement('script');
            // This example uses a local copy of the GeoJSON stored at
            // http://earthquake.usgs.gov/earthquakes/feed/v1.0/summary/2.5_week.geojsonp
            script.src = 'http://api.openweathermap.org/data/2.5/find?lat='+lat+'&lon='+lng+'&cnt=20&APPID=3f3f3ee955f0cacb2fbb1aa892b0a963&callback=callMe';
            document.getElementsByTagName('head')[0].appendChild(script);
        }

        window.callMe = function(results) {
            for (var i = 0; i < results.list.length; i++) {
                var coords = results.list[i].coord;
                var location = new google.maps.LatLng(coords.lat,coords.lon);
                var weatherId = results.list[i].weather[0].id;
                console.log(weatherId);
                var city = results.list[i].name;
                var marker = new mapIcons.Marker({
                    map: map,
                    position: location,
                    icon: {
                        path: mapIcons.shapes.SQUARE_ROUNDED,
                        fillColor: '#642BB1',
                        fillOpacity: .6,
                        strokeColor: '',
                        strokeWeight: 0
                    },
                    map_icon_label: '<span class="map-icon wi wi-owm-'+weatherId+'"></span>'
                });
            }
        }

        google.maps.event.addDomListener(window, 'load', startup);

    </script>
            <!--Load the API from the specified URL
            * The async attribute allows the browser to render the page while the API loads
            * The key parameter will contain your own API key (which is not needed for this tutorial)
            * The callback parameter executes the initMap() function
            -->

    <!-- Optional JavaScript -->


  </body>
</html>
HTML;
