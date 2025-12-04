<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradise Destinations - Discover Your Next Adventure</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #fff5f5 0%, #ffeaea 100%);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
       

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }


        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(220, 38, 38, 0.8), rgba(153, 27, 27, 0.8)), url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><rect fill="%23f87171" width="1200" height="600"/><circle fill="%23dc2626" cx="200" cy="150" r="100" opacity="0.3"/><circle fill="%23991b1b" cx="800" cy="400" r="150" opacity="0.2"/><polygon fill="%23b91c1c" points="0,600 400,300 800,500 1200,200 1200,600" opacity="0.4"/></svg>');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: white;
            position: relative;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            text-shadow: 3px 3px 6px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease-out;
        }

        .hero-content p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .cta-button {
            display: inline-block;
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            color: white;
            padding: 1rem 2.5rem;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(251, 191, 36, 0.4);
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(251, 191, 36, 0.6);
        }

        /* Section Styles */
        .section {
            padding: 5rem 0;
            margin-top: 80px;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 3rem;
            color: #dc2626;
            text-shadow: 1px 1px 2px rgba(220, 38, 38, 0.2);
        }

        .grid {
            display: grid;
            gap: 2rem;
            margin-bottom: 3rem;
        }

        .grid-3 {
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        }

        .grid-4 {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        /* Card Styles */
        .card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(220, 38, 38, 0.15);
            transition: all 0.3s ease;
            position: relative;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(220, 38, 38, 0.25);
        }

        .card-image {
            height: 200px;
            background: linear-gradient(45deg, #dc2626, #f87171);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .card-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle fill="rgba(255,255,255,0.1)" cx="20" cy="20" r="10"/><circle fill="rgba(255,255,255,0.1)" cx="80" cy="60" r="15"/><circle fill="rgba(255,255,255,0.1)" cx="50" cy="80" r="8"/></svg>');
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #dc2626;
            margin-bottom: 0.5rem;
        }

        .card-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .card-price {
            background: linear-gradient(45deg, #dc2626, #991b1b);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        /* Attractions Section */
        .attractions {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
        }

        /* Resorts Section */
        .resorts {
            background: linear-gradient(135deg, #fff1f2 0%, #fce7e8 100%);
        }

        /* Beaches Section */
        .beaches {
            background: linear-gradient(135deg, #fef7ff 0%, #fce7f3 100%);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%);
            color: white;
            text-align: center;
            padding: 3rem 0;
            margin-top: 3rem;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            margin-bottom: 1rem;
            color: #fca5a5;
        }

        .footer-section p, .footer-section a {
            color: #fed7d7;
            text-decoration: none;
            line-height: 1.8;
        }

        .footer-section a:hover {
            color: white;
        }

        /* Animations */
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

        .fade-in {
            animation: fadeInUp 0.8s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            
            .hero-content p {
                font-size: 1.1rem;
            }
            
           
            
            .grid-3, .grid-4 {
                grid-template-columns: 1fr;
            }
            
            .section-title {
                font-size: 2rem;
            }
        }

        /* Scroll animations */
        .card {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .card.visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>
     <?php
        include 'header.php';
    ?>

    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Discover Paradise</h1>
                <p>Explore breathtaking destinations, luxury resorts, and pristine beaches</p>
                <a href="#attractions" class="cta-button">Start Your Journey</a>
            </div>
        </div>
    </section>

    <section id="attractions" class="section attractions">
        <div class="container">
            <h2 class="section-title">🏛️ Top Attractions</h2>
            <div class="grid grid-3">
                <div class="card">
                    <div class="card-image">🏰</div>
                    <div class="card-content">
                        <h3 class="card-title">Ancient Castle Ruins</h3>
                        <p class="card-description">Explore centuries-old castle ruins with breathtaking views and rich historical significance. Perfect for history enthusiasts.</p>
                        <span class="card-price">$25 Entry</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🌋</div>
                    <div class="card-content">
                        <h3 class="card-title">Volcano Adventure Park</h3>
                        <p class="card-description">Experience the power of nature at our active volcano viewpoint with guided tours and educational exhibits.</p>
                        <span class="card-price">$45 Tour</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🦋</div>
                    <div class="card-content">
                        <h3 class="card-title">Butterfly Sanctuary</h3>
                        <p class="card-description">Walk through tropical gardens filled with exotic butterflies from around the world in this magical sanctuary.</p>
                        <span class="card-price">$18 Entry</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🏛️</div>
                    <div class="card-content">
                        <h3 class="card-title">Cultural Heritage Museum</h3>
                        <p class="card-description">Discover local art, artifacts, and traditions spanning thousands of years of cultural heritage.</p>
                        <span class="card-price">$20 Entry</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🌊</div>
                    <div class="card-content">
                        <h3 class="card-title">Crystal Caves</h3>
                        <p class="card-description">Venture into stunning underground caves with crystal formations and underground lakes.</p>
                        <span class="card-price">$35 Tour</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="resorts" class="section resorts">
        <div class="container">
            <h2 class="section-title">🏨 Luxury Resorts</h2>
            <div class="grid grid-4">
                <div class="card">
                    <div class="card-image">🏖️</div>
                    <div class="card-content">
                        <h3 class="card-title">Sunset Beach Resort</h3>
                        <p class="card-description">Oceanfront luxury with private beaches, spa services, and world-class dining.</p>
                        <span class="card-price">$299/night</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🏔️</div>
                    <div class="card-content">
                        <h3 class="card-title">Mountain View Lodge</h3>
                        <p class="card-description">Scenic mountain retreat with hiking trails, cozy cabins, and breathtaking vistas.</p>
                        <span class="card-price">$189/night</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🌺</div>
                    <div class="card-content">
                        <h3 class="card-title">Tropical Paradise Hotel</h3>
                        <p class="card-description">All-inclusive tropical experience with pools, gardens, and exotic cuisine.</p>
                        <span class="card-price">$249/night</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🏰</div>
                    <div class="card-content">
                        <h3 class="card-title">Royal Palace Resort</h3>
                        <p class="card-description">Luxurious accommodations in a palace setting with royal service and amenities.</p>
                        <span class="card-price">$459/night</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🌲</div>
                    <div class="card-content">
                        <h3 class="card-title">Forest Retreat Spa</h3>
                        <p class="card-description">Wellness-focused resort surrounded by pristine forests with spa treatments.</p>
                        <span class="card-price">$329/night</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🏝️</div>
                    <div class="card-content">
                        <h3 class="card-title">Island Paradise Resort</h3>
                        <p class="card-description">Private island getaway with overwater bungalows and crystal-clear lagoons.</p>
                        <span class="card-price">$599/night</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🏺</div>
                    <div class="card-content">
                        <h3 class="card-title">Heritage Boutique Hotel</h3>
                        <p class="card-description">Historic charm meets modern luxury in this beautifully restored heritage property.</p>
                        <span class="card-price">$219/night</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🌅</div>
                    <div class="card-content">
                        <h3 class="card-title">Sunrise Cliff Resort</h3>
                        <p class="card-description">Dramatic clifftop location with infinity pools and spectacular sunrise views.</p>
                        <span class="card-price">$389/night</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="beaches" class="section beaches">
        <div class="container">
            <h2 class="section-title">🏖️ Pristine Beaches</h2>
            <div class="grid grid-3">
                <div class="card">
                    <div class="card-image">🏖️</div>
                    <div class="card-content">
                        <h3 class="card-title">Golden Sand Bay</h3>
                        <p class="card-description">Miles of golden sand with calm waters perfect for swimming, sunbathing, and beach sports.</p>
                        <span class="card-price">Free Access</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🌊</div>
                    <div class="card-content">
                        <h3 class="card-title">Crystal Cove Beach</h3>
                        <p class="card-description">Hidden gem with crystal-clear waters, perfect for snorkeling and discovering marine life.</p>
                        <span class="card-price">$10 Parking</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🏄</div>
                    <div class="card-content">
                        <h3 class="card-title">Surfer's Paradise</h3>
                        <p class="card-description">World-class surfing destination with consistent waves and vibrant beach culture.</p>
                        <span class="card-price">$15 Gear Rental</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🐚</div>
                    <div class="card-content">
                        <h3 class="card-title">Seashell Shore</h3>
                        <p class="card-description">Peaceful beach known for its abundance of beautiful seashells and tranquil atmosphere.</p>
                        <span class="card-price">Free Access</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image">🌅</div>
                    <div class="card-content">
                        <h3 class="card-title">Sunset Point Beach</h3>
                        <p class="card-description">Famous for spectacular sunsets and romantic evening walks along the pristine coastline.</p>
                        <span class="card-price">$5 Parking</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="contact">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p>📧 info@paradisedestinations.com</p>
                    <p>📱 +1 (555) 123-4567</p>
                    <p>📍 123 Paradise Street, Tropical City</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <p><a href="#attractions">Attractions</a></p>
                    <p><a href="#resorts">Resorts</a></p>
                    <p><a href="#beaches">Beaches</a></p>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <p><a href="#">Facebook</a></p>
                    <p><a href="#">Instagram</a></p>
                    <p><a href="#">Twitter</a></p>
                </div>
            </div>
            <div class="footer-content">
        <div class="footer-section">
            <h2>REPUBLIC OF THE PHILIPPINES</h2>
            <p>All content is in the public domain unless otherwise stated.</p>
        </div>
        <div class="footer-section">
            <h3>ABOUT GOVPH</h3>
            <p>Learn more about the Philippine government, its structure, how government works and the people behind it.</p>
            <ul>
                <li><a href="#">GOV.PH</a></li>
                <li><a href="#">Open Data Portal</a></li>
                <li><a href="#">Official Gazette</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>GOVERNMENT LINKS</h3>
            <ul>
                <li><a href="#">Office of the President</a></li>
                <li><a href="#">Office of the Vice President</a></li>
                <li><a href="#">Senate of the Philippines</a></li>
                <li><a href="#">House of Representatives</a></li>
                <li><a href="#">Supreme Court</a></li>
                <li><a href="#">Court of Appeals</a></li>
                <li><a href="#">Sandiganbayan</a></li>
            </ul>
        </div>
    </div>
            <p>&copy; 2025 Paradise Destinations. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.card').forEach(card => {
            observer.observe(card);
        });

        // Add staggered animation delay to cards
        document.querySelectorAll('.card').forEach((card, index) => {
            card.style.transitionDelay = `${index * 0.1}s`;
        });

        // Header background change on scroll
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 100) {
                header.style.background = 'linear-gradient(135deg, rgba(220, 38, 38, 0.95) 0%, rgba(153, 27, 27, 0.95) 100%)';
                header.style.backdropFilter = 'blur(10px)';
            } else {
                header.style.background = 'linear-gradient(135deg, #dc2626 0%, #991b1b 100%)';
                header.style.backdropFilter = 'none';
            }
        });

        // Add hover effects to cards
        document.querySelectorAll('.card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
    </script>
</body>
</html>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>