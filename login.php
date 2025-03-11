<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Fetch user data from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(":username", $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Debugging: Print user details
    if (!$user) {
        die("User not found in database.");
    }

    // Debugging: Print stored password hash
    echo "Stored Hash: " . $user['password'] . "<br>";

    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['user'] = $username;
        header("Location: home.php");
        exit();
    } else {
        die("Incorrect password! Hash mismatch.");
    }
}
?>
