<?php
include('../includes/connection.php'); // Include database connection

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Deal WHERE Deal_ID = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manage_deals.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM Deal WHERE Customer_ID LIKE '%$search%' OR Inspector_ID LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Deal Table</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Deal Table</h1>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search by Customer or Inspector" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Deal Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Deal ID</th>
                    <th>Customer ID</th>
                    <th>Inspector ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['Deal_ID']; ?></td>
                    <td><?php echo $row['Customer_ID']; ?></td>
                    <td><?php echo $row['Inspector_ID']; ?></td>
                    <td>
                        <a href="edit_deal.php?id=<?php echo $row['Deal_ID']; ?>">Edit</a>
                        <a href="?delete=<?php echo $row['Deal_ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add New Deal Record -->
        <a href="add_deal.php">Add New Deal Record</a>
    </div>
</body>
</html>
