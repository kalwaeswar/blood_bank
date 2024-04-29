<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donor Registration</title>
    <link rel="stylesheet" href="donor.css">
</head>
<body>
    <div class="container">
        <h2>Donor Registration</h2>
        <form action="process_donor_registration.php" method="post">
            <input type="text" name="donor_name" placeholder="Donor Name" required><br>
            <input type="number" name="age" placeholder="Age" required><br>
            <input type="text" name="blood_group" placeholder="Blood Group" required><br>
            <input type="tel" name="contact_number" placeholder="Contact Number" required><br>
            <input type="text" name="address" placeholder="Address" required><br>
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html>
