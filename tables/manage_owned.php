<?php
include('../includes/connection.php'); // Include database connection

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Owned WHERE Owned_ID = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manage_owned.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM Owned WHERE Land_ID LIKE '%$search%' OR Land_Owner_ID LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Owned</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Owned Lands</h1>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search Owned Records" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Owned Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Owned ID</th>
                    <th>Land ID</th>
                    <th>Land Owner ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['Owned_ID']; ?></td>
                    <td><?php echo $row['Land_ID']; ?></td>
                    <td><?php echo $row['Land_Owner_ID']; ?></td>
                    <td>
                        <a href="edit_owned.php?id=<?php echo $row['Owned_ID']; ?>">Edit</a>
                        <a href="?delete=<?php echo $row['Owned_ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add New Owned Record -->
        <a href="add_owned.php">Add New Owned Record</a>
    </div>
</body>
</html>

