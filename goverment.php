
<?php
include 'g-6.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Government of Unisan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet" />
    <link href="css\government.css" rel="stylesheet" />
    <style>
        :root {
            --primary-red: #dc2626;
            --secondary-red: #ef4444;
            --light-red: #fecaca;
            --accent-gold: #f59e0b;
            --dark-red: #991b1b;
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

        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%);
            box-shadow: 0 4px 20px rgba(220, 38, 38, 0.15);
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
            box-shadow: 0 20px 40px rgba(220, 38, 38, 0.08);
            border: 1px solid var(--border-gray);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-red), var(--secondary-red), var(--accent-gold));
        }

        .card h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            color: var(--primary-red);
            margin-bottom: 1.5rem;
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
            background: linear-gradient(90deg, var(--accent-gold), var(--secondary-red));
            border-radius: 2px;
        }

        .card h3 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--dark-red);
            margin: 2rem 0 1rem 0;
            padding: 0.8rem 1.2rem;
            background: linear-gradient(135deg, var(--light-red) 0%, rgba(239, 68, 68, 0.1) 100%);
            border-radius: 12px;
            border-left: 4px solid var(--secondary-red);
            position: relative;
        }

        .card h3::before {
            content: '📋';
            margin-right: 10px;
        }

        .card p {
            color: var(--text-light);
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
            text-align: justify;
            line-height: 1.7;
        }

        .card ul {
            margin: 1rem 0 1.5rem 0;
            padding-left: 0;
        }

        .card ul li {
            list-style: none;
            padding: 0.8rem 1.2rem;
            margin: 0.5rem 0;
            background: linear-gradient(135deg, #ffffff 0%, var(--light-gray) 100%);
            border-radius: 10px;
            border-left: 3px solid var(--accent-gold);
            color: var(--text-dark);
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            position: relative;
        }

        .card ul li::before {
            content: '▶';
            color: var(--secondary-red);
            margin-right: 10px;
            font-size: 0.8rem;
        }

        .card ul li:hover {
            transform: translateX(5px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.15);
            border-left-color: var(--secondary-red);
        }

        .card ul li strong {
            color: var(--primary-red);
            font-weight: 600;
        }

        /* Nested lists */
        .card ul ul {
            margin-left: 1rem;
            margin-top: 0.5rem;
        }

        .card ul ul li {
            background: linear-gradient(135deg, var(--light-red) 0%, rgba(254, 202, 202, 0.5) 100%);
            border-left-color: var(--secondary-red);
            font-size: 0.95rem;
        }

        .card ul ul li::before {
            content: '◆';
            color: var(--accent-gold);
        }

        /* Special sections styling */
        .vision-mission {
            background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid #fca5a5;
        }

        .core-values {
            background: linear-gradient(135deg, #fff7ed 0%, #fed7aa 100%);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid #fdba74;
        }

        .programs {
            background: linear-gradient(135deg, #fef2f2 0%, #fecaca 100%);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid #f87171;
        }

        .events {
            background: linear-gradient(135deg, #fff1f2 0%, #fce7e8 100%);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid #fda4af;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark-red) 0%, #7f1d1d 100%);
            padding: 3rem 0 2rem 0;
            color: #fca5a5;
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
            background: linear-gradient(90deg, var(--primary-red), var(--secondary-red), var(--accent-gold));
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 3rem;
        }
        
        .footer-section h3 {
            color: white;
            font-size: 16px;
            font-weight: 700;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
            position: relative;
        }

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
            color: #fca5a5;
            line-height: 1.6;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 0.8rem;
        }
        
        .footer-section ul li a {
            color: #fca5a5;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 0.3rem 0;
            display: inline-block;
        }
        
        .footer-section ul li a:hover {
            color: white;
            transform: translateX(5px);
        }
        
        .logo-section {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .logo {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-red), var(--secondary-red));
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            font-size: 1.2rem;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 8px 20px rgba(220, 38, 38, 0.3);
        }
        
        .logo-content {
            flex: 1;
        }

        .logo-content h3 {
            color: white;
            font-size: 18px;
            margin-bottom: 0.5rem;
        }

        .logo-content h3::after {
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .logo-section {
                flex-direction: column;
                text-align: center;
                align-items: center;
            }

            .card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .card h2 {
                font-size: 2rem;
            }

            .navbar-nav {
                background: rgba(220, 38, 38, 0.95);
                border-radius: 10px;
                padding: 1rem;
                margin-top: 1rem;
            }
        }

        /* Animation for cards */
        .card {
            animation: fadeInUp 0.8s ease-out;
        }

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
            box-shadow: 0 25px 50px rgba(220, 38, 38, 0.12);
            transition: all 0.3s ease;
        }

        /* Special styling for officials list */
        .officials-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        .official-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            border-radius: 12px;
            padding: 1.5rem;
            border: 2px solid var(--border-gray);
            text-align: center;
            transition: all 0.3s ease;
        }

        .official-card:hover {
            border-color: var(--secondary-red);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(239, 68, 68, 0.15);
        }

        .official-title {
            color: var(--primary-red);
            font-weight: 600;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .official-name {
            color: var(--text-dark);
            font-weight: 700;
            font-size: 1.1rem;
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
                <h2>Government of Unisan</h2>
                <p>The local government of Unisan is dedicated to serving its residents through various programs and initiatives. Our leadership is committed to transparency, accountability, and community engagement.</p>
                
                <h3 id="officials">Current Officials</h3>
                <div class="officials-grid">
                    <div class="official-card">
                        <div class="official-title">Mayor</div>
                        <div class="official-name">OMAR VELUZ</div>
                    </div>
                    <div class="official-card">
                        <div class="official-title">Vice Mayor</div>
                        <div class="official-name">FELOMINA CABUTIHAN</div>
                    </div>
                </div>
                
                <h3>Sangguniang Bayan Members</h3>
                <div class="officials-grid">
                    <div class="official-card">
                        <div class="official-name">KEBOY MAGNAYE</div>
                    </div>
                    <div class="official-card">
                        <div class="official-name">CRISTY CAPER</div>
                    </div>
                    <div class="official-card">
                        <div class="official-name">JOBERT GALANG</div>
                    </div>
                    <div class="official-card">
                        <div class="official-name">UWA MANALO</div>
                    </div>
                    <div class="official-card">
                        <div class="official-name">TONOY VILLAPANDO</div>
                    </div>
                    <div class="official-card">
                        <div class="official-name">ANRI MIMAY</div>
                    </div>
                    <div class="official-card">
                        <div class="official-name">JESS VERA CRUZ</div>
                    </div>
                </div>

                <div class="programs">
                    <h3 id="programs">📋 Programs and Initiatives</h3>
                    <ul>
                        <li>Community Health Services</li>
                        <li>Education and Scholarship Programs</li>
                        <li>Environmental Protection Initiatives</li>
                        <li>Infrastructure Development Projects</li>
                        <li>Disaster Preparedness and Response</li>
                        <li>Livelihood and Employment Programs</li>
                        <li>Public Safety and Security Initiatives</li>
                    </ul>
                </div>

                <div class="events">
                    <h3>Upoming Events</h3>
                    <p>Join us for our upcoming community events aimed at fostering unity and participation:</p>
                    <ul>
                        <li><strong>Annual Town Fiesta</strong> - June 29, 2025</li>
                        <li><strong>Health Fair</strong> - August 20, 2025</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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
    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const offsetTop = target.offsetTop - 100;
                    window.scrollTo({
                        top: offsetTop,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add scroll effect to navbar
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 50) {
                header.style.background = 'linear-gradient(135deg, rgba(220, 38, 38, 0.95) 0%, rgba(239, 68, 68, 0.95) 100%)';
                header.style.backdropFilter = 'blur(15px)';
            } else {
                header.style.background = 'linear-gradient(135deg, var(--primary-red) 0%, var(--secondary-red) 100%)';
                header.style.backdropFilter = 'blur(10px)';
            }
        });
    </script>
</body>

</html>