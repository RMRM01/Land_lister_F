<?php
include('../includes/header.php');
include('../includes/connection.php');
include('../includes/functions.php');

// Fetch inspections for this inspector
$inspector_id = $_SESSION['user_id'];
$records = isset($_GET['search']) ? 
    searchRecords($conn, 'Inspection', 'Land_ID', $_GET['search']) : 
    fetchAllRecords($conn, 'Inspection');
?>
<div class="container">
    <h3>Your Inspections</h3>
    <form method="GET">
        <input type="text" name="search" placeholder="Search by Land ID">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <tr>
            <th>Inspection ID</th>
            <th>Land ID</th>
        </tr>
        <?php while ($row = $records->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['Inspection_ID']; ?></td>
                <td><?= $row['Land_ID']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>

