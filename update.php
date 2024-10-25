<?php
                        // Create connection
                        $conn = mysqli_connect("localhost", "root", "", "PawCare_records");

                        // Check connection
                        if (mysqli_connect_errno()) {
                            echo "Failed to connect: " . mysqli_connect_error();
                        }	

                        // Insert data into the "Pets" table
						$sqlInsertData = "INSERT INTO ActivityData (PetID, Current_latitude, Current_longitude) VALUES ('$PetID','$', '$type', '$name', '$age', '$weight', '$latitude', '$longitude')";
	
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
                    ?>