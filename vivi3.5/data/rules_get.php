<?php
if (!defined('VV_INC'))exit(header('HTTP/1.1 403 Forbidden'));
if ($v_config["sifton"] && OoO0o0O0o()){
    $var_4 = explode('[cutline]', $v_config["sifturl"]);
    foreach($var_4 as $var_5 => $var_6){
        if ($var_6 == $GLOBALS["geturl"]){
            header("location: {$v_config["web_url"]}");
            exit();
        }
    }
}
run_time(true);
if ($var_130)$GLOBALS["geturl"] = $var_130;
$GLOBALS["geturl"] = str_replace('%u', '%25u', $GLOBALS["geturl"]);
$GLOBALS["geturl"] = str_replace(array(' ', '+'), '%20', $GLOBALS["geturl"]);
$var_7 = parse_url($GLOBALS["geturl"]);
$var_171 = $var_7["scheme"];
$var_169 = thisurl();
$var_172 = false;
$var_11 = true;
$var_173 = false;
$GLOBALS["debug"][] = '目标url：' . $GLOBALS["geturl"];
if (($v_config["cacheon"] || $caiji_config["collect_close"]) && OoO0o0O0o()){
    if($caiji_config["collect_close"]){
        if(is_file($cachefile)){
            $var_11 = false;
        }else{
            exit('not file');
        }
    }
    if ($var_11 && !is_file($cachefile) || (@filemtime($cachefile) + ($var_10 * 3600)) <= time()){
        run_time(true);
        $GLOBALS["html"] = $caiji -> post($GLOBALS["geturl"], $_POST);
        $var_172 = true;
    }else{
        $GLOBALS["html"] = file_get_contents($cachefile);
        $GLOBALS["debug"][] = '使用缓存：是';
        $GLOBALS["debug"][] = '缓存路径：' . $cachefile;
    }
}else{
    run_time(true);
    $GLOBALS["html"] = $caiji -> post($GLOBALS["geturl"], $_POST);
    $var_172 = true;
}
if($GLOBALS["html"]){
    if($v_config["web_404_str"] && strpos($GLOBALS["html"], $v_config["web_404_str"]) > -1){
        display_404();
    }
}
if($var_172 && $GLOBALS["html"]){
    $GLOBALS["mygeturl"] = str_ireplace(array($var_125, $var_126), 'http://' . $_SERVER["HTTP_HOST"], $GLOBALS["geturl"]);
    plus_run('before_convert_charset');
    $GLOBALS["debug"][] = '使用缓存：否';
    $GLOBALS["debug"][] = '采集用时：' . run_time() . 's';
    $var_174 = $caiji -> strcut('<head>', '</head>', $GLOBALS["html"]);
    if (preg_match('#<meta[^>]*charset\s*=\s*utf-8#iUs', $var_174) && $GLOBALS["urlext"] != 'js'){
        $caiji_config["charset"] = 'utf-8';
    }
    if (($GLOBALS["urlext"] == 'js' && preg_match('/[^\x00-\x80]/', $GLOBALS["html"]) && is_utf8($GLOBALS["html"])) || ($GLOBALS["urlext"] != 'xml' && !ISOUTURL && is_utf8($GLOBALS["html"]))){
        if(stripos($_SERVER["HTTP_ACCEPT"], 'application/json') === false && !$var_173){
            if (PATH_SEPARATOR == ':'){
                $GLOBALS["html"] = mb_convert_encoding($GLOBALS["html"], 'gbk', 'utf-8');
            }else{
                $GLOBALS["html"] = iconv('utf-8', 'gbk//IGNORE', $GLOBALS["html"]);
            }
        }
    }else if($caiji_config["charset_force"] && $caiji_config["charset"] == 'utf-8'){
        if (PATH_SEPARATOR == ':'){
            $GLOBALS["html"] = mb_convert_encoding($GLOBALS["html"], 'gbk', 'utf-8');
        }else{
            $GLOBALS["html"] = iconv('utf-8', 'gbk//IGNORE', $GLOBALS["html"]);
        }
    }
    plus_run('source');
    if($caiji_config["replace_before_on"]){
        run_time(true);
        $GLOBALS["html"] = replace_before($GLOBALS["html"], $v_config);
        $GLOBALS["html"] = replace_before($GLOBALS["html"], $caiji_config);
        $GLOBALS["debug"][] = '前置替换：' . run_time() . 's';
    }
    $GLOBALS["html"] = str_ireplace('</head>', '</head>', $GLOBALS["html"]);
    $GLOBALS["html"] = str_ireplace('</body>', '</body>', $GLOBALS["html"]);
    if($GLOBALS["urlext"] != 'css' && $GLOBALS["urlext"] != 'js'){
        $GLOBALS["html"] = preg_replace('~<(body[^>]*)>~i', '<\1><bodycut>', $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('~<(/body[^>]*)>~i', '<\1>', $GLOBALS["html"]);
        if($caiji_config["body_start"] && $caiji_config["body_end"]){
            list($var_175, $var_176) = explode('<bodycut>', $GLOBALS["html"]);
            list($var_177, $var_178) = explode('</body>', $var_176);
            $var_177 = strcut($caiji_config["body_start"], $caiji_config["body_end"], $var_177);
            if($var_177) $GLOBALS["html"] = $var_175 . '<body>' . $var_177 . '</body>' . $var_178;
        }
        $GLOBALS["html"] = str_replace('<bodycut>', "", $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('#content=\s*(["|\']*)\s*text/html;\s*charset[^"\']+\1#i', 'content="text/html; charset=gbk"', $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('#<meta charset="[^"]+">#i', '<meta charset="gbk">', $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('#<meta charset=\'[^\']+\'>#i', '<meta charset="gbk">', $GLOBALS["html"]);
        if(preg_match('~<base\s*href\s*=\s*(["|\']?)([^"\'>]+)\1~iUs', $GLOBALS["html"], $var_164)){
            if($var_164[2]){
                $var_7 = parse_url($var_164[2]);
                $var_146 = geturlpath($var_7);
            }
            $GLOBALS["html"] = preg_replace('/<base[^>]+>/si', "", $GLOBALS["html"]);
        }
        $GLOBALS["html"] = preg_replace('/<(applet.*?)>(.*?)<(\/applet.*?)>/si', "", $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('/<(\/?applet.*?)>/si', "", $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('/<(noframes.*?)>(.*?)<(\/noframes.*?)>/si', "", $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('/<(\/?noframes.*?)>/si', "", $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('#content=\s*(["|\']*)([^"\'>]+)\1\s*name\s*=\s*(["|\']*)keywords\3#i', 'name="keywords" content="\2"', $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('#content=\s*(["|\']*)([^"\'>]+)\1\s*name\s*=\s*(["|\']*)description\3#i', 'name="description" content="\2"', $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('#<meta[^>]+name\s*=\s*(["|\']*)keywords[^>]+content\s*=\s*(["|\']*)([^"\'>\s*]+)\2#i', '<meta name="keywords" content="\3"', $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('#<meta[^>]+name\s*=\s*(["|\']*)description[^>]+content\s*=\s*(["|\']*)([^"\'>\s*]+)\2#i', '<meta name="description" content="\3"', $GLOBALS["html"]);
        $GLOBALS["html"] = str_ireplace('?<!DOCTYPE', '<!DOCTYPE', $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('#<(a[^>]+)href\s*=\s*\'([^\']+)\'#i', '<\1href="\2"', $GLOBALS["html"]);
        $GLOBALS["html"] = str_ireplace('href', 'href', $GLOBALS["html"]);
        $GLOBALS["html"] = str_ireplace(array($var_125, $var_126, $var_127), "", $GLOBALS["html"]);
    }
    if ($caiji_config["other_url"]){
        $var_179 = explode(',', $caiji_config["other_url"]);
        foreach($var_179 as $var_5 => $var_6){
            $GLOBALS["html"] = str_ireplace(array('http://' . $var_6, 'https://' . $var_6, '//' . $var_6), "", $GLOBALS["html"]);
        }
    }
    $GLOBALS["html"] = preg_replace('~href=(["|\']*)//([0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+)~i', 'href=\1' . $var_171 . '://\2', $GLOBALS["html"]);
    $var_180 = $var_181 = $var_182 = $var_183 = $var_184 = $var_185 = $var_186 = $var_187 = array();
    run_time(true);
    $var_183 = getallimg($GLOBALS["html"]);
    $var_182 = getalljs($GLOBALS["html"]);
    $var_181 = getallcss($GLOBALS["html"]);
    $GLOBALS["debug"][] = '图片链接总数：' . count($var_183);
    $GLOBALS["debug"][] = 'css链接总数：' . count($var_181);
    $GLOBALS["debug"][] = 'js链接总数：' . count($var_182);
    $caiji_config["siftags"] = $caiji_config["siftags"]?$caiji_config["siftags"]:array();
    run_time(true);
    foreach($var_183 as $var_5 => $var_6){
        if (substr($var_6, "0", 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $var_6)){
                $var_6 = $var_171 . ':' . $var_6;
            }else{
                $var_6 = substr($var_6, 1);
            }
        }
        $var_188 = "";
        if($caiji_config["domain_fan"] && $var_189 = is_fanurl($var_6)){
            $var_6 = preg_replace('~https?://[^/]+/?~i', '/', $var_6);
            $var_188 = $_SERVER["REQUEST_SCHEME"] . '://' . $var_189;
        }
        if (isgoodurl($var_6)){
            $var_190[] = $var_188 . get_showurl($var_6, 'jpg');
        }else{
            if(is_resdomain($var_6)){
                $var_6 = WEB_ROOT . '/img.php?' . encode_source($var_2 . '|' . $var_6);
            }
            $var_190[] = $var_6;
        }
    }
    if($var_190){
        $GLOBALS["html"] = str_replace($var_183, $var_190, $GLOBALS["html"]);
    }
    $GLOBALS["debug"][] = '替换所有图片链接用时：' . run_time() . 's';
    run_time(true);
    foreach($var_182 as $var_5 => $var_6){
        if (substr($var_6, "0", 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $var_6)){
                if($_SERVER["REQUEST_SCHEME"]){
                    $var_6 = $_SERVER["REQUEST_SCHEME"] . ':' . $var_6;
                }else{
                    $var_6 = $var_171 . ':' . $var_6;
                }
            }else{
                $var_6 = substr($var_6, 1);
            }
        }
        $var_188 = "";
        if($caiji_config["domain_fan"] && $var_189 = is_fanurl($var_6)){
            $var_6 = preg_replace('~https?://[^/]+/?~i', '/', $var_6);
            $var_188 = $_SERVER["REQUEST_SCHEME"] . '://' . $var_189;
        }
        if (isgoodurl($var_6)){
            if (in_array('localjs', $caiji_config["siftags"])){
                $var_186[] = 'none';
                continue;
            }
            $var_186[] = $var_188 . get_showurl($var_6, 'js');
        }else{
            if (in_array('outjs', $caiji_config["siftags"])){
                $var_186[] = 'none';
                continue;
            }
            if(is_resdomain($var_6)){
                $var_6 = WEB_ROOT . '/js.php?' . encode_source($var_2 . '|' . $var_6);
            }
            $var_186[] = $var_6;
        }
    }
    if($var_186){
        $GLOBALS["html"] = str_replace($var_182, $var_186, $GLOBALS["html"]);
    }
    $GLOBALS["debug"][] = '替换所有JS链接用时：' . run_time() . 's';
    run_time(true);
    foreach($var_181 as $var_5 => $var_6){
        if (substr($var_6, "0", 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $var_6)){
                if($_SERVER["REQUEST_SCHEME"]){
                    $var_6 = $_SERVER["REQUEST_SCHEME"] . ':' . $var_6;
                }else{
                    $var_6 = $var_171 . ':' . $var_6;
                }
            }else{
                $var_6 = substr($var_6, 1);
            }
        }
        $var_188 = "";
        if($caiji_config["domain_fan"] && $var_189 = is_fanurl($var_6)){
            $var_6 = preg_replace('~https?://[^/]+/?~i', '/', $var_6);
            $var_188 = $_SERVER["REQUEST_SCHEME"] . '://' . $var_189;
        }
        if (isgoodurl($var_6)){
            if (in_array('localcss', $caiji_config["siftags"])){
                $var_185[] = 'none';
                continue;
            }
            $var_185[] = $var_188 . get_showurl($var_6, 'css');
        }else{
            if (in_array('outcss', $caiji_config["siftags"])){
                $var_185[] = 'none';
                continue;
            }
            if(is_resdomain($var_6)){
                $var_6 = WEB_ROOT . '/css.php?' . encode_source($var_2 . '|' . $var_6);
            }
            $var_185[] = $var_6;
        }
    }
    if($var_185){
        $GLOBALS["html"] = str_replace($var_181, $var_185, $GLOBALS["html"]);
    }
    $GLOBALS["debug"][] = '替换所有css链接用时：' . run_time() . 's';
    $GLOBALS["all_links"] = get_all_link($GLOBALS["html"]);
    $var_180 = $GLOBALS["allhref"];
    $var_180 = array_diff($var_180, $var_181, $var_182, $var_183);
    $GLOBALS["debug"][] = '超链接总数：' . count($var_180);
    run_time(true);
    sort($var_180);
    foreach($var_180 as $var_5 => $var_6){
        if (strlen($var_6) <= 1 || stripos($var_6, 'javascript:') > -1){
            continue;
        }
        $var_191 = $var_6;
        if (substr($var_6, "0", 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $var_6)){
                if($_SERVER["REQUEST_SCHEME"]){
                    $var_6 = $_SERVER["REQUEST_SCHEME"] . ':' . $var_6;
                }else{
                    $var_6 = $var_171 . ':' . $var_6;
                }
            }else{
                $var_6 = substr($var_6, 1);
            }
        }
        $var_188 = "";
        if($caiji_config["domain_fan"] && $var_189 = is_fanurl($var_6)){
            $var_6 = preg_replace('~https?://[^/]+/?~i', '/', $var_6);
            $var_188 = $_SERVER["REQUEST_SCHEME"] . '://' . $var_189;
        }
        if($caiji_config["domain_fanmod"] && isgoodurl($var_6)){
            $var_192 = $caiji_config["my_domain"];
            if($caiji_config["domain_fanmod"]){
                if(!$var_193){
                    $var_193 = explode(',', $caiji_config["web_domains"]);
                    foreach($var_193 as $var_5 => $var_6){
                        if(substr($var_6, "0", 1) != '*'){
                            unset($var_193[$var_5]);
                        }
                    }
                }
                if($var_193){
                    shuffle($var_193);
                    $var_192 = substr($var_193["0"], 2);
                }
            }
            $var_194 = get_rand_str(rand($caiji_config["domain_num_min"], $caiji_config["domain_num_max"]), 1);
            $var_188 = $_SERVER["REQUEST_SCHEME"] . '://' . $var_194 . '.' . $var_192;
        }
        if (isgoodurl($var_6)){
            if (in_array('locala', $caiji_config["siftags"])){
                $GLOBALS["html"] = preg_replace("~<a[^>]+href\s*=\s*([\"|']?){$var_6}\\1[^>]+>(.*)</a>~i", '\1', $GLOBALS["html"]);
                continue;
            }
            if(SCRIPT == 'search' && substr($var_6, "0", 1) == '?'){
                continue;
            }
            $var_195 = $var_188 . get_showurl($var_6, $v_config["web_urlencode_suffix"]);
            if(isset($GLOBALS["all_links"][md5($var_191)])){
                $GLOBALS["all_links"][md5($var_191)]["url"] = $var_195;
            }
            if(isset($GLOBALS["all_links_text"][md5($var_191)])){
                $GLOBALS["all_links_text"][md5($var_191)]["url"] = $var_195;
            }
            if(isset($GLOBALS["all_links_pic"][md5($var_191)])){
                $GLOBALS["all_links_pic"][md5($var_191)]["url"] = $var_195;
            }
            if(strpos($GLOBALS["html"], '"' . $var_191 . '"') > -1){
                $GLOBALS["html"] = str_replace('"' . $var_191 . '"', '"' . $var_195 . '"', $GLOBALS["html"]);
            }
            if(strpos($GLOBALS["html"], 'href=' . $var_191) > -1){
                $GLOBALS["html"] = str_replace('href=' . $var_191, 'href=' . $var_195, $GLOBALS["html"]);
            }
        }else{
            if(!preg_match('~^(magnet|thunder|ftp)~i', $var_6) && in_array('outa', $caiji_config["siftags"])){
                $GLOBALS["html"] = str_replace('"' . $var_6 . '"', '"none"', $GLOBALS["html"]);
            }
        }
    }
    $GLOBALS["debug"][] = '替换所有超链接用时：' . run_time() . 's';
    if($GLOBALS["urlext"] != 'js'){
        $GLOBALS["html"] = replace_css($GLOBALS["html"]);
    }
    if($GLOBALS["urlext"] != 'js' && $GLOBALS["urlext"] != 'css'){
        if ($caiji_config["big52gbk"] && OoO0o0O0o()){
            run_time(true);
            if (preg_match_all('#>\s*(\S*)\s*<#Us', $GLOBALS["html"], $var_66)){
                $var_66[1] = array_unique($var_66[1]);
                $var_196 = $var_197 = array();
                include(VV_DATA . '/big5.php');
                if ($caiji_config["big52gbk"] == 'togbk')$var_198 = 'simplified';
                if ($caiji_config["big52gbk"] == 'tobig5')$var_198 = 'traditionalized';
                foreach($var_66[1]as $var_5 => $var_6){
                    if (preg_match('/[^\x00-\x80]/', $var_6)){
                        $var_196[] = $var_66[1][$var_5];
                        $var_197[] = $var_198($var_66[1][$var_5]);
                    }
                }
                $GLOBALS["html"] = str_replace($var_196, $var_197, $GLOBALS["html"]);
            }
            $GLOBALS["debug"][] = '繁简互转用时：' . run_time() . 's';
        }
        $GLOBALS["html"] = preg_replace('~<(script[^>]+)src\s*=\s*(["|\']?)none\2([^>]*)>(.*?)<\/script>~si', "", $GLOBALS["html"]);
        $GLOBALS["html"] = preg_replace('~<(a[^>]+)href\s*=\s*(["|\']?)none\2([^>]*)>(.*?)<\/a>~si', '\4', $GLOBALS["html"]);
    }
    plus_run('before_cache');
    if ($v_config["cacheon"] && OoO0o0O0o()){
        if (!empty($GLOBALS["html"])){
            write($cachefile, $GLOBALS["html"]);
        }else{
            if(is_file($cachefile)) touch($cachefile, time() + 300);
        }
    }
    if($caiji_config["theme_open"]){
        savelinksdata($GLOBALS["geturl"]);
    }
}
run_time(true);
$GLOBALS["html"] = replace_zdy($GLOBALS["html"], $v_config);
$GLOBALS["html"] = replace_zdy($GLOBALS["html"], $caiji_config);
$GLOBALS["debug"][] = '自定义替换用时：' . run_time() . 's';
$var_199 = explode('*', $caiji_config["from_title"]);
foreach($var_199 as $var_5 => $var_6){
    $GLOBALS["html"] = str_ireplace($var_6, $v_config["web_name"], $GLOBALS["html"]);
}
if($caiji_config["auto_get_search"] && preg_match_all('~<form([^>]+)action\s*=\s*(["|\']*)([\w/].+)["\']*[> ' . "\r\n\t" . ']{1,}~iUs', $GLOBALS["html"], $var_200)){
    $caiji_config["search_url"] = $var_200[3]["0"];
    $caiji_config["search_url"] = str_ireplace('?', '\?', $caiji_config["search_url"]);
}
if($caiji_config["search_url"]){
    $GLOBALS["html"] = preg_replace('~<form([^>]+)action\s*=\s*(["|\']?)' . $caiji_config["search_url"] . '~i', '<form$1action=$2' . WEB_ROOT . '/search.php', $GLOBALS["html"]);
    if($caiji_config["auto_get_search"]){
        session_start();
        $_SESSION["rules"]["search_url"] = $caiji_config["search_url"];
        session_write_close();
    }
}
$GLOBALS["html"] = str_replace(array('{web_thisurl}', '{title}', '{web_domain}'), array($var_169, $var_168, $_SERVER["HTTP_HOST"]), $GLOBALS["html"]);
foreach($v_config as $var_5 => $var_6){
    $GLOBALS["html"] = str_replace('{' . $var_5 . '}', $var_6, $GLOBALS["html"]);
}
if($caiji_config["source_replace"]){
    $var_150 = explode("\n", $caiji_config["source_replace"]);
    foreach($var_150 as $var_5 => $var_6){
        $var_6 = trim($var_6);
        list($var_151, $var_152) = explode('----', $var_6);
        $GLOBALS["html"] = str_replace($var_151, $var_152, $GLOBALS["html"]);
    }
}
$var_49 = array();
if(!empty($caiji_config["zdy"])){
    foreach($caiji_config["zdy"] as $var_5 => $var_6){
        if($var_6["type"] == "0"){
            $var_49[$var_6["ename"]] = $var_6["body"];
        }
        if($var_6["type"] == 1){
            if($var_6["start"] && $var_6["end"]){
                $var_49[$var_6["ename"]] = strcut($var_6["start"], $var_6["end"], $GLOBALS["html"]);
            }
        }
        if($var_6["type"] == 2){
            if($var_6["regx"]){
                $var_49[$var_6["ename"]] = regxcut($var_6["regx"], $GLOBALS["html"]);
            }
        }
        $GLOBALS["html"] = str_replace('{zdy.' . $var_6["ename"] . '}', $var_49[$var_6["ename"]], $GLOBALS["html"]);
    }
}
if($GLOBALS["urlext"] != 'css' && $GLOBALS["urlext"] != 'js'){
    if($caiji_config["hidejserror"]){
        $GLOBALS["html"] = str_ireplace('<head>', '<head><script>var V_PATH="' . WEB_ROOT . '/' . '";window.onerror=function(){ return true; };</script>', $GLOBALS["html"]);
    }
    if($caiji_config["no_siteapp"]){
        $GLOBALS["html"] = str_ireplace('<head>', '<head><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" />', $GLOBALS["html"]);
    }
    if ($caiji_config["css"]){
        $var_201 = str_replace('{webpath}', WEB_ROOT . '/', $caiji_config["css"]);
        $GLOBALS["html"] = str_ireplace('</head>', '<style>' . $var_201 . '</style></head>', $GLOBALS["html"]);
        $GLOBALS["html"] = str_ireplace('</body>', '<style>' . $var_201 . '</style></body>', $GLOBALS["html"]);
    }
    preg_match_all('~(<!--replacesign-->.*<!--/replacesign-->)~iUs', $GLOBALS["html"], $var_164);
    $GLOBALS["html"] = str_replace($var_164[1], "", $GLOBALS["html"]);
    if($var_142["top"]){
        $GLOBALS["html"] = preg_replace('~<(body[^>]*)>~i', '<\1><!--replacesign-->{ad.top}<!--/replacesign-->', $GLOBALS["html"], 1);
    }
    if($var_142["bottom"] || $v_config["web_tongji"]){
        $GLOBALS["html"] = preg_replace('~</body>~i', '<!--replacesign-->{ad.bottom}' . $v_config["web_tongji"] . '<!--/replacesign--></body>', $GLOBALS["html"], 1);
    }
    if(empty($_SERVER["QUERY_STRING"]) || $GLOBALS["is_wwwroot"]){
        if($GLOBALS["is_fanurl"]){
            $v_config["web_seo_name"] = $v_config["web_keywords"] = $v_config["web_description"] = "";
            if($GLOBALS["fan_title"]){
                $v_config["web_seo_name"] = $GLOBALS["fan_title"];
            }
            if($GLOBALS["fan_keywords"]){
                $v_config["web_keywords"] = $GLOBALS["fan_keywords"];
            }
            if($GLOBALS["fan_description"]){
                $v_config["web_description"] = $GLOBALS["fan_description"];
            }
        }
        if($v_config["web_keywords"]){
            $GLOBALS["html"] = preg_replace('#name\s*=\s*(["|\']*)keywords\1\s*content=\s*(["|\']*)[^"\']+\2#i', 'name="keywords" content="' . $v_config["web_keywords"] . '"', $GLOBALS["html"]);
        }
        if($v_config["web_description"]){
            $GLOBALS["html"] = preg_replace('#name\s*=\s*(["|\']*)description\1\s*content=\s*(["|\']*)[^"\']+\2#i', 'name="description" content="' . $v_config["web_description"] . '"', $GLOBALS["html"]);
        }
        if($v_config["web_seo_name"]){
            $GLOBALS["html"] = preg_replace('#<title>(.*)</title>#i', '<title>' . $v_config["web_seo_name"] . '</title>', $GLOBALS["html"]);
        }
    }
    if (empty($_SERVER["QUERY_STRING"]) || $GLOBALS["is_wwwroot"] || $v_config["flinkshowtype"] == 1){
        $var_141 = "";
        if($v_config["flinktype"] == 2){
            $var_202 = require_once(VV_DATA . '/domain_link.php');
            if($var_202){
                shuffle($var_202);
                $var_202 = array_slice($var_202, "0", $v_config["flinknum"]);
                foreach($var_202 as $var_5 => $var_6){
                    if($var_6["domain"] != $_SERVER["HTTP_HOST"]){
                        $var_203 = explode(',', $var_6["name"]);
                        shuffle($var_203);
                        $var_6["name"] = $var_203["0"];
                        $var_141 .= "<a href='http://{$var_6["domain"]}/' target='_blank'>{$var_6["name"]}</a>\r\n";
                    }
                }
            }
        }else{
            if($caiji_config["flink_set"]){
                $var_141 = $caiji_config["flink"];
            }else{
                $var_141 = @file_get_contents(VV_DATA . '/flink.conf');
            }
        }
        if ($var_141){
            $var_141 = str_ireplace(array("\r\n", "\r", "\n"), '&nbsp;&nbsp;', $var_141);
            if ($caiji_config["flinks_auto_insert"] != 2){
                if(stripos($GLOBALS["html"], '</body>') > -1){
                    $GLOBALS["html"] = preg_replace('~</body>~i', '<div align="center">友情链接：' . $var_141 . '</div></body>', $GLOBALS["html"], 1);
                }else if(stripos($GLOBALS["html"], '</html>') > -1){
                    $GLOBALS["html"] = preg_replace('~</html>~i', '<div align="center">友情链接：' . $var_141 . '</div></html>', $GLOBALS["html"], 1);
                }else{
                    $GLOBALS["html"] .= '<div align="center">友情链接：' . $var_141 . '</div></html>';
                }
            }
        }
    }
    $GLOBALS["html"] = str_ireplace('{flinks}', $var_141, $GLOBALS["html"]);
    $GLOBALS["html"] = preg_replace('~=(["\']*)//(\w+)/~i', '=\1/\2/', $GLOBALS["html"]);
    $GLOBALS["title"] = $caiji -> strcut('<title>', '</title>', $GLOBALS["html"]);
    foreach(array(' ', '|', '-', '_', ',') as $var_6){
        $GLOBALS["title"] = str_replace($var_6 . $v_config["web_name"], "", $GLOBALS["title"]);
        $GLOBALS["title"] = trim(trim($GLOBALS["title"]), $var_6);
    }
    $GLOBALS["title"] = trim(trim($GLOBALS["title"]), '-');
    $GLOBALS["title"] = trim($GLOBALS["title"]);
    $GLOBALS["debug"][] = '获取当前title标题：' . $GLOBALS["title"];
    $var_168 = $GLOBALS["title"];
}
if($var_142){
    foreach($var_142 as $var_5 => $var_6){
        $GLOBALS["html"] = str_ireplace('{ad.' . $var_5 . '}', $var_6, $GLOBALS["html"]);
    }
}
if($caiji_config["linkword_set"]){
    $v_config["linkword_on"] = $caiji_config["linkword_on"];
    $var_71 = $caiji_config["link_config"];
}else{
    $var_71 = @file_get_contents($var_75);
}
if ($v_config["linkword_on"] && OoO0o0O0o()){
    if($var_71){
        run_time(true);
        $GLOBALS["html"] = link_word($GLOBALS["html"], $var_71);
        $GLOBALS["debug"][] = '关键词内链用时：' . run_time() . 's';
    }
}
plus_run(end);
?>