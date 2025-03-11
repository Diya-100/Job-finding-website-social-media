<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username OR email = :email");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Username or Email already taken!'); window.location.href='register.php';</script>";
        exit();
    }

    // Insert user into database
    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $hashedPassword);
    $stmt->bindParam(":role", $role);
    $stmt->execute();

    $_SESSION['user'] = $username;
    $_SESSION['role'] = $role;
    
    // Redirect based on role
    if ($role == "job_seeker") {
        header("Location: login.html");
    } else {
        header("Location: login.html");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Job Portal</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <form id="registerForm" action="register.php" method="POST">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            
            <select name="role" id="role" required>
                <option value="">Select Your Role</option>
                <option value="job_seeker">Looking for a Job</option>
                <option value="employer">Looking to Hire</option>
            </select>

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="index.php">Login</a></p>
    </div>

    <script src="register.js"></script>
</body>
</html>
