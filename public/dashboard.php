<?php
require_once "../includes/middleware.php";
// This ensures ONLY people with a valid JWT token can see this page
$user = checkAccess('user'); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
    <h2>Dashboard</h2>
    <p>Welcome, <strong><?php echo $user['role']; ?></strong> (<?php echo $user['email']; ?>)</p>
    <hr>
    
    <div class="nav-links" style="margin-top: 20px; display: flex; flex-direction: column; gap: 10px;">
        <a href="profile.php"><button style="background: #444;">Go to Profile (All Users)</button></a>
        
        <?php if ($user['role'] == 'manager' || $user['role'] == 'admin'): ?>
            <a href="manager.php"><button style="background: #444;">Manager Panel</button></a>
        <?php endif; ?>

        <?php if ($user['role'] == 'admin'): ?>
            <a href="admin.php"><button style="background: #b30000;">Admin Control Panel</button></a>
        <?php endif; ?>

        <a href="logout.php" style="color: red; margin-top: 10px;">Logout</a>
    </div>
</div>
</body>
</html>