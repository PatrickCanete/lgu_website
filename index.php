<?php
include 'g-6.php';
include 'config.php';

// Get events from database
$events_query = "SELECT * FROM events ORDER BY event_date ASC";
$events_result = $conn->query($events_query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UNISAN QUEZON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="css\style.css" rel="stylesheet" />
    <style>
        /* Enhanced Carousel */
        #mainCarousel {
            position: relative;
            height: 750px;
        }
        #mainCarousel .carousel-item {
            height: 750px;
        }
        #mainCarousel img {
            height: 750px;
            object-fit: cover;
            filter: brightness(0.75);
        }
        #mainCarousel .carousel-caption {
            bottom: 50px;
            background: linear-gradient(135deg, rgba(184, 50, 50, 0.95), rgba(139, 26, 26, 0.95));
            padding: 20px 40px;
            border-radius: 15px;
            font-size: 2rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        /* History Section Styling */
        #history {
            padding: 80px 0;
            background: linear-gradient(to bottom, #f8f9fa 0%, #ffffff 100%);
        }
        #history h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            color: #b83232;
            margin-bottom: 60px;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        #history h2::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 5px;
            background: linear-gradient(to right, #b83232, #8b1a1a);
            border-radius: 3px;
        }
        .history-images {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 30px;
            max-width: 1200px;
            margin: 0 auto 50px;
            flex-wrap: wrap;
        }
        .history-images img {
            width: 450px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            transition: all 0.4s ease;
        }
        .history-images img:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 50px rgba(184, 50, 50, 0.3);
        }
        .history-text {
            max-width: 1200px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
            line-height: 1.8;
        }
        .history-text p {
            text-align: justify;
            font-size: 1.05rem;
            color: #333;
            margin-bottom: 25px;
            padding: 0 20px;
        }

        /* Events Section Enhanced */
        #upcoming-events {
            padding: 80px 0;
            background: white;
        }
        #upcoming-events h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            color: #b83232;
            margin-bottom: 60px;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        #upcoming-events h2::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 5px;
            background: linear-gradient(to right, #b83232, #8b1a1a);
            border-radius: 3px;
        }
        #upcoming-events .list-group {
            max-width: 900px;
            margin: 0 auto;
        }
        #upcoming-events .list-group-item {
            border: none;
            border-left: 5px solid #b83232;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            background: linear-gradient(to right, #fff 0%, #f8f9fa 100%);
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        #upcoming-events .list-group-item:hover {
            transform: translateX(10px);
            box-shadow: 0 8px 30px rgba(184, 50, 50, 0.2);
            border-left-width: 8px;
        }
        #upcoming-events .list-group-item strong {
            color: #b83232;
            font-size: 1.1rem;
            font-weight: 700;
        }

        /* Emergency Hotlines Section */
        .emergency-section {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }
        .emergency-section h2 {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 800;
            color: #b83232;
            margin-bottom: 50px;
            position: relative;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .emergency-section h2::after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 5px;
            background: linear-gradient(to right, #b83232, #8b1a1a);
            border-radius: 3px;
        }
        .hotline-card {
            background: white;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            border-top: 4px solid #b83232;
        }
        .hotline-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(184, 50, 50, 0.2);
        }
        .hotline-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #b83232, #8b1a1a);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
            box-shadow: 0 5px 15px rgba(184, 50, 50, 0.3);
        }
        .hotline-label {
            font-size: 1.1rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
        }
        .hotline-number {
            font-size: 1.3rem;
            font-weight: 800;
            color: #b83232;
            letter-spacing: 1px;
        }
        .emergency-note {
            text-align: center;
            margin-top: 40px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        .emergency-note i {
            color: #b83232;
            font-size: 1.5rem;
            margin-right: 10px;
        }
        .emergency-note p {
            display: inline;
            font-size: 1rem;
            color: #666;
            margin: 0;
        }

        /* Map Container Styling - REMOVED */

        /* Responsive Design */
        @media (max-width: 768px) {
            #mainCarousel, #mainCarousel .carousel-item, #mainCarousel img {
                height: 500px;
            }
            #mainCarousel .carousel-caption {
                font-size: 1.3rem;
                padding: 15px 30px;
            }
            #history h2, #upcoming-events h2 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>


<body>
    <?php include 'header.php'; ?>


    
    <!-- Main Carousel -->
    <section id="mainCarousel" class="carousel slide" data-bs-ride="carousel" aria-label="Main banner images">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/unisan arch.jpg" width="100px" height="750" class="d-block w-100"
                    alt="Unisan architecture building with sunset">
                <div class="carousel-caption d-none d-md-block">
                    Unisan Arc
                </div>
            </div>
            <div class="carousel-item">
                <img src="images/munisipyo.jpg" class="d-block w-100"
                    alt="Unisan natural scenic view with coastline and hills">
                <div class="carousel-caption d-none d-md-block">
                    Municipality of Unisan
                </div>
          
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev"
            aria-label="Previous slide">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next"
            aria-label="Next slide">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </section>



    <!-- Upcoming Events Section -->
    <section id="upcoming-events" class="container my-5">
        <h2>Upcoming Events in Unisan</h2>
        <ul class="list-group">
            <?php while ($event = $events_result->fetch_assoc()): ?>
                <li class="list-group-item">
                    <strong><?php echo date('F d, Y', strtotime($event['event_date'])); ?>:</strong> 
                    <?php echo htmlspecialchars($event['event_title']); ?> - 
                    <?php echo htmlspecialchars($event['event_description']); ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </section>

    <!-- Emergency Hotlines Section -->
    <section class="emergency-section">
        <div class="container">
            <h2><i class="fas fa-phone-volume me-3"></i>Emergency Hotlines</h2>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="hotline-card">
                        <div class="hotline-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="hotline-label">Municipal Hotline</div>
                        <div class="hotline-number">09338507284</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hotline-card">
                        <div class="hotline-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="hotline-label">Philippine National Police</div>
                        <div class="hotline-number">09985985783</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hotline-card">
                        <div class="hotline-icon">
                            <i class="fas fa-fire-extinguisher"></i>
                        </div>
                        <div class="hotline-label">Bureau of Fire Protection</div>
                        <div class="hotline-number">(042) 795-0143</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="hotline-card">
                        <div class="hotline-icon">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div class="hotline-label">NDRRMO Unisan</div>
                        <div class="hotline-number">09318797830</div>
                    </div>
                </div>
            </div>
            <div class="emergency-note">
                <i class="fas fa-info-circle"></i>
                <p>For emergencies, please call the appropriate hotline immediately. Keep these numbers accessible at all times.</p>
            </div>
        </div>
    </section>

    <!-- Map Section - REMOVED -->

     <?php
        include 'footer.php';
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>