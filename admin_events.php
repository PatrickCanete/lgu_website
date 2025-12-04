<?php
session_start();
include 'db.php';

// Check if admin is logged in
if(!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit;
}

// Add new event
if(isset($_POST['add'])) {
    $date = $_POST['event_date'];
    $title = $_POST['title'];
    $desc = $_POST['description'];
    
    $stmt = $conn->prepare("INSERT INTO upcoming_events (event_date, title, description) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $date, $title, $desc);
    $stmt->execute();
}

// Delete event
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM upcoming_events WHERE id=$id");
}

// Fetch all events
$events = $conn->query("SELECT * FROM upcoming_events ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin - Upcoming Events</title>
</head>
<body>
<h1>Manage Upcoming Events</h1>

<h2>Add Event</h2>
<form method="POST">
    <label>Date:</label>
    <input type="date" name="event_date" required><br>
    <label>Title:</label>
    <input type="text" name="title" required><br>
    <label>Description:</label>
    <textarea name="description"></textarea><br>
    <button name="add">Add Event</button>
</form>

<h2>Existing Events</h2>
<table border="1" cellpadding="5">
<tr>
    <th>Date</th>
    <th>Title</th>
    <th>Description</th>
    <th>Action</th>
</tr>
<?php while($row = $events->fetch_assoc()): ?>
<tr>
    <td><?= $row['event_date'] ?></td>
    <td><?= $row['title'] ?></td>
    <td><?= $row['description'] ?></td>
    <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this event?')">Delete</a></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>
