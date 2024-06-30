<?php
// Ensure POST request method is used
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    include_once "connection.php"; // Ensure this file exists and includes database connection
    
    // Get POST data
    $data = json_decode(file_get_contents("php://input"));
    
    // Prepare data
    $TentID = $data->TentID;
    $TentName = $data->TentName;
    $Price = $data->Price;
    $Capacity = $data->Capacity;
    $Description = $data->Description;
    
    // File upload handling
    if ($_FILES['TentImage']['error'] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['TentImage']['name'];
        $file_tmp = $_FILES['TentImage']['tmp_name'];
        $file_type = $_FILES['TentImage']['type'];
        
        // Specify the target directory where you want to store uploaded files
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file_name);
        
        // Move uploaded file to specified directory
        if (move_uploaded_file($file_tmp, $target_file)) {
            // File upload success, proceed with database insertion
            $sql = "INSERT INTO tent (TentID, TentName, Price, Capacity, Description, TentImage)
                    VALUES ('$TentID', '$TentName', '$Price', '$Capacity', '$Description', '$target_file')";
            
            if ($conn->query($sql) === TRUE) {
                // Success response
                http_response_code(200);
                echo json_encode(array("message" => "Tent added successfully"));
            } else {
                // Error response
                http_response_code(500);
                echo json_encode(array("message" => "Error adding tent: " . $conn->error));
            }
        } else {
            // Error moving uploaded file
            http_response_code(500);
            echo json_encode(array("message" => "Error uploading file"));
        }
    } else {
        // No file uploaded or error in file upload
        http_response_code(400);
        echo json_encode(array("message" => "No file uploaded or error in file upload"));
    }
    
    $conn->close();
    
} else {
    // Method not allowed
    http_response_code(405);
    echo json_encode(array("message" => "Method Not Allowed"));
}
?>
