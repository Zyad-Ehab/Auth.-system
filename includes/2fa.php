<?php
// includes/2fa.php

// 1. Generate a random secret for the user
function generateSecret($length = 16) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567'; // Base32
    $secret = '';
    for ($i = 0; $i < $length; $i++) {
        $secret .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $secret;
}

// 2. Generate the QR code URL (uses Google Chart API)
function getQRCodeUrl($email, $secret) {
    $name = "SecureApp";
    $url = "otpauth://totp/$name:$email?secret=$secret&issuer=$name";
    return "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($url);
}

// 3. Verify the 6-digit code entered by user
function verify2FA($secret, $code) {
    $timeStep = floor(time() / 30);
    // Check current, previous, and next windows (to allow for small time desync)
    for ($i = -1; $i <= 1; $i++) {
        if (calculateTOTP($secret, $timeStep + $i) == $code) {
            return true;
        }
    }
    return false;
}

// Helper: The math behind TOTP (Time-based One Time Password)
function calculateTOTP($secret, $time) {
    $key = base32_decode($secret);
    $time = pack('N*', 0) . pack('N*', $time);
    $hmac = hash_hmac('sha1', $time, $key, true);
    $offset = ord($hmac[19]) & 0xf;
    $otp = ((ord($hmac[$offset+0])&0x7f)<<24 | (ord($hmac[$offset+1])&0xff)<<16 | (ord($hmac[$offset+2])&0xff)<<8 | (ord($hmac[$offset+3])&0xff)) % 1000000;
    return str_pad($otp, 6, '0', STR_PAD_LEFT);
}

function base32_decode($base32) {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ234567";
    $flipped = array_flip(str_split($chars));
    $output = ""; $v = 0; $vlen = 0;
    foreach (str_split($base32) as $c) {
        $v = ($v << 5) | $flipped[$c]; $vlen += 5;
        if ($vlen >= 8) { $output .= chr(($v >> ($vlen - 8)) & 0xff); $vlen -= 8; }
    }
    return $output;
}
?>