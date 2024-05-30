<?php

include("connection.php");


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
    <!-- Page content -->
    <div id="main-content" class="main-content">
   
  

    <div id="tableContainer" style="display: block;">
    <center>
        <h4 id="text2">Document Information</h4> <br>
    </center>
    <table id="myTable">
        <tr>
            <th>ID</th>
            <th>Document Name</th>
            <th>Document Type</th>
            <th>Uploader Name</th>
            <th>Upload Date</th>
            <th>Description</th>
            <th>File Size</th>
            <th>Action</th>
        </tr>
        <?php
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT id, document_name, document_type, uploader_name, upload_date, description, file_size FROM document";
        $result = $conn->query($sql);

        if ($result === false) {
            die("Error executing query: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["document_name"] . "</td><td>" .
                    $row["document_type"] . "</td><td>" . $row["uploader_name"] . "</td><td>" .
                    $row["upload_date"] . "</td><td>" . $row["description"] . "</td><td>" .
                    $row["file_size"] . "</td><td>" .
                    "<button class='action-button view-button' onclick='viewEvent(" . $row["id"] . ")'>View</button>" .
                    "<button class='action-button update-button' onclick='updateEvent(" . $row["id"] . ")'>Update</button>" .
                    "<div class='button-group'>" .
                    "<form method='GET' action='delete.php'>" .
                    "<input type='hidden' name='delete_id' value='" . $row['id'] . "'>" .
                    "<button type='submit' class='action-button delete-button'>Delete</button>" .
                    "</form>" .
                    "</div></td></tr>";
            }
        } else {
            echo "<tr><td colspan='8'>0 results</td></tr>";
        }

        echo "</table>";

        $conn->close();
        ?>
    </table>
</div>

    <!-- Modal for view, update, delete -->

    <div id="myModal" class="modal" style="display: none;">
        <div class="modal-content" style="margin: 15% auto; width: 50%;">
            <span class="close" onclick="closeModal()">×</span>
            <div id="modalContent"></div>
        </div>
    </div>
    </div>
    <script>
        function viewEvent(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("modalContent").innerHTML = this.responseText;
                    document.getElementById("myModal").style.display = "block";
                }
            };
            xhttp.open("GET", "view.php?id=" + id, true);
            xhttp.send();
        }

        function updateEvent(id) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("modalContent").innerHTML = this.responseText;
                    document.getElementById("myModal").style.display = "block";
                }
            };
            xhttp.open("GET", "update.php?id=" + id, true);
            xhttp.send();
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }
    </script>
  <script>
        document.getElementById('toggleSidebarBtn').addEventListener('click', function () {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('main-content').classList.toggle('active');
        });
    </script>
</body>

</html>
<?php
