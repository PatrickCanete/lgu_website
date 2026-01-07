<?php
include 'g-6.php'; // database connection

// Fetch main history image
$main_image_query = "SELECT * FROM history_main_image WHERE id = 1";
$main_image_result = mysqli_query($conn, $main_image_query);
$main_image = mysqli_fetch_assoc($main_image_result);

// Fetch all history events ordered by display_order
$events_query = "SELECT * FROM history_events ORDER BY display_order ASC";
$events_result = mysqli_query($conn, $events_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>History of Unisan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<style>
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f5f5;
    padding-top: 80px;
}
main {
    max-width: 1000px;
    margin: 0 auto 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}
h1 {
    text-align: center;
    margin-bottom: 40px;
    color: #b83232;
}
.timeline {
    position: relative;
    padding: 20px 0;
}
.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    transform: translateX(-50%);
    width: 4px;
    height: 100%;
    background-color: #b83232;
}
.timeline-event {
    position: relative;
    width: 50%;
    padding: 20px 40px;
    box-sizing: border-box;
}
.timeline-event-left {
    left: 0;
    text-align: right;
}
.timeline-event-right {
    left: 50%;
}
.timeline-event::before {
    content: '';
    position: absolute;
    top: 25px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #b83232;
    border: 4px solid #fff;
    z-index: 1;
}
.timeline-event-left::before {
    right: -12px;
}
.timeline-event-right::before {
    left: -12px;
}
.timeline-event h3 {
    margin-bottom: 10px;
    color: #b83232;
}
.timeline-event p {
    margin: 0;
    text-align: justify;
}
@media (max-width: 768px) {
    .timeline::before {
        left: 8px;
    }
    .timeline-event {
        width: 100%;
        padding-left: 30px;
        padding-right: 15px;
        margin-bottom: 20px;
    }
    .timeline-event-left,
    .timeline-event-right {
        left: 0;
        text-align: left;
    }
    .timeline-event::before {
        left: 0;
        top: 0;
    }
}
.history-image {
    display: block;
    margin: 0 auto 30px auto;
    width: 100%;
    max-width: 450px;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}
</style>
</head>

<body>
<?php include 'header.php'; ?>

<main>
    <h1>History of Unisan</h1>

    <?php if ($main_image && file_exists($main_image['image_path'])): ?>
        <img src="<?php echo $main_image['image_path']; ?>" alt="<?php echo htmlspecialchars($main_image['alt_text']); ?>" class="history-image">
    <?php endif; ?>

    <div class="timeline">
        <?php if(mysqli_num_rows($events_result) > 0): ?>
            <?php while($event = mysqli_fetch_assoc($events_result)): ?>
                <div class="timeline-event <?php echo $event['position'] == 'left' ? 'timeline-event-left' : 'timeline-event-right'; ?>">
                    <h3><?php echo htmlspecialchars($event['year']) . ' - ' . htmlspecialchars($event['title']); ?></h3>
                    <p><?php echo nl2br(htmlspecialchars($event['description'])); ?></p>
                    <?php if($event['image_path'] && file_exists($event['image_path'])): ?>
                        <img src="<?php echo $event['image_path']; ?>" alt="<?php echo htmlspecialchars($event['title']); ?>" class="history-image">
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center text-muted">No history events available yet.</p>
        <?php endif; ?>
    </div>
</main>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
