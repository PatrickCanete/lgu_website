<?php
// Test Database Connection
echo "<h2>Testing Database Connection...</h2>";

// Database credentials
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'lgu_db';

// Try to connect
$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<p style='color:red;'>CONNECTION FAILED: " . $conn->connect_error . "</p>";
    echo "<p>Solutions:</p>";
    echo "<ul>";
    echo "<li>Make sure XAMPP MySQL is running</li>";
    echo "<li>Check if database 'lgu_db' exists in phpMyAdmin</li>";
    echo "<li>Verify your database password (usually empty for XAMPP)</li>";
    echo "</ul>";
    exit();
} else {
    echo "<p style='color:green;'> DATABASE CONNECTION SUCCESSFUL!</p>";
}

// Check if admin_users table exists
$result = $conn->query("SHOW TABLES LIKE 'admin_users'");
if ($result->num_rows > 0) {
    echo "<p style='color:green;'>Table 'admin_users' EXISTS</p>";
    
    // Check if there's an admin user
    $admin_check = $conn->query("SELECT * FROM admin_users WHERE username = 'admin'");
    if ($admin_check->num_rows > 0) {
        $admin = $admin_check->fetch_assoc();
        echo "<p style='color:green;'>Admin user 'admin' EXISTS</p>";
        echo "<p><strong>Current password hash:</strong></p>";
        echo "<code>" . $admin['password'] . "</code>";
        
        // Test password verification
        $test_password = 'admin123';
        if (password_verify($test_password, $admin['password'])) {
            echo "<p style='color:green;'> Password 'admin123' VERIFICATION WORKS!</p>";
            echo "<p style='color:orange;'> If you still can't login, check your admin_login.php file</p>";
        } else {
            echo "<p style='color:red;'> Password 'admin123' VERIFICATION FAILED!</p>";
            echo "<p style='color:orange;'>Need to reset password. See solution below.</p>";
            
            // Generate new password hash
            $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
            echo "<p><strong>Use this SQL to reset password:</strong></p>";
            echo "<code>UPDATE admin_users SET password = '$new_hash' WHERE username = 'admin';</code>";
        }
    } else {
        echo "<p style='color:red;'>Admin user 'admin' NOT FOUND</p>";
        echo "<p>Run this SQL in phpMyAdmin:</p>";
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        echo "<code>INSERT INTO admin_users (username, password, email) VALUES ('admin', '$hash', 'admin@unisan.gov.ph');</code>";
    }
} else {
    echo "<p style='color:red;'> Table 'admin_users' DOES NOT EXIST</p>";
    echo "<p>You need to import the database SQL file!</p>";
    echo "<p>Go to phpMyAdmin → Import → Select lgu_db.sql</p>";
}

$conn->close();
?>

<style>
body {
    font-family: Arial, sans-serif;
    padding: 20px;
    max-width: 800px;
    margin: 0 auto;
}
code {
    background: #f4f4f4;
    padding: 10px;
    display: block;
    margin: 10px 0;
    border-left: 3px solid #667eea;
    overflow-x: auto;
}
</style>