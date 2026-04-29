<?php
// includes/jwt_helper.php
define('SECRET_KEY', 'my_secret_123'); // Your signing key

function generateJWT($user) {
    $header = base64_encode(json_encode(['alg' => 'HS256', 'typ' => 'JWT']));
    $payload = base64_encode(json_encode([
        'id' => $user['id'],
        'email' => $user['email'],
        'role' => $user['role'],
        'exp' => time() + 3600 // Token lasts 1 hour
    ]));
    
    $signature = base64_encode(hash_hmac('sha256', "$header.$payload", SECRET_KEY, true));
    return "$header.$payload.$signature";
}

function verifyJWT($token) {
    $parts = explode('.', $token);
    if (count($parts) != 3) return false;
    list($header, $payload, $signature) = $parts;
    
    $validSig = base64_encode(hash_hmac('sha256', "$header.$payload", SECRET_KEY, true));
    if ($signature !== $validSig) return false;

    $data = json_decode(base64_decode($payload), true);
    if ($data['exp'] < time()) return false; // Expired
    return $data;
}
?>