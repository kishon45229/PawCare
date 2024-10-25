<html>
    <head>
        <script>
            function device1A2S3D4F5G6H7J8K() {
                window.location.href = `1A2S3D4F5G6H7J8.php`;
            }
        </script>
    </head>

    <body>
        <?php
            //Receive 'UserId, latitude, longitude' from 'Db add user' file
            $deviceIdNo = $_GET['idno']; 

            // Create connection
            $conn = mysqli_connect("localhost", "root", "", "PawCare_records");

            // Check connection
            if (mysqli_connect_errno()) {
                echo "Failed to connect: " . mysqli_connect_error();
                //echo "<script>otherErrorNotification();</script>";
            }		

            if ($deviceIdNo == "1A2S3D4F5G6H7J8K") {
                echo "<script>device1A2S3D4F5G6H7J8K();</script>";
            }
        ?>
    </body>
</html>