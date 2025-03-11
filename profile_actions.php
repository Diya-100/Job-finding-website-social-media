<?php
/**
 * Handle profile actions like updating profile, changing password, and deleting account
 * 
 * This file processes all profile-related form submissions
 */

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Return JSON error for AJAX requests
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
        exit;
    }
    // Redirect to login page for regular form submissions
    header('Location: login.php');
    exit;
}

// Include database connection
require_once 'includes/db_connect.php';

// Get user ID from session
$user_id = $_SESSION['user_id'];

// Check which action is requested
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'update_profile':
        updateProfile($conn, $user_id);
        break;
    case 'upload_photo':
        uploadProfilePhoto($conn, $user_id);