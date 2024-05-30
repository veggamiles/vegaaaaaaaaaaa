<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("connection.php");

 $document_name = $document_type = $uploader_name = $upload_date = $description = $file_size = "";
$document_nameErr = $document_typeErr = $uploader_nameErr = $upload_dateErr = $descriptionErr = $file_sizeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

    if (empty($_POST["document_name"])) {
        $document_nameErr = "Document name is required";
    } else {
        $document_name = test_input($_POST["document_name"]);
    }

    if (empty($_POST["document_type"])) {
        $document_typeErr = "Document type is required";
    } else {
        $document_type = test_input($_POST["document_type"]);
    }

    if (empty($_POST["uploader_name"])) {
        $uploader_nameErr = "Uploader name is required";
    } else {
        $uploader_name = test_input($_POST["uploader_name"]);
    }

    // Assuming upload_date is not user-input, but rather handled by the system (like TIMESTAMP DEFAULT CURRENT_TIMESTAMP in the database)

    if (empty($_POST["description"])) {
        $descriptionErr = "Description is required";
    } else {
        $description = test_input($_POST["description"]);
    }

    if (empty($_POST["file_size"])) {
        $file_sizeErr = "File size is required";
    } else {
        $file_size = test_input($_POST["file_size"]);
    }

    if (empty($idErr) && empty($document_nameErr) && empty($document_typeErr) && empty($uploader_nameErr) && empty($descriptionErr) && empty($file_sizeErr)) {

        $stmt = $conn->prepare("INSERT INTO document (id, document_name, document_type, uploader_name, upload_date, description, file_size) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP, ?, ?)");
        $stmt->bind_param("issssi", $id, $document_name, $document_type, $uploader_name, $description, $file_size);

        if ($stmt->execute()) {
            echo "<script>alert('Record successfully added'); window.location.href = 'index.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Function to sanitize and validate input
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>   DOCUMENT  MANAGEMENT</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
  
    <!-- Sidebar -->
    <div id="sidebar" class="sidebar">
        <a href="index.php">Add  Document</a>
        <a href="view_record.php"> Document Information</a>   
         <a href="login.php">Logout</a>
    </div>


    <!-- Button to toggle sidebar -->
    <button id="toggleSidebarBtn" class="sidebar-toggle-btn">&#9776; </button>
    <div class="container">
    <h4>Add Document Record</h4><br>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="inputbox-row top">
          

            <div class="inputbox">
                <label for="document_name">Document Name:</label><br>
                <input type="text" id="document_name" name="document_name" placeholder="Document Name" value="<?php echo htmlspecialchars($document_name); ?>"><br>
                <span class="error"><?php echo $document_nameErr; ?></span><br>
            </div>

            <div class="inputbox">
                <label for="document_type">Document Type:</label><br>
                <input type="text" id="document_type" name="document_type" placeholder="Document Type" value="<?php echo htmlspecialchars($document_type); ?>"><br>
                <span class="error"><?php echo $document_typeErr; ?></span><br>
            </div>
        </div>

        <div class="inputbox-row middle">
            <div class="inputbox">
                <label for="uploader_name">Uploader Name:</label><br>
                <input type="text" id="uploader_name" name="uploader_name" placeholder="Uploader Name" value="<?php echo htmlspecialchars($uploader_name); ?>"><br>
                <span class="error"><?php echo $uploader_nameErr; ?></span><br>
            </div>

            <div class="inputbox">
                <label for="upload_date">Upload Date:</label><br>
                <input type="datetime-local" id="upload_date" name="upload_date" value="<?php echo date('Y-m-d\TH:i', strtotime($upload_date)); ?>"><br>
                <span class="error"><?php echo $upload_dateErr; ?></span><br>
            </div>

            <div class="inputbox">
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" placeholder="Description"><?php echo htmlspecialchars($description); ?></textarea><br>
                <span class="error"><?php echo $descriptionErr; ?></span><br>
            </div>
        </div>

        <div class="inputbox-row bottom">
            <div class="inputbox">
                <label for="file_size">File Size:</label><br>
                <input type="text" id="file_size" name="file_size" placeholder="File Size" value="<?php echo htmlspecialchars($file_size); ?>"><br>
                <span class="error"><?php echo $file_sizeErr; ?></span><br>
            </div>
        </div>
        
        <div class="custom-button-container">
            <button type="submit" name="submit" value="Add Document Record" class="custom-button">Add Document Record</button>
        </div>
    </form>
</div>


</div>


<script>
        document.getElementById('toggleSidebarBtn').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        });
    </script>

</body>
</html>
<?php

