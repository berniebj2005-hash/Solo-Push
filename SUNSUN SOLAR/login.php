<?php
session_start();
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['Username']);
    $password = $_POST['Password'];
    $role = $_POST['Role'] ?? '';

    if (empty($role)) {
        $message = "Please select a login role.";
    } else {
        if ($role === 'Customer') {
            // Check Customer Table
            $stmt = $conn->prepare("SELECT User_ID, Password, First_Name FROM customer_information WHERE Username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['Password'])) {
                    $_SESSION['user_id'] = $user['User_ID'];
                    $_SESSION['username'] = $username;
                    $_SESSION['first_name'] = $user['First_Name'];
                    $_SESSION['role'] = 'Customer';

                    header("Location: customer_dashboard.php");
                    exit;
                } else {
                    $message = "Invalid Credentials.";
                }
            } else {
                $message = "Customer username not found.";
            }
            $stmt->close();

        } elseif ($role === 'Employee') {
            // Check Employee Table
            $stmt = $conn->prepare("SELECT Employee_ID, Password, First_name, Department FROM employee_db WHERE Username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $employee = $result->fetch_assoc();
                if (password_verify($password, $employee['Password'])) {
                    $_SESSION['user_id'] = $employee['Employee_ID'];
                    $_SESSION['username'] = $username;
                    $_SESSION['first_name'] = $employee['First_name'];
                    $_SESSION['department'] = $employee['Department'];
                    $_SESSION['role'] = 'Employee';

                    header("Location: employee_dashboard.php");
                    exit;
                } else {
                    $message = "Invalid Credentials.";
                }
            } else {
                $message = "Employee username not found.";
            }
            $stmt->close();

        } elseif ($role === 'Admin') {
            $stmt = $conn->prepare("SELECT Admin_id, Password, Username FROM admin_db WHERE Username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $admin = $result->fetch_assoc();

                if ($password === $admin['Password']) {
                    $_SESSION['user_id'] = $admin['Admin_id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['first_name'] = $admin['Username'];
                    $_SESSION['role'] = 'Admin';

                    header("Location: admin_dashboard.php");
                    exit;
                } else {
                    $message = "Invalid Credentials.";
                }
            } else {
                $message = "Admin username not found.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php if ($message)
        echo "<p style='color: red;'><strong>$message</strong></p>"; ?>

    <form action="login.php" method="POST">
        <label>Select Role:</label><br>
        <input type="radio" id="customer" name="Role" value="Customer" checked>
        <label for="customer">Customer</label>

        <input type="radio" id="employee" name="Role" value="Employee">
        <label for="employee">Employee</label>

        <input type="radio" id="admin" name="Role" value="Admin">
        <label for="admin">Admin</label>
        <br><br>

        <label>Username:</label><br>
        <input type="text" name="Username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="Password" required><br><br>

        <button type="submit">Log In</button>
    </form>

    <p>Don't have an account? <a href="register_portal.php">Register here</a></p>
</body>

</html>