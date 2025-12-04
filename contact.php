<?php
include ('connect.php');
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $number = $_POST['phone'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $query = "INSERT INTO lgutb (`user_name`, `phone_number`, `email`, `mess`) VALUES ('$name', '$number', '$email', '$message')";
    $query_run = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@600;700&display=swap" rel="stylesheet" />
    <link href=".vscode/css/contact.css" rel="stylesheet" />
</head>
<style>
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


<body>
    <?php include 'header.php'; ?>

    <main>
        <article class="card" aria-labelledby="contactTitle">
            <h1 id="contactTitle">Contact Us</h1>
            <form id="contactForm" novalidate aria-describedby="formInstructions" method="POST">
                <p id="formInstructions">Please fill out this form and we will get back to you as soon as possible.</p>
                <div class="mb-3">
                    <label for="nameInput">Full Name</label>
                    <input type="text" id="nameInput" name="name" required aria-required="true" aria-describedby="nameError" />
                    <div id="nameError" class="error-message">Please enter your full name.</div>
                    <label for="emailInput">Email Address</label>
                    <input type="email" id="emailInput" name="email" required aria-required="true" aria-describedby="emailError" />
                    <div id="emailError" class="error-message">Please enter a valid email address.</div>
                    <label for="phoneInput">Phone Number</label>
                    <input type="tel" id="phoneInput" name="phone" pattern="^\+?[0-9\s\-]{7,15}$" aria-describedby="phoneError" placeholder="+63 912 345 6789" />
                    <div id="phoneError" class="error-message">Please enter a valid phone number.</div>
                    <label for="messageInput">Message</label>
                    <textarea id="messageInput" name="message" rows="5" required aria-required="true" aria-describedby="messageError"></textarea>
                    <div id="messageError" class="error-message">Please enter your message.</div><br>
                    <input style="padding-top: 15px; color: #fff; background-color: #0b3d91; border: none; border-radius: 5px; padding: 10px 20px; cursor: pointer;" type="submit" name="submit" value="Send Message">
                </div>
            </form>

            <section class="location" aria-label="Location of Unisan">
                <h2>Location</h2>
                <p>Find us at:</p>
                <p>Municipal Hall, Unisan, Quezon</p>
                <div class="map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d164195.58286516328!2d121.98832115433635!3d13.871686837567426!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a2bfc5ff13c1a3%3A0xb7cefd367e1ace1!2sUnisan%2C%20Quezon!5e0!3m2!1sen!2sph!4v1749994621203!5m2!1sen!2sph"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </section>
        </article>
    </main>

   
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
