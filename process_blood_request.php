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
            echo "<h2>Matching Donors</h2>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "Name: " . $row['donor_name'] . "<br>";
                echo "Age: " . $row['age'] . "<br>";
                echo "Contact Number: " . $row['contact_number'] . "<br>";
                echo "Address: " . $row['address'] . "<br><br>";
            }
        } else {
            echo "<h2>No matching donors found</h2>";
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close database connection
    mysqli_close($conn);
} else {
    // Handle case where form was not submitted
    echo "Form submission error.";
}
?>
