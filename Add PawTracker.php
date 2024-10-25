<?php
    //Receive 'UserId, latitude, longitude' from 'Db add user' file
    $lastInsertedID = $_GET['id'];
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
?>

<html>
    <head>
        <title>
            Connect your PawTracker with your account
        </title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--Link for browser lab logo-->
        <link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

        <!--css style for login page-->
        <style>
            body {
                font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background-color:whitesmoke;
                margin: 0;
                padding: 0;
                height: 100vh;
            }

            .back-to-home {
                position: absolute;
                top: 70px;
                left: 210px;
                font-size: 16px;
            }

            h1 {
                text-align: center;
                color: #012853;
                margin-bottom: 0;
            }

            p {
                margin-top: 10;
                text-align: center;
                font-size: large;
                font-weight: 400;
            }

            form {
                background-color: #fff;
                padding-left: 40px;
                padding-right: 40px;
                padding-top: 5px;
                padding-bottom: 30px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                margin-bottom: 100px;
                width: 420px;
                height: fit-content;
                margin: 40px auto;
            }

            label {
                display: block;
                margin-top: 10px;
                font-size: 19px;
                padding-bottom: 5px;
            }

            input[type="text"] {
                width: 100%;
                padding: 12px;
                border: 1px solid #245953;
                border-radius: 30px;
                box-sizing: border-box;
                margin-bottom: 8px;
                font-size: 16px;
            }

            .drop-down {
                width: 100%;
                padding: 12px;
                border: 1px solid #245953;
                border-radius: 30px;
                box-sizing: border-box;
                margin-bottom: 8px;
                font-size: 16px;
            }

            .file-input {
                margin-top: 5px;
                margin-bottom: 10px;
            }

            button {
                background-color: #012853;
                color: #fff;
                padding: 13.5px 20px;
                border: none;
                border-radius: 30px;
                cursor: pointer;
                font-size: 16px;
                width: 100%;
                margin-top: 20px;
                margin-bottom: 10px;
            }

            button:hover {
                background-color: black;
            }

            input[type="checkbox"] {
                margin-top: 30px;
                margin-bottom: 20px;
            }

            .login{
                text-align: center;
            }

            footer {
                background-color: #245953;
                width: 100%;
                padding: 6px;
                position: relative;
            }

            footer p {
                margin: 0;
                color: #fff;
                font-size: 10pt;
            }

            /* Style for the map container */
            #map-container {
                height: 400px;
                margin-bottom: 20px;
            }

            footer {
                background-color: #012853;
                padding: 10px;
                text-align: center;
            }

            footer p {
                color: white;
                font-size: 12px;
                margin: 0;
            }
        </style>  

        <script>
            //JavaScript validation
            function validateForm() {
                let id = document.getElementById("id-no").value.trim();
                let type = document.getElementById("type");
                let breed = document.getElementById("breed");
                let name = document.getElementById("name").value.trim();
                let age = document.getElementById("age").value.trim();
                let weight = document.getElementById("weight").value.trim();

                document.getElementById("userid").value = lastInsertedID;

                if (id === "") {
                    alert("PawTracker ID must be filled out");
                    return false;
                }

                if (id.length !== 16) {
                    alert("Invalid PawTracker ID");
                    return false;
                }

                if (type.selectedIndex === 0) {
                    alert("Please select your pet type.");
                    return false;
                }

                if (breed.selectedIndex === 0) {
                    alert("Please select your pet breed.");
                    return false;
                }

                if (age === "") {
                    alert("Pet's age must be filled out.");
                    return false;
                }

                if (isNaN(age)) {
                    alert("Age must be a valid number.");
                    return false;
                }

                if (age < 1 || age > 25) {
                    alert("Age must be between 1 and 25.");
                    return false;
                }

                if (weight === "") {
                    alert("Weight cannot be blank");
                    return false;
                }

                if (isNaN(weight)) {
                    alert("Weight must be a valid number.");
                    return false;
                }

                return true;
            }

            //PawTracker id no formatting-->
            function formatIdNumber() {
                var idNumberInput = document.getElementById('idno');
                var idNumberValue = idNumberInput.value.replace(/\s/g, '');
                var formattedIdNumber = '';

                for (var i = 0; i < idNumberValue.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        formattedIdNumber += ' ';
                    }
                    formattedIdNumber += idNumberValue[i];
                }

                idNumberInput.value = formattedIdNumber;

                formattedIdNumber = formattedIdNumber.substr(0, 19);
                idNumberInput.value = formattedIdNumber;
            }
            
            var breedByPet = {
                    "Dog": ["Labrador", "Golden Retriever", "German Shepherd"],
                    "Cat": ["Persian", "Siamese", "Maine Coon"],
            };

            function updateDropdown() {
                    var selectedPetype = document.getElementById("type").value;
                    var breedDropdown = document.getElementById("breed");

                    // Clear the current options in the district dropdown
                    breedDropdown.innerHTML = "<option value=''>-- Select your pet breed --</option>";

                    // Populate the district dropdown with the districts of the selected province
                    if (selectedPetype !== "") {
                        var breeds = breedByPet[selectedPetype];
                        breeds.forEach(function(breed) {
                            var option = document.createElement("option");
                            option.value = breed;
                            option.text = breed;
                            breedDropdown.appendChild(option);
                        });
                    }
            }
        </script>
    </head>

    <body>  
        <!--'Back to home' link-->
        <a href="Getting started.php" class="back-to-home">
            Back to Home
        </a>
        
        <!--Form to get details about pet-->
        <form name="add-PawTracker" onsubmit="return validateForm();" method="POST" action="Db add PawTracker.php?id=<?php echo $lastInsertedID; ?>" enctype="multipart/form-data">
            <h1>
                Connect your PawTracker
            </h1>

            <p>
                Add your PawTracker details
            </p>

            <label for="id">
                PawTracker ID
            </label>
            <input type="text" id="idno" name="idno" oninput="formatIdNumber()"  placeholder="XXXX~XXXX~XXXX~XXXX">           
            
            <label for="pet-type">
                Pet type
            </label>
            <select id="type" name="type" class="drop-down" onchange="updateDropdown()">
                <option value="">-- Select your pet type --</option>
                <option value="Dog">Dog</option>
                <option value="Cat">Cat</option>
            </select>   

            <label for="pet-breed">
                Pet breed
            </label>
            <select id="breed" name="breed" class="drop-down">
                <option value="">-- Select your pet breed --</option>
            </select>

            <label for="name">
                Pet name
            </label>
            <input type="text" id="name" name="name" placeholder="Enter pet name">

            <label for="pet-age">
                Age
            </label> 
            <input type="text" id="age" name="age" placeholder="Enter pet's age">

            <label for="pet-image">
                Image of your pet
                <span style="font-size: 12px; color: gray;">(Optional)</span>
            </label>
            <input type="file" id="image" name="image" class="file-input">

            <label for="weight">
                Weight (kg)
            </label>
            <input type="text" id="weight" name="weight" placeholder="Enter pet's weight">

            <!-- Displaying map to select the home location -->
            <label for="home-location">
                Pet's home location
            </label>
            <div id="map-container"></div>

            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">

            <button type="submit">
                Connect
            </button>
        </form>

          <!--JavaScript code to initialize the map-->
          <script>
            // Callback function to initialize and display the map
            function initMap() {
                // Create the map instance
                var map = new google.maps.Map(document.getElementById('map-container'), {
                    center: { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> },
                    zoom: 12
                });

                // Add a marker when the map is clicked
                var marker = new google.maps.Marker({
                    map: map
                });

                // Listen for click events on the map
                google.maps.event.addListener(map, 'click', function(event) {
                    // Set the position of the marker to the clicked location
                    marker.setPosition(event.latLng);

                    // Retrieve the latitude and longitude
                    var clickedLatitude = event.latLng.lat();
                    var clickedLongitude = event.latLng.lng();

                    // Update the hidden input fields with the clicked location
                    document.getElementById('latitude').value = clickedLatitude;
                    document.getElementById('longitude').value = clickedLongitude;
                });
            }
        </script>

        <!--Google Maps API script-->
        <script src="https://maps.googleapis.com/maps/api/js?key=API_KEY&callback=initMap" async defer></script>
        
        <!--Footer-->
        <footer>
            <p>&copy; 2023 PawCare. All rights reserved.</p>
        </footer>
    </body>
</html>
