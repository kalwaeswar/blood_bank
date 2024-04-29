<?php
    session_start();
    // Connect to MySQL database
    $conn = mysqli_connect("localhost", "root", "", "blood_bank");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['username'] = $username;
        header("Location: main_page.php");
        exit();
    } else {
        echo "Invalid username or password!";
    }

    mysqli_close($conn);
?>
