<?php
session_start();
require_once "../includes/2fa.php";
require_once "../includes/jwt_helper.php";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $code = $_POST['code'];
    $user = $_SESSION['user'];

    if (verify2FA($user['twofa_secret'], $code)) {
        // SUCCESS: Create JWT Token
        $token = generateJWT($user);
        // Save token in browser cookie
        setcookie("auth_token", $token, time() + 3600, "/", "", false, true);
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid 2FA code. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="../assets/style.css"></head>
<body>
    <div class="container">
        <h2>Identity Verification</h2>
        <form method="POST">
            <input type="text" name="code" placeholder="Enter 6-digit code" required>
            <button type="submit">Verify & Access</button>
        </form>
        <p style="color:red;"><?php echo $error; ?></p>
    </div>
</body>
</html>