<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'config.php';

$error = '';
$debug_info = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = sanitize($_POST['username']);
    $password = $_POST['password'];
    
    // Debug: Log the input
    $debug_info[] = "Username entered: " . $username;
    $debug_info[] = "Password length: " . strlen($password);
    
    $sql = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    // Debug: Check query result
    $debug_info[] = "Query executed: " . $sql;
    $debug_info[] = "Rows found: " . $result->num_rows;
    
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        
        // Debug: Show user data (partial)
        $debug_info[] = "User found with ID: " . $admin['id'];
        $debug_info[] = "Stored hash (first 20 chars): " . substr($admin['password'], 0, 20) . "...";
        
        // Verify password
        $verify_result = password_verify($password, $admin['password']);
        $debug_info[] = "Password verify result: " . ($verify_result ? 'TRUE' : 'FALSE');
        
        if ($verify_result) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $debug_info[] = "Session created successfully";
            header('Location: admin_dashboard.php');
            exit();
        } else {
            $error = 'Invalid username or password';
            $debug_info[] = "Password verification FAILED";
        }
    } else {
        $error = 'Invalid username or password';
        $debug_info[] = "No user found with username: " . $username;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Unisan Quezon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #9f2320db  0%, #750a08ff  100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 450px;
            width: 100%;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-header h2 {
            color: #e34635ff;
            font-weight: 700;
            margin-bottom: 5px;
        }
        .login-header p {
            color: #6c757d;
            font-size: 14px;
        }
        .btn-login {
            background: linear-gradient(135deg, #af3f39ff 0%, #6c0402ff 100%);
            border: none;
            padding: 12px;
            font-weight: 600;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(125, 37, 13, 0.4);
        }
        .alert {
            border-radius: 10px;
        }
        .debug-info {
            background: #f1847cff;
            border: 1px solid #fd5748ff;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            font-size: 12px;
        }
        .debug-info h6 {
            margin-bottom: 10px;
            color: #495057;
        }
        .debug-info ul {
            margin: 0;
            padding-left: 20px;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a {
            color: white;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div>
        <div class="login-container">
            <div class="login-header">
                <h2>🏛️ Admin Portal</h2>
                <p>Municipality of Unisan, Quezon</p>
            </div>

            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" 
                           value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-login w-100">Login</button>
            </form>

           
            <?php if (!empty($debug_info)): ?>
                <div class="debug-info">
                    <h6>🐛 Debug Information:</h6>
                    <ul>
                        <?php foreach ($debug_info as $info): ?>
                            <li><?php echo htmlspecialchars($info); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="text-center mt-3">
                <a href="debug_login.php" class="btn btn-sm btn-outline-secondary">🔍 Run Full Diagnostic</a>
            </div>
        </div>

        <div class="back-link">
            <a href="index.php">← Back to Website</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>