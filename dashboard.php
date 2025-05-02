<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['contact']) || !isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}

// Retrieve the user's contact and role from the session
$user_contact = $_SESSION['contact'];
$user_role = $_SESSION['role']; // Assuming 'role' is stored during login

// Redirect to the appropriate dashboard based on the role
switch ($user_role) {
    case 'Customer':
        header('Location: ../roles/customer.php');
        exit();
    case 'Developer':
        header('Location: ../roles/developer.php');
        exit();
    case 'Inspector':
        header('Location: ../roles/inspector.php');
        exit();
    case 'Land_owner':
        header('Location: ../roles/land_owner.php');
        exit();
    default:
        // Handle unknown roles
        echo "Invalid role detected. Please contact support.";
        exit();
}
?>
