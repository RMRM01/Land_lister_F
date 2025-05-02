<?php
include('../includes/connection.php'); // Include database connection

// Handle delete operation
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM Transaction WHERE Transaction_ID = $id";
    if (mysqli_query($conn, $query)) {
        header('Location: manage_transactions.php');
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Search functionality
$search = $_GET['search'] ?? '';
$query = "SELECT * FROM Transaction WHERE Bill LIKE '%$search%' OR Payment LIKE '%$search%'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transactions</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Transactions</h1>

        <!-- Search Form -->
        <form method="GET">
            <input type="text" name="search" placeholder="Search Transaction" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Transaction Table -->
        <table border="1">
            <thead>
                <tr>
                    <th>Transaction ID</th>
                    <th>Payment</th>
                    <th>Time Stamp</th>
                    <th>Bill</th>
                    <th>Customer ID</th>
                    <th>Land ID</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['Transaction_ID']; ?></td>
                    <td><?php echo $row['Payment']; ?></td>
                    <td><?php echo $row['Time_Stamp']; ?></td>
                    <td><?php echo $row['Bill']; ?></td>
                    <td><?php echo $row['Customer_ID']; ?></td>
                    <td><?php echo $row['Land_ID']; ?></td>
                    <td>
                        <a href="edit_transaction.php?id=<?php echo $row['Transaction_ID']; ?>">Edit</a>
                        <a href="?delete=<?php echo $row['Transaction_ID']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Add New Transaction -->
        <a href="add_transaction.php">Add New Transaction</a>
    </div>
</body>
</html>
