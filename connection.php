<?php
// Database credentials
$db_host = 'localhost';     // Hostname
$db_user = 'root';     // Database username
$db_pass = ''; // Database password
$db_name = 'glamping_park';     // Database name
 
// Attempt database connection
$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
 
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>