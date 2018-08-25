<?php




$GLOBALS['debug'][] = '采集url：' . $url;
$GLOBALS['debug'][] = '返回状态码：' . $httpCode;
$post and $GLOBALS['debug'][] = 'POST：' . $post;

if(substr($httpCode, 0, 2) == '30'){
    $GLOBALS['get_redirect'] = $GLOBALS['get_redirect']?($GLOBALS['get_redirect'] + 1):1;
    $GLOBALS['get_redirect'] < 4 and  $this -> get_redirect($url, $cacheurlfile, $post, $cookie);

}
if($httpCode >= 400){
    if($v_config['web_debug'] != "on" && $_GET['ac'] != 'yulan'){
        header("HTTP/1.1 404 Not Found");
        $v_config['web_404_url'] and header("Location: " . $v_config['web_404_url']);
        exit;
    }else $v_config['cacheon'] = false;

}
$ydatalen = strlen($data);
$unpackdata = @$this -> gzdecode($data);
$undatalen = strlen($unpackdata);
$unpackdata && $undatalen > $ydatalen and $data = $unpackdata;