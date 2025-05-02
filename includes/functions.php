<?php
function fetchAllRecords($conn, $table)
{
    $query = "SELECT * FROM $table";
    return $conn->query($query);
}

function searchRecords($conn, $table, $searchColumn, $searchValue)
{
    $query = "SELECT * FROM $table WHERE $searchColumn LIKE '%$searchValue%'";
    return $conn->query($query);
}
?>
