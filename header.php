<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="images/unisan seal.jpg" alt="Unisan Seal" width="50" height="50">
                UNISAN QUEZON
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="aboutDropdown" role="button"
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
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <style>
        /* Navbar Background & Text */
        .navbar {
            background: linear-gradient(135deg, #d64545 0%, #b83232 100%);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(6px);
        }

        .navbar-brand {
            font-weight: 700;
            color: #fff;
        }

        .navbar-brand img {
            border-radius: 50%;
            margin-right: 10px;
        }

        .nav-link {
            color: #fff;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover,
        .nav-item.dropdown:hover>.nav-link {
            color: #ffe5e5;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }

        /* Dropdown */
        .dropdown-menu {
            background: #d64545;
            border-radius: 8px;
        }

        .dropdown-item {
            color: #fff;
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background: #e06b6b;
            color: #000;
        }

        /* Toggler */
        .navbar-light .navbar-toggler {
            border-color: rgba(255, 255, 255, 0.7);
        }

        .navbar-light .navbar-toggler-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255, 255, 255, 0.7%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
        }

        /* Padding for body so content not matakpan */
        body {
            padding-top: 80px;
        }

        /* Responsive padding */
        @media (max-width: 992px) {
            .navbar-nav {
                background: #d64545;
                border-radius: 10px;
                margin-top: 0.5rem;
            }
        }
    </style>
</header>
