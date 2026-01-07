<?php
include 'g-6.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name  = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $phone = sanitize($_POST['phone']);
    $message = sanitize($_POST['message']);
    $submitted_at = date("Y-m-d H:i:s");

    $sql = "INSERT INTO contact_us (name, email, phone, message, submitted_at)
            VALUES ('$name', '$email', '$phone', '$message', '$submitted_at')";

    if ($conn->query($sql)) {
        echo "<script>alert('Message submitted successfully!'); window.location='contact.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Contact Us - UNISAN QUEZON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f5f5f5;
        }

        main {
            flex: 1;
        }

        .contact-section {
            padding: 90px 0;
        }

        .contact-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .contact-card h3 {
            color: #b83232;
            font-weight: 700;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 12px 15px;
            transition: all 0.3s;
        }

        .form-control:focus {
            border-color: #b83232;
            box-shadow: 0 0 0 0.2rem rgba(184, 50, 50, 0.15);
        }

        .btn-submit {
            background: linear-gradient(135deg, #b83232 0%, #8b1a1a 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.1rem;
            font-weight: 700;
            border-radius: 50px;
            width: 100%;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(184, 50, 50, 0.3);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(184, 50, 50, 0.4);
        }

        .info-box i {
            font-size: 2rem;
            color: #b83232;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .contact-hero h1 {
                font-size: 2rem;
            }
        }

    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <main>
        <!-- Contact Form Section -->
        <section class="contact-section">
            <div class="container">
                <div class="row">
                    <!-- Contact Form -->
                    <div class="col-lg-8 mb-4">
                        <div class="contact-card">
                            <h3>Send Us a Message</h3>
                            <form method="POST" action="">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="name" class="form-control" required placeholder="Juan Dela Cruz">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" required placeholder="juan@example.com">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" required placeholder="+63 912 345 6789">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Message</label>
                                    <textarea name="message" class="form-control" rows="6" required placeholder="Type your message here..."></textarea>
                                </div>
                                <button type="submit" class="btn-submit">
                                    <i class="fas fa-paper-plane me-2"></i>Submit Message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="container my-5">
            <div class="contact-card">
                <h3 class="text-center mb-4">Find Us on the Map</h3>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.123456789012!2d121.12345678901234!3d13.123456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33b1234567890abc%3A0x1234567890abcdef!2sUnisan%2C%20Quezon%2C%20Philippines!5e0!3m2!1sen!2sus!4v1234567890123" 
                    width="100%" 
                    height="400" 
                    style="border:0; border-radius:15px;" 
                    allowfullscreen="" 
                    loading="lazy">
                </iframe>
            </div>
        </section>
    </main>

   <?php
        include 'footer.php';
    ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
