<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header("Location: login.html");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <div class="options">
            <a href="register_donor.php" class="button">Register as Donor</a>
            <a href="request_blood.php" class="button">Request Blood</a>
        </div>
    </div>
</body>
</html>
