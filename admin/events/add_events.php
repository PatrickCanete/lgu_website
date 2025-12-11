<?php
session_start();
include "../../includes/auth.php";
include "../../includes/db_connect.php";

if (isset($_POST['submit'])) {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];
    $location = $_POST['location'];

    // upload image
    $image = $_FILES['image']['name'];
    $path = "../../assets/uploads/events/" . $image;
    move_uploaded_file($_FILES['image']['tmp_name'], $path);

    $query = $conn->prepare("INSERT INTO events (title, description, event_date, location, image) VALUES (?,?,?,?,?)");
    $query->bind_param("sssss", $title, $description, $event_date, $location, $image);

    if ($query->execute()) {
        header("Location: events_list.php?added=1");
    } else {
        echo "Error!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
</head>
<body>

<h2>Add New Event</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Event Title:</label><br>
    <input type="text" name="title" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" required></textarea><br><br>

    <label>Event Date:</label><br>
    <input type="date" name="event_date" required><br><br>

    <label>Location:</label><br>
    <input type="text" name="location" required><br><br>

    <label>Event Image:</label><br>
    <input type="file" name="image" required><br><br>

    <button type="submit" name="submit">Add Event</button>

</form>

</body>
</html>
