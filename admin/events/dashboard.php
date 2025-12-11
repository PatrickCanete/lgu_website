<?php
session_start();
include "../includes/auth.php"; // Make sure admin is logged in
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>

<h3>Admin Dashboard</h3>

<ul>
    <li><a href="events/events_list.php">Manage Events</a></li>
    <li><a href="tourism/tourism_list.php">Manage Tourism Spots</a></li>
    <li><a href="users/users_list.php">Manage Users</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

</body>
</html>
