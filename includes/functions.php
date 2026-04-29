<?php

// Hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Verify password
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

// Clean input
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}
?>