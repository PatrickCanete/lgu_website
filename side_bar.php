<?php if(!isset($unread_count)) $unread_count = 0; ?>
<div class="col-md-2 sidebar p-0">
    <div class="p-4">
        <h4 class="mb-4">Unisan Admin</h4>
        <nav class="nav flex-column">
            <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_dashboard.php'?'active':'' ?>" href="admin_dashboard.php">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_events.php'?'active':'' ?>" href="admin_events.php">
                <i class="fas fa-calendar-alt"></i> Events
            </a>
            <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_tourism.php'?'active':'' ?>" href="admin_tourism.php">
                <i class="fas fa-map-marked-alt"></i> Tourism
            </a>
            <a class="nav-link <?= basename($_SERVER['PHP_SELF'])=='admin_submissions.php'?'active':'' ?>" href="admin_submissions.php">
                <i class="fas fa-envelope"></i> Submissions
                <?php if ($unread_count > 0): ?>
                    <span class="badge bg-danger"><?= $unread_count ?></span>
                <?php endif; ?>
            </a>
            <hr class="my-3" style="border-color: rgba(255,255,255,0.2)">
            <a class="nav-link" href="admin_logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </nav>
    </div>
</div>
