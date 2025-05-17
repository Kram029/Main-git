<?php
// Connect to DB
$conn = new mysqli("localhost", "root", "", "adbms");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch contacts
$result = $conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contacts</title>
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
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
       position: relative; 
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
            position: relative; 
      background-color: rgba(242, 242, 242, 0.8);
        }

        .footer {
      text-align: center;
      font-size: 12px;
      color: gray;
      margin-top: 40px;
    }

    .footer p {
      margin: 4px 0;
    }


/* Modal consistent with reports page */
.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0; top: 0;
  width: 100%; height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.5);
  justify-content: center;
  align-items: center;
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
.close:hover {
  color: #c8e6c9;
}

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
    <p><?= date('l, F d, Y') ?></p>
  </div>
</header>

<div class="container">
  <?php include 'sidebar.php'; ?>


 <div class="main">
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
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= date("F j, Y, g:i A", strtotime($row['created_at'])) ?></td>
                <td class="actions">
  <a href="#" onclick="openModal(
      '<?= addslashes(htmlspecialchars($row['name'])) ?>',
      '<?= addslashes(htmlspecialchars($row['email'])) ?>',
      `<?= addslashes(htmlspecialchars($row['message'])) ?>`
  )">View</a>
</td>

            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <div class="footer">
      <p>&copy; 2023 EcoTrack. All rights reserved.</p>
      <p>Developed by Team EcoTrack</p>
  </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div id="contactModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Contact Details</h3>
      <span class="close" onclick="closeModal()">&times;</span>
    </div>
    <div class="modal-body">
      <p><strong>Name:</strong> <span id="modalName"></span></p>
      <p><strong>Email:</strong> <span id="modalEmail"></span></p>
      <p><strong>Message:</strong></p>
      <p id="modalMessage" style="white-space: pre-wrap;"></p>
    </div>
  </div>
</div>



<script>
function openModal(name, email, message) {
  document.getElementById('modalName').textContent = name;
  document.getElementById('modalEmail').textContent = email;
  document.getElementById('modalMessage').textContent = message;
  document.getElementById('contactModal').style.display = 'flex';
}
function closeModal() {
  document.getElementById('contactModal').style.display = 'none';
}
</script>
>

</body>
</html>
