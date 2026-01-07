<?php
include 'g-6.php';
include 'config.php';

// Fetch all barangays from database
$barangays = $conn->query("SELECT * FROM barangays ORDER BY barangay_name ASC");

// Count total population
$total_population_result = $conn->query("SELECT SUM(population) as total FROM barangays");
$total_population = $total_population_result->fetch_assoc()['total'] ?? 0;

// Count rural and urban
$rural_count = $conn->query("SELECT COUNT(*) as total FROM barangays WHERE type='Rural'")->fetch_assoc()['total'];
$urban_count = $conn->query("SELECT COUNT(*) as total FROM barangays WHERE type='Urban'")->fetch_assoc()['total'];
$total_barangays = $rural_count + $urban_count;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barangays of Unisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-red: #b22222;
            --secondary-red: #c0392b;
            --light-red: #fca5a5;
            --accent-gold: #f59e0b;
            --dark-red: #7f1d1d;
            --light-gray: #f8fafc;
            --medium-gray: #64748b;
            --border-gray: #e2e8f0;
            --success-green: #10b981;
            --text-dark: #0f172a;
            --text-light: #475569;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--light-gray) 0%, #ffffff 100%);
            color: var(--text-dark);
            line-height: 1.6;
        }

        header {
            background: var(--primary-red);
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0.8rem 1rem;
        }

        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
        }

        .nav-link {
            color: white !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 0.2rem;
        }

        .nav-link:hover,
        .nav-link:focus {
            background: rgba(255, 255, 255, 0.2);
            color: white !important;
            transform: translateY(-2px);
        }

        .main-content {
            margin-top: 90px;
            padding: 2rem 0;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--dark-red) 100%);
            color: white;
            padding: 4rem 0;
            border-radius: 20px;
            margin-bottom: 3rem;
            text-align: center;
        }

        .hero-section h1 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.9;
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border: 2px solid var(--border-gray);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            border-color: var(--primary-red);
            box-shadow: 0 15px 35px rgba(178, 34, 34, 0.15);
        }

        .stat-icon {
            font-size: 2.5rem;
            color: var(--primary-red);
            margin-bottom: 1rem;
        }

        .stat-number {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-light);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .section-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 2rem;
            color: var(--text-dark);
            margin: 3rem 0 1.5rem 0;
            text-align: center;
        }

        .filter-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 2rem 0;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.7rem 1.5rem;
            border: 2px solid var(--border-gray);
            background: white;
            color: var(--text-dark);
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-red);
            color: white;
            border-color: var(--primary-red);
        }

        .table-container {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            margin-top: 2rem;
        }

        .barangay-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .barangay-table thead th {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
            color: white;
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .barangay-table thead th:first-child {
            border-radius: 10px 0 0 0;
        }

        .barangay-table thead th:last-child {
            border-radius: 0 10px 0 0;
        }

        .barangay-table tbody tr {
            border-bottom: 1px solid var(--border-gray);
            transition: all 0.3s ease;
        }

        .barangay-table tbody tr:hover {
            background: #fef2f2;
            transform: scale(1.01);
        }

        .barangay-table tbody td {
            padding: 1rem;
            color: var(--text-dark);
        }

        .barangay-name {
            font-weight: 600;
            color: var(--primary-red);
        }

        .type-badge {
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }

        .type-badge.rural {
            background: #d1fae5;
            color: #065f46;
        }

        .type-badge.urban {
            background: #dbeafe;
            color: #1e40af;
        }

        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            .barangay-table {
                font-size: 0.9rem;
            }
            
            .barangay-table thead th,
            .barangay-table tbody td {
                padding: 0.7rem 0.5rem;
            }
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <div class="main-content">
        <div class="container">
            <!-- Hero Section -->
            <div class="hero-section">
                <h1>🏘️ Barangays of Unisan</h1>
                <p>Discover the vibrant communities that make up our municipality</p>
            </div>

            <!-- Statistics -->
            <div class="stats-container">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-building"></i></div>
                    <div class="stat-number"><?= $total_barangays ?></div>
                    <div class="stat-label">Total Barangays</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-number"><?= number_format($total_population) ?></div>
                    <div class="stat-label">Total Population</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-tree"></i></div>
                    <div class="stat-number"><?= $rural_count ?></div>
                    <div class="stat-label">Rural Barangays</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-city"></i></div>
                    <div class="stat-number"><?= $urban_count ?></div>
                    <div class="stat-label">Urban Barangays</div>
                </div>
            </div>

            <!-- Filter Buttons -->
            <div class="filter-buttons">
                <button class="filter-btn active" onclick="filterBarangays('all')">All Barangays</button>
                <button class="filter-btn" onclick="filterBarangays('urban')">Urban</button>
                <button class="filter-btn" onclick="filterBarangays('rural')">Rural</button>
            </div>

            <!-- Barangays Table -->
            <h2 class="section-title">Complete List of Barangays</h2>
            <div class="table-container">
                <table class="barangay-table" id="barangayTable">
                    <thead>
                        <tr>
                            <th><i class="fas fa-hashtag me-2"></i>No.</th>
                            <th><i class="fas fa-map-marker-alt me-2"></i>Barangay</th>
                            <th><i class="fas fa-layer-group me-2"></i>Type</th>
                            <th><i class="fas fa-users me-2"></i>Population</th>
                            <th><i class="fas fa-user-tie me-2"></i>Barangay Captain</th>
                            <th><i class="fas fa-phone me-2"></i>Contact Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $counter = 1;
                        while($barangay = $barangays->fetch_assoc()): 
                        ?>
                        <tr data-type="<?= strtolower($barangay['type']) ?>">
                            <td><?= $counter++ ?></td>
                            <td class="barangay-name"><?= htmlspecialchars($barangay['barangay_name']) ?></td>
                            <td>
                                <span class="type-badge <?= strtolower($barangay['type']) ?>">
                                    <?= $barangay['type'] ?>
                                </span>
                            </td>
                            <td><?= number_format($barangay['population']) ?></td>
                            <td><?= htmlspecialchars($barangay['barangay_captain']) ?></td>
                            <td><?= htmlspecialchars($barangay['contact_number']) ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterBarangays(type) {
            const rows = document.querySelectorAll('#barangayTable tbody tr');
            const buttons = document.querySelectorAll('.filter-btn');
            
            // Update active button
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            // Filter rows and renumber
            let visibleCounter = 1;
            rows.forEach(row => {
                const rowType = row.dataset.type;
                
                if (type === 'all' || rowType === type) {
                    row.style.display = 'table-row';
                    row.cells[0].textContent = visibleCounter++;
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>

</html>