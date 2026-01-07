<?php
// ------------------ ERRORS & TIMEZONE ------------------
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Manila');

include 'config.php';
requireLogin();

// ------------------ HANDLE MARK AS READ ------------------
if (isset($_GET['read'])) {
    $id = intval($_GET['read']);
    $type = $_GET['type'] ?? 'contact';
    $current_time = date('Y-m-d H:i:s');

    if ($type === 'submit') {
        $conn->query("UPDATE submit_request SET status='read', date_read='$current_time' WHERE id=$id");
    } else {
        $conn->query("UPDATE contact_us SET status='read', date_read='$current_time' WHERE id=$id");
    }

    header('Location: admin_submissions.php');
    exit();
}

// ------------------ HANDLE DELETE ------------------
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $type = $_GET['type'] ?? 'contact';

    if ($type === 'submit') {
        $conn->query("DELETE FROM submit_request WHERE id=$id");
    } else {
        $conn->query("DELETE FROM contact_us WHERE id=$id");
    }

    header('Location: admin_submissions.php');
    exit();
}

// ------------------ GET COUNTS ------------------
$contact_unread = $conn->query("SELECT COUNT(*) AS total FROM contact_us WHERE status='unread'")->fetch_assoc()['total'];
$submit_unread = $conn->query("SELECT COUNT(*) AS total FROM submit_request WHERE status='unread'")->fetch_assoc()['total'];
$unread_count = $contact_unread + $submit_unread;

$events_count = $conn->query("SELECT COUNT(*) as count FROM events")->fetch_assoc()['count'];
$submit_requests_count = $conn->query("SELECT COUNT(*) as count FROM submit_request")->fetch_assoc()['count'];

// ------------------ GET DATA ------------------
$requests = $conn->query("SELECT * FROM submit_request ORDER BY date_submitted DESC");
$messages = $conn->query("SELECT * FROM contact_us ORDER BY submitted_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submissions - Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
.sidebar { min-height: 100vh; background: linear-gradient(135deg, #750a08ff  0%, #750a08ff 100%); color: white; }
.sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 10px; border-radius: 8px; transition: all 0.3s; }
.sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.2); color:white; }
.navbar-custom { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
.card { border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); }
.status-dot { display:inline-block; width:10px; height:10px; border-radius:50%; margin-right:5px; }
.submission-unread { font-weight:600; background-color:#e3f2fd; }
</style>
</head>
<body>
<div class="container-fluid">
<div class="row">

   <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="p-4">
                <h4 class="mb-4">🏛️ Unisan Admin</h4>
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
<div class="col-md-10 p-0">
    <nav class="navbar navbar-custom px-4">
        <span class="navbar-brand mb-0 h1">Submissions</span>
    </nav>

    <div class="p-4">

        <!-- Submit Requests Table -->
        <div class="card mb-4">
            <div class="card-header bg-white"><h5 class="mb-0">Submit Requests</h5></div>
            <div class="card-body">
                <?php if ($requests->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date Submitted</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Read At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($req = $requests->fetch_assoc()): ?>
                            <tr class="<?= ($req['status']??'unread')=='unread' ? 'submission-unread' : '' ?>">
                                <td><?= date('M d, Y h:i A', strtotime($req['date_submitted'])) ?></td>
                                <td><?= htmlspecialchars($req['citizen_name']) ?></td>
                                <td><?= htmlspecialchars($req['request_type']) ?></td>
                                <td><?= htmlspecialchars($req['description']) ?></td>
                                <td><?= ucfirst($req['status'] ?? 'unread') ?></td>
                                <td><?= ($req['date_read']) ? date('M d, Y h:i A', strtotime($req['date_read'])) : '-' ?></td>
                                <td>
                                    <?php if(($req['status']??'unread')=='unread'): ?>
                                        <a href="?read=<?= $req['id'] ?>&type=submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Mark Read</a>
                                    <?php endif; ?>
                                    <a href="?delete=<?= $req['id'] ?>&type=submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this request?')"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">No submit requests yet</h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Contact Us Messages Table -->
        <div class="card">
            <div class="card-header bg-white"><h5 class="mb-0">Contact Us Messages</h5></div>
            <div class="card-body">
                <?php if ($messages->num_rows > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date Submitted</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Status</th>
                                <th>Read At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($msg = $messages->fetch_assoc()): ?>
                            <tr class="<?= $msg['status']=='unread' ? 'submission-unread' : '' ?>">
                                <td><?= date('M d, Y h:i A', strtotime($msg['submitted_at'])); ?></td>
                                <td><?= htmlspecialchars($msg['name']); ?></td>
                                <td><?= htmlspecialchars($msg['email']); ?></td>
                                <td><?= htmlspecialchars($msg['phone']); ?></td>
                                <td><?= htmlspecialchars(substr($msg['message'],0,50)) . '...'; ?></td>
                                <td><?= ucfirst($msg['status']); ?></td>
                                <td><?= ($msg['date_read']) ? date('M d, Y h:i A', strtotime($msg['date_read'])) : '-' ?></td>
                                <td>
                                    <?php if($msg['status']=='unread'): ?>
                                        <a href="?read=<?= $msg['id'] ?>&type=contact" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Mark Read</a>
                                    <?php endif; ?>
                                    <a href="?delete=<?= $msg['id'] ?>&type=contact" class="btn btn-sm btn-danger" onclick="return confirm('Delete this message?')"><i class="fas fa-trash"></i> Delete</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <?php else: ?>
                    <div class="text-center py-5">
                        <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                        <h5 class="text-muted">No messages yet</h5>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
