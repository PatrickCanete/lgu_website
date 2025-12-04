<?php
session_start();
include 'db.php'; // Include your MySQL connection

// Check if admin is logged in
if(!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Add a new card
if(isset($_POST['add'])) {
    $type = $_POST['type'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Handle image upload
    $image_url = '';
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";
        if(!is_dir($target_dir)) mkdir($target_dir, 0755, true);
        $image_url = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_url);
    }

    $stmt = $conn->prepare("INSERT INTO tourism_cards (type, title, description, price, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $type, $title, $description, $price, $image_url);
    $stmt->execute();
}

// Delete card
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM tourism_cards WHERE id=$id");
}

// Fetch all cards
$cards = $conn->query("SELECT * FROM tourism_cards ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<style>
body { font-family: Arial; margin: 20px; }
table { width: 100%; border-collapse: collapse; margin-top: 20px; }
th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
form { margin-bottom: 20px; }
input, select, textarea { width: 100%; padding: 8px; margin: 5px 0; }
button { padding: 10px 20px; margin-top: 10px; }
img { max-width: 100px; }
</style>
</head>
<body>
<h1>Admin Dashboard</h1>
<p>Logged in as: <?= $_SESSION['admin'] ?> | <a href="logout.php">Logout</a></p>

<h2>Add New Tourism Card</h2>
<form method="POST" enctype="multipart/form-data">
    <label>Type:</label>
    <select name="type" required>
        <option value="attraction">Attraction</option>
        <option value="resort">Resort</option>
        <option value="beach">Beach</option>
    </select>

    <label>Title:</label>
    <input type="text" name="title" required>

    <label>Description:</label>
    <textarea name="description" required></textarea>

    <label>Price:</label>
    <input type="text" name="price">

    <label>Image:</label>
    <input type="file" name="image">

    <button name="add">Add Card</button>
</form>

<h2>Existing Cards</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Type</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php while($card = $cards->fetch_assoc()): ?>
    <tr>
        <td><?= $card['id'] ?></td>
        <td><?= ucfirst($card['type']) ?></td>
        <td><?= $card['title'] ?></td>
        <td><?= $card['description'] ?></td>
        <td><?= $card['price'] ?></td>
        <td><?php if($card['image_url']) echo "<img src='{$card['image_url']}'>"; ?></td>
        <td>
            <a href="edit_card.php?id=<?= $card['id'] ?>">Edit</a> | 
            <a href="?delete=<?= $card['id'] ?>" onclick="return confirm('Delete this card?')">Delete</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
