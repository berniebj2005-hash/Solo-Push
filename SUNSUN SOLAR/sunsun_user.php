<?php
include 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name  = $_POST['First_Name'];
    $middle_name = $_POST['Middle_Name'];
    $last_name   = $_POST['Last_Name'];
    $birth_date  = $_POST['Birth_date'];
    $gender      = $_POST['Gender'];
    $email       = $_POST['Email'];
    $phone       = $_POST['Phone_Number'];
    $address     = $_POST['Address'];
    $username    = $_POST['Username'];
    $password    = password_hash($_POST['Password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO customer_information 
        (First_Name, Middle_Name, Last_Name, Birth_date, Gender, Email, Phone_Number, Address, Username, Password) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("ssssssssss", $first_name, $middle_name, $last_name, $birth_date, $gender, $email, $phone, $address, $username, $password);

    if ($stmt->execute()) {
        $message = "Customer registered successfully! User ID: " . $stmt->insert_id;
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
    <title>Customer Registration</title>
</head>
<body>
    <h2>Register Customer</h2>
    <?php if ($message) echo "<p><strong>$message</strong></p>"; ?>

    <form action="sunsun_user.php" method="POST">
        <label>First Name:</label><br>
        <input type="text" name="First_Name" required><br><br>

        <label>Middle Name:</label><br>
        <input type="text" name="Middle_Name"><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="Last_Name" required><br><br>

        <label>Birth Date:</label><br>
        <input type="date" name="Birth_date" required><br><br>

        <label>Gender:</label><br>
        <select name="Gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label>Email:</label><br>
        <input type="email" name="Email" required><br><br>

        <label>Phone Number:</label><br>
        <input type="tel" name="Phone_Number" required><br><br>

        <label>Address:</label><br>
        <textarea name="Address" required></textarea><br><br>

        <label>Username:</label><br>
        <input type="text" name="Username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="Password" required><br><br>

        <button type="submit">Submit Registration</button>
    </form>
</body>
</html>