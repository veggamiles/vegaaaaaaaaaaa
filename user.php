<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document Management System</title>
<style>
    /* General styles */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        background-image: url('bg.jpeg');
        background-size: cover;
    }

    header {
        background-color: #333;
        color: #fff;
        padding: 10px 0;
        text-align: center;
    }

    nav {
        background-color: #444;
        color: #fff;
        padding: 10px 0;
        text-align: center;
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin: 0 10px;
    }

    nav ul li a {
        color: #fff;
        text-decoration: none;
    }

    main {
        padding: 20px;
    }

    h1 {
        margin-top: 0;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        overflow: hidden;
    }

    /* Document table styles */
    .document-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .document-table th, .document-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .document-table th {
        background-color: #333;
        color: #fff;
    }

    .document-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .document-table tr:hover {
        background-color: #ddd;
    }

    /* Button styles */
    .button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
    }

    .button:hover {
        background-color: #45a049;
    }

    /* User section styles */
    .user-section {
        background-color: #fff;
        padding: 20px;
        margin-top: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .user-section h2 {
        margin-top: 0;
    }

    .user-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-gap: 20px;
    }

    .user-details label {
        font-weight: bold;
    }

    .user-details p {
        margin: 0;
    }
</style>
</head>
<body>

<header>
    <h1>Document Management System</h1>
</header>

<nav>
    <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">Documents</a></li>
        <li><a href="#">Folders</a></li>
        <li><a href="#">Tags</a></li>
        <li><a href="#">Settings</a></li>
    </ul>
</nav>

<main>
    <div class="container">
        <!-- Document Table -->
        <h2>Document List</h2>
        <table class="document-table">
            <thead>
                <tr>
                    <th>Document ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th>Upload Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Proposal</td>
                    <td>Business</td>
                    <td>JohnDoe</td>
                    <td>2024-05-23</td>
                    <td>Active</td>
                </tr>
                <!-- More document rows here -->
            </tbody>
        </table>
        <button class="button">Upload Document</button>
        
        <!-- User Section -->
        <div class="user-section">
            <h2>User Details</h2>
            <div class="user-details">
                <div>
                    <label for="username">Username:</label>
                    <p>JohnDoe</p>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <p>johndoe@example.com</p>
                </div>
                <div>
                    <label for="role">Role:</label>
                    <p>Administrator</p>
                </div>
                <div>
                    <label for="last-login">Last Login:</label>
                    <p>2022-05-25 09:30 AM</p>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>