<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name  = $_POST['First_name'];
    $middle_name = $_POST['Middle_name'];
    $last_name   = $_POST['Last_name'];
    $gender      = $_POST['Gender'];
    $email       = $_POST['Email'];
    $phone       = $_POST['Phone_Number'];
    $address     = $_POST['Address'];
    $username    = $_POST['Username'];
    $password    = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $department  = $_POST['Department'];

    $stmt = $conn->prepare("INSERT INTO employee_db 
        (First_name, Middle_name, Last_name, Gender, Email, Phone_Number, Address, Username, Password, Department) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
    $stmt->bind_param("ssssssssss", $first_name, $middle_name, $last_name, $gender, $email, $phone, $address, $username, $password, $department);

    if ($stmt->execute()) {
        $message = "Employee registered successfully! Employee ID: " . $stmt->insert_id;
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Registration</title>
</head>
<body>
    <h2>Register Employee</h2>
    <?php if ($message) echo "<p><strong>$message</strong></p>"; ?>

    <form action="sunsun_employee.php" method="POST">
        <label>First Name:</label><br>
        <input type="text" name="First_name" required><br><br>

        <label>Middle Name:</label><br>
        <input type="text" name="Middle_name"><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="Last_name" required><br><br>

        <label>Gender:</label><br>
        <input type="text" name="Gender" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="Email" required><br><br>

        <label>Phone Number:</label><br>
        <input type="number" name="Phone_Number" required><br><br>

        <label>Address:</label><br>
        <textarea name="Address" required></textarea><br><br>

        <label>Department:</label><br>
        <input type="text" name="Department" required><br><br>

        <label>Username:</label><br>
        <input type="text" name="Username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="Password" required><br><br>

        <button type="submit">Submit Registration</button>
    </form>
</body>
</html>