<?php
session_start();
include "../../includes/auth.php";
include "../../includes/db_connect.php";

$event_id = $_GET['id'];

$query = $conn->prepare("SELECT * FROM events WHERE event_id=?");
$query->bind_param("i", $event_id);
$query->execute();
$event = $query->get_result()->fetch_assoc();

if (isset($_POST['update'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    // If image is replaced
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $path = "../../assets/uploads/events/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
    } else {
        $image = $event['image']; // keep old image
    }

    $update = $conn->prepare("UPDATE events SET title=?, description=?, event_date=?, location=?, image=? WHERE event_id=?");
    $update->bind_param("sssssi", $title, $description, $event_date, $location, $image, $event_id);

    if ($update->execute()) {
        header("Location: events_list.php?updated=1");
    } else {
        echo "Error updating event!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>
</head>
<body>

<h2>Edit Event</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Event Title:</label><br>
    <input type="text" name="title" value="<?php echo $event['title']; ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required><?php echo $event['description']; ?></textarea><br><br>

    <label>Event Date:</label><br>
    <input type="date" name="event_date" value="<?php echo $event['event_date']; ?>" required><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" value="<?php echo $event['location']; ?>" required><br><br>

    <label>Current Image:</label><br>
    <img src="../../assets/uploads/events/<?php echo $event['image']; ?>" width="150"><br><br>

    <label>Change Image (optional):</label><br>
    <input type="file" name="image"><br><br>

    <button type="submit" name="update">Update Event</button>

</form>

</body>
</html>
