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

		<script>
			//Device added successful notification
			function showSuccessNotification() {
				// Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('popup-notification');

				// Add the heading
				const heading = document.createElement('h2');
				heading.textContent = 'Successful Connection!';
				notification.appendChild(heading);

				// Add the notification text
				const text = document.createElement('p');
				text.textContent = 'Congratulations! Your account and Pawtracker device have been successfully connected. Login with your account to continue';
				notification.appendChild(text);

				// Add the button
				const button = document.createElement('fbutton');
				button.textContent = 'Login';
				button.addEventListener('click', function() {
					notification.parentNode.removeChild(notification);
					document.body.removeChild(background);
					window.location.href = 'Login.html';
				});
				notification.appendChild(button);

				// Create the background
				const background = document.createElement('div');
				background.classList.add('popup-background');

				// Add the notification and background to the body
				document.body.appendChild(background);
				document.body.appendChild(notification);				
			}		

			//Device already exixts notification
			function deviceExistsNotification() {
				// Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('popup-notification');

				// Add the heading
				const heading = document.createElement('h2');
				heading.textContent = 'Oops! It seems that the Pawtracker ID you entered already exists.';
				notification.appendChild(heading);

				// Add the notification text
				const text = document.createElement('p');
				text.textContent = 'Please consider using a different device or explore the option of purchasing a new one';
				notification.appendChild(text);

				// Add the button
				const button = document.createElement('fbutton');
				button.textContent = 'Okay';
				button.addEventListener('click', function() {
					notification.parentNode.removeChild(notification);
					document.body.removeChild(background);
					window.location.href = 'Add PawTracker.php';
				});
				notification.appendChild(button);

				// Create the background
				const background = document.createElement('div');
				background.classList.add('popup-background');

				// Add the notification and background to the body
				document.body.appendChild(background);
				document.body.appendChild(notification);
			}

			//Invalid device notification
			function invalidDeviceNotification() {
				// Create the popup notification
				const notification = document.createElement('div');
				notification.classList.add('popup-notification');

				// Add the heading
				const heading = document.createElement('h2');
				heading.textContent = 'Oops! Invalid PawTracker ID';
				notification.appendChild(heading);

				// Add the notification text
				const text = document.createElement('p');
				text.textContent = 'Please enter a valid PawTracker ID or explore the option of purchasing a new one';
				notification.appendChild(text);

				// Add the button
				const button = document.createElement('fbutton');
				button.textContent = 'Okay';
				button.addEventListener('click', function() {
					notification.parentNode.removeChild(notification);
					document.body.removeChild(background);
					window.location.href = 'Add PawTracker.php';
				});
				notification.appendChild(button);

				// Create the background
				const background = document.createElement('div');
				background.classList.add('popup-background');

				// Add the notification and background to the body
				//document.body.appendChild(background);
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
					window.location.href = 'Add Pawtracker.php';
				});
				notification.appendChild(button);

				// Create the background
				const background = document.createElement('div');
				background.classList.add('popup-background');

				// Add the notification and background to the body
				document.body.appendChild(background);
				document.body.appendChild(notification);
			}
			/*
			function activateDevice(idno) {
				window.location.href = `PawTrackers.php?idno=${idno}`;
			}*/
		</script>
	</head>

	<body>
		<!--Database connectivity and integration-->
		<?php
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			
			// Retrieve the data from the POST request
			$id = $_POST['idno'];
			$type = $_POST['type'];
			$name = $_POST['name'];
			$age = $_POST['age'];
			$weight = $_POST['weight'];
			$latitude = $_POST['latitude'];
			$longitude = $_POST['longitude'];								

			$id = str_replace(' ', '', $id); 
			//echo "<script>activateDevice('$id');</script>";

			// Retrieve the lastInsertedID from the query parameter
			$userId = $_GET['id'];
			//echo "<script>alert('User ID: $userId');</script>";

			// Create connection
			$conn = mysqli_connect("localhost", "root", "", "PawCare_records");

			// Check connection
			if (mysqli_connect_errno()) {
				//echo "Failed to connect: " . mysqli_connect_error();
				echo "<script>otherErrorNotification();</script>";
			}				

			$getDeviceIDQuery = "SELECT * FROM Device WHERE DeviceID = '$id'";
			$getDeviceIDResult = mysqli_query($conn, $getDeviceIDQuery);	

			if (mysqli_num_rows($getDeviceIDResult) == 1) {
				// Check if the "Pets" table exists
				$tableExistsQuery = "SHOW TABLES LIKE 'Pets'";
				$tableExistsQueryResult = mysqli_query($conn, $tableExistsQuery);

				if (mysqli_num_rows($tableExistsQueryResult) == 0) {
					// "Pets" table does not exist, create it
					$sqlCreateTable = "CREATE TABLE Pets (
						PetID INT(30) AUTO_INCREMENT,
						UserID INT(30),
						DeviceID VARCHAR(16),
						Pet_type CHAR(3),
						Name VARCHAR(30),
						Age INT(11),
						Weight FLOAT(11),
						Image LONGBLOB,
						Latitude DECIMAL(10,8),
						Longitude DECIMAL(11,8),
						Geofence_radius INT(11),
						PRIMARY KEY (PetId),
						FOREIGN KEY (UserID) REFERENCES Accounts (UserID),
						FOREIGN KEY (DeviceId) REFERENCES Device (DeviceID)
					)";
	
					// Execute query
					if (mysqli_query($conn, $sqlCreateTable)) {
						//echo "alert('Table 'Pets' created successfully!');";
	
						// Insert data into the "Pets" table
						$sqlInsertData = "INSERT INTO Pets (UserID, DeviceId, Pet_type, Name, Age, Weight, Latitude, Longitude) VALUES ('$userId','$id', '$type', '$name', '$age', '$weight', '$latitude', '$longitude')";
	
						// If data inserted into table "Pets" successfully
						if (mysqli_query($conn, $sqlInsertData)) {
							//echo "alert('Data inserted successfully!');";
							echo "<script>showSuccessNotification();</script>";
						}
						//Error inserting data into table "Pets"
						else {
							//echo "alert('Error inserting data: ' . mysqli_error($conn));";
							echo "<script>otherErrorNotification();</script>";
						} 
					}
					// Error creating the table "Pets"
					else {
						//echo "alert('Error creating table: ' . mysqli_error($conn));";
						echo "<script>otherErrorNotification();</script>";
					}
				} 
				else {
					// "Pets" table exists, no need to create it
					//echo "alert('Table 'Pets' already exists!');";
	
					// Check if the PawTracker ID already exists in the table
					$getDataQuery = "SELECT * FROM Pets WHERE DeviceID = '$id'";
					$resultOfGetDataQuery = mysqli_query($conn, $getDataQuery);	
	
					if (mysqli_num_rows($resultOfGetDataQuery) == 0) {
						// PawTracker ID does not exists and insert data into the "Pets" table
						$sqlInsertData = "INSERT INTO Pets (UserID, DeviceId, Pet_type, Name, Age, Weight, Latitude, Longitude) VALUES ('$userId','$id', '$type', '$name', '$age', '$weight', '$latitude', '$longitude')";
	
						// Data successfully inserted into "Pets" table
						if (mysqli_query($conn, $sqlInsertData)) {
							//echo "alert('Data inserted successfully');";
							echo "<script>showSuccessNotification();</script>";
						}
						//Error inserting data into table "Pets"
						else {
							//echo "alert('Error inserting data:: ' . mysqli_error($conn));";
							echo "<script>otherErrorNotification();</script>";
						} 
					}
					// PawTRacker ID already exists in the table "Pets"	 
					else {
						//echo "alert('PawTracker ID already exists');";
						echo "<script>deviceExistsNotification();</script>";
					}
				}
			}
			else {
				echo "<script>invalidDeviceNotification();</script>";
			}

			if (isset($_FILES['image'])) {
				$file = $_FILES['image'];
			
				// Get file information
				$fileName = $file['name'];
				$fileTmpPath = $file['tmp_name'];
			
				// Move the uploaded file to a desired location
				$targetPath = "Profile/" . $fileName;
				move_uploaded_file($fileTmpPath, $targetPath);
				
				$profilePicturePath = mysqli_real_escape_string($conn, $targetPath);
				
				$query = "UPDATE Pets SET Image = '$profilePicturePath' WHERE DeviceID = '$id'";
				mysqli_query($conn, $query);
			}
			// Close connection
			mysqli_close($conn);					
		?>
	</body>
</html>