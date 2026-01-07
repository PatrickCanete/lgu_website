<?php

// ------------------ SESSION & TIMEZONE ------------------
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only once
}
date_default_timezone_set('Asia/Manila'); // Set PHP time to Manila

// ------------------ DATABASE CONFIG ------------------
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'lgu_db');

// Create MySQLi connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optional: set MySQL session timezone
$conn->query("SET time_zone = '+08:00'");

// Set charset to utf8
$conn->set_charset("utf8");

// ------------------ UNREAD COUNTS ------------------
$contact_unread = $conn->query("SELECT COUNT(*) FROM contact_us WHERE status='unread'")->fetch_row()[0];
$submit_unread  = $conn->query("SELECT COUNT(*) FROM submit_request WHERE status='unread'")->fetch_row()[0];
$unread_count = $contact_unread + $submit_unread;

// ------------------ HELPER FUNCTIONS ------------------

// Check if admin is logged in
function isLoggedIn() {
    return isset($_SESSION['admin_id']) && isset($_SESSION['admin_username']);
}

// Redirect to login if not logged in
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: admin_login.php');
        exit();
    }
}

// Sanitize input
function sanitize($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $conn->real_escape_string($data);
}
?>
