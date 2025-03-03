<?php
session_start();
include 'db.php'; // Include database connection

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: index.php"); // Redirect to login page
    exit();
}

// Fetch job listings from the database
try {
    $stmt = $conn->prepare("SELECT * FROM jobs ORDER BY created_at DESC");
    $stmt->execute();
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching jobs: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Finder - Home</title>
    <link rel="stylesheet" href="home.css">
    <script defer src="home.js"></script>
</head>
<body>

<!-- Header -->
<header>
    <div class="logo">JobFinder</div>
    <nav>
        <a href="#">Home</a>
        <a href="#">Browse Jobs</a>
        <a href="#">Companies</a>
        <a href="#">Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<!-- Main Body -->
<main>
    <section class="hero">
        <h1>Find Your Dream Job Today!</h1>
        <p>Thousands of job listings from top companies.</p>
        <div class="search-bar">
            <input type="text" id="job-search" placeholder="Search job title, company...">
            <button id="search-btn">Search</button>
        </div>
    </section>

    <h2>Latest Job Listings</h2>
    <div class="job-listings">
        <?php foreach ($jobs as $job): ?>
            <div class="job-card">
                <h3><?= htmlspecialchars($job['title']) ?></h3>
                <p>Company: <?= htmlspecialchars($job['company']) ?></p>
                <p>Location: <?= htmlspecialchars($job['location']) ?></p>
                <button class="apply-btn">Apply Now</button>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<!-- Footer -->
<footer>
    <p>© 2025 JobFinder. All rights reserved.</p>
    <p><a href="#">Privacy Policy</a> | <a href="#">Contact Us</a></p>
    <div class="social-links">
        <a href="#">LinkedIn</a> | <a href="#">Twitter</a> | <a href="#">Facebook</a>
    </div>
</footer>

</body>
</html>
