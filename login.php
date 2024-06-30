<?php
 
include_once "connection.php";
 
// Handling POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieving data from the Flutter app
    $ic = $_POST['ic'];
    $password = $_POST['password'];
 
    // Query to check user credentials
    $sql = "SELECT * FROM user WHERE ic = '".$ic."' AND password = '".$password."'";
    $result = $conn->query($sql);
 
    if ($result->num_rows >= 1) {
        // User credentials are valid, fetch user data
        $user = $result->fetch_assoc();
        $response = array(
            "result" => "success",
            "usertype" => $user['usertype']
        );
        echo json_encode($response);
    } else {
        // User credentials are invalid
        $response = array("result" => "error");
        echo json_encode($response);
    }
}
 
// Close the database connection
$conn->close();
?>