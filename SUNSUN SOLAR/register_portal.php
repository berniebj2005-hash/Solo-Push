<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Portal</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        .card { border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 280px; text-align: center; margin: 10px; display: inline-block; vertical-align: top; }
        .btn { display: inline-block; padding: 10px 15px; background-color: #007BFF; color: white; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <h2>Select Account Type to Register</h2>

    <div class="card">
        <h3>Customer</h3>
        <p>Create a personal customer account.</p>
        <a href="sunsun_user.php" class="btn">Register Customer</a>
    </div>

    <div class="card">
        <h3>Employee</h3>
        <p>Create an employee staff account.</p>
        <a href="sunsun_employee.php" class="btn">Register Employee</a>
    </div>

    <p style="margin-top:20px;">Already have an account? <a href="login.php">Log in here</a></p>
</body>
</html>