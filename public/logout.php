<?php
// pages/logout.php
session_start();
session_destroy(); // Clear session
setcookie("auth_token", "", time() - 3600, "/"); // Delete JWT cookie
header("Location: login.php");
exit();
?>