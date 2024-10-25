<?php
    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "PawCare_records");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect: " . mysqli_connect_error();
        exit(); // Terminate script execution if connection fails
    }

    $petId = $_GET['id'];

    // Query to fetch the latitude and longitude from the database
    $petDataQuery = "SELECT * FROM Pets WHERE PetID = '$petId'";
    $petDataResult = $conn->query($petDataQuery);

    if ($petDataResult->num_rows > 0) {
        $locations = array(); // Create an array to store location data

        while ($row = $petDataResult->fetch_assoc()) {
            $locationData = array(
                'PetID' => $row['PetID'],
                'Latitude' => $row['Latitude'],
                'Longitude' => $row['Longitude'],
                'Geofence_radius' => $row['Geofence_radius'],
                'Weight' => $row['Weight']
            );
            $locations[] = $locationData; // Add the location to the array
        }

        $locationQueryString = http_build_query(array('locations' => $locations));
        $redirectURL = "Random data.php?" . $locationQueryString;
        header("Location: " . $redirectURL);
        exit(); 
    }

    // Close the database connection
    $conn->close();
?>