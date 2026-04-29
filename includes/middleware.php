<?php
// includes/middleware.php
require_once "jwt_helper.php";

function checkAccess($requiredRole) {
    // 1. Is there a token in the cookie?
    if (!isset($_COOKIE['auth_token'])) {
        header("Location: login.php");
        exit();
    }

    // 2. Is the token valid?
    $user = verifyJWT($_COOKIE['auth_token']);
    if (!$user) {
        header("Location: login.php");
        exit();
    }

    // 3. RBAC Logic
    $hierarchy = ['user' => 1, 'manager' => 2, 'admin' => 3];
    
    // Check if the user's role level is enough for the required role
    if ($hierarchy[$user['role']] < $hierarchy[$requiredRole]) {
        die("<div style='text-align:center; padding:50px;'><h1>Access Denied</h1><p>You do not have permission to view this page.</p></div>");
    }

    return $user;
}
?>