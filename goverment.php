<?php
include 'g-6.php';
include 'config.php';

// Fetch government officials from database
$mayor = $conn->query("SELECT * FROM government_officials WHERE position='Mayor' ORDER BY position_order LIMIT 1")->fetch_assoc();
$vice_mayor = $conn->query("SELECT * FROM government_officials WHERE position='Vice Mayor' ORDER BY position_order LIMIT 1")->fetch_assoc();
$sb_members = $conn->query("SELECT * FROM government_officials WHERE position='Sangguniang Bayan Member' ORDER BY position_order, id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Government of Unisan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@400;500&display=swap" rel="stylesheet">

<style>
:root{
    --red:#8b1e1e;
    --red-dark:#7f1d1d;
    --dark:#1e293b;
    --gray:#64748b;
    --border:#e5e7eb;
}

/* FIXED HEADER SAFE SPACE */
body{
    font-family:Inter,sans-serif;
    background:#f8fafc;
    color:var(--dark);
    padding-top:90px; /* height ng navbar */
}

/* HERO */
.hero{
    background:linear-gradient(135deg,#7f1d1d,#b91c1c);
    color:white;
    padding:4.5rem 1rem;
    text-align:center;
}
.hero h1{
    font-family:Poppins,sans-serif;
    font-weight:800;
    font-size:2.6rem;
}
.hero p{
    max-width:720px;
    margin:1rem auto 0;
    opacity:.9;
    font-size:1.05rem;
}

/* CONTENT WRAPPER */
.page-content{
    padding:3.5rem 1rem 4rem;
}

/* MAIN CARD */
.content-card{
    background:white;
    max-width:1100px;
    margin:0 auto;
    border-radius:24px;
    padding:3rem;
    box-shadow:0 20px 40px rgba(0,0,0,.08);
}

/* SECTION TITLE */
.section-title{
    font-family:Poppins,sans-serif;
    font-weight:700;
    color:var(--red-dark);
    margin-bottom:1.8rem;
    border-left:5px solid var(--red-dark);
    padding-left:1rem;
}

/* OFFICIALS GRID */
.officials-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:1.5rem;
}

/* OFFICIAL CARD */
.official-card{
    background:#fff;
    border:1px solid var(--border);
    border-radius:18px;
    padding:2rem 1.5rem;
    text-align:center;
    transition:.3s ease;
}

.official-card:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 25px rgba(185,28,28,.2);
    border-color:var(--red-dark);
}

.official-title{
    font-size:.8rem;
    letter-spacing:1.5px;
    text-transform:uppercase;
    color:var(--gray);
    margin-bottom:.4rem;
}

.official-name{
    font-family:Poppins,sans-serif;
    font-size:1.15rem;
    font-weight:700;
}

/* MOBILE */
@media(max-width:768px){
    body{
        padding-top:80px;
    }
    .hero{
        padding:3.5rem 1rem;
    }
    .content-card{
        padding:2.3rem 1.5rem;
    }
}
</style>
</head>

<body>

<?php include 'header.php'; ?>

<section class="hero">
    <h1>Government of Unisan</h1>
    <p>
        Committed to transparent governance, responsive leadership,
        and people-centered public service for the Municipality of Unisan.
    </p>
</section>

<div class="page-content">
    <div class="content-card">

        <h3 class="section-title">Current Officials</h3>

        <div class="officials-grid mb-5">
            <?php if($mayor): ?>
            <div class="official-card">
                <div class="official-title">Mayor</div>
                <div class="official-name"><?= htmlspecialchars($mayor['name']) ?></div>
            </div>
            <?php endif; ?>

            <?php if($vice_mayor): ?>
            <div class="official-card">
                <div class="official-title">Vice Mayor</div>
                <div class="official-name"><?= htmlspecialchars($vice_mayor['name']) ?></div>
            </div>
            <?php endif; ?>
        </div>

        <?php if($sb_members->num_rows > 0): ?>
        <h3 class="section-title">Sangguniang Bayan Members</h3>

        <div class="officials-grid">
            <?php while($member = $sb_members->fetch_assoc()): ?>
            <div class="official-card">
                <div class="official-name"><?= htmlspecialchars($member['name']) ?></div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php include 'footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
