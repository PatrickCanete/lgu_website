<?php
// Install Tourism Table (Full Content)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'lgu_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>🌴 Installing Tourism Attractions Module</h1>";
echo "<hr>";

// Create tourism_attractions table
$sql = "CREATE TABLE IF NOT EXISTS tourism_attractions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    location VARCHAR(255) NOT NULL,
    description TEXT,
    category ENUM('Restaurant','Beach & Resort') NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_featured TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql)) {
    echo "<p style='color:green;'>✅ Table <b>tourism_attractions</b> created successfully!</p>";

    // Check existing data
    $check = $conn->query("SELECT COUNT(*) as total FROM tourism_attractions");
    $total = $check->fetch_assoc()['total'];

    if ($total == 0) {

        // Insert all restaurants and resorts
        $insert = "INSERT INTO tourism_attractions (title, location, description, category, image_path, is_featured) VALUES
        ('ROBERTO','Brgy. Ibabang Kalilayan, Unisan, Quezon','Popular local restaurant known for affordable Filipino dishes.','Restaurant','images/roberto.jpg',1),
        ('TULAY RESTO BAR','Brgy. Ibabang Kalilayan, Unisan, Quezon','Casual dining and drinks with a relaxing atmosphere.','Restaurant','images/tulay resto bar.jpg',0),
        ('JINGGAY\'S','Brgy. F. De Jesus, Unisan, Quezon','Cozy Filipino restaurant for families and friends.','Restaurant','images/jinggays.jpg',0),
        ('CASA ESMERALDA','Brgy. Magsaysay, Unisan, Quezon','Fine dining with local and international flavors.','Restaurant','images/casa esmeralda.jpg',0),
        ('BALAY BISTRO','Brgy. Ibabang Kalilayan, Unisan, Quezon','Bistro with modern Filipino dishes.','Restaurant','images/balaybistro.jpeg',0),
        ('CUCINA MANGANTANA','Brgy. Malvar, Unisan, Quezon','Known for delicious Italian and Filipino cuisine.','Restaurant','images/cm.jpg',0),
        ('SO-JUU','Brgy. F. De Jesus, Unisan, Quezon','Trendy restaurant offering drinks and meals.','Restaurant','images/so-juu.jpg',0),
        ('KUSINA NI ATE CYNTHIA','Brgy. Muliguin, Unisan, Quezon','Homestyle Filipino dishes served with love.','Restaurant','images/KNAC.jpg',0),
        ('ELVIS GRILL','Brgy. Ibabang Kalilayan, Unisan, Quezon','Grilled specialties and local favorites.','Restaurant','images/elvisgrill.jpg',0),
        ('ADELAS BEACH RESORT','Brgy. Ibabang Kalilayan, Unisan, Quezon','Peaceful beach resort ideal for family outings and relaxation.','Beach & Resort','images/adelas.jpg',1),
        ('AREDAN','Brgy. Ibabang Kalilayan, Unisan, Quezon','Cozy resort with beach activities and cottages.','Beach & Resort','images/aredan.jpg',0),
        ('CALILAYAN COVE','Brgy. Ilayang Kalilayan, Unisan, Quezon','Scenic beachfront destination with cottages and ocean views.','Beach & Resort','images/calilayancove.jpg',1),
        ('DANPRISE','Brgy. Maputat, Unisan, Quezon','Family-friendly resort with swimming facilities.','Beach & Resort','images/danprise.jpg',0),
        ('EL NICO','Brgy. Malvar, Unisan, Quezon','Beach resort with relaxing atmosphere and amenities.','Beach & Resort','images/el nico.jpg',0),
        ('LACALA','Brgy. Ibabang Kalilayan, Unisan, Quezon','Beachfront resort ideal for gatherings and leisure.','Beach & Resort','images/lacala.jpg',0),
        ('MONCELLA','Brgy. Maputat, Unisan, Quezon','Beach resort with cottages and swimming areas.','Beach & Resort','images/mbr.jpg',0),
        ('PUNTA SANCTUARY','Brgy. Punta, Unisan, Quezon','Quiet beach resort for relaxation.','Beach & Resort','images/punta S.jpg',0),
        ('UNISAN SANDS','Brgy. Maputat, Unisan, Quezon','White sand beach resort perfect for swimming and events.','Beach & Resort','images/unisansands.jpg',0)";

        if ($conn->query($insert)) {
            echo "<p style='color:green;'>✅ All restaurants and resorts inserted successfully!</p>";
        } else {
            echo "<p style='color:red;'>❌ Error inserting sample data: ".$conn->error."</p>";
        }

    } else {
        echo "<p style='color:orange;'>ℹ️ Tourism data already exists ($total records found)</p>";
    }

    // Create upload directory
    $upload_dir = "uploads/tourism/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
        echo "<p style='color:green;'>✅ Upload folder created: <b>$upload_dir</b></p>";
    } else {
        echo "<p style='color:orange;'>ℹ️ Upload folder already exists</p>";
    }

    echo "<hr>";
    echo "<div style='background:#d4edda; padding:20px; border-radius:10px;'>";
    echo "<h2>🎉 Tourism Module Ready!</h2>";
    echo "<p>The Tourism page is now connected to the database.</p>";
    echo "<p>You can add, edit, and feature Restaurants and Beach Resorts.</p>";
    echo "<a href='admin_tourism.php' style='background:#991b1b; color:white; padding:10px 20px; border-radius:5px; text-decoration:none;'>Go to Tourism Admin →</a>";
    echo "</div>";

} else {
    echo "<p style='color:red;'>❌ Error creating table: " . $conn->error . "</p>";
}

$conn->close();
?>

<style>
body {
    font-family: 'Poppins', sans-serif;
    max-width: 900px;
    margin: 30px auto;
    padding: 25px;
    background: #fff7f7;
}
h1, h2 {
    color: #991b1b;
}
hr {
    border: 0;
    height: 3px;
    background: linear-gradient(to right, #dc2626, #7f1d1d);
    margin: 25px 0;
}
</style>
