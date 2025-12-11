<?php
include 'g-6.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UNISAN QUEZON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
    <link href="css\style.css" rel="stylesheet" />
</head>


<body>
    <?php include 'header.php'; ?>


    <!-- Bootstrap Modal for Submit a Form -->
    <div class="modal fade" id="submitFormModal" tabindex="-1" aria-labelledby="submitFormModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submitFormModalLabel">Submit a Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="submitForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Rest of your existing body content -->
    <section id="mainCarousel" class="carousel slide" data-bs-ride="carousel" aria-label="Main banner images">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src=".vscode\images\unisan arc.jpg" width="100px" height="750" class="d-block w-100"
                    alt="Unisan architecture building with sunset">
                <div class="carousel-caption d-none d-md-block">
                    Unisan Arc
                </div>
            </div>
            <div class="carousel-item">
                <img src=".vscode\images\munisipyo.jpg" class="d-block w-100"
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

    <section id="history" class="container my-5">
        <h2>History of Unisan</h2>
        <div style="display: flex; justify-content: center; align-items: flex-start; gap: 30px; max-width: 1200px; margin: 0 auto; font-family: Arial, sans-serif; line-height: 1.6;">
            <img src=".vscode\images\unisan oldhouse.jpg" alt="Unisan View" style="width: 450px; height: auto; border-radius: 8px;">
            <img src=".vscode\images\unisanmuseum.jpg" alt="" style="width: 450px; height: auto; border-radius: 8px;">
        </div>
        <div style="display: flex; align-items: flex-start; gap: 30px; max-width: 1200px; margin: 0 auto; font-family: Arial, sans-serif; line-height: 1.6;">
            <div style="flex: 1;">
                <p>Kalilayan was the first name of this municipality. As early as 1591, more than 4 centuries ago, the town of Kalilayan was founded by the first Malayan settlers. The name Kalilayan derived from the Tagalog term, a rootword ‘’Lilay’’ a kind of palm similar to buri with the smaller leaves in the size of anahaw leaves that grow once in abundance. During the latter part of the 19th century, traditions said that the real founder of the town, was a woman called of Ladya. She was a Malayan lady of nobility. Hence her title was (called) ‘’QUEEN of Kalilayan’’. It is believed that such founding occurred in the Middle Ages when immigration of the Malayans to this country was still predominant. That was before the advent of Mohamedanism in the East Indies. This proven by the fact that no traces of Mohamed’s Creed were found in that part of the Philippines when the Europeans landed in our Islands.</p>
                <p>Unisan, Quezon could be the oldest town in the Philippines. The people of Unisan claimed that their town is now 481 years old, having been established in 1521, the same year that Ferdinand Magellan first landed in the Philippines. All other towns in the country were established not earlier than 1565, when Spain formally occupied the Philippines as a colony. A Malayan queen named Ladya reportedly founded Calilayan, the old name of the town. In 1876, Calilayan was renamed Unisan which was derived from the Latin word uni-sancti, meaning "holy saint". (Source: Philippine Daily Inquirer)</p>
                <p>According to records, the name of Unisan was derived from a Spanish verb "UNIR" meaning, UNITE. At that time inhabitants, which were composed of strangers from different parts of the Island, were united. They wanted to call the town Unisan from the Tagalog word in place of UNION, or UNIDOS and for the sake of euphony they call the town UNISAN. There was another version which related that the name was derived from the Latin words UNI-SANCTI, one saint or saint in honor of a saint. Friar Pedro Bautista, once a missionary to Unisan when this town was still CALILAYAN and later canonized saint following his martyrdom while a missionary in Japan. This is more probable considering that there was a historical fact to support the version Uni-Sancti was made Unisan for short and to suit the Visayan and Caviteño tongues. Calilayan then regained its status as full-pledge pueblo under the new UNISAN. The people being united in their ideals struggled for the improvement of their new municipality.</p>
            </div>
        </div>
    </section>

    <section id="upcoming-events" class="container my-5">
        <h2>Upcoming Events in Unisan</h2>
        <ul class="list-group">
            <li class="list-group-item"><strong>June 29, 2025:</strong> Unisan Town Fiesta - A celebration of culture and community with parades, food stalls, and local performances.</li>
            <li class="list-group-item"><strong>July 15, 2025:</strong> Coastal Clean-Up Day - Join us in keeping our beaches clean and beautiful. Supplies will be provided.</li>
            <li class="list-group-item"><strong>August 10, 2025:</strong> Unisan Sports Festival - A day of friendly competition featuring various sports and games for all ages.</li>
            <li class="list-group-item"><strong>September 5, 2025:</strong> Cultural Heritage Day - Experience the rich history of Unisan through exhibits, workshops, and traditional performances.</li>
        </ul>
    </section>

    <div class="sidebar">
        <div class="hotline">Emergency Hotlines:</div>
        <p>Municipal Hotline: 09338507284</p>
        <p>PNP: 09985985783</p>
        <p>BFP Hotline: (042) 795-0143</p>
        <p>NDRRMO Unisan, Quezon: 09318797830</p>
        <p>For emergencies, please call the appropriate hotline.</p>
    </div>

    <div class="map-container">
        <h2>Location of Unisan</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3871.123456789012!2d121.12345678901234!3d13.123456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33b1234567890abc%3A0x1234567890abcdef!2sUnisan%2C%20Quezon%2C%20Philippines!5e0!3m2!1sen!2sus!4v1234567890123" allowfullscreen="" loading="lazy"></iframe>
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

