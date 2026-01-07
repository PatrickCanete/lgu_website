<!-- HEADER -->
<header>
    <nav class="navbar navbar-expand-lg" style="background: linear-gradient(135deg, #d64545 0%, #b83232 100%);">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="#">
                <img src=".vscode/images/unisan seal.jpg" alt="Unisan Seal" width="50" height="50">
                UNISAN QUEZON
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="aboutDropdown" role="button"
                            data-bs-toggle="dropdown">
                            About
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="aboutDropdown">
                            <li><a class="dropdown-item" href="baranggay.php">Barangay</a></li>
                            <li><a class="dropdown-item" href="history.php">History</a></li>
                            <li><a class="dropdown-item" href="goverment.php">Government</a></li>
                            <li><a class="dropdown-item" href="tourism.php">Tourism</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="services.php">Services</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- FOOTER -->
<footer class="footer" style="background: linear-gradient(135deg, #d64545 0%, #b83232 100%); color: #fff; padding: 40px 20px;">
    <div class="footer-content container d-flex flex-wrap justify-content-between">
        <div class="footer-section">
            <h2 class="fw-bold">REPUBLIC OF THE PHILIPPINES</h2>
            <p>All content is in the public domain unless otherwise stated.</p>
        </div>
        <div class="footer-section">
            <h3 class="fw-bold">ABOUT GOVPH</h3>
            <p>Learn more about the Philippine government, its structure, how government works and the people behind it.</p>
            <ul class="list-unstyled">
                <li><a href="#" class="text-white text-decoration-none">GOV.PH</a></li>
                <li><a href="#" class="text-white text-decoration-none">Open Data Portal</a></li>
                <li><a href="#" class="text-white text-decoration-none">Official Gazette</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3 class="fw-bold">GOVERNMENT LINKS</h3>
            <ul class="list-unstyled">
                <li><a href="#" class="text-white text-decoration-none">Office of the President</a></li>
                <li><a href="#" class="text-white text-decoration-none">Office of the Vice President</a></li>
                <li><a href="#" class="text-white text-decoration-none">Senate of the Philippines</a></li>
                <li><a href="#" class="text-white text-decoration-none">House of Representatives</a></li>
                <li><a href="#" class="text-white text-decoration-none">Supreme Court</a></li>
                <li><a href="#" class="text-white text-decoration-none">Court of Appeals</a></li>
                <li><a href="#" class="text-white text-decoration-none">Sandiganbayan</a></li>
            </ul>
        </div>
    </div>
    <style>
        .footer a:hover {
            color: #ffd6d6;
        }
        .navbar-nav .nav-link:hover {
            color: #ffd6d6;
        }
        .dropdown-menu li a:hover {
            background-color: #b83232;
            color: #fff;
        }
    </style>
</footer>
