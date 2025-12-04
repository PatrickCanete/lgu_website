<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])) { header("Location: login.php"); exit; }

$id = intval($_GET['id']);
$card = $conn->query("SELECT * FROM tourism_cards WHERE id=$id")->fetch_assoc();

if(isset($_POST['update'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $image_url = $card['image_url'];
    if(isset($_FILES['image']) && $_FILES['image']['error']==0) {
        $target_dir = "uploads/";
        if(!is_dir($target_dir)) mkdir($target_dir, 0755, true);
        $image_url = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_url);
    }

    $stmt = $conn->prepare("UPDATE tourism_cards SET title=?, description=?, price=?, image_url=? WHERE id=?");
    $stmt->bind_param("ssssi", $title, $description, $price, $image_url, $id);
    $stmt->execute();
    header("Location: admin_dashboard.php");
    exit;
}
?>

<form method="POST" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="title" value="<?= $card['title'] ?>" required>

    <label>Description:</label>
    <textarea name="description" required><?= $card['description'] ?></textarea>

    <label>Price:</label>
    <input type="text" name="price" value="<?= $card['price'] ?>">

    <label>Image:</label>
    <input type="file" name="image">
    <?php if($card['image_url']) echo "<img src='{$card['image_url']}'>"; ?>

    <button name="update">Update Card</button>
</form>
