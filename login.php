<?php
// Include the database connection
include('includes/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact = $_POST['contact'];

    // Validate and log the user in
    $sql = "SELECT * FROM Customer WHERE Contact='$contact'";  // You can adjust the query based on the role.
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['contact'] = $contact;
        header('Location: dashboard.php');
    } else {
        echo "Invalid login!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <input type="text" name="contact" placeholder="Contact" required><br>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
