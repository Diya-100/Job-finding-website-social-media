<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'job_giver') {
    header("Location: login.php");
    exit();
}

$job_giver_id = $_SESSION['user_id'];

// Fetch jobs posted by the job giver
$query = "SELECT id, title, company, location, description, created_at FROM jobs WHERE posted_by = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $job_giver_id);
$stmt->execute();
$result = $stmt->get_result();
$jobs = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Jobs</title>
    <link rel="stylesheet" href="manage-jobs.css">
    <script defer src="manage-jobs.js"></script>
</head>
<body>

<header>
    <div class="logo">JobFinder</div>
    <nav>
        <a href="job_giver.php">Home</a>
        <a href="post-job.php">Post a Job</a>
        <a href="manage-jobs.php" class="active">Manage Jobs</a>
        <a href="view-applicants.php">View Applicants</a>
        <a href="giver_profile.php">View Profile</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<main>
    <div class="container">
        <h1>Manage Jobs</h1>

        <?php if (empty($jobs)): ?>
            <p>No jobs posted yet.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Location</th>
                        <th>Posted On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jobs as $job): ?>
                        <tr>
                            <td><?= htmlspecialchars($job['title']) ?></td>
                            <td><?= htmlspecialchars($job['company']) ?></td>
                            <td><?= htmlspecialchars($job['location']) ?></td>
                            <td><?= htmlspecialchars($job['created_at']) ?></td>
                            <td>
                                <button class="edit-btn" data-id="<?= $job['id'] ?>">Edit</button>
                                <button class="delete-btn" data-id="<?= $job['id'] ?>">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>

<footer>
    <p>© 2025 JobFinder. All rights reserved.</p>
</footer>

</body>
</html>
