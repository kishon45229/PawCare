<?php
    // Create connection
	$conn = mysqli_connect("localhost", "root", "", "PawCare_records");

    // Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_error();
	}					

    // Query to fetch the latitude and longitude from the database
    $sql = "SELECT PetID, Latitude, Longitude, Geofence_radius FROM Pets "; // Replace 'pet_location' with your table name and 'id = 1' with the appropriate condition
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Loop through the rows and fetch the latitude and longitude values
        while ($row = $result->fetch_assoc()) {
            $locationData = array(
                'PetID' => $row['PetID'],
                'Latitude' => $row['Latitude'],
                'Longitude' => $row['Longitude'],
                'Geofence_radius' => $row['Geofence_radius'],
            );
        
            $locations[] = $locationData; // Add the location to the array

            $locationQueryString = http_build_query(array('locations' => $locations));
            $redirectURL = "Random data.php?" . $locationQueryString;
            header("Location: " . $redirectURL); 
        }
    } 

    // Close the database connection
    $conn->close();
?>


