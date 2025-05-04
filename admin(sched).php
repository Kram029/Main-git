<?php
$conn = new mysqli("localhost", "root", "", "adbms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_schedule'])) {
        $stmt = $conn->prepare("CALL AddSchedule(?, ?, ?, ?)");
        $stmt->bind_param("ssss", $_POST['barangay'], $_POST['date'], $_POST['time'], $_POST['status']);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['update_schedule'])) {
        $stmt = $conn->prepare("CALL UpdateSchedule(?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $_POST['edit_id'], $_POST['barangay'], $_POST['date'], $_POST['time'], $_POST['status']);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['delete_schedule'])) {
        $stmt = $conn->prepare("CALL DeleteSchedule(?)");
        $stmt->bind_param("i", $_POST['delete_id']);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Fetch current row for editing
$editData = null;
if (isset($_GET['edit_id'])) {
    $id = intval($_GET['edit_id']);
    $res = $conn->query("SELECT * FROM schedules WHERE id = $id");
    $editData = $res->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EcoTrack - Schedules</title>
    <style>
        /* Your existing styles here */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body { background-color: #f2f2f2; }
        header {
            background-color: #2e7d32; color: white;
            padding: 15px 20px;
            display: flex; justify-content: space-between;
            align-items: center;
        }
        .logout { color: white; font-size: 14px; text-decoration: none; }
        .container { display: flex; height: calc(100vh - 70px); }
        .sidebar {
            background-color: #ffffff;
            width: 200px;
            padding: 20px 10px;
            border-right: 1px solid #ccc;
        }
        .nav-button {
            display: flex; align-items: center;
            width: 100%; padding: 10px;
            background-color: transparent;
            border: none;
            text-align: left; font-size: 16px;
            cursor: pointer; margin-bottom: 5px;
            text-decoration: none; color: black;
        }
        .nav-button.active {
            background-color: #388e3c;
            color: white; font-weight: bold;
            border-radius: 6px;
        }
        .main {
            flex-grow: 1; padding: 30px; overflow-y: auto;
        }
        .welcome {
            background-color: #a5d6a7;
            padding: 15px 20px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
        }
        .search-bar { text-align: right; margin-top: 20px; }
        .search-bar input {
            padding: 8px; font-size: 14px; width: 200px;
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
        th { background-color: #c8e6c9; }
        .actions a {
            color: #1565c0;
            text-decoration: none;
            margin-right: 8px;
        }
        .actions button {
            color: #d32f2f;
            border: none;
            background: none;
            cursor: pointer;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: gray;
        }
        .footer p { margin: 4px 0; }
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
        <div class="welcome">Welcome, Admin [username]!</div>

        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barangay</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $result = $conn->query("SELECT * FROM schedules ORDER BY id ASC");
            if ($result->num_rows > 0) {
                while ($schedule = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$schedule['id']}</td>
                        <td>{$schedule['barangay']}</td>
                        <td>{$schedule['date']}</td>
                        <td>{$schedule['time']}</td>
                        <td>{$schedule['status']}</td>
                        <td class='actions'>
                            <a href='?edit_id={$schedule['id']}'>Edit</a>
                            <form method='post' style='display:inline;' onsubmit='return confirm(\"Are you sure?\");'>
                                <input type='hidden' name='delete_id' value='{$schedule['id']}'>
                                <button type='submit' name='delete_schedule'>Delete</button>
                            </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No schedules found.</td></tr>";
            }
            ?>
            </tbody>
        </table>

        <br>

        <?php if ($editData): ?>
            <h3>Edit Schedule</h3>
            <form method="post" style="background:#fff; padding:20px; border-radius:8px;">
                <input type="hidden" name="edit_id" value="<?= $editData['id'] ?>">
                <label>Barangay:</label><br>
                <input type="text" name="barangay" value="<?= $editData['barangay'] ?>" required><br><br>

                <label>Date:</label><br>
                <input type="date" name="date" value="<?= $editData['date'] ?>" required><br><br>

                <label>Time:</label><br>
                <input type="time" name="time" value="<?= $editData['time'] ?>" required><br><br>

                <label>Status:</label><br>
                <select name="status" required>
                    <option value="Pending" <?= $editData['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Scheduled" <?= $editData['status'] == 'Scheduled' ? 'selected' : '' ?>>Scheduled</option>
                </select><br><br>

                <button type="submit" name="update_schedule" style="background-color: #2e7d32; color: white; padding: 10px 15px; border: none; border-radius: 4px;">Update Schedule</button>
            </form>
        <?php else: ?>
            <button id="showFormButton" style="margin-top: 20px; background-color: #4caf50; color: white; padding: 10px 20px; border: none; border-radius: 5px;">+ Add Schedule</button>

            <div id="addScheduleForm" style="display: none; margin-top: 20px; background-color: #fff; padding: 20px; border-radius: 8px;">
                <form method="post">
                    <label>Barangay:</label><br>
                    <input type="text" name="barangay" required><br><br>

                    <label>Date:</label><br>
                    <input type="date" name="date" required><br><br>

                    <label>Time:</label><br>
                    <input type="time" name="time" required><br><br>

                    <label>Status:</label><br>
                    <select name="status" required>
                        <option value="Pending">Pending</option>
                        <option value="Scheduled">Scheduled</option>
                    </select><br><br>

                    <button type="submit" name="add_schedule" style="background-color: #2e7d32; color: white; padding: 10px 15px; border: none; border-radius: 4px;">Add Schedule</button>
                </form>
            </div>
        <?php endif; ?>

        <div class="footer">
            <p>Privacy Statement | Terms and Condition | Privacy Policy</p>
            <p>&copy;2025 EcoTrack. All Rights Reserved.</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('showFormButton')?.addEventListener('click', function () {
        const form = document.getElementById('addScheduleForm');
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    });
</script>

</body>
</html>
