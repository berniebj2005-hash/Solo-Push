<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Customer') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Customer Portal</title></head>
<body>
    <h1>Customer Portal</h1>
    <p>Welcome back, <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</p>
    <a href="logout.php">Logout</a>
</body>
</html>