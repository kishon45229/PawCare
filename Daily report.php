<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    //Get pawtracker id from 'Db login' file
    $petId = $_GET['id'];
    /*
    if (isset($$pawtrackerID)) {
        echo "<script>alert('PawTracker ID: $pawtrackerID');</script>";
    }*/

    //Create connection
    $conn = mysqli_connect("localhost", "root", "", "pawcare_records");

    //Check connection
    if (mysqli_connect_errno()) {
        //echo "Failed to connect: " . mysqli_connect_error();
        echo "<script>otherErrorNotification();</script>";
    }

    //Retrieve data from "daily _data" table
    $getPetDataQuery = "SELECT * FROM pets WHERE PetID = '$petId'";
    $getPetDataResults = $conn->query($getPetDataQuery);

    if ($getPetDataResults === false) {
        //echo "Failed to retieve: " . mysqli_connect_error();
        echo "<script>otherErrorNotification();</script>";
    }

    if ($getPetDataResults->num_rows > 0) {
        $row = $getPetDataResults->fetch_assoc();

        $userId = $row["UserID"];
        $deviceId = $row["DeviceID"];
        $petType = $row["Pet_type"];
        $age = $row["Age"];
        $weight = $row["Weight"];

        // Query to fetch the latitude and longitude from the database
        $petDataQuery = "SELECT * FROM Pets WHERE DeviceID = '$deviceId'";
        $petDataResult = $conn->query($petDataQuery);

        if ($petDataResult->num_rows > 0) {
            $row = $petDataResult->fetch_assoc();

            $petId = $row['PetID'];
            $Latitude = $row['Latitude'];
            $Longitude = $row['Longitude'];
            $GeofenceRadius = $row['Geofence_radius'];
            $weight = $row['Weight'];
        }
        else {
            echo "<script>otherErrorNotification();</script>";
        }
    } 
    else {
        echo "<script>otherErrorNotification();</script>";
    }


    //Retrieve data from "daily _data" table
    $currentDate = date('Y-m-d');
    $getActivityDataQuery = "SELECT * FROM activitydata WHERE PetID = '$petId' AND Date = (SELECT MAX(Date) FROM activitydata WHERE PetID = '$petId') ORDER BY ActivityID DESC LIMIT 1";

    $getActivityDataResults = $conn->query($getActivityDataQuery);

    if ($getActivityDataResults->num_rows > 0) {
        $row = $getActivityDataResults->fetch_assoc();

        $date = $row["Date"];
        $distance = $row["Distance"];    
        $burnedCalories = $row["Burned_calories"];
        $walkedSteps = $row["Steps_moved"];
    } 
    else {
        echo "<script>otherErrorNotification();</script>";
    }

    $getDistinctDatesQuery = "SELECT DISTINCT Date FROM activitydata WHERE PetID = '$petId'";
    $distinctDatesResult = $conn->query($getDistinctDatesQuery);

    $dataByDate = array();

    if ($distinctDatesResult->num_rows > 0) {
        while ($dateRow = $distinctDatesResult->fetch_assoc()) {
            $date = $dateRow['Date'];

            // Get the last inserted data for each date
            $getLastInsertedDataQuery = "SELECT * FROM activitydata WHERE PetID = '$petId' AND Date = '$date' ORDER BY ActivityID DESC LIMIT 1";
            $lastInsertedDataResult = $conn->query($getLastInsertedDataQuery);

            if ($lastInsertedDataResult->num_rows > 0) {
                $dataRow = $lastInsertedDataResult->fetch_assoc();
                $dataByDate[$date] = $dataRow;
            }
        }
    }

    $labels = array();
    $distanceData = array();
    $caloriesData = array();
    $stepsData = array();

    foreach ($dataByDate as $date => $dataRow) {
        $labels[] = $date;
        $distanceData[] = $dataRow["Distance"];
        $caloriesData[] = $dataRow["Burned_calories"];
        $stepsData[] = $dataRow["Steps_moved"];
    }
?>

<html>
    <head>
        <title>Daily report</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: content-box;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
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
                padding: 20px 100px;
                display: flex;
                justify-content: space-between;
                align-items: center;
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
                margin-right: 20px;
            }

            header .navigation a:hover {
                color: white;
                background-color: black;
            }

            header .navigation a.active {
                color: white;
                background-color: black;
            } 

            nav {
                background-color: #f1f1f1;
            }

            .nav-item {
                display: inline-block;
                color: #333;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            .nav-item:hover {
                background-color: #ddd;
            }

            .dropdown {
                display: inline-block;
                position: relative; 
            }

            .dropbtn {
                background-color: transparent;
                border: none;
                cursor: pointer;
                padding-left: 150px;
            }

            .dropbtn img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 220px;
                padding-top: 15px;
                padding-bottom: 15px;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: #333;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .dropdown:hover .dropdown-content {
                display: block;
            }

            .battery-icon {
                width: 50px;
                height: 25px;
                background-color: #e1e1e1;
                border-radius: 5px;
                position: relative;
                overflow: hidden;
            }

            .battery-fill {
                height: 100%;
                background-color: #4caf50;
                transition: width 1s ease-in-out;
            }

            #map {
                height: 100vh;
                width: 100%;
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

            .pet-info { 
                padding-left: 100px;
                padding-top: 40px;
                padding-bottom: 40px;
                font-size: 35px;
            }

            .pet-info h1 {
                font-size: 50px;
                text-align: left;
            }

            .progress-bar {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: row;
                height: fit-content;
                padding-bottom: 100px;
            }

            .circle {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                margin: 0 20px;
                position: relative;
                width: 300px;
                height: 300px;
            }

            .circle svg {
                width: 300px;
                height: 300px;
                position: absolute;
            }

            .circle .bg {
                fill: none;
                stroke-width: 10px;
                stroke: whitesmoke;
            }

            .circle .progress {
                fill: none;
                stroke-width: 10px;
                stroke: #014487;
                stroke-linecap: round;
                stroke-dasharray: 942.48;
                stroke-dashoffset: 180;
                transform: rotate(-90deg);
                transform-origin: 50% 50%;
                animation: circling 1.5s ease-out;
            } 

            .circle .text {
                position: absolute;
                width: 100%;
                font-size: 48px;
                text-align: center;
                font-weight: 400;
                line-height: 44px;
            }

            .circle .text .text-head {
                font-size: 28px;
            } 

            @keyframes circling{
                from {
                    stroke-dashoffset: 942.48;
                }
                to {
                    stroke-dashoffset: 180;
                }
            }

            canvas {
                margin: 0 auto;
                font-size: 20px;
                font-weight: bold;
            }

            #dataSelect {
                font-size: 15px;
                margin-left: 100px;
                margin-bottom: 40px;
                padding: 3px 20px;
                border-radius: 20px;
            }

            #dataSelect:hover {
                cursor: pointer;
                border-color: #014487;
            }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <script>
            function otherErrorNotification() {
                // Create the popup notification
                const notification = document.createElement('div');
                notification.classList.add('popup-notification');

                // Add the heading
                const heading = document.createElement('h2');
                heading.textContent = 'Something went wrong!';
                notification.appendChild(heading);

                // Add the notification text
                const text = document.createElement('p');
                text.textContent = '"We apologize for the inconvenience. An error occurred. Please try again later.';
                notification.appendChild(text);

                // Add the button
                const button = document.createElement('fbutton');
                button.textContent = 'Okay';
                button.addEventListener('click', function() {
                    notification.parentNode.removeChild(notification);
                    document.body.removeChild(background);
                    window.location.href = 'Sign up.php';
                });
                notification.appendChild(button);

                // Create the background
                const background = document.createElement('div');
                background.classList.add('popup-background');

                // Add the notification and background to the body
                document.body.appendChild(background);
                document.body.appendChild(notification);
            }

            function redirectToPage2(petId) {
				window.location.href = 'Track pet.php?id=' + petId;
			}

            function redirectToPage3(petId) {
				window.location.href = 'Find lost pet.php?id=' + petId;
			}

            function signOut() {
                // Perform sign out operations here
                alert('Signed out successfully!');
            }

            // Function to generate a random battery percentage
            function generateRandomBatteryPercentage() {
                return Math.floor(Math.random() * 101);
            }

            // Function to update the battery icon and percentage
            function updateBattery() {
                const batteryFill = document.getElementById("battery-fill");
                const batteryPercentage = generateRandomBatteryPercentage();
                batteryFill.style.width = `${batteryPercentage}%`;
            }

            // Call the updateBattery function every 15 minutes (or as desired) to simulate battery depletion over two weeks
            // Note: For the purpose of this example, we'll simulate two weeks as 20160 minutes (15 mins x 20160 = 2 weeks)
            setInterval(updateBattery, 15 * 60 * 1000); // 15 minutes in milliseconds

        </script>
    </head>

    <body>
        <section class="openning">
            <header>    
                <div class="navigation">
                    <a href="#" onclick="redirectToPage2('<?php echo $petId; ?>');">Track pet</a>
                    <a href="#" class="active">Daily report</a>
                    <a href="#" onclick="redirectToPage3('<?php echo $petId; ?>');">Find lost Pet</a>
                    <a href="#">Services</a>
                    <a href="#">Contact</a>

                    <div class="dropdown">
                        <button class="dropbtn">
                            <img src="profilepic.png" alt="Default Profile Picture">
                        </button>

                        <div class="dropdown-content">
                            <a href="#">Edit Profile</a>
                            <a href="#">Change Password</a>
                            <a href="Login.html">Logout</a>
                        </div>
                    </div>
                </div>               
            </header>
        </section>
        
        <section class="pet-info">
            <h1>
                Today's activity of your pet
            </h1>

            <p>
                <?php
                    $currentDate = date('Y-m-d');
                    echo $currentDate;
                ?>
            </p>
        </section>

        <section class="progress-bar">
                <div class="circle">
                    <svg>
                        <circle class="bg" cx="150" cy="150" r="140" />
                        <circle class="progress" cx="150" cy="150" r="140" />
                    </svg>

                    <div class="text">
                        <?php echo $burnedCalories?><div class="text-head">kcal</div>
                    </div>
                </div>

                <div class="circle">
                    <svg>
                        <circle class="bg" cx="150" cy="150" r="140" />
                        <circle class="progress" cx="150" cy="150" r="140" />
                    </svg>


                    <div class="text">
                        <?php echo $walkedSteps?><div class="text-head">steps</div>
                    </div>
                </div>

                
                <div class="circle">
                    <svg>
                        <circle class="bg" cx="150" cy="150" r="140" />
                        <circle class="progress" cx="150" cy="150" r="140" />
                    </svg>

                    <div class="text">
                        <?php echo $distance?><div class="text-head">meters</div>
                    </div>
                </div>
        </section>

        <select id="dataSelect" onchange="updateGraph()">
            <option value="distance">Walking Distance</option>
            <option value="calories">Burned Calories</option>
            <option value="steps">Walked Steps</option>
        </select>

        <canvas id="walkingDataChart" style="max-width: 1000px; max-height: 500px;"></canvas>
        
        <script>
            var walkingData = {
                distance: <?php echo json_encode($distanceData); ?>,
                calories: <?php echo json_encode($caloriesData); ?>,
                steps: <?php echo json_encode($stepsData); ?>
            };
            var walkingDataLabels = <?php echo json_encode($labels); ?>;


            var ctx = document.getElementById('walkingDataChart').getContext('2d');
            var walkingDataChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: walkingDataLabels,
                    datasets: [{
                        label: 'Walking Data',
                        data: walkingData.distance,
                        fill: false,
                        borderColor: '#014487',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        },
                        y: {
                            display: true,
                            title: {
                                display: true,
                                text: 'Value'
                            }
                        }
                    }
                }
            });

            function updateGraph() {
                var selectedData = document.getElementById('dataSelect').value;
                walkingDataChart.data.datasets[0].data = walkingData[selectedData];
                walkingDataChart.update();
            }
        </script>
    </body>
</html> 