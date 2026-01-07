<?php
include 'g-6.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Attraction</title>
    <link href="css\css\attraction.css" rel="stylesheet" />
    
</head>
<body>

<?php include 'header.php'; ?>

<div class="content">
    <section id="about">
        <h2>About Us</h2>
        <p>Discover the beauty and excitement of our tourist attraction. We offer a variety of activities and experiences for all ages.</p>
    </section>

    <section id="attractions">
        <h2>Attractions</h2>
        <div class="attraction-grid">
            <div>
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/2057e22f-3135-4aa0-b328-045e619d903d.png" alt="Breathtaking mountain views">
                <p>Scenic Views</p>
            </div>
            <div>
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/06e9d75b-0226-4d6c-bb2d-d5e15be4262b.png" alt="Exciting adventure activities">
                <p>Adventure Activities</p>
            </div>
            <div>
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/265b742b-21dd-4da8-8566-be534234e4b0.png" alt="Traditional cultural performances">
                <p>Cultural Experiences</p>
            </div>
            <div>
                <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/541edfa2-c459-43bf-98c0-8781332aac36.png" alt="Diverse wildlife species">
                <p>Wildlife Tours</p>
            </div>
        </div>
    </section>

    <section id="contact">
        <h2>Contact Us</h2>
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/d5d2e479-08fb-44bc-a6f8-821f22431efe.png" alt="Our visitor center location" style="margin-bottom: 20px;">
        <p>Email: info@touristattraction.com</p>
        <p>Phone: (123) 456-7890</p>
    </section>
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
            
             <?php
        include 'footer.php';
    ?>


</body>
</html>

