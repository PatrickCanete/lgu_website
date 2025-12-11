<?php
include 'g-6.php'; // your database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['citizen_name'];
    $type = $_POST['request_type'];
    $desc = $_POST['description'];

    $sql = "INSERT INTO request_tb (citizen_name, request_type, description)
            VALUES ('$name', '$type', '$desc')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Request submitted successfully!'); window.location='services.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Government Services - Unisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet" />
        <link href="css\services.css" rel="stylesheet" />
    
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
                    <p>The Municipality of Unisan is committed to providing comprehensive, efficient, and accessible
                        services to all residents. Our dedicated team works tirelessly to ensure that every citizen
                        receives the support and assistance they need.</p>
                </div>

                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-title">Public Health Services</div>
                        <div class="service-description">Comprehensive healthcare programs including immunizations,
                            maternal care, health screenings, and medical assistance for residents.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Environmental Protection Services</div>
                        <div class="service-description">Environmental conservation programs, waste management, tree
                            planting initiatives, and pollution control measures.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Public Safety & Emergency Services</div>
                        <div class="service-description">24/7 emergency response, disaster preparedness, fire
                            protection, and community safety programs.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Community Development Programs</div>
                        <div class="service-description">Social development initiatives, community organizing, capacity
                            building, and civic engagement programs.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Tourism & Cultural Services</div>
                        <div class="service-description">Cultural preservation, tourism promotion, heritage site
                            maintenance, and cultural events organization.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Education & Scholarship Programs</div>
                        <div class="service-description">Educational support, scholarship grants, learning facilities
                            maintenance, and academic assistance programs.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Infrastructure Development Projects</div>
                        <div class="service-description">Road construction and maintenance, bridge building, public
                            facilities development, and utility improvements.</div>
                    </div>

                    <div class="service-card">
                        <div class="service-title">Disaster Preparedness & Response</div>
                        <div class="service-description">Early warning systems, evacuation planning, relief
                            distribution, and post-disaster rehabilitation programs.</div>
                    </div>
                </div>

                <div class="form-card">
                    <h3
                        style="font-family: 'Poppins', sans-serif; font-weight: 700; color: var(--dark-blue); margin-bottom: 1.5rem; text-align: center;">
                        📝 Submit a Request</h3>
                    <form id="requestForm" action="submit_request.php" method="POST">
                        <div class="form-group">
                            <label for="citizenName" class="form-label">Citizen Name</label>
                            <input type="text" class="form-control" id="citizenName" name="citizen_name" required
                                placeholder="Enter your full name">
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
                            <input type="text" class="form-control" id="description" name="description" required
                                placeholder="Enter your description">
                        </div>
                        <button type="submit" class="btn-submit">Submit Request</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <?php
        include 'header.php';
        ?>
    </footer>