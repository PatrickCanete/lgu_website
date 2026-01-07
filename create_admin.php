<?php
include "includes/db_connect.php"; // siguraduhing tama ang path

$password = password_hash("admin123", PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$username = "admin";
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

if($stmt->affected_rows > 0){
    echo "Admin user created successfully!";
} else {
    echo "Error creating admin user.";
}
