<?php
include 'db.php'; // Ensure this file contains your database connection

// Check if a delete request is made
if (isset($_GET['id']) && isset($_GET['delete']) && $_GET['delete'] == 'true') {
    $userId = $_GET['id'];

    // Prepare and execute the stored procedure to delete the user
    if ($stmt = $conn->prepare("CALL delete_user(?)")) {
        $stmt->bind_param("i", $userId);  // Bind the user ID parameter
        if ($stmt->execute()) {
            // Redirect to the same page after deletion
            header('Location: admin(users).php');
            exit();
        } else {
            echo "Error deleting user: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Failed to prepare statement: " . $conn->error;
    }
}

// Fetch users to display in the table
$sql = "SELECT id, first_name, last_name, email, contact FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoTrack - Users</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f2f2f2;
        }

        header {
            background-color: #2e7d32;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main {
            flex-grow: 1;
            padding: 30px;
        }

        .welcome {
            background-color: #a5d6a7;
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
            background-color: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #c8e6c9;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: gray;
        }

        .footer p {
            margin: 4px 0;
        }

        .actions a {
            margin: 0 5px;
            color: #1565c0;
            text-decoration: none;
        }

        .actions a:hover {
            text-decoration: underline;
        }

        .search-bar {
            text-align: right;
            margin: 20px 0;
        }

        .search-bar input {
            padding: 8px;
            font-size: 14px;
            width: 200px;
        }

        /* Flex layout to organize sidebar and main content */
        .container {
            display: flex;
            height: calc(100vh - 70px); /* Account for header height */
        }

        /* Sidebar styling */
        .sidebar {
            background-color: #ffffff;
            width: 200px;
            padding: 20px 10px;
            border-right: 1px solid #ccc;
            flex-shrink: 0;
        }

        /* Main content area */
        .main {
            flex-grow: 1;
            padding: 30px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

<header>
    <div>
        <h1>EcoTrack</h1>
        <p>Smarter Waste, Greener Cities</p>
    </div>
    <div>
        <p>Thursday, April 03, 2025</p>
        <a class="logout" href="#">LOG OUT</a>
    </div>
</header>

<div class="container">
    <?php include 'sidebar.php'; // Include your sidebar file ?>

    <div class="main">
        <div class="welcome">Welcome, Admin [username]!</div>

        <!-- Search bar -->
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>

        <!-- Table displaying users -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $fullName = $row['first_name'] . ' ' . $row['last_name'];
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$fullName}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['contact']}</td>
                                    <td class='actions'>
                                        <a href='#' onclick='confirmDelete({$row['id']})'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found.</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>

        <div class="footer">
            <p>Privacy Statement | Terms and Condition | Privacy Policy</p>
            <p>&copy;2025 EcoTrack. All Rights Reserved.</p>
        </div>
    </div>
</div>

<script>
  // JavaScript function to confirm user deletion
  function confirmDelete(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        // Redirect to the same page with the delete flag and user ID
        window.location.href = 'admin(users).php?id=' + userId + '&delete=true';
    }
  }
</script>

</body>
</html>
