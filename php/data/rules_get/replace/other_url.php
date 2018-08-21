<?php
$GLOBALS['html'] = str_ireplace([$server_url, $server_url2], '', $GLOBALS['html']);




if($caiji_config['other_url']){ //https
    $other_url = explode(',', $caiji_config['other_url']);
    foreach($other_url as $k => $vo) $GLOBALS['html'] = str_ireplace(['http://' . $vo, 'https://' . $vo, '//' . $vo], '', $GLOBALS['html']);
}

$GLOBALS['html'] = preg_replace('~href=(["|\']*)//([0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+)~i', 'href=\\1' . $scheme . '://\\2', $GLOBALS['html']);
