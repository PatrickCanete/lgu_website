<?php
// Quick Fix for Admin Password
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database config
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'lgu_db';

// Connect
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>🔧 Admin Password Fix</h1>";
echo "<hr>";

// Check current admin user
$check = $conn->query("SELECT * FROM admin_users WHERE username = 'admin'");

if ($check->num_rows > 0) {
    $admin = $check->fetch_assoc();
    
    echo "<h3>Current Admin User:</h3>";
    echo "<p>ID: " . $admin['id'] . "</p>";
    echo "<p>Username: " . $admin['username'] . "</p>";
    echo "<p>Email: " . ($admin['email'] ?? 'N/A') . "</p>";
    echo "<p>Current Password Hash: <code>" . substr($admin['password'], 0, 40) . "...</code></p>";
    echo "<hr>";
    
    // Test current password
    echo "<h3>Testing Current Password:</h3>";
    if (password_verify('admin123', $admin['password'])) {
        echo "<p style='color:green;'>✅ Password 'admin123' already works!</p>";
        echo "<p style='color:green;'><strong>You can login now!</strong></p>";
        echo "<a href='admin_login.php' style='background:#28a745; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; display:inline-block; margin-top:10px;'>Go to Login Page</a>";
    } else {
        echo "<p style='color:red;'>❌ Current password doesn't work</p>";
        echo "<p style='color:orange;'>Updating password now...</p>";
        
        // Generate new hash
        $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
        
        // Update password
        $update = $conn->query("UPDATE admin_users SET password = '$new_hash' WHERE username = 'admin'");
        
        if ($update) {
            echo "<p style='color:green;'>✅ Password updated successfully!</p>";
            
            // Verify the new password works
            $verify_check = $conn->query("SELECT password FROM admin_users WHERE username = 'admin'");
            $new_admin = $verify_check->fetch_assoc();
            
            if (password_verify('admin123', $new_admin['password'])) {
                echo "<p style='color:green;'>✅ Verified: New password works!</p>";
                echo "<hr>";
                echo "<div style='background:#d4edda; padding:20px; border-radius:10px; margin:20px 0;'>";
                echo "<h2>🎉 Success!</h2>";
                echo "<p><strong>Login credentials:</strong></p>";
                echo "<p>Username: <code>admin</code></p>";
                echo "<p>Password: <code>admin123</code></p>";
                echo "<a href='admin_login.php' style='background:#667eea; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; display:inline-block; margin-top:10px;'>Go to Login Page →</a>";
                echo "</div>";
            } else {
                echo "<p style='color:red;'>❌ Verification failed. Something went wrong.</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Update failed: " . $conn->error . "</p>";
        }
    }
} else {
    echo "<p style='color:red;'>❌ No admin user found!</p>";
    echo "<p>Creating new admin user...</p>";
    
    // Create new admin
    $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
    $insert = $conn->query("INSERT INTO admin_users (username, password, email) VALUES ('admin', '$new_hash', 'admin@unisan.gov.ph')");
    
    if ($insert) {
        echo "<p style='color:green;'>✅ Admin user created!</p>";
        echo "<p>Username: <code>admin</code></p>";
        echo "<p>Password: <code>admin123</code></p>";
        echo "<a href='admin_login.php' style='background:#667eea; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; display:inline-block; margin-top:10px;'>Go to Login Page →</a>";
    } else {
        echo "<p style='color:red;'>❌ Failed to create admin: " . $conn->error . "</p>";
    }
}

$conn->close();
?>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background: #f5f5f5;
}
h1, h2, h3 {
    color: #667eea;
}
hr {
    border: 0;
    height: 2px;
    background: linear-gradient(to right, #667eea, #764ba2);
    margin: 20px 0;
}
code {
    background: #fff;
    padding: 5px 10px;
    border-radius: 3px;
    border: 1px solid #ddd;
    display: inline-block;
}
</style>