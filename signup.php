<?php

include_once "connection.php";
// Handling POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieving data from the Flutter app
    $ic = $_POST['ic'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $usertype = "user";

    // Inserting data into the database
    $sql = "INSERT INTO user (ic, name, email, password, address, phone, usertype) 
    VALUES ('$ic', '$name', '$email', '$password', '$address', '$phone', '$usertype')";

    if ($conn->query($sql) === TRUE) {
        // Sending a success response to the Flutter app
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        // Sending an error response to the Flutter app
        $response = array("success" => false);
        echo json_encode($response);
    }
}

// Close the database connection
$conn->close();
?>
