<?php
$randip = rand(13, 255) . '.' . rand(13, 255) . '.' . rand(13, 255) . '.' . rand(13, 255);
if($caiji_config['ip_type'] == 3 && $caiji_config['ip']){
    if(preg_match('~^http://~i', $caiji_config['ip']) || @is_file(VV_ROOT . $caiji_config['ip'])){
        $ipfile = VV_DATA . '/proxyip.dat';
        $cachetime = 600;
        $iparr = array();
        if(@is_file(VV_ROOT . $caiji_config['ip'])){
            $ipstr = file_get_contents(VV_ROOT . $caiji_config['ip']);
            $ipstr = str_replace(array("\r\n", "\n", "\r"), '|', $ipstr);
            $iparr = explode('|', $ipstr);
        }else{
            if(!is_file($ipfile) || (@filemtime($ipfile) + $cachetime) <= time()){
                $opt = array('http' => array('timeout' => 3));
                $context = stream_context_create($opt);
                $ipstr = file_get_contents($caiji_config['ip'], false, $context);
                if($ipstr){
                    $ipstr = str_replace(array("\r\n", "\n", "\r"), '|', $ipstr);
                    $iparr = explode('|', $ipstr);
                    write($ipfile, serialize($iparr));
                }else if(is_file($ipfile))  touch($ipfile, time() + 180);

            }else{
                $ipstr = file_get_contents($ipfile);
                $iparr = unserialize($ipstr);
            }
        }
        if($iparr){
            shuffle($iparr);
            $caiji_config['ip'] = $iparr[0];
        }
    }
    list($proxyserver, $proxyauth) = explode('@', $caiji_config['ip']);
    if(stripos($proxyserver, '.') === false){
        $proxyserver2 = $proxyserver;
        $proxyserver = $proxyauth;
        $proxyauth = $proxyserver2;
    }
    list($proxyhost, $proxyport) = explode(':', $proxyserver);
    list($proxyuser, $proxypass) = explode(':', $proxyauth);
    if($proxyhost && $proxyport){
        if(stripos($proxyport, '~') > -1){
            list($minproxyport, $maxproxyport) = explode('~', $proxyport);
            $proxyport = rand($minproxyport, $maxproxyport);
        }
    }
    $GLOBALS['debug'][] = '代理IP：' . $caiji_config['ip'];
}
else if($caiji_config['ip']) $GLOBALS['debug'][] = '伪造IP：' . $caiji_config['ip'];