<footer class="footer">
    <div class="footer-content container">
        <div class="footer-section">
            <h2 style="color: #fff;">REPUBLIC OF THE PHILIPPINES</h2>
            <p>All content is in the public domain unless otherwise stated.</p>
        </div>

        <div class="footer-section">
            <h3 style="color: #fff;">ABOUT GOVPH</h3>
            <p>Learn more about the Philippine government, its structure, how government works, and the people behind it.</p>
            <ul>
                <li><a href="#">GOV.PH</a></li>
                <li><a href="#">Open Data Portal</a></li>
                <li><a href="#">Official Gazette</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h3 style="color: #fff;">GOVERNMENT LINKS</h3>
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

    <style>
        .footer {
            background: linear-gradient(135deg, #d64545 0%, hsla(0, 57%, 46%, 1.00) 100%);
            color: #fff;
            padding: 40px 20px;
            font-family: 'Poppins', sans-serif;
        }

        .footer h2, .footer h3 {
            margin-bottom: 15px;
            font-weight: 700;
        }

        .footer p {
            margin-bottom: 15px;
            line-height: 1.6;
            color: #fff;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 8px;
        }

        .footer ul li a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer ul li a:hover {
            color: #ffd6d6;
        }

        .footer-content {
            display: flex;
            flex-wrap: wrap;
            gap: 40px;
            justify-content: space-between;
        }

        .footer-section {
            flex: 1;
            min-width: 220px;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</footer>
