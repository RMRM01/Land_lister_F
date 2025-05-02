<?php
include('../includes/connection.php'); // Include database connection

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Developer WHERE ID = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manage_developer.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM Developer WHERE Contact LIKE '%$search%' OR License LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Developer</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Developer</h1>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search Developer" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Developer Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Contact</th>
                    <th>License</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['ID']; ?></td>
                    <td><?php echo $row['Contact']; ?></td>
                    <td><?php echo $row['License']; ?></td>
                    <td>
                        <a href="edit_developer.php?id=<?php echo $row['ID']; ?>">Edit</a>
                        <a href="?delete=<?php echo $row['ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add New Developer -->
        <a href="add_developer.php">Add New Developer</a>
    </div>
</body>
</html>
