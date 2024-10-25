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

    if ($getPetDataResults->num_rows > 0) {
        $row = $getPetDataResults->fetch_assoc();

        $userId = $row["UserID"];
        $deviceId = $row["DeviceID"];
        $petName = $row["Name"];
        $petType = $row["Pet_type"];
        $age = $row["Age"];
        $image = $row["Image"];
        $weight = $row["Weight"];
    } 
    else {
        echo "otherErrorNotification();";
    }
?>

<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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

            h2 {
				font-size: 15pt;
			}

			p {
				margin-top: 10px;
				text-align: left;
				font-size: 15pt;
				margin-right: 0px;
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

            .lost-pet {
                padding-left: 100px;
                padding-right: 100px;
                padding-top: 20px;
                padding-bottom: 100px;
            }

            .lost-pet h1 {
                font-size: 50px;
                text-align: left;
            }

            .lost-pet h3 {
                font-size: 26px;
                padding-top: 40px;
                text-align: center;
                font-weight: 400;
            }

            .instructions {
                padding-left: 100px;
                padding-right: 100px;
                padding-top: 20px;
                padding-bottom: 100px;
            }

            .instructions h1 {
                font-size: 35px;
                text-align: left;
            }

            .instructions h3 {
                padding-left: 120px;
                padding-top: 30px;
                font-size: 25px;
                text-align: left;
            }

            .instructions p {
                padding-top: 20px;
                font-size: 20px;
            }

            .social-icons {
                display: flex;
                justify-content: center;
                padding-top: 40px;
            }
                
            .social-icons a {
                color: #333;
                font-size: 50px;
                margin: 0 30px;
                transition: color 0.3s;
            }
                
            .social-icons a:hover {
                color: #1877f2;
            }

            .generate-flyer-button {
                text-align: center;
                padding-top: 30px;
                padding-bottom: 15px;
            }

            .generate-flyer-button button{
                width: 200px;
                padding: 10px 20px;
                text-align: center;
                border: none;
                border-radius: 20px;
                background-color: #333;
                color: white;
                font-size: 20px;
                cursor: pointer;
            }

            .generate-flyer-button button:hover {
                background-color: #1877f2;
                color: white;
            }

            .report-button {
                text-align: center;
                padding-top: 60px;
                padding-bottom: 15px;
            }

            .report-button button{
                width: 400px;
                padding: 10px 20px;
                text-align: center;
                border: none;
                border-radius: 20px;
                background-color: #333;
                color: white;
                font-size: 20px;
                cursor: pointer;
            }

            .report-button button:hover {
                background-color: #1877f2;
                color: white;
            }
        </style>

        <script>
            function redirectToPage() {
				window.location.href = 'Flyer generator.html';
			}
        </script>
    </head>

    <body>
        <section class="openning">
            <header>    
                <div class="navigation">
                    <a href="#" onclick="redirectToPage('<?php echo $petId; ?>');">Today's activity</a>
                    <a href="#" onclick="redirectToPage();">Track your Pet</a>
                    <a href="#" class="active">Find lost Pet</a>
                    <a href="#">Services</a>
                    <a href="#">Contact</a>
                </div>
            </header>
        </section>

        <div class="lost-pet">
            <h1>
                Are you think your pet <?php echo $petName; ?> is lost or stolen?
            </h1>

            <div class="report-button">
                <button onclick="reportLostPet('<?php echo $petId; ?>');" target="_blank">
                    Yes. My pet <?php echo $petName; ?> is lost or stolen
                </button>
            </div>

            <h3>
                "Remember to remain patient and hopeful during the search. Reuniting with a missing pet can sometimes take time, but many pets are found and returned to their owners. Good luck with your search!"
            </h3>
        </div>

        <div class="instructions">
            <h1>
                Here are the steps to get closer to your pet. 
            </h1>

            <h3>
                Step 1: Search Nearby
            </h3>

            <p>
                Start by thoroughly searching the immediate vicinity of the last known location. Check hiding spots, bushes, and favorite spots your pet might frequent. Pay attention to any sounds or movements that could indicate your pet's presence.
            </p>

            <h3>
                Step 2: Gather Information
            </h3>

            <p>
                Note down any additional information about your pet, such as favorite treats, toys, or noises that might attract their attention. This information can be helpful in luring your pet back.
            </p>

            <h3>
                Step 3: Alert Neighbors
            </h3>

            <p>
                Inform your neighbors about the missing pet, providing them with a description and your contact information. They can keep an eye out and help in the search efforts.
            </p>

            <h3>
                Step 4: Use Social Media
            </h3>

            <p>
                Utilize social media platforms to spread the word about your missing pet. Post clear pictures, descriptions, and contact information on local community groups, animal shelters, and lost-and-found pet websites.
            </p>

            <div class="social-icons">
                <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.twitter.com/" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
            </div>

            <h3>
                Step 5: Create and Distribute Flyers
            </h3>

            <p>
                Create visually appealing flyers with a clear picture of your pet, relevant details, and your contact information. Distribute these flyers in the neighborhood, pet stores, parks, and other areas where pet lovers gather.
            </p> 

            <div class="generate-flyer-button">
                <button onclick="redirectToPage();" target="_blank">
                    Generate flyer
                </button>
            </div>

            <h3>
                Step 6: Expand the Search
            </h3>

            <p>
                If your pet hasn't been found after initial searches, expand your search radius. Pets can wander surprisingly far from their original location, so it's important not to limit the search too narrowly.
            </p> 

            <h3>
                Step 7: Check Local Listings and Lost Pet Databases
            </h3>

            <p>
                Regularly check local lost pet listings and online databases. Many websites and organizations maintain databases where people can report lost and found pets.
            </p> 

            <h3>
                Step 8: Check Local Listings and Lost Pet Databases
            </h3>

            <p>
                If you've exhausted all your efforts and are unable to find your pet, consider hiring professional pet trackers or engaging the services of pet search organizations. They have experience and resources to help locate missing pets.
            </p> 
        </div>
    </body>
</html>