<?php
// Reset Admin Password Script
include 'config.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    
    if ($new_password !== $confirm_password) {
        $message = 'Passwords do not match!';
        $message_type = 'danger';
    } elseif (strlen($new_password) < 6) {
        $message = 'Password must be at least 6 characters!';
        $message_type = 'danger';
    } else {
        // Hash the new password
        $hashed = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Update the admin password
        $sql = "UPDATE admin_users SET password = '$hashed' WHERE username = 'admin'";
        
        if ($conn->query($sql)) {
            $message = 'Password reset successful! You can now login with: admin / ' . $new_password;
            $message_type = 'success';
        } else {
            $message = 'Error: ' . $conn->error;
            $message_type = 'danger';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Admin Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        }
        .reset-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 500px;
            width: 100%;
        }
        .btn-reset {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <h2 class="mb-4 text-center">🔐 Reset Admin Password</h2>
        
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $message_type; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if ($message_type !== 'success'): ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input type="password" class="form-control" name="new_password" required minlength="6">
                <small class="text-muted">Minimum 6 characters</small>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" required minlength="6">
            </div>
            <button type="submit" class="btn btn-reset w-100">Reset Password</button>
        </form>
        <?php else: ?>
            <div class="text-center mt-3">
                <a href="admin_login.php" class="btn btn-primary">Go to Login</a>
            </div>
        <?php endif; ?>

        <div class="text-center mt-3">
            <small class="text-muted">Current username: admin</small>
        </div>
    </div>
</body>
</html>