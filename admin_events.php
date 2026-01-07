<?php
include 'config.php';
requireLogin();

$message = '';
$message_type = '';
$contact_unread = $conn->query(
    "SELECT COUNT(*) AS total FROM contact_us WHERE status='unread'"
)->fetch_assoc()['total'];

$submit_unread = $conn->query(
    "SELECT COUNT(*) AS total FROM submit_request WHERE status='unread'"
)->fetch_assoc()['total'];

$unread_count = $contact_unread + $submit_unread;

// Get unread submissions count for sidebar
$unread_count = $conn->query("SELECT COUNT(*) as total FROM form_submissions WHERE is_read = 0")->fetch_assoc()['total'];

// Handle DELETE
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $sql = "DELETE FROM events WHERE id = $id";
    if ($conn->query($sql)) {
        $message = 'Event deleted successfully!';
        $message_type = 'success';
    } else {
        $message = 'Error deleting event: ' . $conn->error;
        $message_type = 'danger';
    }
}

// Handle ADD/EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $event_date = sanitize($_POST['event_date']);
    $event_title = sanitize($_POST['event_title']);
    $event_description = sanitize($_POST['event_description']);
    
    if ($id > 0) {
        // Update
        $sql = "UPDATE events SET event_date='$event_date', event_title='$event_title', event_description='$event_description' WHERE id=$id";
        $success_msg = 'Event updated successfully!';
    } else {
        // Insert
        $sql = "INSERT INTO events (event_date, event_title, event_description) VALUES ('$event_date', '$event_title', '$event_description')";
        $success_msg = 'Event added successfully!';
    }
    
    if ($conn->query($sql)) {
        $message = $success_msg;
        $message_type = 'success';
    } else {
        $message = 'Error: ' . $conn->error;
        $message_type = 'danger';
    }
}

// Get event for editing
$edit_event = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $result = $conn->query("SELECT * FROM events WHERE id = $edit_id");
    $edit_event = $result->fetch_assoc();
}

// Get all events
$events = $conn->query("SELECT * FROM events ORDER BY event_date ASC");

// Make sure sanitize function exists
if (!function_exists('sanitize')) {
    function sanitize($data) {
        global $conn;
        return htmlspecialchars($conn->real_escape_string(trim($data)));
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Events - Unisan Admin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
.sidebar { min-height: 100vh; background: linear-gradient(135deg, #750a08ff   0%, #750a08ff   100%); color: white; }
.sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 10px; border-radius: 8px; transition: all 0.3s; }
.sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.2); color: white; }
.sidebar .nav-link i { margin-right: 10px; }
.navbar-custom { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
.card { border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.08); border-radius: 10px; }
.btn-action { padding: 5px 10px; font-size: 14px; }
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
            <span class="navbar-brand mb-0 h1">Manage Events</span>
        </nav>
        <div class="p-4">
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                    <?php echo $message; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <!-- Add/Edit Form -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><?php echo $edit_event ? 'Edit Event' : 'Add New Event'; ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="">
                        <?php if ($edit_event): ?>
                            <input type="hidden" name="id" value="<?php echo $edit_event['id']; ?>">
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="event_date" class="form-label">Event Date</label>
                                <input type="date" class="form-control" id="event_date" name="event_date" 
                                       value="<?php echo $edit_event ? $edit_event['event_date'] : ''; ?>" required>
                            </div>
                            <div class="col-md-9 mb-3">
                                <label for="event_title" class="form-label">Event Title</label>
                                <input type="text" class="form-control" id="event_title" name="event_title" 
                                       value="<?php echo $edit_event ? htmlspecialchars($edit_event['event_title']) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="event_description" class="form-label">Event Description</label>
                            <textarea class="form-control" id="event_description" name="event_description" 
                                      rows="3" required><?php echo $edit_event ? htmlspecialchars($edit_event['event_description']) : ''; ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> <?php echo $edit_event ? 'Update Event' : 'Add Event'; ?>
                        </button>
                        <?php if ($edit_event): ?>
                            <a href="admin_events.php" class="btn btn-secondary">Cancel</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- Events List -->
            <div class="card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">All Events</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($event = $events->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo date('M d, Y', strtotime($event['event_date'])); ?></td>
                                        <td><strong><?php echo htmlspecialchars($event['event_title']); ?></strong></td>
                                        <td><?php echo htmlspecialchars(substr($event['event_description'], 0, 100)) . '...'; ?></td>
                                        <td>
                                            <a href="?edit=<?php echo $event['id']; ?>" class="btn btn-sm btn-warning btn-action">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="?delete=<?php echo $event['id']; ?>" 
                                               class="btn btn-sm btn-danger btn-action" 
                                               onclick="return confirm('Are you sure you want to delete this event?')">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
