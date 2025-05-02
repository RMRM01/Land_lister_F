<?php
include('../includes/connection.php'); // Include database connection

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Inspection WHERE Inspection_ID = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manage_inspections.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM Inspection WHERE Land_ID LIKE '%$search%' OR Inspector_ID LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Inspections</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Inspections</h1>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search Inspections" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Inspections Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Inspection ID</th>
                    <th>Land ID</th>
                    <th>Inspector ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['Inspection_ID']; ?></td>
                    <td><?php echo $row['Land_ID']; ?></td>
                    <td><?php echo $row['Inspector_ID']; ?></td>
                    <td>
                        <a href="edit_inspection.php?id=<?php echo $row['Inspection_ID']; ?>">Edit</a>
                        <a href="?delete=<?php echo $row['Inspection_ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add New Inspection Record -->
        <a href="add_inspection.php">Add New Inspection Record</a>
    </div>
</body>
</html>
