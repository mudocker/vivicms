<?php
$cacheurlfile = VV_CACHE . "/redirect_url/" . substr(md5($url . $post), 0, 16) . '.txt';
if(is_file($cacheurlfile)){
    $lasturl = file_get_contents($cacheurlfile);
    header('HTTP/1.1 301 Moved Permanently');
    header("Location: $lasturl");
    exit;
}
$btcachefile = VV_CACHE . "/btfile/" . substr(md5($url), 0, 16) . '.bt';
if(is_file($btcachefile)){
    header("Content-Type: application/x-bittorrent");
    header("Content-Disposition: attachment; filename=" . md5($url) . ".torrent;");
    exit;
}