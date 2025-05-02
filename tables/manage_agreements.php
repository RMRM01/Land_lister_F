<?php
include('../includes/connection.php'); // Include database connection

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Agreement WHERE Agreement_ID = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manage_agreements.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM Agreement WHERE Land_ID LIKE '%$search%' OR Developer_ID LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Agreements</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Agreements</h1>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search Agreement" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Agreements Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Agreement ID</th>
                    <th>Land ID</th>
                    <th>Developer ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['Agreement_ID']; ?></td>
                    <td><?php echo $row['Land_ID']; ?></td>
                    <td><?php echo $row['Developer_ID']; ?></td>
                    <td>
                        <a href="edit_agreement.php?id=<?php echo $row['Agreement_ID']; ?>">Edit</a>
                        <a href="?delete=<?php echo $row['Agreement_ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add New Agreement -->
        <a href="add_agreement.php">Add New Agreement</a>
    </div>
</body>
</html>
