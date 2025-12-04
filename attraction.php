<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Prepare email
    $to = "info@touristattraction.com"; // Change to your email address
    $subject = "New Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\nMessage:\n$message";
    $headers = "From: $email";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send message.";
    }
} else {
    echo "Invalid request method.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourist Attraction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffcccc; 
            color: #660000; 
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #cc0000; 
            color: white;
            padding: 20px;
            text-align: center;
        }
        nav {
            margin: 20px 0;
        }
        nav a {
            color: white;
            margin: 0 15px;
            text-decoration: none;
        }
        .content {
            padding: 20px;
        }
        footer {
            background-color: #cc0000;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 50px 20px;
        }
        
        .footer {
            background-color: #e8e8e8;
            padding: 40px 0;
            color: #666;
            font-size: 13px;
            line-height: 1.6;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 40px;
        }
        
        .footer-section h3 {
            color: #999;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        
        .footer-section p {
            margin-bottom: 10px;
            color: #888;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 8px;
        }
        
        .footer-section ul li a {
            color: #888;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-section ul li a:hover {
            color: #666;
            text-decoration: underline;
        }
        
        .logo-section {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }
        
        .logo {
            width: 60px;
            height: 60px;
            background-color: #ccc;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #888;
        }
        
        .logo-content {
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .logo-section {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="header-image">
        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/899608a1-1282-4e21-8c71-f8c9de818385.png" alt="Beautiful panoramic view of the tourist attraction">
    </div>
    <h1>Welcome to the Amazing Tourist Attraction</h1>
    <nav>
        <a href="#about">About</a>
        <a href="#attractions">Attractions</a>
        <a href="#contact">Contact</a>
    </nav>
</header>

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

</body>
</html>

