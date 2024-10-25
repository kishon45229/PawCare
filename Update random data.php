<?php 
    $petId = $_GET['petId'];
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
    $distance = $_GET['distance'];
    $address = $_GET['address'];
    $calories = $_GET['totalCaloriesBurned'];
    $steps = $_GET['totalWalkedSteps'];

    // Create connection
	$conn = mysqli_connect("localhost", "root", "", "PawCare_records");

    // Check connection
	if (mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_error();
	}		
    
    // Prepare and execute the SQL statement
    $sql = "INSERT INTO ActivityData (PetID, Current_latitude, Current_longitude, Distance, Current_address, Burned_calories, Steps_moved) VALUES ('$petId', '$latitude', '$longitude', '$distance', '$address', '$calories', '$steps')";

    if ($conn->query($sql) === true) {
        echo "Value inserted successfully";
    } 
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close the connection
    $conn->close();
?>