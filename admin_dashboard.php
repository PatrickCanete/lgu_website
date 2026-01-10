<?php
include 'config.php';
requireLogin();

// Counts
$events_count = $conn->query("SELECT COUNT(*) AS total FROM events")->fetch_assoc()['total'];
$submissions_count = $conn->query("SELECT COUNT(*) AS total FROM submit_request")->fetch_assoc()['total'];
$contact_total = $conn->query("SELECT COUNT(*) AS total FROM contact_us")->fetch_assoc()['total'];
$contact_unread = $conn->query("SELECT COUNT(*) AS total FROM contact_us WHERE status='unread'")->fetch_assoc()['total'];
$submit_unread = $conn->query("SELECT COUNT(*) AS total FROM submit_request WHERE status='unread'")->fetch_assoc()['total'];


$unread_count = $contact_unread + $submit_unread;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Dashboard - Unisan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
.sidebar { min-height: 100vh; background: linear-gradient(135deg, #750a08ff 0%, #750a08ff 100%); color: white; position: fixed; width: 16.666667%; }
.sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 10px; border-radius: 8px; transition: all 0.3s; text-decoration: none; display: block; }
.sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.2); color: white; }
.sidebar .nav-link i { margin-right: 10px; width: 20px; }
.main-wrapper { margin-left: 16.666667%; }
.stat-card { border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s; }
.stat-card:hover { transform: translateY(-5px); }
.stat-icon { font-size: 40px; opacity: 0.8; }
.navbar-custom { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
</style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="p-4">
                <h4 class="mb-4">Unisan Admin</h4>
                <nav class="nav flex-column">
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_dashboard.php'?'active':'' ?>" href="admin_dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_events.php'?'active':'' ?>" href="admin_events.php"><i class="fas fa-calendar-alt"></i> Events</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_tourism.php'?'active':'' ?>" href="admin_tourism.php"><i class="fas fa-map-marked-alt"></i> Tourism</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_government.php'?'active':'' ?>" href="admin_government.php"><i class="fas fa-landmark"></i> Government Officials</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_barangay.php'?'active':'' ?>" href="admin_barangay.php"><i class="fas fa-building"></i> Barangays</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_history.php'?'active':'' ?>" href="admin_history.php"><i class="fas fa-history"></i> History</a>
                    <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_submissions.php'?'active':'' ?>" href="admin_submissions.php"><i class="fas fa-envelope"></i> Submissions
                        <?php if($unread_count>0): ?><span class="badge bg-danger"><?= $unread_count ?></span><?php endif; ?>
                    </a>
                    <hr class="my-3" style="border-color: rgba(255,255,255,0.2)">
                    <a class="nav-link" href="admin_logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 main-wrapper p-0">
            <nav class="navbar navbar-custom px-4">
                <span class="navbar-brand mb-0 h1">Dashboard</span>
                <span class="text-muted">Welcome, <?= $_SESSION['admin_username']; ?>!</span>
            </nav>

           <div class="row g-4 mb-4">
    <!-- Total Events -->
    <div class="col-md-3">
        <div class="card stat-card text-white" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-2">Total Events</h6>
                    <h2 class="mb-0"><?= $events_count ?></h2>
                </div>
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
            </div>
        </div>
    </div>

    <!-- Submit Requests -->
    <div class="col-md-3">
        <div class="card stat-card text-white" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-2">Submit Requests</h6>
                    <h2 class="mb-0"><?= $submissions_count ?></h2>
                </div>
                <div class="stat-icon"><i class="fas fa-paper-plane"></i></div>
            </div>
        </div>
    </div>

    <!-- Contact Messages -->
    <div class="col-md-3">
        <div class="card stat-card text-white" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-2">Contact Messages</h6>
                    <h2 class="mb-0"><?= $contact_total ?></h2>
                </div>
                <div class="stat-icon"><i class="fas fa-comments"></i></div>
            </div>
        </div>
    </div>

    <!-- Unread Messages (Not Clickable) -->
    <div class="col-md-3">
        <div class="card stat-card text-white" style="background: linear-gradient(135deg, #ff6a00 0%, #ee0979 100%);">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-white-50 mb-2">Unread Messages</h6>
                    <h2 class="mb-0"><?= $unread_count ?></h2>
                </div>
                <div class="stat-icon"><i class="fas fa-envelope-open-text"></i></div>
            </div>
        </div>
    </div>
</div>

             
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>