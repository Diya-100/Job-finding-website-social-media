<?php
// Start Session
session_start();

// Dummy Data (Replace with Database Queries)
$total_jobs = 125;
$total_employers = 50;
$total_seekers = 200;
$new_applications = 30;
$monthly_revenue = "$2,500";

// Check Admin Login (Replace with actual authentication)
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Job Portal</title>
    <link rel="stylesheet" href="admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js for Graphs -->
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="jobs.php">Manage Jobs</a></li>
            <li><a href="employers.php">Employers</a></li>
            <li><a href="seekers.php">Job Seekers</a></li>
            <li><a href="applications.php">Applications</a></li>
            <li><a href="payments.php">Payments</a></li>
            <li><a href="reports.php">Reports & Analytics</a></li>
            <li><a href="cms.php">CMS Management</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <header>
            <h1>Dashboard Overview</h1>
        </header>

        <!-- Dashboard Cards -->
        <section class="dashboard">
            <div class="card">
                <h3>Total Jobs</h3>
                <p><?php echo $total_jobs; ?></p>
            </div>
            <div class="card">
                <h3>Total Employers</h3>
                <p><?php echo $total_employers; ?></p>
            </div>
            <div class="card">
                <h3>Total Job Seekers</h3>
                <p><?php echo $total_seekers; ?></p>
            </div>
            <div class="card">
                <h3>New Applications</h3>
                <p><?php echo $new_applications; ?></p>
            </div>
            <div class="card revenue">
                <h3>Monthly Revenue</h3>
                <p><?php echo $monthly_revenue; ?></p>
            </div>
        </section>

        <!-- Graphs & Reports -->
        <section class="reports">
            <h2>User Growth Statistics</h2>
            <canvas id="userChart"></canvas>
        </section>
    </main>

    <script src="admin.js"></script>
</body>
</html>
