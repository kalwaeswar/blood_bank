<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .donor-card {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .donor-card h2 {
            margin-top: 0;
            color: #333;
        }

        .donor-info {
            margin-bottom: 10px;
        }

        .donor-info p {
            margin: 5px 0;
            color: #555;
        }

        .no-matching-donors {
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        session_start();

        // Check if the form was submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Connect to MySQL database
            $conn = mysqli_connect('localhost', 'root', '', 'blood_bank');

            // Check connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Sanitize and validate form data
            $blood_type = mysqli_real_escape_string($conn, $_POST['blood_type']);
            $time_needed = mysqli_real_escape_string($conn, $_POST['time_needed']);
            $location = mysqli_real_escape_string($conn, $_POST['location']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $contact_details = mysqli_real_escape_string($conn, $_POST['contact_details']);

            // Insert blood request into database
            $sql = "INSERT INTO blood_requests (blood_type, time_needed, location,username,contact_details) 
                    VALUES ('$blood_type', '$time_needed', '$location', '$username', '$contact_details')";

            if (mysqli_query($conn, $sql)) {
                // Print matching donors
                $sql_matching_donors = "SELECT * FROM donors WHERE blood_group = '$blood_type'";
                $result = mysqli_query($conn, $sql_matching_donors);
                if (mysqli_num_rows($result) > 0) {
                    echo "<h1>Matching Donors</h1>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="donor-card">
                            <h2><?php echo $row['donor_name']; ?></h2>
                            <div class="donor-info">
                                <p><strong>Blood Type:</strong> <?php echo $row['blood_group']; ?></p>
                                <p><strong>Age:</strong> <?php echo $row['age']; ?></p>
                                <p><strong>Contact Number:</strong> <?php echo $row['contact_number']; ?></p>
                                <p><strong>Address:</strong> <?php echo $row['address']; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='no-matching-donors'>No matching donors found</p>";
                }
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }

            // Close database connection
            mysqli_close($conn);
        } else {
            // Handle case where form was not submitted
            echo "<p class='no-matching-donors'>Form submission error.</p>";
        }
        ?>
    </div>
</body>
</html>
