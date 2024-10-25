<?php
    // Retrieve latitude, longitude, and distance from the POST request
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $distance = $_POST['distance'];

    // Create connection
    $conn = mysqli_connect("localhost", "root", "", "PawCare_records");

    // Check connection
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } else {
        // Insert the data into the database table
        $insertQuery = "INSERT INTO YourTableName (Latitude, L
        ongitude, Distance) VALUES ('$latitude', '$longitude', '$distance')";
        if (mysqli_query($conn, $insertQuery)) {
            echo "Data inserted successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    // Close connection
    mysqli_close($conn);
?>
