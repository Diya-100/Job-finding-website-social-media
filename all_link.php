<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !==  'super') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html>
<head>
    <title>All Links</title>
</head>
<body>
    <h1>Welcome Superuser: <?= htmlspecialchars($_SESSION['superuser']) ?></h1>
    <ul>
        <li><a href="job_seeker.php">Job Seeker Dashboard</a></li>
        <li><a href="job_giver.php">Job Giver Dashboard</a></li>
        <li><a href="admindash.php">Admin Dashboard</a></li>
        <!-- Add more routes as required -->
    </ul>
</body>
</html>
