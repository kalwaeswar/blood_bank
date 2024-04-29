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
    $donor_name = mysqli_real_escape_string($conn, $_POST['donor_name']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Insert donor data into database
    $sql = "INSERT INTO donors (donor_name, age, blood_group, contact_number, address) 
            VALUES ('$donor_name', '$age', '$blood_group', '$contact_number', '$address')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to a success page or display a success message
        echo "Donor registration successful!";
        header("Location: main_page.php");
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
