<?php
// Include the database connection
include('../includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact = $_POST['contact'];
    $bank_details = $_POST['bank_details'];
    $location = $_POST['location'];
    $role = $_POST['role'];

    if ($role == 'Customer') {
        // Insert into CUSTOMER table
        $sql = "INSERT INTO CUSTOMER (Contact, Bank_Details, Location) VALUES ('$contact', '$bank_details', '$location')";
    } elseif ($role == 'Land_owner') {
        // Insert into LAND_OWNER table
        $sql = "INSERT INTO LAND_OWNER (Contact, Bank_Details, Location) VALUES ('$contact', '$bank_details', '$location')";
    } elseif ($role == 'Inspector') {
        // Insert into INSPECTOR table
        $sql = "INSERT INTO INSPECTOR (Contact, Location) VALUES ('$contact', '$location')";
    } else {
        echo "Invalid role selected.";
        exit;
    }

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="contact" placeholder="Contact" required><br>
            <input type="text" name="bank_details" placeholder="Bank Details" required><br>
            <input type="text" name="location" placeholder="Location" required><br>
            <select name="role" required>
                <option value="Land_owner">Land Owner</option>
                <option value="Inspector">Inspector</option>
                <option value="Customer">Customer</option>
            </select><br>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
