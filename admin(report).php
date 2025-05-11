<?php
$conn = new mysqli("localhost", "root", "", "adbms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
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
            background-color: #f2f2f2;
        }
        header {
            background-color: #2e7d32;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
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
        }
        .main {
            flex-grow: 1;
            padding: 30px;
            overflow-y: auto;
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

<header>
    <div>
        <h1>EcoTrack</h1>
        <p>Smarter Waste, Greener Cities</p>
    </div>
    <div>
        <p><?php echo date("l, F d, Y"); ?></p>
        <a class="logout" href="#">LOG OUT</a>
    </div>
</header>

<div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="main">
        <div class="welcome">Welcome, Admin!</div>

        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td class="actions">
                        <a href="#" onclick="openModal(
                            '<?php echo htmlspecialchars(addslashes($row['name'])); ?>',
                            '<?php echo htmlspecialchars(addslashes($row['email'])); ?>',
                            '<?php echo htmlspecialchars(addslashes($row['created_at'])); ?>',
                            `<?php echo htmlspecialchars(addslashes($row['message'])); ?>`
                        )">View</a>
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
            <h3>Contact Message Details</h3>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <p><strong>Name:</strong> <span id="modalName"></span></p>
            <p><strong>Email:</strong> <span id="modalEmail"></span></p>
            <p><strong>Date:</strong> <span id="modalDate"></span></p>
            <p><strong>Message:</strong></p>
            <p id="modalMessage" style="white-space: pre-wrap;"></p>
        </div>
    </div>
</div>

<script>
function openModal(name, email, date, message) {
    document.getElementById('modalName').textContent = name;
    document.getElementById('modalEmail').textContent = email;
    document.getElementById('modalDate').textContent = date;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('myModal').style.display = 'flex';
}
function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}
</script>

</body>
</html>
