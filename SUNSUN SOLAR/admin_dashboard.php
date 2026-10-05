<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Admin Panel</title></head>
<body>
    <h1>Admin Panel</h1>
    <p>Welcome, Control Admin <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</p>
    <a href="logout.php">Logout</a>
</body>
</html>