<?php
include 'config.php';
requireLogin();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Add New Event
    if (isset($_POST['add_event'])) {
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $display_order = mysqli_real_escape_string($conn, $_POST['display_order']);
        
        $image_path = NULL;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $target_dir = "images/history/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $new_filename = 'event_' . time() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $target_file;
            }
        }
        
        $sql = "INSERT INTO history_events (year, title, description, image_path, position, display_order) 
                VALUES ('$year', '$title', '$description', " . ($image_path ? "'$image_path'" : "NULL") . ", '$position', '$display_order')";
        
        if (mysqli_query($conn, $sql)) {
            $success = "Event added successfully!";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
    
    // Update Event
    if (isset($_POST['update_event'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $position = mysqli_real_escape_string($conn, $_POST['position']);
        $display_order = mysqli_real_escape_string($conn, $_POST['display_order']);
        
        $image_update = "";
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            // Delete old image
            $old_query = "SELECT image_path FROM history_events WHERE id = '$id'";
            $old_result = mysqli_query($conn, $old_query);
            $old_data = mysqli_fetch_assoc($old_result);
            if ($old_data['image_path'] && file_exists($old_data['image_path'])) {
                unlink($old_data['image_path']);
            }
            
            $target_dir = "images/history/";
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            $file_extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $new_filename = 'event_' . time() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_update = ", image_path = '$target_file'";
            }
        }
        
        $sql = "UPDATE history_events SET 
                year = '$year', 
                title = '$title', 
                description = '$description', 
                position = '$position', 
                display_order = '$display_order'
                $image_update
                WHERE id = '$id'";
        
        if (mysqli_query($conn, $sql)) {
            $success = "Event updated successfully!";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
    
    // Delete Event
    if (isset($_POST['delete_event'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        
        // Delete image file
        $query = "SELECT image_path FROM history_events WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
        $data = mysqli_fetch_assoc($result);
        if ($data['image_path'] && file_exists($data['image_path'])) {
            unlink($data['image_path']);
        }
        
        $sql = "DELETE FROM history_events WHERE id = '$id'";
        if (mysqli_query($conn, $sql)) {
            $success = "Event deleted successfully!";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
    
    // Update Main Image
    if (isset($_POST['update_main_image'])) {
        $alt_text = mysqli_real_escape_string($conn, $_POST['alt_text']);
        
        if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === 0) {
            // Delete old image
            $old_query = "SELECT image_path FROM history_main_image WHERE id = 1";
            $old_result = mysqli_query($conn, $old_query);
            $old_data = mysqli_fetch_assoc($old_result);
            if ($old_data && $old_data['image_path'] && file_exists($old_data['image_path'])) {
                unlink($old_data['image_path']);
            }
            
            $target_dir = "images/";
            $file_extension = pathinfo($_FILES['main_image']['name'], PATHINFO_EXTENSION);
            $new_filename = 'unisan_main_' . time() . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            if (move_uploaded_file($_FILES['main_image']['tmp_name'], $target_file)) {
                // Check if record exists
                $check = mysqli_query($conn, "SELECT id FROM history_main_image WHERE id = 1");
                if (mysqli_num_rows($check) > 0) {
                    $sql = "UPDATE history_main_image SET image_path = '$target_file', alt_text = '$alt_text' WHERE id = 1";
                } else {
                    $sql = "INSERT INTO history_main_image (image_path, alt_text) VALUES ('$target_file', '$alt_text')";
                }
                
                if (mysqli_query($conn, $sql)) {
                    $success = "Main image updated successfully!";
                } else {
                    $error = "Error: " . mysqli_error($conn);
                }
            }
        }
    }
}

// Fetch all events
$events_query = "SELECT * FROM history_events ORDER BY display_order ASC";
$events_result = mysqli_query($conn, $events_query);

// Fetch main image
$main_image_query = "SELECT * FROM history_main_image WHERE id = 1";
$main_image_result = mysqli_query($conn, $main_image_query);
$main_image = mysqli_fetch_assoc($main_image_result);

// Get count for dashboard
$history_count = mysqli_num_rows($events_result);
mysqli_data_seek($events_result, 0); // Reset pointer
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage History - Admin</title>
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
        .navbar-custom { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card { margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); border: none; border-radius: 10px; }
        .event-image { max-width: 100px; height: auto; border-radius: 5px; }
        .main-image-preview { max-width: 300px; height: auto; margin-top: 10px; border-radius: 8px; }
        .table-responsive { border-radius: 10px; overflow: hidden; }
        .btn { border-radius: 8px; }
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
            <div class="col-md-10 main-wrapper p-0">
                <nav class="navbar navbar-custom px-4">
                    <span class="navbar-brand mb-0 h1"><i class="fas fa-history"></i> Manage History</span>
                    <span class="text-muted">Welcome, <?= $_SESSION['admin_username']; ?>!</span>
                </nav>

                <div class="p-4">
                    <?php if (isset($success)): ?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <i class="fas fa-check-circle"></i> <?php echo $success; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Main Image Section -->
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                            <h5 class="mb-0"><i class="fas fa-image"></i> Main History Image</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <?php if ($main_image): ?>
                                        <img src="<?php echo $main_image['image_path']; ?>" alt="Current Main Image" class="main-image-preview img-fluid">
                                    <?php else: ?>
                                        <p class="text-muted">No main image set</p>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-8">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label"><i class="fas fa-upload"></i> New Main Image</label>
                                            <input type="file" name="main_image" class="form-control" accept="image/*" required>
                                            <small class="text-muted">Recommended size: 450x300px</small>
                                        </div>
                                        
                                        <button type="submit" name="update_main_image" class="btn btn-primary">
                                            <i class="fas fa-save"></i> Update Main Image
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add New Event -->
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%); color: white;">
                            <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Add New History Event</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Year/Period *</label>
                                        <input type="text" name="year" class="form-control" placeholder="e.g., 1591, 19th Century" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title *</label>
                                        <input type="text" name="title" class="form-control" placeholder="e.g., Founding of Kalilayan" required>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description *</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter historical description..." required></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Timeline Position *</label>
                                        <select name="position" class="form-control" required>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Display Order *</label>
                                        <input type="number" name="display_order" class="form-control" placeholder="1, 2, 3..." required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Image (Optional)</label>
                                        <input type="file" name="image" class="form-control" accept="image/*">
                                    </div>
                                </div>
                                <button type="submit" name="add_event" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Add Event
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- List of Events -->
                    <div class="card">
                        <div class="card-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                            <h5 class="mb-0"><i class="fas fa-list"></i> History Events (<?= $history_count ?>)</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead style="background-color: #f8f9fa;">
                                        <tr>
                                            <th width="80">Order</th>
                                            <th width="120">Year</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th width="100">Position</th>
                                            <th width="120">Image</th>
                                            <th width="150">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (mysqli_num_rows($events_result) > 0): ?>
                                            <?php while ($event = mysqli_fetch_assoc($events_result)): ?>
                                            <tr>
                                                <td><span class="badge bg-secondary"><?php echo $event['display_order']; ?></span></td>
                                                <td><?php echo htmlspecialchars($event['year']); ?></td>
                                                <td><strong><?php echo htmlspecialchars($event['title']); ?></strong></td>
                                                <td><?php echo substr(htmlspecialchars($event['description']), 0, 80) . '...'; ?></td>
                                                <td>
                                                    <?php if ($event['position'] == 'left'): ?>
                                                        <span class="badge bg-info">Left</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-primary">Right</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if ($event['image_path']): ?>
                                                        <img src="<?php echo $event['image_path']; ?>" class="event-image">
                                                    <?php else: ?>
                                                        <span class="text-muted"><i class="fas fa-image-slash"></i></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $event['id']; ?>">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $event['id']; ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Edit Modal -->
                                            <div class="modal fade" id="editModal<?php echo $event['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: white;">
                                                            <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Event</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="form-label">Year/Period</label>
                                                                        <input type="text" name="year" class="form-control" value="<?php echo htmlspecialchars($event['year']); ?>" required>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="form-label">Title</label>
                                                                        <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($event['title']); ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Description</label>
                                                                    <textarea name="description" class="form-control" rows="4" required><?php echo htmlspecialchars($event['description']); ?></textarea>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="form-label">Position</label>
                                                                        <select name="position" class="form-control" required>
                                                                            <option value="left" <?php echo $event['position'] == 'left' ? 'selected' : ''; ?>>Left</option>
                                                                            <option value="right" <?php echo $event['position'] == 'right' ? 'selected' : ''; ?>>Right</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-6 mb-3">
                                                                        <label class="form-label">Display Order</label>
                                                                        <input type="number" name="display_order" class="form-control" value="<?php echo $event['display_order']; ?>" required>
                                                                    </div>
                                                                </div>
                                                                <?php if ($event['image_path']): ?>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Current Image</label><br>
                                                                        <img src="<?php echo $event['image_path']; ?>" class="event-image mb-2">
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="mb-3">
                                                                    <label class="form-label">New Image (optional - leave empty to keep current)</label>
                                                                    <input type="file" name="image" class="form-control" accept="image/*">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="fas fa-times"></i> Cancel
                                                                </button>
                                                                <button type="submit" name="update_event" class="btn btn-warning">
                                                                    <i class="fas fa-save"></i> Update Event
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Delete Modal -->
                                            <div class="modal fade" id="deleteModal<?php echo $event['id']; ?>" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger text-white">
                                                            <h5 class="modal-title"><i class="fas fa-exclamation-triangle"></i> Confirm Delete</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this event?</p>
                                                            <div class="alert alert-warning">
                                                                <strong>Year:</strong> <?php echo htmlspecialchars($event['year']); ?><br>
                                                                <strong>Title:</strong> <?php echo htmlspecialchars($event['title']); ?>
                                                            </div>
                                                            <p class="text-danger"><small><i class="fas fa-info-circle"></i> This action cannot be undone!</small></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST">
                                                                <input type="hidden" name="id" value="<?php echo $event['id']; ?>">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                                    <i class="fas fa-times"></i> Cancel
                                                                </button>
                                                                <button type="submit" name="delete_event" class="btn btn-danger">
                                                                    <i class="fas fa-trash"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endwhile; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center text-muted py-4">
                                                    <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                                                    No history events yet. Add your first event above!
                                                </td>
                                            </tr>
                                        <?php endif; ?>
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
    <script>
        // Auto dismiss alerts after 5 seconds
        setTimeout(function() {
            var alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>
</body>
</html>