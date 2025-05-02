<?php
include('../includes/header.php');
include('../includes/connection.php');
include('../includes/functions.php');

// Fetch agreements for this developer
$developer_id = $_SESSION['user_id'];
$records = isset($_GET['search']) ? 
    searchRecords($conn, 'Agreement', 'Land_ID', $_GET['search']) : 
    fetchAllRecords($conn, 'Agreement');
?>
<div class="container">
    <h3>Your Agreements</h3>
    <form method="GET">
        <input type="text" name="search" placeholder="Search by Land ID">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <tr>
            <th>Agreement ID</th>
            <th>Land ID</th>
        </tr>
        <?php while ($row = $records->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['Agreement_ID']; ?></td>
                <td><?= $row['Land_ID']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>

