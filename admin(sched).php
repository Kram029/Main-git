<?php
session_start();
date_default_timezone_set('Asia/Manila'); // Set correct timezone

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

// Use 'username' directly since there's no 'name' column
$adminName = $admin['username'];

$conn = new mysqli("localhost", "root", "", "adbms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_schedule'])) {
        $barangay = trim($_POST['barangay']);
        if (!preg_match("/^[A-Za-z\s\-]{2,50}$/", $barangay)) {
            die("Invalid Barangay name. Only letters, spaces, and hyphens allowed (2-50 chars).");
        }

        $date = $_POST['date'];
        $today = date('Y-m-d');

        $selectedDatetime = strtotime("$date {$_POST['time']}");
        $currentDatetime = time();

        if ($selectedDatetime < $currentDatetime) {
             echo "<script>alert('Schedule datetime cannot be in the past.');</script>";
            exit();
        }
        // Continue with schedule adding logic...
        $stmt = $conn->prepare("CALL AddSchedule(?, ?, ?, ?)");
        $stmt->bind_param("ssss", $_POST['barangay'], $_POST['date'], $_POST['time'], $_POST['status']);
        $stmt->execute();
        $stmt->close();
    }

    if (isset($_POST['delete_schedule'])) {
        $stmt = $conn->prepare("CALL DeleteSchedule(?)");
        $stmt->bind_param("i", $_POST['delete_id']);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit();
}

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
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body { background-color: #f2f2f2; }

        header {
            background-color: #2e7d32;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 { font-size: 32px; }
        header p { font-size: 18px; }
        .logout { color: white; font-size: 14px; text-decoration: none; }

        .container {
            display: flex;
            height: calc(100vh - 70px);
        }

        .sidebar {
            background-color: #ffffff;
            width: 200px;
            padding: 20px 10px;
            border-right: 1px solid #ccc;
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

        /* Modal styles */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100vw; height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            padding: 20px 25px;
            width: 300px;
            position: relative;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            background-color: #2e7d32;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 20px;
        }

        .close-btn {
            background: none;
            border: none;
            color: yellow;
            font-size: 20px;
            cursor: pointer;
        }

        .modal-content label {
            display: block;
            text-align: left;
            margin: 12px 0 4px;
            font-weight: bold;
        }

        .modal-content input[type="text"],
        .modal-content input[type="date"],
        .modal-content input[type="time"],
        .modal-content select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }

        .modal-content button {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .add-btn {
            margin-top: 20px;
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
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
    </div>
</header>

<div class="container">
    <?php include 'sidebar.php'; ?>

    <div class="main">
        <div class="welcome">Welcome, <?= htmlspecialchars($adminName) ?>!</div>

        <button class="add-btn" onclick="openAddModal()">+ Add Schedule</button>

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
                        <td>" . date("g:i A", strtotime($schedule['time'])) . "</td>
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

        <div class="footer">
            <p>Privacy Statement | Terms and Condition | Privacy Policy</p>
            <p>&copy;2025 EcoTrack. All Rights Reserved.</p>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal-overlay" id="addModal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add Pickup Schedule</h2>
            <button class="close-btn" onclick="closeAddModal()">&times;</button>
        </div>
        <div id="addScheduleError" style="color: red; margin-bottom: 10px; display: none;"></div>
        <form method="post" id="addScheduleFormElement">
            <label>Barangay:</label>
            <input type="text" id="barangay" name="barangay" pattern="[A-Za-z\s\-]{2,50}" required
                   title="Barangay must be 2-50 letters, spaces, or hyphens only.">

            <label>Date:</label>
            <input type="date" name="date" required min="<?= date('Y-m-d'); ?>">

            <label>Time:</label>
            <input type="time" name="time" required>

            <label>Status:</label>
            <select name="status" required>
                <option value="Pending">Pending</option>
                <option value="Scheduled">Scheduled</option>
            </select>

            <button type="submit" name="add_schedule">Add Schedule</button>
        </form>
    </div>
</div>

<?php if ($editData): ?>
    <div class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Pickup Schedule</h2>
                <form method="get" style="margin:0;">
                    <button class="close-btn" title="Close" name="cancel" value="1">&times;</button>
                </form>
            </div>
            <form method="post">
                <input type="hidden" name="edit_id" value="<?= $editData['id'] ?>">

                <label>Barangay:</label>
                <p style="text-align:left;"><?= htmlspecialchars($editData['barangay']) ?></p>
                <input type="hidden" name="barangay" value="<?= htmlspecialchars($editData['barangay']) ?>">

                <label>Date:</label>
                <input type="date" name="date" value="<?= $editData['date'] ?>" required min="<?= date('Y-m-d'); ?>">

                <label>Time:</label>
                <input type="time" name="time" value="<?= $editData['time'] ?>" required>

                <label>Status:</label>
                <select name="status" required>
                    <option value="Pending" <?= $editData['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Scheduled" <?= $editData['status'] == 'Scheduled' ? 'selected' : '' ?>>Scheduled</option>
                </select>

                <button type="submit" name="update_schedule">Save Changes</button>
            </form>
        </div>
    </div>
<?php endif; ?>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const form = document.getElementById("addScheduleFormElement");
        const barangay = document.getElementById("barangay");
        const dateInput = form.querySelector("input[name='date']");
        const errorDiv = document.getElementById("addScheduleError");

        errorDiv.style.display = "none";

        form.addEventListener("submit", function (e) {
            let hasError = false;
            const today = new Date().toISOString().split('T')[0];

            const pattern = /^[A-Za-z\s\-]{2,50}$/;
            if (!pattern.test(barangay.value.trim())) {
                barangay.setCustomValidity("Invalid Barangay name.");
                barangay.reportValidity();
                e.preventDefault();
                hasError = true;
            } else {
                barangay.setCustomValidity("");
            }

          const selectedDate = dateInput.value;
const selectedTime = form.querySelector("input[name='time']").value;

if (selectedDate < today) {
    errorDiv.textContent = "Schedule date cannot be in the past.";
    errorDiv.style.display = "block";
    dateInput.setCustomValidity("Date must not be in the past.");
    dateInput.reportValidity();
    e.preventDefault();
    hasError = true;
} else if (selectedDate === today) {
    const currentTime = new Date().toTimeString().slice(0,5); // format: HH:MM
    if (selectedTime < currentTime) {
        errorDiv.textContent = "Time must not be in the past for today's schedule.";
        errorDiv.style.display = "block";
        form.querySelector("input[name='time']").setCustomValidity("Invalid time.");
        form.querySelector("input[name='time']").reportValidity();
        e.preventDefault();
        hasError = true;
    }
}

        });
    }); 

    function openAddModal() {
        document.getElementById('addModal').style.display = 'flex';
    }

    function closeAddModal() {
        document.getElementById('addModal').style.display = 'none';
    }
</script>

</body>
</html>
