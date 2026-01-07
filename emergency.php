<?php
include 'config.php';
$hotlines = $conn->query("SELECT * FROM emergency_hotlines");
?>

<section class="container my-5">
    <h2>Emergency Hotlines</h2>

    <div class="row">
        <?php while($row=$hotlines->fetch_assoc()): ?>
        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <strong><?= $row['department'] ?></strong>
                <p><?= $row['hotline'] ?></p>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>
