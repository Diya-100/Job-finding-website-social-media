<?php
$host = "localhost";
$dbname = "socialmedia";
$username = "root"; // Default MySQL username for XAMPP
$password = "";     // Default MySQL password for XAMPP (leave empty)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
