<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $message = sanitize($_POST['message']);
    
    $sql = "INSERT INTO form_submissions (full_name, email, message) VALUES ('$name', '$email', '$message')";
    
    if ($conn->query($sql)) {
        // Success - redirect back to index with success message
        header('Location: index.php?submit=success');
    } else {
        // Error - redirect back with error
        header('Location: index.php?submit=error');
    }
    exit();
} else {
    header('Location: index.php');
    exit();
}
?>