<?php
include 'g-6.php';
include 'config.php';

// Get selected position from query
$selected_position = isset($_GET['position']) ? $_GET['position'] : 'All';

// Build query
if ($selected_position == 'All') {
    $stmt = $conn->prepare("SELECT * FROM government_officials ORDER BY position_order ASC, id ASC");
    $stmt->execute();
} else {
    $stmt = $conn->prepare("SELECT * FROM government_officials WHERE position = ? ORDER BY position_order ASC, id ASC");
    $stmt->bind_param("s", $selected_position);
    $stmt->execute();
}

$result = $stmt->get_result();

// Group results by position just for rendering if “All”
$officials = [];
while ($row = $result->fetch_assoc()) {
    $officials[$row['position']][] = $row;
}

// List of positions for dropdown
$positions = ['All', 'Mayor', 'Vice Mayor', 'Sangguniang Bayan Member'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Government of Unisan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">

<style>
:root{
    --red:#8b1e1e;
    --red-dark:#7f1d1d;
    --dark:#1e293b;
    --gray:#64748b;
    --border:#e5e7eb;
}

body{
    font-family:Inter,sans-serif;
    background:#f8fafc;
    color:var(--dark);
    padding-top:90px;
}

.hero{
    background:linear-gradient(135deg,#7f1d1d,#b91c1c);
    color:white;
    padding:4.5rem 1rem;
    text-align:center;
}

.hero h1{
    font-family:Poppins,sans-serif;
    font-weight:800;
    font-size:2.6rem;
}

.hero p{
    max-width:720px;
    margin:1rem auto 0;
    opacity:.9;
}

.page-content{
    padding:3.5rem 1rem 4rem;
}

.content-card{
    background:white;
    max-width:1100px;
    margin:0 auto;
    border-radius:24px;
    padding:3rem;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

.section-title{
    font-family:Poppins,sans-serif;
    font-weight:700;
    color:var(--red-dark);
    margin-bottom:1.8rem;
    border-left:5px solid var(--red-dark);
    padding-left:1rem;
}

.officials-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:1.5rem;
}

.official-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:18px;
    padding:2rem 1.5rem;
    text-align:center;
    transition:.3s ease;
}

.official-card:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 25px rgba(185,28,28,.2);
    border-color:var(--red-dark);
}

.official-title{
    font-size:.8rem;
    letter-spacing:1.5px;
    text-transform:uppercase;
    color:var(--gray);
    margin-bottom:.4rem;
}

.official-name{
    font-family:Poppins,sans-serif;
    font-size:1.15rem;
    font-weight:700;
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<section class="hero">
    <h1>Government of Unisan</h1>
    <p>
        Committed to transparent governance, responsive leadership,
        and people-centered public service for the Municipality of Unisan.
    </p>
</section>

<div class="page-content">
    <div class="content-card">

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

        <!-- ✅ DROPDOWN -->
        <div class="col-md-4">
            <label class="form-label">Position</label>
            <select name="position" class="form-select" required>
                <option value="">-- Select Position --</option>
                <option value="Mayor" <?= isset($edit_official) && $edit_official['position']=='Mayor' ? 'selected' : '' ?>>Mayor</option>
                <option value="Vice Mayor" <?= isset($edit_official) && $edit_official['position']=='Vice Mayor' ? 'selected' : '' ?>>Vice Mayor</option>
                <option value="Sangguniang Bayan Member" <?= isset($edit_official) && $edit_official['position']=='Sangguniang Bayan Member' ? 'selected' : '' ?>>Sangguniang Bayan Member</option>
            </select>
        </div>

        <div class="col-md-2">
            <label class="form-label">Order</label>
            <input type="number" name="position_order" class="form-control" value="<?= $edit_official['position_order'] ?? 1 ?>" min="1" required>
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


        <?php if (!empty($officials)): ?>

            <?php if ($selected_position == 'All'): ?>

                <!-- Show grouped by position -->
                <?php foreach ($officials as $position => $members): ?>

                    <h3 class="section-title"><?= htmlspecialchars($position) ?></h3>

                    <div class="officials-grid mb-5">
                        <?php foreach ($members as $person): ?>
                            <div class="official-card">
                                <div class="official-name">
                                    <?= htmlspecialchars($person['name']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <!-- Show only selected position -->
                <h3 class="section-title"><?= htmlspecialchars($selected_position) ?></h3>

                <div class="officials-grid mb-5">
                    <?php foreach ($officials[$selected_position] as $person): ?>
                        <div class="official-card">
                            <div class="official-name">
                                <?= htmlspecialchars($person['name']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

        <?php else: ?>

            <p class="text-muted text-center">
                No government officials available.
            </p>

        <?php endif; ?>

    </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
