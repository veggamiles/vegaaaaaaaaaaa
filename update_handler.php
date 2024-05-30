<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connection.php");

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = isset($_POST['id']) ? sanitize_input($_POST['id']) : "";
    $document_name = isset($_POST['document_name']) ? sanitize_input($_POST['document_name']) : "";
    $document_type = isset($_POST['document_type']) ? sanitize_input($_POST['document_type']) : "";
    $uploader_name = isset($_POST['uploader_name']) ? sanitize_input($_POST['uploader_name']) : "";
    // Assuming upload_date is not user-input, but rather handled by the system (like TIMESTAMP DEFAULT CURRENT_TIMESTAMP in the database)
    $upload_date = isset($_POST['upload_date']) ? $_POST['upload_date'] : "";
    $description = isset($_POST['description']) ? sanitize_input($_POST['description']) : "";
    $file_size = isset($_POST['file_size']) ? sanitize_input($_POST['file_size']) : "";

    if (empty($id) || empty($document_name) || empty($document_type) || empty($uploader_name) || empty($upload_date) || empty($description) || empty($file_size)) {
        echo "All fields are required.";
    } else {
        $sql = "UPDATE document SET document_name='$document_name', document_type='$document_type', uploader_name='$uploader_name', upload_date='$upload_date', description='$description', file_size='$file_size' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Data updated successfully'); window.location.href = 'view_record.php';</script>";
            exit();
        } else {
            echo "Error updating data: " . $conn->error;
        }
    }
} else {
    header("Location: view_record.php");
    exit();
}
?>