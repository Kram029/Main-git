<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
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

$adminName = $admin['username'];

$conn = new mysqli("localhost", "root", "", "adbms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$success_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['resolve_id'])) {
    $id = (int) $_POST['resolve_id'];
    $stmt = $conn->prepare("DELETE FROM reports WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $success_message = "✅ Report ID $id has been resolved successfully.";
    } else {
        $success_message = "❌ Failed to resolve the report.";
    }
    $stmt->close();
}

$result = $conn->query("SELECT * FROM reports ORDER BY created_at DESC");
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoTrack - Reports</title>
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

        header {
            background-color: #2e7d32;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
             position: relative; 
        }

        header h1 { font-size: 20px; }
        header p { font-size: 14px; }
        
        .logout {
            color: white;
            font-size: 14px;
            text-decoration: none;
        }
        .container {
            display: flex;
            height: calc(100vh - 80px);
            position: relative;
        }
        .main {
            flex-grow: 1;
            padding: 30px;
            overflow-y: auto;
            position: relative; 
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
            margin-top: 20px;
            background-color: #ffffff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #c8e6c9;
        }
        .actions a {
            color: #1565c0;
            text-decoration: none;
            cursor: pointer;
        }
        .actions a:hover {
            text-decoration: underline;
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
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            justify-content: center; align-items: center;
            font-family: Arial, sans-serif;
        }
        .modal-content {
            background-color: #ffffff;
            border-radius: 10px;
            width: 420px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            overflow: hidden;
            animation: fadeIn 0.3s ease;
        }
        .modal-header {
            background-color: #2e7d32;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-header h3 {
            margin: 0;
            font-size: 18px;
        }
        .close {
            color: white;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover { color: #c8e6c9; }
        .modal-body {
            padding: 20px;
            font-size: 14px;
            color: #333;
        }
        .modal-body p {
            margin-bottom: 10px;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
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
        <p><?php echo date("l, F d, Y"); ?></p>
    </div>
</header>

<div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="main">
        <div class="welcome">Welcome, <?= htmlspecialchars($adminName) ?>!</div>

        <?php if (!empty($success_message)) : ?>
            <p style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; border-radius: 5px; margin: 20px 0;">
                <?php echo $success_message; ?>
            </p>
        <?php endif; ?>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['report_title']); ?></td>
                    <td><?php echo htmlspecialchars(substr($row['report_content'], 0, 50)) . '...'; ?></td>
                    <td><?php echo date("F j, Y, g:i A", strtotime($row['created_at'])); ?></td>

                    <td class="actions">
                        <a href="#" onclick="openModal(
                            <?php echo $row['id']; ?>,
                            '<?php echo htmlspecialchars(addslashes($row['report_title'])); ?>',
                            '<?php echo date("F j, Y, g:i A", strtotime($row['created_at'])); ?>',

                            `<?php echo htmlspecialchars(addslashes($row['report_content'])); ?>`
                        ) ">View</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </tbody>
        </table>

        <div class="footer">
            <p>Privacy Statement | Terms and Condition | Privacy Policy</p>
            <p>&copy;2025 EcoTrack. All Rights Reserved.</p>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Report Details</h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <p><strong>Title:</strong> <span id="modalTitle"></span></p>
            <p><strong>Date:</strong> <span id="modalDate"></span></p>
            <p><strong>Content:</strong></p>
            <p id="modalContent" style="white-space: pre-wrap;"></p>

            <div style="margin-top: 20px; text-align: right;">
                <form id="resolveForm" method="post" style="display: inline;">
                    <input type="hidden" name="resolve_id" id="resolveId">
                    <button type="submit" style="
                        background-color: #2e7d32;
                        color: white;
                        border: none;
                        padding: 10px 20px;
                        border-radius: 6px;
                        font-weight: bold;
                        cursor: pointer;
                    ">Resolve</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(id, title, date, content) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDate').textContent = date;
    document.getElementById('modalContent').textContent = content;
    document.getElementById('resolveId').value = id;
    document.getElementById('myModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}
</script>

</body>
</html>
    
