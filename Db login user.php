<!DOCTYPE html>
<html lang="en">
<html>
    <head>
        <!--css style for notification-->
        <style>
			h1, h2, p {
				font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
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
		</style>

        <script> 
            //Invalid output notification
            function invalidInputNotification() {
				//Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('popup-notification');

				//Add the heading
				const heading = document.createElement('h2');
				heading.textContent = 'Invalid email or password!';
				notification.appendChild(heading);

				//Add the notification text
				const text = document.createElement('p');
				text.textContent = 'Invalid login credentials. Please check your email and password and try again.';
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

            //Login success notification
            function showSuccessNotification(petId) {
				//Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('popup-notification');

				//Add the heading
				const heading = document.createElement('h2');
				heading.textContent = 'Welcome!';
				notification.appendChild(heading);

				//Add the notification text
				const text = document.createElement('p');
				text.textContent = 'You have successfully logged in.';
				notification.appendChild(text);

				//Add the button
				const button = document.createElement('fbutton');
				button.textContent = 'Next';
				button.addEventListener('click', function() {
					notification.parentNode.removeChild(notification);
					document.body.removeChild(background);
					redirectToPage(petId);
				});
				notification.appendChild(button);

				//Create the background
				const background = document.createElement('div');
				background.classList.add('popup-background');

				//Add the notification and background to the body
				document.body.appendChild(background);
				document.body.appendChild(notification);
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

            //Send 'PawTracker ID' to 'Daily report' page
            function redirectToPage(petId) {
				window.location.href = 'Track pet.php?id=' + petId;
			}

			function selectDeviceNotification(pets, petIds) {
				// Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('pet-popup-notification');

				// Add the heading
				const heading = document.createElement('h1');
				heading.textContent = 'Choose your pet to begin tracking';
				notification.appendChild(heading);

				// Add the pet selection options
				for (let i = 0; i < pets.length; i++) {
					const pet = pets[i];
					const petId = petIds[i];

					const button = document.createElement('pbutton');
					button.textContent = pet;
					button.addEventListener('click', function() {
						notification.parentNode.removeChild(notification);
						document.body.removeChild(background);
						redirectToPage(petId);
					});
					notification.appendChild(button);
				}

				// Create the background
				const background = document.createElement('div');
				background.classList.add('popup-background');

				// Add the notification and background to the body
				document.body.appendChild(background);
				document.body.appendChild(notification);
			}
        </script>
    </head>

    <body>
        <!--Database connection and integration-->
        <?php	
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			
            //Retrieve the data from the POST request from login page
            $email = $_GET['email'];
            $password = $_GET['password'];
			
            //Create connection
            $conn = mysqli_connect("localhost", "root", "", "pawcare_records");
			
            //Check connection
            if (mysqli_connect_errno()) {
                //echo "Failed to connect to MySQL: " . mysqli_connect_error();
                echo "<script>otherErrorNotification();</script>";
            }

            //Check user entered email and password are correct or not
            $getDataQuery = "SELECT * FROM accounts WHERE Email = '$email' AND Password = '$password'";
            $getDataResult = $conn->query($getDataQuery);

            //If both are correct
            if ($getDataResult->num_rows > 0) {
                // Login successful
                
                //Get 'user id' of the data with user entered email address from 'acounts' table
                $getUserIDQuery = "SELECT UserID FROM accounts WHERE Email = '$email' AND Password = '$password'";
                $getUserIDResults = $conn->query($getUserIDQuery); 

                if ($getUserIDResults->num_rows > 0) {
                    $row = $getUserIDResults->fetch_assoc()['UserID'];
                    $userId = $row;
					//echo "<script>updateTableDaily('$userId');</script>";

					// Get 'pet names' with the 'user id' from 'pets' table
					$getPetNamesQuery = "SELECT Name, PetID FROM pets WHERE UserID = '$userId'";
					$getPetNamesResults = $conn->query($getPetNamesQuery);

					if ($getPetNamesResults->num_rows > 0) {
						$petNames = array();
						$petIds = array();

						while ($row = $getPetNamesResults->fetch_assoc()) {
							$petNames[] = $row['Name'];
							$petIds[] = $row['PetID'];
						}

						// If there is only one pet, proceed to the next page
						if (count($petNames) === 1) {
							$petName = $petNames[0]; 

							$getPetIDQuery = "SELECT PetID FROM pets WHERE Name = '$petName'";
							$getPetIDResults = $conn->query($getPetIDQuery);

							$row = $getPetIDResults->fetch_assoc()['PetID'];
							$petId = $row;

							echo "<script>showSuccessNotification('$petId');</script>";
							
						}
						// If there are multiple pets, display pet selection options
						else {
							// Pass petNames and petIds to the selectDeviceNotification function
    						echo "<script>selectDeviceNotification(" . json_encode($petNames) . ", " . json_encode($petIds) . ");</script>";
						}
					}
                }  
            } 
            //Login failed
            else {   
                //echo "Invalid email or password.";
                echo "<script>invalidInputNotification();</script>";
            }
			
            //Close connection
            mysqli_close($conn);
        ?>        
    </body>
</html>