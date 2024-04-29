<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Blood</title>
    <link rel="stylesheet" href="blood_request.css">
</head>
<body>
    <h2>Blood Request</h2>
    <form action="process_blood_request.php" method="post">
        <input type="text" name="blood_type" placeholder="Blood Type Needed" required><br>
        <input type="text" name="time_needed" placeholder="Time Needed" required><br>
        <input type="text" name="location" placeholder="Location" required><br>
        <input type="text" name="username" placeholder="Your Name" required><br>
        <input type="tel" name="contact_details" placeholder="Contact Details" required><br>
        <button type="submit">Submit Request</button>
    </form>
</body>
</html>
