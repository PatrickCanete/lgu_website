<?php
session_start();
include "../../includes/auth.php";
include "../../includes/db_connect.php";

$event_id = $_GET['id'];

$query = $conn->prepare("DELETE FROM events WHERE event_id=?");
$query->bind_param("i", $event_id);

if ($query->execute()) {
    header("Location: events_list.php?deleted=1");
} else {
    echo "Error deleting event!";
}
