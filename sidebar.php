<!-- sidebar.php -->
<style>
  .sidebar {
    background-color: #ffffff;
    width: 200px;
    padding: 20px 10px;
    border-right: 1px solid #ccc;
    display: flex;
    flex-direction: column;
    gap: 10px;
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
  }

  .nav-button:hover {
    background-color: #c8e6c9;
  }

  .nav-button.active {
    background-color: #388e3c;
    color: white;
    font-weight: bold;
  }
</style>

<div class="sidebar">
  <a href="admin.php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin.php' ? 'active' : '' ?>"><i>📊</i> Dashboard</a>
  <a href="admin(users).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(users).php' ? 'active' : '' ?>"><i>👥</i> Users</a>
  <a href="admin(sched).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(sched).php' ? 'active' : '' ?>"><i>🗓️</i> Schedules</a>
  <a href="admin(report).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(report).php' ? 'active' : '' ?>"><i>📄</i> Reports</a>
  <a href="admin(settings).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(settings).php' ? 'active' : '' ?>"><i>⚙️</i> Settings</a>
  <a href="admin(contacts).php" class="nav-button <?= basename($_SERVER['PHP_SELF']) == 'admin(contacts).php' ? 'active' : '' ?>"><i>☎️</i> Contacts</a>
</div>
