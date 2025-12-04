<?php
// if ($_SERVER["REQUEST_METHOD"] !== "POST") {
//     die("Invalid access. You must submit the form.");
// }

$hostname = "localhost";
$username = "root";
$password = "";
$database = "lgu_db"; // change this

$conn = new mysqli($hostname, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $citizen_name = $_POST['citizen_name'] ?? "";
// $request_type = $_POST['request_type'] ?? "";
// $description  = $_POST['description'] ?? "";

// if ($citizen_name === "" || $request_type === "" || $description === "") {
//     die("Error: Missing form fields.");
// }

// $sql = "INSERT INTO citizen_requests (citizen_name, request_type, description)
//         VALUES (?, ?, ?)";

// $stmt = $conn->prepare($sql);
// $stmt->bind_param("sss", $citizen_name, $request_type, $description);

// if ($stmt->execute()) {
//     header("Location: services.php?success=Request submitted successfully");
//     exit();
// } else {
//     echo "Database Error: " . $stmt->error;
// }
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Government Services - Unisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
    <style>
        :root {
            --primary-blue: #0b3d91;
            --secondary-blue: #1e40af;
            --light-blue: #dbeafe;
            --accent-gold: #f59e0b;
            --dark-blue: #1e3a8a;
            --light-gray: #f8fafc;
            --medium-gray: #64748b;
            --border-gray: #e2e8f0;
            --success-green: #10b981;
            --text-dark: #0f172a;
            --text-light: #010f22ff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--secondary-blue) 100%);
            box-shadow: 0 4px 20px rgba(11, 61, 145, 0.15);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .navbar {
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 0.2rem;
        }

        .nav-link:hover,
        .nav-link:focus {
           color: white !important;
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        /* Main Content */
        .main-content {
            margin-top: 100px;
            padding: 2rem 0;
        }

        .card {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            margin: 2rem auto;
            max-width: 1000px;
            box-shadow: 0 20px 40px rgba(11, 61, 145, 0.08);
            border: 1px solid var(--border-gray);
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.8s ease-out;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary-blue), var(--accent-gold));
        }

        .card h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            color: var(--primary-blue);
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
        }

        .card h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-gold), var(--secondary-blue));
            border-radius: 2px;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .service-card {
            background: linear-gradient(135deg, #ffffff 0%, var(--light-gray) 100%);
            border-radius: 15px;
            padding: 2rem;
            border-left: 4px solid var(--secondary-blue);
            box-shadow: 0 8px 25px rgba(11, 61, 145, 0.05);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--light-blue) 0%, rgba(30, 64, 175, 0.1) 100%);
            border-radius: 0 0 50px 0;
            opacity: 0.7;
        }

        .service-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(11, 61, 145, 0.15);
            border-left-color: var(--primary-blue);
        }

        .service-card:hover::before {
            width: 80px;
            height: 80px;
            opacity: 1;
        }

        .service-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            display: block;
            position: relative;
            z-index: 2;
        }

        .service-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.3rem;
            color: var(--dark-blue);
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        .service-description {
            color: var(--text-light);
            font-size: 1rem;
            line-height: 1.6;
            position: relative;
            z-index: 2;
        }

        /* Service specific styling */
        .service-card:nth-child(1) { border-left-color: #1e40af; }
        .service-card:nth-child(2) { border-left-color: #3b82f6; }
        .service-card:nth-child(3) { border-left-color: #60a5fa; }
        .service-card:nth-child(4) { border-left-color: #93c5fd; }
        .service-card:nth-child(5) { border-left-color: #bfdbfe; }
        .service-card:nth-child(6) { border-left-color: #dbeafe; }
        .service-card:nth-child(7) { border-left-color: #f0f9ff; }
        .service-card:nth-child(8) { border-left-color: #e0f2fe; }
        .service-card:nth-child(9) { border-left-color: #bae6fd; }

        /* Form Styles */
        .form-card {
            background: linear-gradient(135deg, #ffffff 0%, var(--light-gray) 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            border-left: 4px solid var(--accent-gold);
            box-shadow: 0 8px 25px rgba(245, 158, 11, 0.05);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-blue);
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid var(--border-gray);
            padding: 0.75rem;
            font-size: 1rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.2rem rgba(11, 61, 145, 0.25);
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(135deg, var(--dark-blue), var(--primary-blue));
            transform: translateY(-2px);
        }

        /* Footer */
        .footer {
            background-color: #e8e8e8;
            padding: 3rem 0 2rem 0;
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin-top: 4rem;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--secondary-blue), var(--accent-gold));
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 3rem;
        }
        
        .footer-section h2,
        .footer-section h3 {
            color: #999;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .footer-section h2::after,
        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 30px;
            height: 2px;
            background: var(--accent-gold);
            border-radius: 1px;
        }
        
        .footer-section p {
            margin-bottom: 1rem;
            color: #888;
            line-height: 1.6;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 0.8rem;
        }
        
        .footer-section ul li a {
            color: #888;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 0.3rem 0;
            display: inline-block;
        }
        
        .footer-section ul li a:hover {
            color: #666;
            transform: translateX(5px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .card h2 {
                font-size: 2rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .navbar-nav {
                background: rgba(11, 61, 145, 0.95);
                border-radius: 10px;
                padding: 1rem;
                margin-top: 1rem;
            }
        }

        /* Animation for cards */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hover effects */
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(11, 61, 145, 0.12);
            transition: all 0.3s ease;
        }

        /* Intro section */
        .intro-section {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 3rem;
            border: 1px solid #fca5a5;
            text-align: center;
        }

        .intro-section h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 1rem;
        }

        .intro-section p {
            color: var(--text-light);
            font-size: 1.1rem;
            line-height: 1.7;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <?php
    include 'header.php';
    ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container">
            <div class="card">
                <h2>Municipal Services</h2>
                
                <div class="intro-section">
                    <h3>Serving Our Community</h3>
                    <p>The Municipality of Unisan is committed to providing comprehensive, efficient, and accessible services to all residents. Our dedicated team works tirelessly to ensure that every citizen receives the support and assistance they need.</p>
                </div>

                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-title">Public Health Services</div>
                        <div class="service-description">Comprehensive healthcare programs including immunizations, maternal care, health screenings, and medical assistance for residents.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Environmental Protection Services</div>
                        <div class="service-description">Environmental conservation programs, waste management, tree planting initiatives, and pollution control measures.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Public Safety & Emergency Services</div>
                        <div class="service-description">24/7 emergency response, disaster preparedness, fire protection, and community safety programs.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Community Development Programs</div>
                        <div class="service-description">Social development initiatives, community organizing, capacity building, and civic engagement programs.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Tourism & Cultural Services</div>
                        <div class="service-description">Cultural preservation, tourism promotion, heritage site maintenance, and cultural events organization.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Education & Scholarship Programs</div>
                        <div class="service-description">Educational support, scholarship grants, learning facilities maintenance, and academic assistance programs.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Infrastructure Development Projects</div>
                        <div class="service-description">Road construction and maintenance, bridge building, public facilities development, and utility improvements.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Disaster Preparedness & Response</div>
                        <div class="service-description">Early warning systems, evacuation planning, relief distribution, and post-disaster rehabilitation programs.</div>
                    </div>
                </div>

                <div class="form-card">
                    <h3 style="font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--dark-blue); margin-bottom: 1.5rem; text-align: center;">📝 Submit a Request</h3>
                    <form id="requestForm" action="submit_request.php" method="POST">
                        <div class="form-group">
                            <label for="citizenName" class="form-label">Citizen Name</label>
                            <input type="text" class="form-control" id="citizenName" name="citizen_name" required placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="requestType" class="form-label">Request Type</label>
                            <select class="form-select" id="requestType" name="request_type" required>
                                <option value="">Select a service</option>
                                <option value="Concern">Concern</option>
                                <option value="Commendation">Commendation</option>
                                <option value="Complaint">Complaint</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" required placeholder="Enter your description">
                        </div>
                        <button type="submit" class="btn-submit">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-section">
                <h2>Republic of the Philippines</h2>
                <p>All content is in the public domain unless otherwise stated.</p>
                <p><a href="#privacy">Privacy Policy</a></p>
            </div>
            
            <div class="footer-section">
                <h3>About GovPH</h3>
