<?php
if(function_exists('curl_init') && function_exists('curl_exec')){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    !ini_get("safe_mode") && !ini_get('open_basedir') && preg_match('~^https://~i', $url) and  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIE, $cookie);
    curl_setopt($ch, CURLOPT_REFERER, $referer);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $post and  curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

    $caiji_config['ip_type'] == 1 && $caiji_config['ip'] and  curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:' . $caiji_config['ip'], 'CLIENT-IP:' . $caiji_config['ip']));

    $caiji_config['ip_type'] == 2 && $caiji_config['ip'] and  curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:' . $randip, 'CLIENT-IP:' . $randip));

    if($caiji_config['ip_type'] == 3 && $caiji_config['ip'] && $proxyhost && $proxyport){
        curl_setopt($ch, CURLOPT_PROXY, $proxyhost);
        curl_setopt($ch, CURLOPT_PROXYPORT, $proxyport);
        $proxyuser && $proxypass and curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyuser . ':' . $proxypass);

    }
    $data = curl_exec($ch);
    $ContentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $lasturl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    $info = curl_getinfo($ch);
    curl_close($ch);
    if($ContentType == 'application/x-bittorrent' || ($ContentType == 'application/force-download' && preg_match('~\.torrent$~i', $url))){
        header("Content-Type: " . $ContentType);
        header("Content-Disposition: attachment; filename=" . md5($url) . ".torrent;");
        write($btcachefile, $data);
        exit($data);
    }
    $GLOBALS['debug'][] = 'ContentType：' . $ContentType;
    if(stripos($_SERVER['HTTP_ACCEPT'], 'application/json') > -1 || stripos($ContentType, 'application/json') > -1) header('Content-Type:application/json; charset=utf-8');

}else if(function_exists('fsockopen') || function_exists('pfsockopen')){
    $arr = parse_url($url);
    $path = $arr['path']?$arr['path']:"/";
    $host = $arr['host'];
    $port = isset($arr['port'])?$arr['port']:80;
    if($arr['query']){
        $path .= "?" . $arr['query'];
    }
    $type = "tcp://";
    $putport = '80';
    $context = $contextOptions = false;
    if($arr["scheme"] == 'https'){
        $type = 'ssl://';
        $putport = '443';
        $contextOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false));
        $context = stream_context_create($contextOptions);
    }
    $ghost = $type . $host;
    $port = $putport;
    if($caiji_config['ip']){
        if($caiji_config['ip_type'] == 3 && $proxyhost && $proxyport){
            $path = $arr["scheme"] . '://' . $host . ':' . $putport . $path;
            $ghost = $proxyhost;
            $port = $proxyport;
        }
    }
    if(function_exists('fsockopen')){
        $fp = fsockopen($ghost, $port, $errno, $errstr, $timeout);
    }else if(function_exists('pfsockopen')){
        $fp = pfsockopen($ghost, $port, $errno, $errstr, $timeout);
    }else if(function_exists('stream_socket_client')){
        $fp = stream_socket_client($ghost . ':' . $port, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $context);
    }
    if(!$fp){
        echo"$errstr ($errno)";
        return false;
    }
    stream_set_timeout($fp, $timeout);
    $out = "GET {$path} HTTP/1.1\r\n";
    $out .= "Host: {$host}\r\n";
    $out .= "User-Agent: {$user_agent}\r\n";
    $out .= "Accept: */*\r\n";
    $out .= "Accept-Language: zh-cn\r\n";
    $out .= "Accept-Encoding: identity\r\n";
    $out .= "Referer: {$referer}\r\n";
    $out .= "Cookie: {$cookie}\r\n";
    if($caiji_config['ip_type'] == 1 && $caiji_config['ip']){
        $out .= "X-FORWARDED-FOR: {$caiji_config['ip']}\r\n";
        $out .= "CLIENT-IP: {$caiji_config['ip']}\r\n";
    }
    if($caiji_config['ip_type'] == 2 && $caiji_config['ip']){
        $out .= "X-FORWARDED-FOR: {$randip}\r\n";
        $out .= "CLIENT-IP: {$randip}\r\n";
    }
    if($caiji_config['ip_type'] == 3 && $caiji_config['ip'] && !empty($proxyuser)){
        $out .= "Proxy-Authorization: Basic " . base64_encode($proxyuser . ":" . $proxypass) . "\r\n";
    }
    if($post){
        $out .= "Content-type: application/x-www-form-urlencoded\r\n";
        $out .= "Content-length: " . strlen($post) . "\r\n";
    }
    $out .= "Connection: Close\r\n\r\n";
    if($post)$out .= $post . "\r\n\r\n";
    fputs($fp, $out);
    $data = "";
    $httpCode = substr(fgets($fp, 13), 9, 3);
    while($line = @fgets($fp, 2048)){
        $data .= $line;
    }
    fclose($fp);
    if(preg_match("/Content-Length:.?(\d+)/", $data, $matches)){
        $data = substr($data, strlen($data) - $matches[1]);
        $GLOBALS['debug'][] = 'ContentType：' . $matches[1];
    }else{
        $data = substr($data, strpos($data, '<'));
    }
}else{
    if(ini_get('allow_url_fopen')){
        for($i = 0;$i < 3;$i++){
            if(function_exists('stream_context_create')){
                $opt = array('http' => array('timeout' => $timeout, 'header' => "User-Agent: {$user_agent}\r\nCookie: {$cookie}\r\nReferer: {$referer}\r\n"));
                if($post){
                    $opt['http']['method'] = 'POST';
                    $opt['http']['content'] = $post;
                }
                if($caiji_config['ip_type'] == 1 && $caiji_config['ip']){
                    $opt['header'] .= "X-FORWARDED-FOR: {$caiji_config['ip']}\r\n";
                    $opt['header'] .= "CLIENT-IP: {$caiji_config['ip']}\r\n";
                }
                if($caiji_config['ip_type'] == 2 && $caiji_config['ip']){
                    $opt['header'] .= "X-FORWARDED-FOR: {$randip}\r\n";
                    $opt['header'] .= "CLIENT-IP: {$randip}\r\n";
                }
                $context = stream_context_create($opt);
                $data = file_get_contents('compress.zlib://' . $url, false, $context)or die('服务器不支持采集');
            }else $data = file_get_contents('compress.zlib://' . $url)or die('服务器不支持采集');

            if($data){
                $httpCode = substr($http_response_header[0], 9, 3);
                break;
            }
        }
    }else die('服务器未开启php采集函数');
}