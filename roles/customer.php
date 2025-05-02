<?php
include('../includes/header.php');
include('../includes/connection.php');
include('../includes/functions.php');

// Fetch transactions for this customer
$customer_id = $_SESSION['user_id'];
$records = isset($_GET['search']) ? 
    searchRecords($conn, 'Transaction', 'Bill', $_GET['search']) : 
    fetchAllRecords($conn, 'Transaction');
?>
<div class="container">
    <h3>Your Transactions</h3>
    <form method="GET">
        <input type="text" name="search" placeholder="Search by Bill">
        <button type="submit">Search</button>
    </form>
    <table border="1">
        <tr>
            <th>Transaction ID</th>
            <th>Payment</th>
            <th>Time Stamp</th>
            <th>Bill</th>
            <th>Land ID</th>
        </tr>
        <?php while ($row = $records->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['Transaction_ID']; ?></td>
                <td><?= $row['Payment']; ?></td>
                <td><?= $row['Time_Stamp']; ?></td>
                <td><?= $row['Bill']; ?></td>
                <td><?= $row['Land_ID']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
