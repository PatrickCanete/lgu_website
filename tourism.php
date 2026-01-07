
<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Unisan Tourism</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    padding-top: 80px;
    background: #fff7f7;
}
.section {
    padding: 60px 20px;
}
.section-title {
    text-align: center;
    font-size: 2rem;
    margin-bottom: 40px;
    color: #991b1b;
}
.grid {
    display: grid;
    gap: 20px;
}
.grid-4 {
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
}
.grid-3 {
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
}
.card {
    background: #fff;
    padding: 15px;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    transition: 0.3s;
    text-align: center;
}
.card:hover {
    transform: translateY(-6px);
}
.card img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 10px;
}
.card-title {
    font-size: 1.2rem;
    font-weight: 700;
    color: #991b1b;
}
.card-description {
    font-size: 0.95rem;
    color: #555;
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<!-- RESTAURANTS -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Restaurants</h2>
        <div class="grid grid-4">

            <?php
            $restaurants = $conn->query("
                SELECT * FROM tourism_attractions 
                WHERE category='Restaurant'
                ORDER BY is_featured DESC, id DESC
            ");

            while($row = $restaurants->fetch_assoc()):
            ?>
            <div class="card">
                <img src="<?= $row['image_path']; ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                <div class="card-title"><?= htmlspecialchars($row['title']); ?></div>
                <div class="card-description"><?= htmlspecialchars($row['location']); ?></div>
            </div>
            <?php endwhile; ?>

        </div>
    </div>
</section>

<!-- BEACH & RESORTS -->
<section class="section">
    <div class="container">
        <h2 class="section-title">Beach & Resorts</h2>
        <div class="grid grid-3">

            <?php
            $resorts = $conn->query("
                SELECT * FROM tourism_attractions 
                WHERE category='Beach & Resort'
                ORDER BY is_featured DESC, id DESC
            ");

            while($row = $resorts->fetch_assoc()):
            ?>
            <div class="card">
                <img src="<?= $row['image_path']; ?>" alt="<?= htmlspecialchars($row['title']); ?>">
                <div class="card-title"><?= htmlspecialchars($row['title']); ?></div>
                <div class="card-description"><?= htmlspecialchars($row['location']); ?></div>
            </div>
            <?php endwhile; ?>

        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
```
