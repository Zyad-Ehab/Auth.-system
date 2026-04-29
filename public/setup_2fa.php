<?php
session_start();
require_once "../includes/2fa.php";
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$user = $_SESSION['user'];
$qrUrl = getQRCodeUrl($user['email'], $user['twofa_secret']);
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="../assets/style.css"></head>
<body>
    <div class="container">
        <h2>2FA Security</h2>
        <p>Scan this QR with <b>Google Authenticator</b>:</p>
        <img src="<?php echo $qrUrl; ?>" style="margin:20px 0; border:5px solid white;">
        <p>Secret: <code><?php echo $user['twofa_secret']; ?></code></p>
        <a href="verify_2fa.php"><button>I've Scanned It</button></a>
    </div>
</body>
</html>