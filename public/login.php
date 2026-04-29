<?php
require_once "../includes/auth.php";

session_start();
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    $user = loginUser($email, $password);

    if ($user) {
        $_SESSION['user'] = $user;

        // Go to 2FA step
        header("Location: setup_2fa.php");
        exit();
    } else {
        $message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">

<div class="nav">
    <a href="register.php">Register</a>
</div>

<h2>Login</h2>

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Login</button>
</form>

<p><?php echo $message; ?></p>

</div>

</body>
</html>