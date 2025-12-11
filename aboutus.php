<?php
include 'g-6.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About Us</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
  <link href="css\css\aboutus.css" rel="stylesheet" />

</head>

<body>
  <?php
  include 'header.php';
  ?>

   
  <div class="container my-5">
    <div class="row g-4">
      <main class="col-lg-8">
        <div class="card p-4">
          <h2>About Us</h2>
          <p>Unisan, Quezon is a historic municipality known for its rich culture and vibrant community. Established in the early 16th century, it has grown into a thriving town that offers a blend of tradition and modernity.</p>
          <p>Our mission is to provide quality services to our residents and promote sustainable development while preserving our cultural heritage.</p>
        </div>
      </main>

      <aside class="col-lg-4">
        <div class="card p-4">
          <h3>Contact Information</h3>
          <p>If you have any questions or need assistance, please contact us:</p>
          <p><strong>Email:</strong> info@unisanquezon.gov.ph</p>
          <p><strong>Phone:</strong> (042) 987-6543</p>
        </div>
      </aside>
    </div>

    <div class="map-container">
      <h3 class="text-center">Location of Unisan, Quezon</h3>
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.1234567890123!2d121.12345678901234!3d13.123456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33b1234567890abc%3A0x1234567890abcdef!2sUnisan%2C%20Quezon!5e0!3m2!1sen!2sph!4v1234567890123" allowfullscreen="" loading="lazy"></iframe>
    </div>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <div class="logo-section">
                    <div class="logo">RP</div>
                    <div class="logo-content">
                        <h3>Republic of the Philippines</h3>
                        <p>All content is in the public domain unless otherwise stated.</p>
                        <p><a href="#privacy">Privacy Policy</a></p>
                    </div>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>About GovPH</h3>
                <p>Learn more about the Philippine government, its structure, how government works and the people behind it.</p>
                <ul>
                    <li><a href="#gazette">Official Gazette</a></li>
                    <li><a href="#opendata">Open Data Portal</a></li>
                    <li><a href="#feedback">Send us your feedback</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Government Links</h3>
                <ul>
                    <li><a href="#president">Office of the President</a></li>
                    <li><a href="#vp">Office of the Vice President</a></li>
                    <li><a href="#senate">Senate of the Philippines</a></li>
                    <li><a href="#house">House of Representatives</a></li>
                    <li><a href="#supreme">Supreme Court</a></li>
                    <li><a href="#appeals">Court of Appeals</a></li>
                    <li><a href="#sandiganbayan">Sandiganbayan</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>