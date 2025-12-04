<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
    <link href=".vscode/css/history.css" rel="stylesheet" />

</head>
<style>
    .nav-link:hover,
    .nav-link:focus {
    color: #0b3d91 !important;
    text-decoration: underline;
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
    <main>
        <h1>History of Unisan</h1>
        <div style="flex-shrink: 0; display: flex; justify-content: center; margin-bottom: 20px;">
            <img src="https://live.staticflickr.com/1313/5160898699_55d5ed7fac_b.jpg" alt="Unisan View"
                style="width: 450px; height: auto; border-radius: 8px;">
        </div>
        <div style="max-width: 1200px; margin: 0 auto; font-family: Arial, sans-serif; line-height: 1.6;">
            <p>
                Kalilayan was the first name of this municipality. 
                As early as 1591, more than 4 centuries ago, the town of Kalilayan was founded by the first Malayan settlers. 
                The name Kalilayan derived from the Tagalog term, a rootword ‘’Lilay’’ a kind of palm similar to buri with the smaller leaves in the size of anahaw leaves that grow once in abundance. 
                During the latter part of the 19th century, traditions said that the real founder of the town, was a woman called of Ladya. She was a Malayan lady of nobility. Hence her title was (called) ‘’QUEEN of Kalilayan’’. It is believed that such founding occurred in the Middle Ages when immigration of the Malayans to this country was still predominant.
                That was before the advent of Mohamedanism in the East Indies. This proven by the fact that no traces of Mohamed’s Creed were found in that part of the Philippines when the Europeans landed in our Islands.
            </p>

            <p>
                Unisan, Quezon could be the oldest town in the Philippines.
                 The people of Unisan claimed that their town is now 481 years old, having been established in 1521, the same year that Ferdinand Magellan first landed in the Philippines. 
                 All other towns in the country were established not earlier than 1565, when Spain formally occupied the Philippines as a colony. A Malayan queen named Ladya reportedly founded Calilayan, the old name of the town. In 1876, Calilayan was renamed Unisan which was derived from the Latin word uni-sancti, meaning "holy saint".
            </p>

            <p>
                According to records, the name of Unisan was derived from a Spanish verb "UNIR" meaning, UNITE.
                At that time inhabitants, which were composed of strangers from different parts of the Island, were united.
                They wanted to call the town Unisan from the Tagalog word in place of UNION, or UNIDOS and for the sake of euphony they call the town UNISAN. 
                There was another version which related that the name was derived from the Latin words UNI-SANCTI, one saint or saint in honor of a saint. Friar Pedro Bautista, once a missionary to Unisan when this town was still CALILAYAN and later canonized saint following his martyrdom while a missionary in Japan. 
                This is more probable considering that there was a historical fact to support the version Uni-Sancti was made Unisan for short and to suit the Visayan and Caviteño tongues. Calilayan then regained its status as full-pledge pueblo under the new UNISAN. The people being united in their ideals struggled for the improvement of their new municipality.
            </p>
        </div>
    </main>
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
