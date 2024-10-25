<html>
	<head>
		<!--css style for notification-->
		<style>
			h2, p {
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
			}

			fbutton:hover {
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
				text-align: center;
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
	</head>

	<body>
		<script>
			//Account created successful notification
			function showSuccessNotification(lastInsertedID, latitude, longitude) {
				// Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('popup-notification');

				// Add the heading
				const heading = document.createElement('h2');
				heading.textContent = 'We are a family now!';
				notification.appendChild(heading);

				// Add the notification text
				const text = document.createElement('p');
				text.textContent = 'Account successfully created! Get ready to unleash the power of PawTracker by connecting it now.';
				notification.appendChild(text);

				// Add the button
				const button = document.createElement('fbutton');
				button.textContent = 'Next';
				button.addEventListener('click', function() {
					notification.parentNode.removeChild(notification);
					document.body.removeChild(background);
					redirectToPage(lastInsertedID, latitude, longitude);
				});
				notification.appendChild(button);

				// Create the background
				const background = document.createElement('div');
				background.classList.add('popup-background');

				// Add the notification and background to the body
				document.body.appendChild(background);
				document.body.appendChild(notification);
			}

			//Email already exixts notification
			function emailExistsNotification() {
				// Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('popup-notification');

				// Add the heading
				const heading = document.createElement('h2');
				heading.textContent = 'Email already exists!';
				notification.appendChild(heading);

				// Add the notification text
				const text = document.createElement('p');
				text.textContent = 'Try to login or use a different email address.';
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

			//Unknown error notification
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

			//Send 'UserId', 'Latitude', and 'Longitude' to 'Add PawTracker' file 
			function redirectToPage(lastInsertedID, latitude, longitude) {
				window.location.href = `Add PawTracker.php?id=${lastInsertedID}&latitude=${latitude}&longitude=${longitude}`;
			}
		</script>

		<!--Database connectivity and integration-->
		<?php
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			
			// Retrieve the data from the POST request
			$firstname = $_POST['firstname'];
			$lastname = $_POST['lastname'];
			$email = $_POST['email'];
			$district = $_POST['district'];
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];
			$password = $_POST['password'];

			// Create connection
			$conn = mysqli_connect("localhost", "root", "", "PawCare_records");

			// Check connection
			if (mysqli_connect_errno()) {
				//echo "Failed to connect: " . mysqli_connect_error();
				echo "<script>otherErrorNotification();</script>";
			}

			// Check if the "Accounts" table exists
			$tableExistsQuery = "SHOW TABLES LIKE 'Accounts'";
			$tableExistsQueryResult = mysqli_query($conn, $tableExistsQuery);

			if (mysqli_num_rows($tableExistsQueryResult) == 0) {
				// "Accounts" table does not exist, create it
				$sqlCreateTable = "CREATE TABLE Accounts (
					UserID INT AUTO_INCREMENT,
					First_name VARCHAR(30),
					Last_name VARCHAR(30),
					Email VARCHAR(30),
					District CHAR(30),
					Password VARCHAR(30),
					PRIMARY KEY (UserID)
				)";

				// Execute query
				if (mysqli_query($conn, $sqlCreateTable)) {
				//echo "alert('Table \'Accounts\' created successfully!');";

					// Insert data into the "Accounts" table
					$sqlInsertData = "INSERT INTO Accounts (First_name, Last_name, Email, District, Password) VALUES ('$firstname', '$lastname', '$email', '$district', '$password')";

					// If data inserted into table "Accounts" successfully
					if (mysqli_query($conn, $sqlInsertData)) {
						$lastInsertedID = mysqli_insert_id($conn);
						//echo "alert('Account created successfully. User ID: $lastInsertedID');";
						echo "<script>showSuccessNotification('$lastInsertedID', '$latitude', '$longitude');</script>";
						//echo "redirectToPage($lastInsertedID);"; // Redirect to another file
					}
					// Error inserting data into table "Accounts"
					else {
						//echo "alert('Error inserting data: " . mysqli_error($conn) . "');";
						echo "<script>otherErrorNotification();</script>";
					}
				}
				// Error creating the table "Accounts"
				else {
					//echo "alert('Error creating table: " . mysqli_error($conn) . "');";
					echo "<script>otherErrorNotification();</script>";
				}
			} 
			else {
				// "Accounts" table exists, no need to create it
				//echo "alert('Table \'Accounts\' already exists!');";

				// Check if the email already exists in the table
				$getDataQuery = "SELECT * FROM Accounts WHERE Email = '$email'";
				$getDataQueryResult = mysqli_query($conn, $getDataQuery);

				if (mysqli_num_rows($getDataQueryResult) == 0) {
					// Email does not exist, insert data into the "Accounts" table
					$sqlInsertData = "INSERT INTO Accounts (First_name, Last_name, Email, District, Password) VALUES ('$firstname', '$lastname', '$email', '$district', '$password')";

					// Data successfully inserted into "Accounts" table
					if (mysqli_query($conn, $sqlInsertData)) {
						$lastInsertedID = mysqli_insert_id($conn);
						//echo "alert('Account created successfully. User ID: $lastInsertedID');";
						echo "<script>showSuccessNotification('$lastInsertedID', '$latitude', '$longitude');</script>";
						//echo "redirectToPage($lastInsertedID);";		
					}
					// Error inserting data into table "Accounts"
					else {
						//echo "alert('Error inserting data: " . mysqli_error($conn) . "');";
						echo "<script>otherErrorNotification();</script>";
					}
				}
				// Email already exists in the table "Accounts"	 
				else {
					//echo "emailExistsNotification();";
					echo "<script>emailExistsNotification();</script>";
				}
			}

			// Close connection
			mysqli_close($conn);
		?>
	</body>
</html>