<?php
if(SCRIPT == 'search'){
    if(!empty($_POST)) $searchurl = $caiji_config['search_url'];
    else{
        unset($_GET['action']);
        $getstr = http_build_query($_GET);
        $search_sign = stripos($caiji_config['search_url'], '?') > -1?'&':'?';
        $searchurl = $caiji_config['search_url'] . $search_sign . $getstr;
    }
    if(substr($searchurl, 0, 7) != 'http://' && substr($searchurl, 0, 8) != 'https://') $searchurl = $server_url . '/' . ltrim($searchurl, '/');

    $cacheid = !empty($_POST)?md5($searchurl . http_build_query($_POST)):md5($searchurl);
    $cachefile = getcachefile($cacheid);
    $cachetime = $v_config['othercache'];
}
$extarr = array('php', 'html', 'shtml', 'htm', 'jsp', 'xhtml', 'asp', 'aspx', 'txt', 'action', 'xml', 'css', 'js', 'gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'swf');
foreach($extarr as $vo) $GLOBALS['geturl'] = str_replace('.' . $vo . '&', '.' . $vo . '?', $GLOBALS['geturl']);
$script_cmp=
        SCRIPT != 'search' && $_SERVER['QUERY_STRING']
        && checktime_log_out_1h()
        && $caiji_config['rewrite']
        && (substr($_SERVER["REQUEST_URI"], 0, 2) == '/?'
        || (!$v_config['web_remark']
         && substr($_SERVER["REQUEST_URI"], 0, 11) == '/index.php?')
        || preg_match('~^/' . $v_config['web_remark'] . '/\?~', $_SERVER["REQUEST_URI"])
        || preg_match('~^/' . $v_config['web_remark'] . '/index.php\?~', $_SERVER["REQUEST_URI"]));

$script_cmp and  $GLOBALS['geturl'] = $server_url . '/?' . $_SERVER['QUERY_STRING'];

(stripos($GLOBALS['geturl'], '?') === false && stripos($GLOBALS['geturl'], '&') > -1)                                        and  $GLOBALS['geturl'] = preg_replace('~\&~', '?', $GLOBALS['geturl'], 1);



