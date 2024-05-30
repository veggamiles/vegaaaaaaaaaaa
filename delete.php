<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'connection.php';


function deleteRecord($id) {
    global $conn;
    $delete_query = "DELETE FROM document WHERE id = '$id'";
    if (mysqli_query($conn, $delete_query)) {
        return true;
    } else {
        return false;
    }
}

// Check if record deletion is confirmed
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    echo "<script>
            var result = confirm('Are you sure you want to delete this record?');
            if (result) {
                window.location.href='delete.php?confirmed_delete_id=$delete_id';
            } else {
                window.location.href='view_record.php';
            }
          </script>";
}

// Check if confirmed deletion is triggered
if (isset($_GET['confirmed_delete_id'])) {
    $confirmed_delete_id = $_GET['confirmed_delete_id'];
    if (deleteRecord($confirmed_delete_id)) {
        session_start();
        $_SESSION['record_deleted'] = true;
    
 
        header("refresh:1; url=view_record.php");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
