<?php
include 'config.php';
requireLogin();

// Handle Delete
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM government_officials WHERE id=$id");
    header("Location: admin_government.php?msg=deleted");
    exit;
}

// Handle Add/Edit
if($_SERVER['REQUEST_METHOD']=='POST') {
    $name = $conn->real_escape_string($_POST['name']);
    $position = $conn->real_escape_string($_POST['position']);
    $position_order = intval($_POST['position_order']);
    
    if(isset($_POST['id']) && $_POST['id']!='') {
        // Update
        $id = intval($_POST['id']);
        $conn->query("UPDATE government_officials SET name='$name', position='$position', position_order=$position_order WHERE id=$id");
        header("Location: admin_government.php?msg=updated");
    } else {
        // Insert
        $conn->query("INSERT INTO government_officials (name, position, position_order) VALUES ('$name', '$position', $position_order)");
        header("Location: admin_government.php?msg=added");
    }
    exit;
}

// Fetch all officials
$officials = $conn->query("SELECT * FROM government_officials ORDER BY position_order ASC, id ASC");

// For editing
$edit_official = null;
if(isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_official = $conn->query("SELECT * FROM government_officials WHERE id=$edit_id")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Government Officials - Unisan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
body { font-family: 'Poppins', sans-serif; background: #f4f6f9; }
.sidebar { min-height: 100vh; background: linear-gradient(135deg, #750a08ff 0%, #750a08ff 100%); color: white; }
.sidebar .nav-link { color: rgba(255,255,255,0.8); padding: 12px 20px; margin: 5px 10px; border-radius: 8px; transition: all 0.3s; }
.sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.2); color: white; }
.sidebar .nav-link i { margin-right: 10px; width: 20px; }
.navbar-custom { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
.table-card { background: white; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); padding: 25px; }
.btn-primary { background: linear-gradient(135deg, #750a08ff 0%, #b22222 100%); border: none; }
.btn-primary:hover { background: linear-gradient(135deg, #b22222 0%, #750a08ff 100%); }
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
                <span class="navbar-brand mb-0 h1">Government Officials</span>
                <span class="text-muted">Welcome, <?= $_SESSION['admin_username']; ?>!</span>
            </nav>

            <div class="p-4">
                <?php if(isset($_GET['msg'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php 
                        if($_GET['msg']=='added') echo 'Official added successfully!';
                        if($_GET['msg']=='updated') echo 'Official updated successfully!';
                        if($_GET['msg']=='deleted') echo 'Official deleted successfully!';
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Add/Edit Form -->
                <div class="table-card mb-4">
                    <h4><?= $edit_official ? 'Edit Official' : 'Add New Official' ?></h4>
                    <form method="POST" class="row g-3">
                        <?php if($edit_official): ?>
                            <input type="hidden" name="id" value="<?= $edit_official['id'] ?>">
                        <?php endif; ?>
                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="<?= $edit_official['name'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Position</label>
                            <input type="text" name="position" class="form-control" value="<?= $edit_official['position'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">Order</label>
                            <input type="number" name="position_order" class="form-control" value="<?= $edit_official['position_order'] ?? 0 ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
                                <?= $edit_official ? 'Update' : 'Add' ?>
                            </button>
                        </div>
                        <?php if($edit_official): ?>
                            <div class="col-12">
                                <a href="admin_government.php" class="btn btn-secondary">Cancel Edit</a>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Officials List -->
                <div class="table-card">
                    <h4 class="mb-3">Current Officials</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $officials->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $row['position_order'] ?></td>
                                    <td><?= htmlspecialchars($row['name']) ?></td>
                                    <td><?= htmlspecialchars($row['position']) ?></td>
                                    <td>
                                        <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Are you sure you want to delete this official?')">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>