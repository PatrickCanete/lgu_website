<?php
include 'config.php';
requireLogin();

// Handle Delete
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM barangays WHERE id=$id");
    header("Location: admin_barangay.php?msg=deleted");
    exit;
}

// Handle Add/Edit
if($_SERVER['REQUEST_METHOD']=='POST') {
    $barangay_name = $conn->real_escape_string($_POST['barangay_name']);
    $type = $conn->real_escape_string($_POST['type']);
    $population = intval($_POST['population']);
    $barangay_captain = $conn->real_escape_string($_POST['barangay_captain']);
    $contact_number = $conn->real_escape_string($_POST['contact_number']);
    
    if(isset($_POST['id']) && $_POST['id']!='') {
        // Update
        $id = intval($_POST['id']);
        $conn->query("UPDATE barangays SET barangay_name='$barangay_name', type='$type', population=$population, 
                     barangay_captain='$barangay_captain', contact_number='$contact_number' WHERE id=$id");
        header("Location: admin_barangay.php?msg=updated");
    } else {
        // Insert
        $conn->query("INSERT INTO barangays (barangay_name, type, population, barangay_captain, contact_number) 
                     VALUES ('$barangay_name', '$type', $population, '$barangay_captain', '$contact_number')");
        header("Location: admin_barangay.php?msg=added");
    }
    exit;
}

// Fetch all barangays
$barangays = $conn->query("SELECT * FROM barangays ORDER BY barangay_name ASC");

// For editing
$edit_barangay = null;
if(isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_barangay = $conn->query("SELECT * FROM barangays WHERE id=$edit_id")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manage Barangays - Unisan</title>
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
.badge-rural { background: #10b981; }
.badge-urban { background: #3b82f6; }
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
                <span class="navbar-brand mb-0 h1">Barangays Management</span>
                <span class="text-muted">Welcome, <?= $_SESSION['admin_username']; ?>!</span>
            </nav>

            <div class="p-4">
                <?php if(isset($_GET['msg'])): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php 
                        if($_GET['msg']=='added') echo 'Barangay added successfully!';
                        if($_GET['msg']=='updated') echo 'Barangay updated successfully!';
                        if($_GET['msg']=='deleted') echo 'Barangay deleted successfully!';
                        ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Add/Edit Form -->
                <div class="table-card mb-4">
                    <h4><?= $edit_barangay ? 'Edit Barangay' : 'Add New Barangay' ?></h4>
                    <form method="POST" class="row g-3">
                        <?php if($edit_barangay): ?>
                            <input type="hidden" name="id" value="<?= $edit_barangay['id'] ?>">
                        <?php endif; ?>
                        <div class="col-md-6">
                            <label class="form-label">Barangay Name</label>
                            <input type="text" name="barangay_name" class="form-control" 
                                   value="<?= $edit_barangay['barangay_name'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select" required>
                                <option value="Rural" <?= ($edit_barangay['type'] ?? '')=='Rural' ? 'selected' : '' ?>>Rural</option>
                                <option value="Urban" <?= ($edit_barangay['type'] ?? '')=='Urban' ? 'selected' : '' ?>>Urban</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Population</label>
                            <input type="number" name="population" class="form-control" 
                                   value="<?= $edit_barangay['population'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Barangay Captain</label>
                            <input type="text" name="barangay_captain" class="form-control" 
                                   value="<?= $edit_barangay['barangay_captain'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" 
                                   value="<?= $edit_barangay['contact_number'] ?? '' ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
                                <?= $edit_barangay ? 'Update' : 'Add' ?>
                            </button>
                        </div>
                        <?php if($edit_barangay): ?>
                            <div class="col-12">
                                <a href="admin_barangay.php" class="btn btn-secondary">Cancel Edit</a>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Barangays List -->
                <div class="table-card">
                    <h4 class="mb-3">All Barangays</h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Barangay</th>
                                    <th>Type</th>
                                    <th>Population</th>
                                    <th>Captain</th>
                                    <th>Contact</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $barangays->fetch_assoc()): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($row['barangay_name']) ?></strong></td>
                                    <td><span class="badge badge-<?= strtolower($row['type']) ?>"><?= $row['type'] ?></span></td>
                                    <td><?= number_format($row['population']) ?></td>
                                    <td><?= htmlspecialchars($row['barangay_captain']) ?></td>
                                    <td><?= htmlspecialchars($row['contact_number']) ?></td>
                                    <td>
                                        <a href="?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Are you sure you want to delete this barangay?')">
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