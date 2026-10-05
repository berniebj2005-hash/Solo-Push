<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Employee') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Employee Dashboard</title></head>
<body>
    <h1>Employee Dashboard</h1>
    <p>Welcome, Staff <?php echo htmlspecialchars($_SESSION['first_name']); ?>!</p>
    <a href="logout.php">Logout</a>
</body>
</html>