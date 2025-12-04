<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barangays</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Poppins:wght@600;700;800&display=swap"rel="stylesheet" />
    <link href=".vscode\css\barangay.css" rel="stylesheet" />

</head>
<style>
    .nav-link:hover,
    .nav-link:focus {
    color: #0b3d91 !important;
    text-decoration: underline;
}
header {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
}
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 50px 20px;
        }
        
        .footer {
            background-color: #e8e8e8;
            padding: 40px 0;
            color: #666;
            font-size: 13px;
            line-height: 1.6;
        }
        
        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 40px;
        }
        
        .footer-section h3 {
            color: #999;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }
        
        .footer-section p {
            margin-bottom: 10px;
            color: #888;
        }
        
        .footer-section ul {
            list-style: none;
        }
        
        .footer-section ul li {
            margin-bottom: 8px;
        }
        
        .footer-section ul li a {
            color: #888;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-section ul li a:hover {
            color: #666;
            text-decoration: underline;
        }
        
        .logo-section {
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }
        
        .logo {
            width: 60px;
            height: 60px;
            background-color: #ccc;
            border-radius: 50%;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #888;
        }
        
        .logo-content {
            flex: 1;
        }
        
        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                gap: 30px;
            }
            
            .logo-section {
                flex-direction: column;
                text-align: center;
            }
        }
</style>

<body>
     <?php
        include 'header.php';
    ?>

    <div class="container my-5" role="main" aria-label="Barangays in the Municipality of Unisan">
        <div class="card p-4">
            <h2 class="mb-4 text-center">Barangays of Unisan (36)</h2>
            <table>
                <caption>Barangays of Unisan, Quezon</caption>
                <thead>
                    <tr>
                        <th>Barangay Name</th>
                        <th>Population (2025)</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Almacen</td>
                        <td>853</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Balagtas</td>
                        <td>703</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Balanacan</td>
                        <td>574</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Bonifacio</td>
                        <td>446</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Bulo Ibaba</td>
                        <td>683</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Bulo Ilaya</td>
                        <td>703</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Burgos</td>
                        <td>218</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Cabulihan Ibaba</td>
                        <td>460</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Cabulihan Ilaya</td>
                        <td>719</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Caigdal</td>
                        <td>682</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>F. de Jesus (Población)</td>
                        <td>2,566</td>
                        <td>Urban</td>
                    </tr>
                    <tr>
                        <td>General Luna</td>
                        <td>244</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Kalilayan Ibaba</td>
                        <td>2,727</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Kalilayan Ilaya</td>
                        <td>1,005</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Mabini</td>
                        <td>497</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Mairok Ibaba</td>
                        <td>311</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Mairok Ilaya</td>
                        <td>193</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Malvar</td>
                        <td>688</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Maputat</td>
                        <td>695</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Muliguin</td>
                        <td>1,383</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Pagaguasan</td>
                        <td>543</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Panaon Ibaba</td>
                        <td>814</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Panaon Ilaya</td>
                        <td>977</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Plaridel</td>
                        <td>327</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Poctol</td>
                        <td>1,503</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Punta</td>
                        <td>569</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>R. Lapu-lapu (Población)</td>
                        <td>349</td>
                        <td>Urban</td>
                    </tr>
                    <tr>
                        <td>R. Magsaysay (Población)</td>
                        <td>753</td>
                        <td>Urban</td>
                    </tr>
                    <tr>
                        <td>Raja Soliman (Población)</td>
                        <td>540</td>
                        <td>Urban</td>
                    </tr>
                    <tr>
                        <td>Rizal Ibaba</td>
                        <td>289</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Rizal Ilaya</td>
                        <td>321</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>San Roque</td>
                        <td>214</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Socorro</td>
                        <td>379</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Tagumpay</td>
                        <td>300</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Tubas</td>
                        <td>549</td>
                        <td>Rural</td>
                    </tr>
                    <tr>
                        <td>Tubigan</td>
                        <td>671</td>
                        <td>Rural</td>
                    </tr>
                </tbody>
            </table>
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
       
 

        

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>