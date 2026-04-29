<?php
require_once "../includes/middleware.php";
$user = checkAccess('manager'); // Rejects 'user', allows 'manager' and 'admin'
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="../assets/style.css"></head>
<body>
    <div class="container">
        <h2>Manager Page</h2>
        <p>Welcome, <?php echo $user['email']; ?>. You can manage staff.</p>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>