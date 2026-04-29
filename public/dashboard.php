<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container">
    <h2>Welcome</h2>
    <p>Hello, <?php echo $_SESSION['user']['name']; ?></p>
</div>
</body>
</html>