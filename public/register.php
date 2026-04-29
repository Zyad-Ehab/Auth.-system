<?php
require_once "../includes/auth.php";
require_once "../includes/2fa.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);
    $role = sanitize($_POST['role']);

    // Generate 2FA secret
    $secret = generateSecret();

    if (registerUser($name, $email, $password, $role, $secret)) {
        header("Location: login.php");
        exit();
    } else {
        $message = "Error registering user!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="container">

<div class="nav">
    <a href="login.php">Login</a>
</div>

<h2>Register</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <select name="role">
        <option value="user">User</option>
        <option value="manager">Manager</option>
        <option value="admin">Admin</option>
    </select>

    <button type="submit">Sign Up</button>
</form>

<p><?php echo $message; ?></p>

</div>

</body>
</html>