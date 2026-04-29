<?php
require_once "../config/db.php";
require_once "functions.php";

// Register user with 2FA secret
function registerUser($name, $email, $password, $role, $secret) {
    global $conn;

    $hashedPassword = hashPassword($password);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role, twofa_secret) VALUES (?, ?, ?, ?, ?)");
    
    return $stmt->execute([$name, $email, $hashedPassword, $role, $secret]);
}

// Login user
function loginUser($email, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && verifyPassword($password, $user['password'])) {
        return $user;
    }

    return false;
}
?>