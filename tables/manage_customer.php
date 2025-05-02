<?php
include('../includes/connection.php'); // Include database connection

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Customer WHERE ID = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manage_customer.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM Customer WHERE Contact LIKE '%$search%' OR Bank_Details LIKE '%$search%' OR Tax_Status LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Customer</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Customer</h1>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search Customer" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Customer Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contact</th>
                    <th>Bank Details</th>
                    <th>Tax Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['Contact']; ?></td>
                    <td><?php echo $row['Bank_Details']; ?></td>
                    <td><?php echo $row['Tax_Status']; ?></td>
                    <td>
                        <a href="edit_customer.php?id=<?php echo $row['ID']; ?>">Edit</a>
                        <a href="?delete=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add New Customer -->
        <a href="add_customer.php">Add New Customer</a>
    </div>
</body>
</html>
