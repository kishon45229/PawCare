<?php
    // Create connection
	$conn = mysqli_connect("localhost", "root", "", "PawCare_records");

    // Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_error();
	}					

    // Query to fetch the latitude and longitude from the database
    $sql = "SELECT Latitude, Longitude, Geofence_radius FROM Pets WHERE PetID = 1"; // Replace 'pet_location' with your table name and 'id = 1' with the appropriate condition
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the latitude and longitude values
        $row = $result->fetch_assoc();
        $latitude = $row['Latitude'];
        $longitude = $row['Longitude'];
        $geofenceRadius = $row['Geofence_radius'];
    }

    // Close the database connection
    $conn->close();
?>

