

<!-- sidebar.php -->
<style>
  .sidebar {
    background-color: #ffffff;
    width: 200px;
    padding: 20px 10px;
    border-right: 1px solid #ccc;
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .nav-button {
    background-color: #e0f2f1;
    padding: 12px;
    border: none;
    border-radius: 6px;
    text-align: left;
    font-size: 16px;
    cursor: pointer;
    font-family: Arial, sans-serif;
    transition: background-color 0.3s ease;
    width: 100%;
    display: block;
    text-decoration: none;
    color: black;
    margin-bottom: 5px;
  }

  .nav-button:hover {
    background-color: #c8e6c9;
  }

  .nav-button.active {
    background-color: #388e3c;
    color: white;
    font-weight: bold;
  }

  .logout-button {
    margin-top: auto;
    background-color: #f44336;
    color: white;
    text-align: center;
    padding: 10px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    transition: background-color 0.3s ease;
  }

  .logout-button:hover {
    background-color: #d32f2f;
  }
</style>

<div class="sidebar">
  <a href="admin.php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : '' ?>"><i>📊</i> Dashboard</a>
  <a href="admin(users).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(users).php' ? 'active' : '' ?>"><i>👥</i> Users</a>
  <a href="admin(sched).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(sched).php' ? 'active' : '' ?>"><i>🗓️</i> Schedules</a>
  <a href="admin(report).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(report).php' ? 'active' : '' ?>"><i>📄</i> Reports</a>
  <a href="admin(settings).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(settings).php' ? 'active' : '' ?>"><i>⚙️</i> Settings</a>

  <a href="Home.php" class="logout-button" onclick="return confirmLogout()">🚪 Log Out</a>

<script>
  function confirmLogout() {
    return confirm("Are you sure you want to log out?");
  }
</script>

</div>
