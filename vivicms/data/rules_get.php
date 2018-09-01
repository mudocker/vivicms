<?php if(!defined('VV_INC'))exit(header("HTTP/1.1 403 Forbidden"));
if($v_config['sifton'] && OoO0o0O0o()){
    $sifturl = explode('[cutline]', $v_config['sifturl']);
    foreach($sifturl as $k => $vo){
        if($vo == $GLOBALS['geturl']){
            header("location: {$v_config['web_url']}");
            exit();
        }
    }
}
run_time(true);
if($searchurl)$GLOBALS['geturl'] = $searchurl;
$GLOBALS['geturl'] = str_replace('%u', '%25u', $GLOBALS['geturl']);
$GLOBALS['geturl'] = str_replace(array(' ', '+'), '%20', $GLOBALS['geturl']);
$parse_url = parse_url($GLOBALS['geturl']);
$scheme = $parse_url['scheme'];
$thisurl = thisurl();
function thisurl(){
    if(!empty($_SERVER["REQUEST_URI"])){
        $scrtName = $_SERVER["REQUEST_URI"];
        $nowurl = $scrtName;
    }else{
        $scrtName = $_SERVER["PHP_SELF"];
        if(empty($_SERVER["QUERY_STRING"])){
            $nowurl = $scrtName;
        }else{
            $nowurl = $scrtName . "?" . $_SERVER["QUERY_STRING"];
        }
    }
    return $nowurl;
}
$isgetnew = false;
$iscollect = true;
$GLOBALS['debug'][] = '目标url：' . $GLOBALS['geturl'];
if(($v_config['cacheon'] || $caiji_config['collect_close']) && OoO0o0O0o()){
    if($caiji_config['collect_close']){
        if(is_file($cachefile)){
            $iscollect = false;
        }else{
            exit('not file');
        }
    }
    if($iscollect && (!is_file($cachefile) || (@filemtime($cachefile) + ($cachetime * 3600)) <= time())){
        run_time(true);
        $GLOBALS['html'] = $caiji -> post($GLOBALS['geturl'], $_POST);
        $isgetnew = true;
    }else{
        $GLOBALS['html'] = file_get_contents($cachefile);
        $GLOBALS['debug'][] = '使用缓存：是';
        $GLOBALS['debug'][] = '缓存路径：' . $cachefile;
    }
}else{
    run_time(true);
    $GLOBALS['html'] = $caiji -> post($GLOBALS['geturl'], $_POST);
    $isgetnew = true;
}
if($isgetnew && $GLOBALS['html']){
    plus_run('before_convert_charset');
    $GLOBALS['debug'][] = '使用缓存：否';
    $GLOBALS['debug'][] = '采集用时：' . run_time() . 's';
    $strhead = $caiji -> strcut('<head>', '</head>', $GLOBALS['html']);
    if(preg_match('#<meta[^>]*charset\s*=\s*utf-8#iUs', $strhead) && $GLOBALS['urlext'] != 'js'){
        $caiji_config['charset'] = 'utf-8';
    }
    if(($GLOBALS['urlext'] == 'js' && preg_match('/[^\x00-\x80]/', $GLOBALS['html']) && is_utf8($GLOBALS['html'])) || ($GLOBALS['urlext'] != 'xml' && !ISOUTURL && is_utf8($GLOBALS['html']))){
        if(PATH_SEPARATOR == ':'){
            $GLOBALS['html'] = mb_convert_encoding($GLOBALS['html'], "gbk", 'utf-8');
        }else{
            $GLOBALS['html'] = iconv('utf-8', "gbk//IGNORE", $GLOBALS['html']);
        }
    }
    plus_run('source');
    if($caiji_config['replace_before_on']){
        run_time(true);
        $GLOBALS['html'] = replace_before($GLOBALS['html']);
        $GLOBALS['debug'][] = '前置替换：' . run_time() . 's';
    }
    $GLOBALS['html'] = str_ireplace('</head>', '</head>', $GLOBALS['html']);
    $GLOBALS['html'] = str_ireplace('</body>', '</body>', $GLOBALS['html']);
    if($GLOBALS['urlext'] != 'css' && $GLOBALS['urlext'] != 'js'){
        $GLOBALS['html'] = preg_replace('~<(/?body[^>]*)>~i', '<\\1>', $GLOBALS['html']);
        if($caiji_config['body_start'] && $caiji_config['body_end']){
            list($headstr, $str2) = explode('<body>', $GLOBALS['html']);
            list($bodystr, $str3) = explode('</body>', $str2);
            $bodystr = strcut($caiji_config['body_start'], $caiji_config['body_end'], $bodystr);
            if($bodystr)$GLOBALS['html'] = $headstr . '<body>' . $bodystr . '</body>' . $str3;
        }
        $GLOBALS['html'] = preg_replace('#content=\s*(["|\']*)\s*text/html;\s*charset[^"\']+\\1#i', 'content="text/html; charset=gbk"', $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace('#<meta charset="[^"]+">#i', '<meta charset="gbk">', $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace('#<meta charset=\'[^\']+\'>#i', '<meta charset="gbk">', $GLOBALS['html']);
        if(preg_match("~<base\s*href\s*=\s*([\"|']?)([^\"'>]+)\\1~iUs", $GLOBALS['html'], $match)){
            if($match[2]){
                $parse_url = parse_url($match[2]);
                $urlpath = geturlpath($parse_url);
            }
            $GLOBALS['html'] = preg_replace("/<base[^>]+>/si", "", $GLOBALS['html']);
        }
        $GLOBALS['html'] = preg_replace("/<(applet.*?)>(.*?)<(\/applet.*?)>/si", "", $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace("/<(\/?applet.*?)>/si", "", $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace("/<(noframes.*?)>(.*?)<(\/noframes.*?)>/si", "", $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace("/<(\/?noframes.*?)>/si", "", $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace('#content=\s*(["|\']*)([^"\'>]+)\\1\s*name\s*=\s*(["|\']*)keywords\\3#i', 'name="keywords" content="\\2"', $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace('#content=\s*(["|\']*)([^"\'>]+)\\1\s*name\s*=\s*(["|\']*)description\\3#i', 'name="description" content="\\2"', $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace('#<meta[^>]+name\s*=\s*(["|\']*)keywords[^>]+content\s*=\s*(["|\']*)([^"\'>\s*]+)\\2#i', '<meta name="keywords" content="\\3"', $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace('#<meta[^>]+name\s*=\s*(["|\']*)description[^>]+content\s*=\s*(["|\']*)([^"\'>\s*]+)\\2#i', '<meta name="description" content="\\3"', $GLOBALS['html']);
        $GLOBALS['html'] = str_ireplace('?<!DOCTYPE', '<!DOCTYPE', $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace('#<(a[^>]+)href\s*=\s*\'([^\']+)\'#i', '<\\1href="\\2"', $GLOBALS['html']);
        $GLOBALS['html'] = str_ireplace('href', 'href', $GLOBALS['html']);
    }
    $GLOBALS['html'] = str_ireplace(array($server_url, $server_url2), '', $GLOBALS['html']);
    if($caiji_config['other_url']){
        $other_url = explode(',', $caiji_config['other_url']);
        foreach($other_url as $k => $vo){
            $GLOBALS['html'] = str_ireplace(array('http://' . $vo, 'https://' . $vo, '//' . $vo), '', $GLOBALS['html']);
        }
    }
    $GLOBALS['html'] = preg_replace('~href=(["|\']*)//([0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+)~i', 'href=\\1' . $scheme . '://\\2', $GLOBALS['html']);
    $allhref = $allcss = $alljs = $allimg = $newhref = $newcss = $newjs = $newimg = array();
    run_time(true);
    $allhref = getallhref($GLOBALS['html']);
    $allimg = getallimg($GLOBALS['html']);
    $alljs = getalljs($GLOBALS['html']);
    $allcss = getallcss($GLOBALS['html']);
    $allhref = array_diff($allhref, $allcss, $alljs, $allimg);
    $GLOBALS['debug'][] = '获取所有资源链接用时：' . run_time() . 's';
    $GLOBALS['debug'][] = '超链接总数：' . count($allhref);
    $GLOBALS['debug'][] = '图片链接总数：' . count($allimg);
    $GLOBALS['debug'][] = 'css链接总数：' . count($allcss);
    $GLOBALS['debug'][] = 'js链接总数：' . count($alljs);
    $caiji_config['siftags'] = $caiji_config['siftags']?$caiji_config['siftags']:array();
    run_time(true);
    foreach($allimg as $k => $vo){
        if(substr($vo, 0, 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)){
                if($_SERVER["REQUEST_SCHEME"]){
                    $vo = $_SERVER["REQUEST_SCHEME"] . ':' . $vo;
                }else{
                    $vo = $scheme . ':' . $vo;
                }
            }else{
                $vo = substr($vo, 1);
            }
        }
        if(isgoodurl($vo)){
            if(substr($vo, 0, 1) == '/'){
                $vo = substr($vo, 1);
            }else if(stripos($vo, '{') === false){
                $vo = $urlpath . $vo;
            }
            $newpic[] = get_showurl($vo, 'jpg');
        }else{
            if(is_resdomain($vo)){
                $vo = WEB_ROOT . '/img.php?' . encode_source($collectid . '|' . $vo);
            }
            $newpic[] = $vo;
        }
    }
    if($newpic){
        $GLOBALS['html'] = str_replace($allimg, $newpic, $GLOBALS['html']);
    }
    $GLOBALS['debug'][] = '替换所有图片链接用时：' . run_time() . 's';
    run_time(true);
    foreach($alljs as $k => $vo){
        if(substr($vo, 0, 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)){
                if($_SERVER["REQUEST_SCHEME"]){
                    $vo = $_SERVER["REQUEST_SCHEME"] . ':' . $vo;
                }else{
                    $vo = $scheme . ':' . $vo;
                }
            }else{
                $vo = substr($vo, 1);
            }
        }
        if(isgoodurl($vo)){
            if(substr($vo, 0, 1) == '/')             $vo = substr($vo, 1);
            else if(stripos($vo, '{') === false)    $vo = $urlpath . $vo;

            if(in_array('localjs', $caiji_config['siftags'])){
                $newjs[] = 'none';
                continue;
            }
            $newjs[] = get_showurl($vo, 'js');
        }else{
            if(in_array('outjs', $caiji_config['siftags'])){
                $newjs[] = 'none';
                continue;
            }
            if(is_resdomain($vo)){
                $vo = WEB_ROOT . '/js.php?' . encode_source($collectid . '|' . $vo);
            }
            $newjs[] = $vo;
        }
    }
    if($newjs){
        $GLOBALS['html'] = str_replace($alljs, $newjs, $GLOBALS['html']);
    }
    $GLOBALS['debug'][] = '替换所有JS链接用时：' . run_time() . 's';
    run_time(true);
    foreach($allcss as $k => $vo){
        if(substr($vo, 0, 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)){
                if($_SERVER["REQUEST_SCHEME"]) $vo = $_SERVER["REQUEST_SCHEME"] . ':' . $vo;
                else                             $vo = $scheme . ':' . $vo;
            }else{
                $vo = substr($vo, 1);
            }
        }
        if(isgoodurl($vo)){
            if(substr($vo, 0, 1) == '/'){
                $vo = substr($vo, 1);
            }else if(stripos($vo, '{') === false){
                $vo = $urlpath . $vo;
            }
            if(in_array('localcss', $caiji_config['siftags'])){
                $newcss[] = 'none';
                continue;
            }
            $newcss[] = get_showurl($vo, 'css');
        }else{
            if(in_array('outcss', $caiji_config['siftags'])){
                $newcss[] = 'none';
                continue;
            }
            if(is_resdomain($vo)){
                $vo = WEB_ROOT . '/css.php?' . encode_source($collectid . '|' . $vo);
            }
            $newcss[] = $vo;
        }
    }
    if($newcss){
        $GLOBALS['html'] = str_replace($allcss, $newcss, $GLOBALS['html']);
    }
    $GLOBALS['debug'][] = '替换所有css链接用时：' . run_time() . 's';
    run_time(true);
    sort($allhref);
    foreach($allhref as $k => $vo){
        if(strlen($vo) <= 1 || stripos($vo, 'javascript:') > -1){
            continue;
        }
        $oldurl = $vo;
        if(substr($vo, 0, 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)){
                if($_SERVER["REQUEST_SCHEME"]){
                    $vo = $_SERVER["REQUEST_SCHEME"] . ':' . $vo;
                }else{
                    $vo = $scheme . ':' . $vo;
                }
            }else{
                $vo = substr($vo, 1);
            }
        }
        if(isgoodurl($vo)){
            if(in_array('locala', $caiji_config['siftags'])){
                $GLOBALS['html'] = preg_replace("~<a[^>]+href\s*=\s*([\"|']?){$vo}\\1[^>]+>(.*)</a>~i", '\\1', $GLOBALS['html']);
                continue;
            }
            if(substr($vo, 0, 1) == '/'){
                $vo = substr($vo, 1);
            }else if(stripos($vo, '{') === false){
                $vo = $urlpath . $vo;
            }
            if(SCRIPT == 'search' && substr($vo, 0, 1) == '?'){
                continue;
            }
            $newurl = get_showurl($vo, $v_config['web_urlencode_suffix']);
            if(strpos($GLOBALS['html'], '"' . $oldurl . '"') > -1){
                $GLOBALS['html'] = str_replace('"' . $oldurl . '"', '"' . $newurl . '"', $GLOBALS['html']);
            }
            if(strpos($GLOBALS['html'], 'href=' . $oldurl) > -1){
                $GLOBALS['html'] = str_replace('href=' . $oldurl, 'href=' . $newurl, $GLOBALS['html']);
            }
        }else{
            if(!preg_match('~^(magnet|thunder|ftp)~i', $vo) && in_array('outa', $caiji_config['siftags'])){
                $GLOBALS['html'] = str_replace('"' . $oldurl . '"', '"none"', $GLOBALS['html']);
            }
        }
    }
    $GLOBALS['debug'][] = '替换所有超链接用时：' . run_time() . 's';
    if($GLOBALS['urlext'] != 'js'){
        $GLOBALS['html'] = replace_css($GLOBALS['html']);
    }
    if($GLOBALS['urlext'] != 'js' && $GLOBALS['urlext'] != 'css'){
        if($caiji_config['big52gbk'] && OoO0o0O0o()){
            run_time(true);
            if(preg_match_all("#>\s*(\S*)\s*<#Us", $GLOBALS['html'], $arr)){
                $arr[1] = array_unique($arr[1]);
                $gbarr = $big5arr = array();
                include(VV_DATA . '/big5.php');
                if($caiji_config['big52gbk'] == 'togbk')$func = 'simplified';
                if($caiji_config['big52gbk'] == 'tobig5')$func = 'traditionalized';
                foreach($arr[1]as $k => $vo){
                    if(preg_match('/[^\x00-\x80]/', $vo)){
                        $gbarr[] = $arr[1][$k];
                        $big5arr[] = $func($arr[1][$k]);
                    }
                }
                $GLOBALS['html'] = str_replace($gbarr, $big5arr, $GLOBALS['html']);
            }
            $GLOBALS['debug'][] = '繁简互转用时：' . run_time() . 's';
        }
        $GLOBALS['html'] = preg_replace("~<(script[^>]+)src\s*=\s*([\"|']?)none\\2([^>]*)>(.*?)<\/script>~si", "", $GLOBALS['html']);
        $GLOBALS['html'] = preg_replace("~<(a[^>]+)href\s*=\s*([\"|']?)none\\2([^>]*)>(.*?)<\/a>~si", "\\4", $GLOBALS['html']);
    }
    plus_run('before_cache');
    if($v_config['cacheon'] && OoO0o0O0o()){
        if(!empty($GLOBALS['html'])){
            write($cachefile, $GLOBALS['html']);
        }else{
            if(is_file($cachefile))touch($cachefile, time() + 300);
        }
    }
}
$titlearr = explode('*', $caiji_config['from_title']);
foreach($titlearr as $k => $vo){
    $GLOBALS['html'] = str_ireplace($vo, $v_config['web_name'], $GLOBALS['html']);
}
if($caiji_config['search_url']){
    $GLOBALS['html'] = preg_replace('~<form([^>]+)action\s*=\s*(["|\']?)' . $caiji_config['search_url'] . '~i', '<form$1action=$2' . WEB_ROOT . '/search.php', $GLOBALS['html']);
}
run_time(true);
$GLOBALS['html'] = replace_zdy($GLOBALS['html']);
$GLOBALS['debug'][] = '自定义替换用时：' . run_time() . 's';
$GLOBALS['html'] = str_replace(array('{web_thisurl}', '{title}', '{web_domain}'), array($thisurl, $title, $_SERVER['HTTP_HOST']), $GLOBALS['html']);
foreach($v_config as $k => $vo){
    $GLOBALS['html'] = str_replace('{' . $k . '}', $vo, $GLOBALS['html']);
}
$zdy = array();
if(!empty($caiji_config['zdy'])){
    foreach($caiji_config['zdy']as $k => $vo){
        if($vo['type'] == '0'){
            $zdy[$vo['ename']] = $vo['body'];
        }
        if($vo['type'] == '1'){
            if($vo['start'] && $vo['end']){
                $zdy[$vo['ename']] = strcut($vo['start'], $vo['end'], $GLOBALS['html']);
            }
        }
        if($vo['type'] == '2'){
            if($vo['regx']){
                $zdy[$vo['ename']] = regxcut($vo['regx'], $GLOBALS['html']);
            }
        }
        $GLOBALS['html'] = str_replace('{zdy.' . $vo['ename'] . '}', $zdy[$vo['ename']], $GLOBALS['html']);
    }
}
if($config_ads2){
    foreach($config_ads2 as $k => $vo){
        $GLOBALS['html'] = str_ireplace('{ad.' . $k . '}', $vo, $GLOBALS['html']);
    }
}
if($config_ads2['top']){
    $topad = '<p align=center>' . $config_ads2['top'] . '</p>';
}
if($config_ads2['bottom']){
    $bottomad = '<p align=center>' . $config_ads2['bottom'] . '</p>';
}
if($GLOBALS['urlext'] != 'css' && $GLOBALS['urlext'] != 'js'){
    $GLOBALS['html'] = preg_replace('~<(body[^>]*)>~i', '<\\1>' . $topad, $GLOBALS['html'], 1);
    $GLOBALS['html'] = preg_replace('~</body>~i', '<div style="text-align:center;">' . $v_config['web_tongji'] . $bottomad . '</div></body>', $GLOBALS['html'], 1);
    if($caiji_config['hidejserror']){
        $GLOBALS['html'] = str_ireplace('<head>', '<head><script>var V_PATH="' . WEB_ROOT . '/' . '";window.onerror=function(){ return true; };</script>', $GLOBALS['html']);
    }
    if($caiji_config['no_siteapp']){
        $GLOBALS['html'] = str_ireplace('<head>', '<head><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" />', $GLOBALS['html']);
    }
    if($caiji_config['css']){
        $css = str_replace('{webpath}', WEB_ROOT . '/', $caiji_config['css']);
        $GLOBALS['html'] = str_ireplace('</head>', '<style>' . $css . '</style></head>', $GLOBALS['html']);
        $GLOBALS['html'] = str_ireplace('</body>', '<style>' . $css . '</style></body>', $GLOBALS['html']);
    }
    if(empty($_SERVER['QUERY_STRING'])){
        if($v_config['web_keywords']){
            $GLOBALS['html'] = preg_replace('#name\s*=\s*(["|\']*)keywords\\1\s*content=\s*(["|\']*)[^"\']+\\2#i', 'name="keywords" content="' . $v_config['web_keywords'] . '"', $GLOBALS['html']);
        }
        if($v_config['web_description']){
            $GLOBALS['html'] = preg_replace('#name\s*=\s*(["|\']*)description\\1\s*content=\s*(["|\']*)[^"\']+\\2#i', 'name="description" content="' . $v_config['web_description'] . '"', $GLOBALS['html']);
        }
        if($v_config['web_seo_name']){
            $GLOBALS['html'] = preg_replace('#<title>(.*)</title>#i', '<title>' . $v_config['web_seo_name'] . '</title>', $GLOBALS['html']);
        }
        if(is_file(VV_DATA . '/flink.conf')){
            $flinks = file_get_contents(VV_DATA . '/flink.conf');
            if($flinks){
                $flinks = str_ireplace(array("\r\n", "\r", "\n"), '&nbsp;&nbsp;', $flinks);
                if($v_config['flinks_auto_insert'] != 2){
                    $GLOBALS['html'] = str_ireplace('</body>', '<div style="text-align:center;">' . $flinks . '</div></body>', $GLOBALS['html']);
                }
            }
        }
    }
    $GLOBALS['html'] = str_ireplace('{flinks}', $flinks, $GLOBALS['html']);
    $GLOBALS['html'] = preg_replace('~=(["\']*)//(\w+)/~i', '=\\1/\\2/', $GLOBALS['html']);
    $GLOBALS['title'] = $caiji -> strcut('<title>', '</title>', $GLOBALS['html']);
    foreach(array(' ', '|', '-', '_', ',')as $vo){
        $GLOBALS['title'] = str_replace($vo . $v_config['web_name'], '', $GLOBALS['title']);
    }
    $GLOBALS['title'] = trim(trim($GLOBALS['title']), '-');
    $GLOBALS['title'] = trim($GLOBALS['title']);
    $GLOBALS['debug'][] = '获取当前title标题：' . $GLOBALS['title'];
    $title = $GLOBALS['title'];
}
if($v_config['linkword_on'] && OoO0o0O0o()){
    $link_config = @file_get_contents($linkwordfile);
    if($link_config){
        run_time(true);
        $GLOBALS['html'] = link_word($GLOBALS['html'], $link_config);
        $GLOBALS['debug'][] = '关键词内链用时：' . run_time() . 's';
    }
}
plus_run('end');
?>