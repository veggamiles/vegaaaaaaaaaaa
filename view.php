<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connection.php");

if(isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id']; 

    $sql = "SELECT id, document_name, document_type, uploader_name, upload_date, description, file_size FROM document WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc(); 

        echo "<h2>Document Details</h2>";
        echo "<p><strong>ID:</strong> " . $row["id"] . "</p><br>";
        echo "<p><strong>Document Name:</strong> " . $row["document_name"] . "</p><br>";
        echo "<p><strong>Document Type:</strong> " . $row["document_type"] . "</p><br>";
        echo "<p><strong>Uploader Name:</strong> " . $row["uploader_name"] . "</p><br>";
        echo "<p><strong>Upload Date:</strong> " . $row["upload_date"] . "</p><br>";
        echo "<p><strong>Description:</strong> " . $row["description"] . "</p><br>";
        echo "<p><strong>File Size:</strong> " . $row["file_size"] . "</p><br>";
    } else {
        echo "Document record not found."; 
    }
} else {
    echo "Invalid request."; 
}
?>