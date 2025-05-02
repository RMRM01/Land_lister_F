<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo ucfirst($_SESSION['role']); ?> Dashboard</title>
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo ucfirst($_SESSION['role']); ?></h2>
        <a href="../logout.php">Logout</a>
    </div>
