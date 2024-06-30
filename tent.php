<?php
header('Content-Type: application/json');

include_once "connection.php"; // Ensure this file exists and includes database connection

$sql = "SELECT TentName, Price, Capacity, Description FROM tent";
$result = $conn->query($sql);

$tents = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $tents[] = $row;
    }
} else {
    echo json_encode([]);
}

$conn->close();

echo json_encode($tents);
?>
