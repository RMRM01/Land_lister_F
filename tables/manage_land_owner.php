<?php
include('../includes/connection.php'); // Database connection

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM LAND_OWNER WHERE ID = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manage_land_owner.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM LAND_OWNER WHERE Contact LIKE '%$search%' OR Bank_Details LIKE '%$search%' OR Location LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage LAND_OWNER</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage LAND_OWNER</h1>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search LAND_OWNER" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- LAND_OWNER Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contact</th>
                    <th>Bank Details</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['Contact']; ?></td>
                    <td><?php echo $row['Bank_Details']; ?></td>
                    <td><?php echo $row['Location']; ?></td>
                    <td>
                        <a href="edit_land_owner.php?id=<?php echo $row['ID']; ?>">Edit</a>
                        <a href="?delete=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add New LAND_OWNER -->
        <a href="add_land_owner.php">Add New LAND_OWNER</a>
    </div>
</body>
</html>
