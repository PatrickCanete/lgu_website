<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🔍 Login Debug Tool</h2>";
echo "<hr>";

// Step 1: Check if config.php exists
echo "<h3>Step 1: Checking config.php</h3>";
if (file_exists('config.php')) {
    echo "✅ config.php EXISTS<br>";
    include 'config.php';
} else {
    echo "❌ config.php NOT FOUND<br>";
    echo "Create config.php in the same folder as this file<br>";
    exit();
}

// Step 2: Test database connection
echo "<h3>Step 2: Testing Database Connection</h3>";
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'unisan_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    echo "❌ Connection failed: " . $conn->connect_error . "<br>";
    exit();
} else {
    echo "✅ Database connected successfully<br>";
}

// Step 3: Check if admin_users table exists
echo "<h3>Step 3: Checking admin_users table</h3>";
$result = $conn->query("SHOW TABLES LIKE 'admin_users'");
if ($result->num_rows == 0) {
    echo "❌ Table 'admin_users' does not exist<br>";
    echo "<p style='color:red;'><strong>SOLUTION: Import unisan_db.sql file in phpMyAdmin</strong></p>";
    exit();
} else {
    echo "✅ Table 'admin_users' exists<br>";
}

// Step 4: Check for admin user
echo "<h3>Step 4: Checking for admin user</h3>";
$query = "SELECT * FROM admin_users WHERE username = 'admin'";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    echo "❌ No admin user found<br>";
    echo "<p style='color:orange;'><strong>SOLUTION: Creating admin user now...</strong></p>";
    
    // Create admin user
    $password_hash = password_hash('admin123', PASSWORD_DEFAULT);
    $insert = "INSERT INTO admin_users (username, password, email) VALUES ('admin', '$password_hash', 'admin@unisan.gov.ph')";
    
    if ($conn->query($insert)) {
        echo "✅ Admin user created successfully!<br>";
        echo "<p style='color:green;'><strong>You can now login with: admin / admin123</strong></p>";
        echo "<a href='admin_login.php' style='padding:10px 20px; background:#667eea; color:white; text-decoration:none; border-radius:5px;'>Go to Login Page</a>";
    } else {
        echo "❌ Error creating admin user: " . $conn->error . "<br>";
    }
} else {
    $admin = $result->fetch_assoc();
    echo "✅ Admin user found<br>";
    echo "<strong>Username:</strong> " . $admin['username'] . "<br>";
    echo "<strong>Email:</strong> " . ($admin['email'] ?? 'N/A') . "<br>";
    echo "<strong>Password Hash:</strong> <code style='background:#f0f0f0; padding:5px;'>" . substr($admin['password'], 0, 50) . "...</code><br>";
    
    // Step 5: Test password verification
    echo "<h3>Step 5: Testing Password Verification</h3>";
    $test_password = 'admin123';
    
    if (password_verify($test_password, $admin['password'])) {
        echo "✅ Password verification WORKS for 'admin123'<br>";
        echo "<p style='color:green;'><strong>Login should work! Try again.</strong></p>";
        
        // Test the actual login logic
        echo "<h3>Step 6: Testing Login Logic</h3>";
        $username_input = 'admin';
        $password_input = 'admin123';
        
        $login_query = "SELECT * FROM admin_users WHERE username = '$username_input'";
        $login_result = $conn->query($login_query);
        
        if ($login_result->num_rows > 0) {
            $user = $login_result->fetch_assoc();
            if (password_verify($password_input, $user['password'])) {
                echo "✅ Login logic test PASSED<br>";
                echo "<p style='color:green;'><strong>Everything is working! Check your admin_login.php file.</strong></p>";
            } else {
                echo "❌ Login logic test FAILED - password verify failed<br>";
            }
        } else {
            echo "❌ Login logic test FAILED - user not found<br>";
        }
        
    } else {
        echo "❌ Password verification FAILED<br>";
        echo "<p style='color:orange;'><strong>Need to reset password...</strong></p>";
        
        // Reset password
        $new_hash = password_hash('admin123', PASSWORD_DEFAULT);
        $update = "UPDATE admin_users SET password = '$new_hash' WHERE username = 'admin'";
        
        if ($conn->query($update)) {
            echo "✅ Password reset successfully!<br>";
            echo "<p style='color:green;'><strong>Try login now with: admin / admin123</strong></p>";
        } else {
            echo "❌ Error resetting password: " . $conn->error . "<br>";
        }
    }
}

// Step 7: Check admin_login.php
echo "<h3>Step 7: Checking admin_login.php</h3>";
if (file_exists('admin_login.php')) {
    echo "✅ admin_login.php exists<br>";
    echo "<a href='admin_login.php' style='padding:10px 20px; background:#667eea; color:white; text-decoration:none; border-radius:5px; margin-top:10px; display:inline-block;'>Go to Login Page</a>";
} elseif (file_exists('admin/login.php')) {
    echo "✅ admin/login.php exists<br>";
    echo "<a href='admin/login.php' style='padding:10px 20px; background:#667eea; color:white; text-decoration:none; border-radius:5px; margin-top:10px; display:inline-block;'>Go to Login Page</a>";
} else {
    echo "❌ Login file not found<br>";
}

$conn->close();
?>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background: #f5f5f5;
}
h2, h3 {
    color: #667eea;
}
hr {
    border: 0;
    height: 2px;
    background: linear-gradient(to right, #667eea, #764ba2);
    margin: 20px 0;
}
code {
    background: #f0f0f0;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 12px;
}
</style>