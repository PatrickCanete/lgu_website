<?php
include 'config.php';
requireLogin();

$message = '';
$message_type = '';

// Ensure uploads folder exists
$upload_dir = 'uploads/tourism/';
if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

// Get unread counts
$contact_unread = $conn->query("SELECT COUNT(*) AS total FROM contact_us WHERE status='unread'")->fetch_assoc()['total'];
$submit_unread = $conn->query("SELECT COUNT(*) AS total FROM submit_request WHERE status='unread'")->fetch_assoc()['total'];
$unread_count = $contact_unread + $submit_unread;

// Handle DELETE
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $row = $conn->query("SELECT image_path FROM tourism_attractions WHERE id=$id")->fetch_assoc();
    if ($row && file_exists($row['image_path'])) unlink($row['image_path']);
    $conn->query("DELETE FROM tourism_attractions WHERE id=$id");
    header('Location: admin_tourism.php');
    exit();
}

// Handle FEATURE toggle
if (isset($_GET['feature'])) {
    $id = intval($_GET['feature']);
    $row = $conn->query("SELECT is_featured FROM tourism_attractions WHERE id=$id")->fetch_assoc();
    $newStatus = $row['is_featured'] ? 0 : 1;
    $conn->query("UPDATE tourism_attractions SET is_featured=$newStatus WHERE id=$id");
    header('Location: admin_tourism.php');
    exit();
}

// Handle ADD/EDIT
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $title = htmlspecialchars($_POST['title']);
    $location = htmlspecialchars($_POST['location']);
    $category = $_POST['category'];

    // Handle image upload
    $image_path = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = $upload_dir . uniqid() . '.' . $ext;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $filename)){
            $image_path = $filename;
        } else {
            $message = 'Failed to upload image.';
            $message_type = 'danger';
        }
    }

    if ($id > 0) {
        // Keep old image if no new upload
        if(empty($image_path)){
            $old = $conn->query("SELECT image_path FROM tourism_attractions WHERE id=$id")->fetch_assoc();
            $image_path = $old['image_path'];
        }
        $sql = "UPDATE tourism_attractions SET title='$title', location='$location', category='$category', image_path='$image_path' WHERE id=$id";
        $success_msg = 'Tourism attraction updated successfully!';
    } else {
        $sql = "INSERT INTO tourism_attractions (title, location, category, image_path) VALUES ('$title','$location','$category','$image_path')";
        $success_msg = 'Tourism attraction added successfully!';
    }

    if ($conn->query($sql)) {
        $message = $success_msg;
        $message_type = 'success';
    } else {
        $message = 'Error: ' . $conn->error;
        $message_type = 'danger';
    }
}

// Get entry for editing
$edit_entry = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_entry = $conn->query("SELECT * FROM tourism_attractions WHERE id=$edit_id")->fetch_assoc();
}

// Get all entries
$entries = $conn->query("SELECT * FROM tourism_attractions ORDER BY is_featured DESC, category ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tourism Admin - Unisan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body {font-family:'Poppins',sans-serif;background: #f4f6f9;}
.sidebar { min-height: 100vh; background: linear-gradient(135deg, #750a08ff ,  0%, #750a08ff    100% ); color: white; }
.sidebar .nav-link {color: rgba(255,255,255,0.8);padding:12px 20px;margin:5px 10px;border-radius:8px;transition: all 0.3s;}
.sidebar .nav-link:hover, .sidebar .nav-link.active {background: rgba(255,255,255,0.2); color:white;}
.sidebar .nav-link i { margin-right:10px; }
.navbar-custom { background:white; box-shadow:0 2px 10px rgba(0,0,0,0.05); }
.card { border:none; box-shadow:0 5px 15px rgba(0,0,0,0.08); border-radius:10px; }
.card img { width:100%; height:180px; object-fit:cover; border-radius:10px; margin-bottom:15px; }
.card-title { font-size:1.1rem; font-weight:600; color:#991b1b; }
.featured-badge { background:#dc2626; color:#fff; padding:5px 12px; border-radius:20px; font-size:12px; display:inline-block; margin-bottom:10px; }
.grid { display:grid; gap:20px; }
.grid-4 { grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); }
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
            <span class="navbar-brand mb-0 h1">Tourism Management</span>
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
                    <h5 class="mb-0"><?php echo $edit_entry ? 'Edit Tourism Attraction' : 'Add New Tourism Attraction'; ?></h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        <?php if ($edit_entry): ?>
                            <input type="hidden" name="id" value="<?= $edit_entry['id']; ?>">
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required value="<?= $edit_entry ? htmlspecialchars($edit_entry['title']) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" id="location" required value="<?= $edit_entry ? htmlspecialchars($edit_entry['location']) : ''; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" name="category" id="category" required>
                                <option value="Restaurant" <?= $edit_entry && $edit_entry['category']=='Restaurant'?'selected':''; ?>>Restaurant</option>
                                <option value="Beach & Resort" <?= $edit_entry && $edit_entry['category']=='Beach & Resort'?'selected':''; ?>>Beach & Resort</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input type="file" class="form-control" name="image" id="image" <?= $edit_entry ? '' : 'required'; ?>>
                            <?php if($edit_entry && $edit_entry['image_path']): ?>
                                <img src="<?= $edit_entry['image_path']; ?>" alt="Current Image" style="width:150px;margin-top:10px;">
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> <?= $edit_entry ? 'Update' : 'Add'; ?></button>
                        <?php if ($edit_entry): ?>
                            <a href="admin_tourism.php" class="btn btn-secondary">Cancel</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- Tourism Grid -->
            <div class="section">
                <div class="grid grid-4">
                    <?php while ($row = $entries->fetch_assoc()): ?>
                        <div class="card">
                            <img src="<?= $row['image_path']; ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                            <?php if($row['is_featured']): ?>
                                <span class="featured-badge">⭐ Featured</span>
                            <?php endif; ?>
                            <div class="card-title"><?= htmlspecialchars($row['title']); ?></div>
                            <div class="card-description"><?= htmlspecialchars($row['location']); ?></div>
                            <div class="mt-2">
                                <a href="?edit=<?= $row['id']; ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="?delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this attraction?')"><i class="fas fa-trash"></i> Delete</a>
                                <a href="?feature=<?= $row['id']; ?>" class="btn btn-sm btn-info text-white"><i class="fas fa-star"></i> <?= $row['is_featured'] ? 'Unfeature' : 'Feature'; ?></a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
