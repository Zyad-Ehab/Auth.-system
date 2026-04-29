<?php
require_once "../includes/middleware.php";
$user = checkAccess('admin'); // Rejects anyone not Admin
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="../assets/style.css"></head>
<body>
    <div class="container">
        <h2>Admin Page</h2>
        <p>Welcome, <?php echo $user['email']; ?>. You have full control.</p>
        <a href="dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>