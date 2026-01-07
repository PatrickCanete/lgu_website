<?php
include 'config.php'; // database connection & sanitize


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = sanitize($_POST['citizen_name']);
    $type = sanitize($_POST['request_type']);
    $desc = sanitize($_POST['description']);
    $date_submitted = date("Y-m-d H:i:s"); // current datetime
    $unread_count = $conn->query("SELECT COUNT(*) as count FROM submit_request WHERE is_read = 0")->fetch_assoc()['count'];
    

    $sql = "INSERT INTO submit_request (citizen_name, request_type, description, date_submitted)
            VALUES ('$name', '$type', '$desc', '$date_submitted')";

    if ($conn->query($sql)) {
        echo "<script>alert('Request submitted successfully!'); window.location='services.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

  <?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Government Services - Unisan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
<link href="css/services.css" rel="stylesheet" />
<style>
.btn-submit {
    background-color: #dc2626;
    color: white;
    font-weight: 600;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    transition: 0.3s;
}
.btn-submit:hover { background-color: #991b1b; }
.form-card { margin-top: 40px; }
.form-group { margin-bottom: 15px; }
</style>
</head>
<body>
<?php include 'header.php'; ?>

<div class="main-content">
    <div class="container py-5">
        <div class="card p-4 shadow-sm">
            <h2 class="mb-4 text-center">Municipal Services</h2>

            <div class="intro-section mb-4">
                <h3>Serving Our Community</h3>
                <p>The Municipality of Unisan is committed to providing comprehensive, efficient, and accessible
                   services to all residents. Our dedicated team works tirelessly to ensure that every citizen
                   receives the support and assistance they need.</p>
            </div>

            <div class="services-grid row row-cols-1 row-cols-md-2 g-4">
                <!-- Example Service Cards -->
                <div class="service-card col">
                    <div class="card p-3 h-100">
                        <div class="service-title fw-bold">Public Health Services</div>
                        <div class="service-description">Healthcare programs including immunizations, maternal care, screenings, and assistance.</div>
                    </div>
                </div>

                <div class="service-card col">
                    <div class="card p-3 h-100">
                        <div class="service-title fw-bold">Environmental Protection Services</div>
                        <div class="service-description">Conservation programs, waste management, tree planting, and pollution control.</div>
                    </div>
                </div>

                <div class="service-card col">
                    <div class="card p-3 h-100">
                        <div class="service-title fw-bold">Public Safety & Emergency Services</div>
                        <div class="service-description">Emergency response, disaster preparedness, fire protection, and safety programs.</div>
                    </div>
                </div>

                <div class="service-card col">
                    <div class="card p-3 h-100">
                        <div class="service-title fw-bold">Community Development Programs</div>
                        <div class="service-description">Social development, community organizing, capacity building, and civic engagement.</div>
                    </div>
                </div>
            </div>

            <!-- Submit a Request Form -->
            <div class="form-card">
                <h3 class="text-center mb-3 fw-bold text-danger">📝 Submit a Request</h3>
                <form id="requestForm" action="" method="POST">
                    <div class="form-group">
                        <label for="citizenName" class="form-label">Citizen Name</label>
                        <input type="text" class="form-control" id="citizenName" name="citizen_name" required placeholder="Enter your full name">
                    </div>
                    <div class="form-group">
                        <label for="requestType" class="form-label">Request Type</label>
                        <select class="form-select" id="requestType" name="request_type" required>
                            <option value="">Select a service</option>
                            <option value="Concern">Concern</option>
                            <option value="Recommendation">Recommendation</option>
                            <option value="Complaint">Complaint</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required placeholder="Enter your description">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn-submit mt-2">Submit Request</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>



<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
