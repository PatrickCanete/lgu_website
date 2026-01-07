<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'lgu_db';

// Connect to database
$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("<h2 style='color:red;'>❌ Connection failed: " . $conn->connect_error . "</h2>");
}

echo "<h1>🚀 LGU Database Installer</h1>";
echo "<hr>";

$success = true;
$messages = [];

// Create admin_users table
$sql1 = "CREATE TABLE IF NOT EXISTS admin_users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql1)) {
    $messages[] = "✅ Table 'admin_users' created successfully";
} else {
    $messages[] = "❌ Error creating admin_users: " . $conn->error;
    $success = false;
}

// Create events table
$sql2 = "CREATE TABLE IF NOT EXISTS events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    event_date DATE NOT NULL,
    event_title VARCHAR(200) NOT NULL,
    event_description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql2)) {
    $messages[] = "✅ Table 'events' created successfully";
} else {
    $messages[] = "❌ Error creating events: " . $conn->error;
    $success = false;
}

// Create form_submissions table
$sql3 = "CREATE TABLE IF NOT EXISTS form_submissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_read TINYINT(1) DEFAULT 0
)";

if ($conn->query($sql3)) {
    $messages[] = "✅ Table 'form_submissions' created successfully";
} else {
    $messages[] = "❌ Error creating form_submissions: " . $conn->error;
    $success = false;
}

// Check if admin user exists
$check_admin = $conn->query("SELECT * FROM admin_users WHERE username = 'admin'");

if ($check_admin->num_rows == 0) {
    // Insert admin user
    $password_hash = password_hash('admin123', PASSWORD_DEFAULT);
    $sql4 = "INSERT INTO admin_users (username, password, email) 
             VALUES ('admin', '$password_hash', 'admin@unisan.gov.ph')";
    
    if ($conn->query($sql4)) {
        $messages[] = "✅ Admin user created successfully";
        $messages[] = "   Username: <strong>admin</strong>";
        $messages[] = "   Password: <strong>admin123</strong>";
    } else {
        $messages[] = "❌ Error creating admin user: " . $conn->error;
        $success = false;
    }
} else {
    $messages[] = "ℹ️ Admin user already exists";
}

// Check if events exist
$check_events = $conn->query("SELECT COUNT(*) as count FROM events");
$event_count = $check_events->fetch_assoc()['count'];

if ($event_count == 0) {
    // Insert sample events
    $sql5 = "INSERT INTO events (event_date, event_title, event_description) VALUES
    ('2025-06-29', 'Unisan Town Fiesta', 'A celebration of culture and community with parades, food stalls, and local performances.'),
    ('2025-07-15', 'Coastal Clean-Up Day', 'Join us in keeping our beaches clean and beautiful. Supplies will be provided.'),
    ('2025-08-10', 'Unisan Sports Festival', 'A day of friendly competition featuring various sports and games for all ages.'),
    ('2025-09-05', 'Cultural Heritage Day', 'Experience the rich history of Unisan through exhibits, workshops, and traditional performances.')";
    
    if ($conn->query($sql5)) {
        $messages[] = "✅ Sample events added successfully";
    } else {
        $messages[] = "❌ Error adding sample events: " . $conn->error;
    }
} else {
    $messages[] = "ℹ️ Events already exist ($event_count events)";
}

// Display results
echo "<div style='background:#f8f9fa; padding:20px; border-radius:10px; margin:20px 0;'>";
foreach ($messages as $message) {
    echo "<p style='margin:5px 0;'>$message</p>";
}
echo "</div>";

if ($success) {
    echo "<div style='background:#d4edda; border:1px solid #c3e6cb; color:#155724; padding:20px; border-radius:10px; margin:20px 0;'>";
    echo "<h2>🎉 Installation Complete!</h2>";
    echo "<p><strong>You can now login to the admin panel:</strong></p>";
    echo "<p>Username: <code style='background:#fff; padding:5px 10px; border-radius:3px;'>admin</code></p>";
    echo "<p>Password: <code style='background:#fff; padding:5px 10px; border-radius:3px;'>admin123</code></p>";
    echo "<br>";
    echo "<a href='admin_login.php' style='background:#667eea; color:white; padding:10px 20px; text-decoration:none; border-radius:5px; display:inline-block;'>Go to Login Page →</a>";
    echo "</div>";
    
    // Show database info
    echo "<h3>📊 Database Summary:</h3>";
    echo "<table style='border-collapse:collapse; width:100%; max-width:600px;'>";
    echo "<tr style='background:#667eea; color:white;'>";
    echo "<th style='padding:10px; text-align:left; border:1px solid #ddd;'>Table</th>";
    echo "<th style='padding:10px; text-align:left; border:1px solid #ddd;'>Rows</th>";
    echo "</tr>";
    
    $tables = ['admin_users', 'events', 'form_submissions'];
    foreach ($tables as $table) {
        $result = $conn->query("SELECT COUNT(*) as count FROM $table");
        $count = $result->fetch_assoc()['count'];
        echo "<tr>";
        echo "<td style='padding:10px; border:1px solid #ddd;'>$table</td>";
        echo "<td style='padding:10px; border:1px solid #ddd;'>$count</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<div style='background:#f8d7da; border:1px solid #f5c6cb; color:#721c24; padding:20px; border-radius:10px; margin:20px 0;'>";
    echo "<h2>⚠️ Installation had some errors</h2>";
    echo "<p>Please check the messages above and try again.</p>";
    echo "</div>";
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
    background: #f0f0f0;
    padding: 2px 6px;
    border-radius: 3px;
}
</style>