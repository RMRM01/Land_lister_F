<?php
include('../includes/header.php');
include('../includes/connection.php');
include('../includes/functions.php');

// Fetch all LAND records owned by this land_owner
$land_owner_id = $_SESSION['user_id'];
$records = isset($_GET['search']) ? 
    searchRecords($conn, 'LAND', 'Category', $_GET['search']) : 
    fetchAllRecords($conn, 'LAND');
?>
<div class="container">
    <h3>Your Owned Land</h3>
    <form method="GET">
        <input type="text" name="search" placeholder="Search Land by Category">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <tr>
            <th>Land ID</th>
            <th>Category</th>
            <th>Price</th>
            <th>Developer ID</th>
        </tr>
        <?php while ($row = $records->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['Land_ID']; ?></td>
                <td><?= $row['Category']; ?></td>
                <td><?= $row['Price']; ?></td>
                <td><?= $row['Developer_ID']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
