<?php
session_start();
include 'db.php';


if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: Home.php");
    exit();
}

$username = $_SESSION['username'];

// Fetch admin details
$query = "SELECT username FROM admin WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Use 'username' directly since there's no 'name' column
$adminName = $admin['username'];
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_id'])) {
    $id = $_POST['edit_id'];
    $firstName = trim($_POST['edit_first_name']);
    $lastName = trim($_POST['edit_last_name']);
    $email = trim($_POST['edit_email']);
    $contact = trim($_POST['edit_contact']);

    // Simple server-side validation
    if (empty($firstName) || empty($lastName) || empty($email) || empty($contact)) {
        echo "<script>alert('All fields are required.'); window.history.back();</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.history.back();</script>";
        exit();
    }

    if (!preg_match('/^\+?\d{10,15}$/', $contact)) {
        echo "<script>alert('Invalid phone number.'); window.history.back();</script>";
        exit();
    }

        if ($stmt = $conn->prepare("CALL update_user(?, ?, ?, ?, ?)")) {
            $stmt->bind_param("issss", $id, $firstName, $lastName, $email, $contact);
            if ($stmt->execute()) {
                header('Location: admin(users).php');
                exit();
            } else {
                echo "Error updating user: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Failed to prepare statement: " . $conn->error;
        }
}


// Fetch users to display in the table
$sql = "SELECT id, first_name, last_name, email, contact FROM table_users_registration";
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
      margin: 0;
      overflow: hidden;
    }

    .background-image {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: url('truck1.png');
      background-size: cover;
      background-repeat: no-repeat;
      z-index: -1;
    }

        .container {
      display: flex;
      height: calc(100vh - 70px);
       position: relative;
       
    }

    .sidebar {
      background-color: #ffffff;
      width: 200px;
      padding: 20px 10px;
      border-right: 1px solid #ccc;
      position: relative;
    }

        header {
      background-color: #2e7d32;
      color: white;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 {
      font-size: 32px;
    }

    header p {
      font-size: 18px;
         }

        .main {
            flex-grow: 1;
            padding: 30px;
             position: relative; /* Needed for z-index */
      background-color: rgba(242, 242, 242, 0.8); 
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

        .container {
            display: flex;
            height: calc(100vh - 70px);
              position: relative;
        }

        .sidebar {
            background-color: #ffffff;
            width: 200px;
            padding: 20px 10px;
            border-right: 1px solid #ccc;
            flex-shrink: 0;
            position: relative;
        }

        .main {
            flex-grow: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            position: relative;
        }

        .modal-header {
            background-color: #2e7d32;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 5px 5px 0 0;
        }

        .modal-buttons {
            text-align: right;
            margin-top: 20px;
        }

        .modal-buttons button {
            margin-left: 10px;
            padding: 8px 16px;
        }

        .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            color: yellow;
            font-weight: bold;
            cursor: pointer;
        }

        .highlight-delete {
            color: red;
        }

        .highlight-action {
            color: #1565c0;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="background-image"></div>

<header>
  <div>
    <h1>EcoTrack</h1>
    <p>Smarter Waste, Greener Cities</p>
  </div>
  <div>
    <p><?= date('l, F d, Y') ?></p>
  </div>
</header>

<div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="main">
    <div class="welcome">Welcome, <?= htmlspecialchars($adminName) ?>!</div>


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
                                        <a href='#' onclick=\"showEditModal({$row['id']}, '{$row['first_name']}', '{$row['last_name']}', '{$row['email']}', '{$row['contact']}')\">Edit</a>
                                        <a href='#' onclick=\"confirmDelete({$row['id']}, '{$fullName}', '{$row['email']}')\">Delete</a>
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

<!-- Delete Modal -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close-btn" onclick="closeDeleteModal()">X</span>
            <h2>Delete User</h2>
        </div>
        <p>Are you sure you want to <span class="highlight-delete">delete</span> this user?</p>
        <p>This action cannot be undone.</p>
        <p><strong>User:</strong> <span id="delete_user_name"></span></p>
        <p><strong>Email:</strong> <span id="delete_user_email"></span></p>
        <div class="modal-buttons">
            <button onclick="closeDeleteModal()">Cancel</button>
            <button onclick="proceedDelete()">Confirm <span class="highlight-delete">Delete</span></button>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" class="modal">
    <div class="modal-content" style="width: 320px; border: 2px solid #2e7d32; border-radius: 6px;">
        <div style="background-color: #2e7d32; color: white; text-align: center; padding: 10px 0; position: relative;">
            <span class="close-btn" onclick="closeEditModal()" style="position: absolute; top: 10px; right: 15px; color: yellow; cursor: pointer;">X</span>
            <div style="font-size: 24px; font-weight: bold;">EcoTrack</div>
            <div style="font-size: 12px;">SMARTER WASTE, CLEANER CITIES</div>
        </div>
        <div style="padding: 20px;">
            <p style="text-align: center; margin-bottom: 20px;">Update the user details below:</p>
<!-- Inside the Edit Modal Form -->
<form method="POST">
    <input type="hidden" name="edit_id" id="edit_id">
    <label>First Name:</label><br>
    <input type="text" name="edit_first_name" id="edit_first_name" style="width: 100%; padding: 6px; margin-bottom: 10px;"><br>
    
    <label>Last Name:</label><br>
    <input type="text" name="edit_last_name" id="edit_last_name" style="width: 100%; padding: 6px; margin-bottom: 10px;"><br>

    <label>Email:</label><br>
    <input type="email" name="edit_email" id="edit_email" style="width: 100%; padding: 6px; margin-bottom: 10px;"><br>

    <label>Phone:</label><br>
    <input type="text" name="edit_contact" id="edit_contact" style="width: 100%; padding: 6px; margin-bottom: 10px;"><br>


    <button type="submit" style="width: 100%; background-color: #2e7d32; color: white; padding: 10px; border: none; cursor: pointer;">Save Changes</button>
</form>

        </div>
    </div>
</div>


<script>
  let deleteUserId = null;

  function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
  }

  function confirmDelete(userId, name, email) {
    deleteUserId = userId;
    document.getElementById('delete_user_name').textContent = name;
    document.getElementById('delete_user_email').textContent = email;
    document.getElementById('deleteModal').style.display = 'block';
  }
  function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    deleteUserId = null;
  }
  function proceedDelete() {
    if (deleteUserId !== null) {
      window.location.href = 'admin(users).php?id=' + deleteUserId + '&delete=true';
    }
  }

  function showEditModal(id, firstName, lastName, email, contact) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_first_name').value = firstName;
    document.getElementById('edit_last_name').value = lastName;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_contact').value = contact; 
    document.getElementById('editModal').style.display = 'block';
}

</script>

<script>
document.querySelector("form").addEventListener("submit", function (e) {
    const firstName = document.getElementById("edit_first_name").value.trim();
    const lastName = document.getElementById("edit_last_name").value.trim();
    const email = document.getElementById("edit_email").value.trim();
    const contact = document.getElementById("edit_contact").value.trim();

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const phonePattern = /^\+?\d{10,15}$/;

    if (firstName === "" || lastName === "" || email === "" || contact === "") {
        alert("All fields are required.");
        e.preventDefault();
        return;
    }

    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        e.preventDefault();
        return;
    }

    if (!phonePattern.test(contact)) {
        alert("Please enter a valid phone number.");
        e.preventDefault();
        return;
    }
});
</script>


</body>
</html>
