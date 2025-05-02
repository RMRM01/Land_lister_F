<?php
include('../includes/connection.php');

// Handle form submissions for Create, Update, and Delete operations
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Add Land
    if (isset($_POST['add_land'])) {
        $category = $_POST['category'];
        $price = $_POST['price'];
        $land_owner_id = $_POST['land_owner_id'];
        $developer_id = $_POST['developer_id'];

        $sql = "INSERT INTO LAND (Category, Price, Land_Owner_ID, Developer_ID) 
                VALUES ('$category', '$price', '$land_owner_id', '$developer_id')";
        mysqli_query($conn, $sql);
    }

    // Update Land
    if (isset($_POST['update_land'])) {
        $land_id = $_POST['land_id'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $land_owner_id = $_POST['land_owner_id'];
        $developer_id = $_POST['developer_id'];

        $sql = "UPDATE LAND SET 
                Category = '$category', 
                Price = '$price', 
                Land_Owner_ID = '$land_owner_id', 
                Developer_ID = '$developer_id' 
                WHERE Land_ID = '$land_id'";
        mysqli_query($conn, $sql);
    }

    // Delete Land
    if (isset($_POST['delete_land'])) {
        $land_id = $_POST['land_id'];
        $sql = "DELETE FROM LAND WHERE Land_ID = '$land_id'";
        mysqli_query($conn, $sql);
    }
}

// Fetch all land records
$result = mysqli_query($conn, "SELECT * FROM land");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage LAND</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h2>Manage LAND</h2>
        <!-- Add Land Form -->
        <form method="POST">
            <input type="text" name="category" placeholder="Category" required>
            <input type="number" step="0.01" name="price" placeholder="Price" required>
            <input type="number" name="land_owner_id" placeholder="Land Owner ID" required>
            <input type="number" name="developer_id" placeholder="Developer ID" required>
            <button type="submit" name="add_land">Add Land</button>
        </form>

        <!-- Display Land Records -->
        <table border="1">
            <tr>
                <th>Land ID</th>
                <th>Category</th>
                <th>Price</th>
                <th>Land Owner ID</th>
                <th>Developer ID</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['Land_ID']; ?></td>
                    <td><?= $row['Category']; ?></td>
                    <td><?= $row['Price']; ?></td>
                    <td><?= $row['Land_Owner_ID']; ?></td>
                    <td><?= $row['Developer_ID']; ?></td>
                    <td>
                        <!-- Edit Button -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="land_id" value="<?= $row['Land_ID']; ?>">
                            <input type="text" name="category" value="<?= $row['Category']; ?>" required>
                            <input type="number" step="0.01" name="price" value="<?= $row['Price']; ?>" required>
                            <input type="number" name="land_owner_id" value="<?= $row['Land_Owner_ID']; ?>" required>
                            <input type="number" name="developer_id" value="<?= $row['Developer_ID']; ?>" required>
                            <button type="submit" name="update_land">Update</button>
                        </form>
                        <!-- Delete Button -->
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="land_id" value="<?= $row['Land_ID']; ?>">
                            <button type="submit" name="delete_land">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
