<?php
include '../aetsconn.php'; 

$tables = [];
$result = mysqli_query($conn, "SHOW TABLES");
while ($row = mysqli_fetch_array($result)) {
    $tables[] = $row[0];
}

foreach ($tables as $table) {
    $query = "SHOW CREATE TABLE $table";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    echo "<pre>{$row['Create Table']}</pre><br><br>";
}
?>
