<?php
    $receivedLocations = $_GET['locations'];
    
    // Output the values of the $locations[] array
    foreach ($receivedLocations as $location) {
        $petId = $location['PetID'];
        $Latitude = $location['Latitude'];
        $Longitude = $location['Longitude'];
        $GeofenceRadius = $location['Geofence_radius'];
        $weight = $location['Weight'];
    }
?>

<html>
    <head>
        <title>Track pet</title>
        <!--Link for browser lab logo-->
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: content-box;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }

            #map {
                height: 80vh;
                
                width: 100%;
            }

            .opening {
                position: relative;
                width: 100%;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
            }

            header {
                position: relative;
                margin-top: 0;
                width: 100%;
                padding: 30px 100px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            header .sign-in-btn a{
                position: relative;
                color: black;
                background-color: white;
                text-decoration: none;
                font-weight: 500;
                letter-spacing: 1px;
                padding: 3px 20px;
                border-radius: 20px;
                transition: 0.3s;
                transition-property: background;
            }

            header .sign-in-btn a:hover {
                color: white;
                background-color: #014487;
            }

            header .navigation a{
                color: black;
                text-decoration: none;
                font-weight: 500;
                letter-spacing: 1px;
                padding: 2px 15px;
                border-radius: 20px;
                transition: 0.3s;
                transition-property: background;
            }

            header .navigation a:not(:last-child) {
                margin-right: 30px;
            }

            header .navigation a:hover {
                color: white;
                background-color: black;
            }

            header .navigation a.active {
                color: white;
                background-color: black;
            } 

            fbutton {
				font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
				background-color: #245953;
				color: #fff;
				padding: 8px 30px;
				border: none;
				border-radius: 30px;
				cursor: pointer;
				font-size: 18px;
				width: 50%;
				margin-top: 20px;
				margin-bottom: 20px;
				margin-left: 450px;
			}

			fbutton:hover {
				background-color: black;
			}

			h1 {
				font-size: 18pt;
				text-align: center;
			}

			.pet-popup-notification {
				display: flex;
            	flex-direction: column;
            	align-items: center;
				height: max-content;
				width: max-content;
				position: fixed;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				background-color: #fff;
				padding: 20px;
				border-radius: 5px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
				z-index: 999;
			}   

			pbutton {
				font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
				text-align: center;
				background-color: #245953;
				color: #fff;
				margin: 10px;
				padding: 8px 30px;
				border: none;
				border-radius: 30px;
				cursor: pointer;
				font-size: 18px;
				width: 40%;
			}

			pbutton:hover {
				background-color: black;
			}

			.popup-notification {
				position: fixed;
				top: 50%;
				left: 50%;
				transform: translate(-50%, -50%);
				background-color: #fff;
				padding: 20px;
				border-radius: 5px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
				z-index: 999;
			}   

			.popup-notification h2 {
				margin-top: 0;
			}

			.popup-notification p {
				margin-bottom: 20px;
			}

			.popup-notification button {
				display: block;
				margin: auto;
			}

			.popup-background {
				position: fixed;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: rgba(0, 0, 0, 0.5);
				z-index: 998;
				backdrop-filter: blur(5px);
			}

            .map-info {
                padding-left: 100px;
                padding-right: 100px;
                padding-top: 20px;
                padding-bottom: 40px;
            }

            .map-info h1 {
                font-size: 50px;
            }

            .map-info p {
                padding-top: 20px;
                padding-bottom: 20px;
                font-size: 15px;
            }

            .map-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 500px;
                border-radius: 20px;
            }

            .search-pet {
                padding-left: 100px;
                padding-right: 100px;
                padding-top: 60px;
                padding-bottom: 60px;
            }

            .search-pet h1 {
                font-size: 50px;
            }

            .search-pet h2{
                padding-top: 0px;
                text-align: center;
                padding-top: 20px;
                padding-bottom: 10px;
            }

            .search-pet p{
                text-align: center;
                font-size: 20px;
            }

            .find-pet {
                padding-left: 100px;
                padding-right: 100px;
                padding-top: 20px;
                padding-bottom: 40px;
            }

            .find-pet h1 {
                font-size: 50px;
            }

            .find-pet-button {
                text-align: center;
                padding-top: 30px;
                padding-bottom: 30px;
            }

            .find-pet-button button{
                width: 200px;
                padding: 10px 20px;
                text-align: center;
                border: none;
                border-radius: 20px;
                background-color: blue;
                font-size: 20px;
                cursor: pointer;
            }

            .find-pet-button button:hover {
                background-color: black;
                color: white;
            }

            .set-geofence {
                padding: 50px 100px;
            }

            .set-geofence h1 {
                font-size: 50px;
                text-align: center;
            }

            .set-geofence form {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 20px;
            }

            .set-geofence label {
                font-size: 20px;
            }

            .set-geofence input {
                margin-left: 10px;
                padding: 5px;
                width: 100px;
            }

            .set-geofence button {
                margin-left: 10px;
                padding: 5px 10px;
            }

            .map-container {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 500px;
                border-radius: 20px;
                margin-bottom: 20px;
                position: relative;
            }


        </style>

        <script>
            function redirectToPage1(petId) {
				window.location.href = 'Daily report.php?id=' + petId;
			}

            function redirectToPage3(petId) {
				window.location.href = 'Find lost pet.php?id=' + petId;
			}

            //Unknown error notification
            function otherErrorNotification() {
				//Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('popup-notification');

				//Add the heading
				const heading = document.createElement('h2');
				heading.textContent = 'Something went wrong!';
				notification.appendChild(heading);

				//Add the notification text
				const text = document.createElement('p');
				text.textContent = '"We apologize for the inconvenience. An error occurred. Please try again later.';
				notification.appendChild(text);

				//Add the button
				const button = document.createElement('fbutton');
				button.textContent = 'Okay';
				button.addEventListener('click', function() {
					notification.parentNode.removeChild(notification);
					document.body.removeChild(background);
					window.location.href = 'Login.php';
				});
				notification.appendChild(button);

				//Create the background
				const background = document.createElement('div');
				background.classList.add('popup-background');

				//Add the notification and background to the body
				document.body.appendChild(background);
				document.body.appendChild(notification);
			}
        </script>
    </head>
    
    <body>
        <section class="openning">
            <header>    
                <div class="navigation">
                    <a href="#" class="active">Today's activity</a>
                    <a href="#" onclick="redirectToPage1('<?php echo $petId; ?>');">Daily report</a>
                    <a href="#" onclick="redirectToPage3('<?php echo $petId; ?>');">Find lost Pet</a>
                    <a href="#">Services</a>
                    <a href="#">Contact</a>
                </div>
            </header>
        </section>

        <section class="map-info">
            <h1>
                Monitor your pet's whereabouts using the map below
            </h1>

            <p>
                Zoom in to see the precise location
            </p>
        </section>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBS5UKufdB0HBiZ0xIH-ZWGrtiBIjrZnyo&callback=initMap" async defer></script>

        <script>
            var totalDistance = 0;
            var totalCaloriesBurned = 0;
            var totalWalkedSteps = 0;
            var previousLocation = null;

            // Define the initial starting location for the pet
            var currentLocation = {
                latitude: <?php echo $Latitude; ?>, 
                longitude: <?php echo $Longitude; ?> 
            };

            function getHomeAddress(latitude, longitude, callback) {
                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(latitude, longitude);

                geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            callback(results[0].formatted_address);
                        } 
                        else {
                            callback('Address not found');
                        }
                    } 
                    else {
                        callback('Geocoder failed due to: ' + status);
                    }
                });
            }       

            // Get the home address of the new location
            getHomeAddress(latitude, longitude, function (address) {
                        var currentAddress = address;
                        //console.log('Address:', address);
                        // Display the address in the HTML document
            });

            // Set the radius (in degrees) for generating random locations
            var radius = <?php echo $GeofenceRadius; ?>;

            // Initialize Google Maps
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: currentLocation.latitude, lng: currentLocation.longitude },
                    zoom: 19
                });

                // Set the latitude and longitude of the location
                var home = { lat: <?php echo $Latitude; ?>, lng: <?php echo $Longitude; ?> }; 

                var marker = new google.maps.Marker({
                    position: home,
                    map: map,
                    icon: {
                        url: 'C:\\Users\\Kishon\\Pictures\\Home.png',
                        scaledSize: new google.maps.Size(30, 30)
                    },
                    title: 'Home'
                });

                // Center the map on the marker
                map.setCenter(home);

                // Create a circle overlay for the geofencing area
                var circle = new google.maps.Circle({
                    strokeColor: '#0000FF',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#0000FF',
                    fillOpacity: 0.2,
                    map: map,
                    center: { lat: currentLocation.latitude, lng: currentLocation.longitude },
                    radius: 100
                });

                // Create an empty polyline for the movements
                var polyline = new google.maps.Polyline({
                    map: map,
                    path: [],
                    geodesic: true,
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });

                // Create a marker for the initial location
                var marker = new google.maps.Marker({
                    position: currentLocation,
                    map: map
                });

                // Set up a timer to execute the updateLocation function at the desired interval (e.g., every 2 hours)
                setInterval(updateLocation, 5 * 1000, map, marker, polyline); // Interval is in milliseconds (2 hours = 2 * 60 * 60 * 1000)

                // Initial call to updateLocation to display the starting location on the map
                updateLocation(map, marker, polyline);
            }

            // Function to generate random movements
            function generateRandomMovement() {
                var movements = ["north", "south", "east", "west", "north-west", "north-east", "south-west", "south-east"];
                var randomIndex = Math.floor(Math.random() * movements.length);
                return movements[randomIndex];
            }

            // Function to generate random locations within a specified radius, restricted to roads and walking areas
            function generateRandomLocation(latitude, longitude, radius, callback) {
                var service = new google.maps.DirectionsService();

                var request = {
                    origin: new google.maps.LatLng(latitude, longitude),
                    destination: new google.maps.LatLng(latitude, longitude),
                    travelMode: google.maps.TravelMode.WALKING,
                    unitSystem: google.maps.UnitSystem.METRIC
                };

                service.route(request, function (response, status) {
                    if (status === google.maps.DirectionsStatus.OK) {
                        var route = response.routes[0];
                        var legs = route.legs[0];
                        var steps = legs.steps;
                        var randomStep = Math.floor(Math.random() * steps.length);
                        var randomLocation = steps[randomStep].end_location;

                        callback(randomLocation.lat(), randomLocation.lng());
                    } 
                    else {
                        console.log('Directions request failed due to ' + status);
                    }
                });
            }

            function getAddress(latitude, longitude, callback) {
                var geocoder = new google.maps.Geocoder();
                var latlng = new google.maps.LatLng(latitude, longitude);

                geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            callback(results[0].formatted_address);
                        } 
                        else {
                            callback('Address not found');
                        }
                    } 
                    else {
                        callback('Geocoder failed due to: ' + status);
                    }
                });
            }           

            // Function to update the pet's location and display it on the map
            function updateLocation(map, marker, polyline) {
                var movement = generateRandomMovement();

                generateRandomLocation(currentLocation.latitude, currentLocation.longitude, radius, function (newLatitude, newLongitude) {
                    if (movement === "north") {
                        newLatitude += 0.0001; // Example adjustment for north movement
                    } 
                    else if (movement === "south") {
                        newLatitude -= 0.0001; // Example adjustment for south movement
                    } 
                    else if (movement === "east") {
                        newLongitude += 0.0001; // Example adjustment for east movement
                    } 
                    else if (movement === "west") {
                        newLongitude -= 0.0001; // Example adjustment for west movement
                    }
                    else if (movement === "south-east") {
                        newLatitude += 0.0001; // Example adjustment for south movement
                        newLongitude += 0.0001;
                    } 
                    else if (movement === "north-east") {
                        newLatitude += 0.0001;
                        newLongitude -= 0.0001; // Example adjustment for east movement
                    } 
                    else if (movement === "north-west") {
                        newLatitude -= 0.0001;
                        newLongitude += 0.0001; // Example adjustment for west movement
                    }
                    else if (movement === "south-west") {
                        newLatitude -= 0.0001;
                        newLongitude -= 0.0001; // Example adjustment for west movement
                    }

                    // Update the current location
                    currentLocation.latitude = newLatitude;
                    currentLocation.longitude = newLongitude; 

                    // Get the address of the new location
                    getAddress(newLatitude, newLongitude, function (address) {
                        currentAddress = address;
                        //console.log('Address:', address);
                        // Display the address in the HTML document
                    });
                    
                    // Calculate the distance from the previous location to the new location
                    if (previousLocation !== null) {
                        var distance = google.maps.geometry.spherical.computeDistanceBetween(
                            new google.maps.LatLng(previousLocation.latitude, previousLocation.longitude),
                            new google.maps.LatLng(currentLocation.latitude, currentLocation.longitude)
                        );

                        totalDistance += distance;

                        const stepsPerKilometer = 1500;
                        const walkedSteps = (distance / 1000) * stepsPerKilometer;

                        totalWalkedSteps += walkedSteps;

                        var weight = <?php echo $weight; ?>;

                        const walkingSpeed = 1.4;
                        const timeInSeconds = distance / walkingSpeed;
                        const caloriesBurned = (0.035 * weight) + (walkingSpeed / 200) * (0.029 * weight);
                    
                        totalCaloriesBurned += caloriesBurned;
                    }

                    previousLocation = {
                        latitude: currentLocation.latitude,
                        longitude: currentLocation.longitude
                    };
                    
                    // Update the marker position on the map
                    marker.setPosition(new google.maps.LatLng(currentLocation.latitude, currentLocation.longitude));

                    // Add the current location to the polyline path
                    polyline.getPath().push(new google.maps.LatLng(currentLocation.latitude, currentLocation.longitude));

                    // Pan the map to the new location
                    map.panTo(marker.getPosition()); 

                    // Create the URL for updating random data
                    var updateURL = 'Update random data.php?petId=<?php echo $petId; ?>&latitude=' + newLatitude + '&longitude=' + newLongitude + '&distance=' + totalDistance + '&totalCaloriesBurned=' + totalCaloriesBurned + '&totalWalkedSteps=' + totalWalkedSteps + '&address=' + currentAddress;
                    
                    // Make an AJAX request to update the data
                    var xhr = new XMLHttpRequest();
                    xhr.open('GET', updateURL, true);
                    xhr.send();
                });
            }        
        </script>

        <div id="map"></div>

        <div class="search-pet">
            <h1>
                Is your pet not at the location indicated on the map?
            </h1>

            <h2>
                Stay Calm & Search Nearby
            </h2>

            <p>
                Take a deep breath and remain calm throughout the search process. 
                Panicking can make it harder to think clearly and may scare your pet further away.
                Start by thoroughly searching the immediate vicinity of the last known location. 
                Check hiding spots, bushes, and favorite spots your pet might frequent. 
                Pay attention to any sounds or movements that could indicate your pet's presence.
            </p>
        </div>

        <div class="find-pet">
            <h1>
                Still can't find your pet?
            </h1>

            <div class="find-pet-button">
                <button onclick="redirectToPage3('<?php echo $petId; ?>');">
                    Find your pet
                </button>
            </div>
        </div>
    </body>
</html>