<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'job_seeker') {
    echo json_encode(["success" => false, "message" => "Unauthorized access!"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['job_id'])) {
    $user_id = $_SESSION['user_id'];
    $job_id = intval($_POST['job_id']);

    // Check if the user has already applied for this job
    $check_query = "SELECT id FROM applications WHERE job_id = ? AND user_id = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ii", $job_id, $user_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "You have already applied for this job!"]);
        exit();
    }

    // Insert application into the database
    $apply_query = "INSERT INTO applications (job_id, user_id) VALUES (?, ?)";
    $stmt = $conn->prepare($apply_query);
    $stmt->bind_param("ii", $job_id, $user_id);
    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Application successful!"]);
    } else {
        echo json_encode(["success" => false, "message" => "Application failed. Try again!"]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request!"]);
}
?>
