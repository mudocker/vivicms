<?php
if (!defined('VV_INC'))exit(header('HTTP/1.1 403 Forbidden'));
banip();
$GLOBALS["debug"] = array();
$var_115 = VV_DATA . '/domain_config.php';
if(!is_file($var_115)){
    exit('站点配置文件不存在，请检查~');
}
$var_14 = isset($_GET["ac"])?$_GET["ac"]:"";
session_start();
if ($var_14 == 'yulan'){
    $var_2 = @$_GET["collectid"];
}else if(1 == 2 && $_SESSION["collectid"]){
}else if($_GET["collectid"]){
    $_SESSION["collectid"] = (int)$_GET["collectid"];
    $var_2 = $_SESSION["collectid"];
}else{
    $var_38 = require_once($var_115);
    foreach($var_38 as $var_5 => $var_6){
        $var_116 = $_SERVER["HTTP_HOST"];
        if(stripos($var_5, ':') > -1){
            $var_116 .= ':' . $_SERVER["SERVER_PORT"];
        }
        $var_66 = explode(',', $var_5);
        foreach($var_66 as $var_47 => $var_48){
            $var_48 = str_replace('.', '\.', $var_48);
            $var_48 = str_replace('*', '([\w-]+)', $var_48);
            $var_48 = strtolower($var_48);
            if(preg_match('~^' . $var_48 . '$~i', $var_116)){
                $var_2 = $var_6;
                break 2;
            }
        }
    }
    if(!$var_2){
        $var_2 = $v_config["collectid"];
    }
}
$var_2 = intval($var_2);
$var_89 = VV_DATA . "/config/{$var_2}.php";
if(is_file($var_89)){
    $caiji_config = require($var_89);
}else{
    header('HTTP/1.1 404 Not Found');
    exit('404 Not Found');
}
if($var_14 != 'yulan' && $caiji_config["web_close"] == 'on'){
    header('HTTP/1.1 404 Not Found');
    exit($caiji_config["web_closecon"]);
}
if($caiji_config["web_debug"] == 'on'){
    @ini_set('display_errors', 'On');
}else{
    error_reporting("0");
}
if(!$caiji_config["img_delay_name"]){
    $caiji_config["img_delay_name"] = 'data-src,_src,data-original,lazy_src,lazysrc,src_data';
}
if($caiji_config["auto_get_search"]){
    session_start();
    $caiji_config["search_url"] = $_SESSION["rules"]["search_url"];
    session_write_close();
}
if($caiji_config["cache_set"]){
    $var_117 = array('flinks_auto_insert', 'indexcache', 'othercache', 'csscache', 'cacheon', 'csscachetime', 'jscachetime', 'delcache', 'delcachetime', 'deloldcache', 'robotlogon', 'jscache', 'imgcache');
    foreach($var_117 as $var_5 => $var_6){
        $v_config[$var_6] = $caiji_config[$var_6];
    }
}
if ($var_14 == 'yulan'){
    $v_config["cacheon"] = false;
}
$var_118 = array('web_name', 'web_seo_name', 'web_keywords', 'web_description', 'web_tongji', 'web_404_url', 'web_debug', 'web_404_type', 'web_404_str');
foreach($var_118 as $var_5 => $var_6){
    $v_config[$var_6] = $caiji_config[$var_6];
}
if($_SERVER["REQUEST_SCHEME"] == ""){
    $_SERVER["REQUEST_SCHEME"] = 'http';
}
$_SERVER["QUERY_STRING"] = str_replace('collectid=' . $var_2, "", $_SERVER["QUERY_STRING"]);
$v_config["web_url"] = $_SERVER["REQUEST_SCHEME"] . '://' . $_SERVER["HTTP_HOST"] . '/';
if($v_config["web_urlencode"] && $_SERVER["QUERY_STRING"]){
    list($_SERVER["QUERY_STRING"],) = explode('&', $_SERVER["QUERY_STRING"]);
    $_SERVER["QUERY_STRING"] = preg_replace('~\.(jpg|css|js|' . $v_config["web_urlencode_suffix"] . ')$~i', "", $_SERVER["QUERY_STRING"]);
    $_SERVER["QUERY_STRING"] = decode_id($_SERVER["QUERY_STRING"]);
}
list($_SERVER["QUERY_STRING"],) = explode('#', $_SERVER["QUERY_STRING"]);
$_SERVER["QUERY_STRING"] = convert_query($_SERVER["QUERY_STRING"], $caiji_config["charset"]);
$var_119 = (SCRIPT == 'search' && $caiji_config["search_charset"])?$caiji_config["search_charset"]:$caiji_config["charset"];
$var_54 = array();
if (!empty($_POST)){
    foreach($_POST as $var_5 => $var_6){
        $var_5 = convert_query($var_5, $var_119);
        $var_54[$var_5] = convert_query($var_6, $var_119);
    }
}
$_POST = $var_54;
$var_54 = array();
foreach($_GET as $var_5 => $var_6){
    $var_5 = convert_query($var_5, $var_119);
    $var_54[$var_5] = convert_query($var_6, $var_119);
}
$_GET = $var_54;
$caiji_config["resdomain"] = $caiji_config["resdomain"]?$caiji_config["resdomain"]:$caiji_config["other_imgurl"];
$var_120 = false;
$var_7 = parse_url($caiji_config["from_url"]);
$var_121 = $var_7["host"];
$var_122 = $var_7["port"]?':' . $var_7["port"]:"";
if(isset($GLOBALS["geturl"])){
    $var_120 = true;
}else{
    if($_SERVER["PATH_INFO"]){
        $GLOBALS["geturl"] = $var_7["scheme"] . '://' . $var_7["host"] . $var_122 . $_SERVER["PHP_SELF"] . ($_SERVER["QUERY_STRING"]?'?' . $_SERVER["QUERY_STRING"]:"");
    }else if (empty($_SERVER["QUERY_STRING"])){
        $GLOBALS["geturl"] = $caiji_config["from_url"];
    }else{
        if (substr($_SERVER["QUERY_STRING"], "0", 1) == '/'){
            $_SERVER["QUERY_STRING"] = substr($_SERVER["QUERY_STRING"], 1);
        }
        $var_7 = parse_url($caiji_config["from_url"]);
        $GLOBALS["geturl"] = $var_7["scheme"] . '://' . $var_7["host"] . $var_122 . '/' . $_SERVER["QUERY_STRING"];
    }
}
define('ISOUTURL', $var_120);
if ($var_14 == 'yulan'){
    if(isset($_GET["url"])){
        $caiji_config["from_url"] = $_GET["url"];
    }
    $GLOBALS["geturl"] = $caiji_config["from_url"];
}
$var_7 = parse_url($GLOBALS["geturl"]);
if($caiji_config["my_domain_auto"]){
    $caiji_config["my_domain"] = dom();
}
if($caiji_config["from_domain_auto"]){
    $caiji_config["from_domain"] = dom($var_7["host"]);
}
if ($caiji_config["domain_fanmod"]){
    $caiji_config["domain_fan"] = "0";
}
$GLOBALS["is_fanurl"] = false;
if(!ISOUTURL) $GLOBALS["geturl"] = get_from_url($GLOBALS["geturl"]);
$var_7 = parse_url($GLOBALS["geturl"]);
$var_123 = $var_121 . '.' . $var_2 . '/' . $_SERVER["SERVER_PORT"];
$var_124 = isset($var_7["port"])?$var_7["port"]:"";
$var_125 = $var_7["scheme"] . '://' . $var_7["host"];
$var_126 = '"//' . $var_7["host"];
$var_127 = '\'//' . $var_7["host"];
if ($var_124){
    $var_125 = $var_125 . ':' . $var_124;
    $var_126 = $var_126 . ':' . $var_124;
    $var_127 = $var_127 . ':' . $var_124;
}
$var_128 = $var_7["host"];
include(VV_INC . '/delcache.php');
$v_110 = "";
$var_83 = $v_config["web_remark"]?'/' . $v_config["web_remark"] . '/':'/';
$var_129 = parse_url($v_config["web_url"]);
define('WEB_ROOT', substr($var_129["path"], "0", -1));
if (!$caiji_config["rewrite"] || !OoO0o0O0o()){
    $var_83 = '?';
    if (SCRIPT == 'search') $var_83 = WEB_ROOT . '/?';
}
if (empty($_SERVER["QUERY_STRING"])){
    $cacheid = md5($GLOBALS["geturl"]);
    $cachefile = VV_CACHE . '/index/' . $var_123 . '/' . getHashDir($cacheid, 2) . '/' . substr(md5($cacheid), "0", 16) . '.cache';
    $var_10 = $v_config["indexcache"];
}else{
    $cacheid = md5($GLOBALS["geturl"]);
    $cachefile = getcachefile($cacheid, $var_123);
    $var_10 = $v_config["othercache"];
}
if (SCRIPT == 'search'){
    if (!empty($_POST)){
        $var_130 = $caiji_config["search_url"];
    }else{
        unset($_GET["action"]);
        $var_131 = http_build_query($_GET);
        $var_132 = stripos($caiji_config["search_url"], '?') > -1?'&':'?';
        $var_130 = $caiji_config["search_url"] . $var_132 . $var_131;
    }
    if (substr($var_130, "0", 7) != 'http://' && substr($var_130, "0", 8) != 'https://'){
        $var_130 = $var_125 . '/' . ltrim($var_130, '/');
    }
    $cacheid = !empty($_POST)?md5($var_130 . http_build_query($_POST)):md5($var_130);
    $cachefile = getcachefile($cacheid, $var_123);
    $var_10 = $v_config["othercache"];
}
$var_133 = array('php', 'html', 'shtml', 'htm', 'jsp', 'xhtml', 'asp', 'aspx', 'txt' , 'action', 'xml', 'css', 'js', 'gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'swf');
foreach($var_133 as $var_6){
    $GLOBALS["geturl"] = str_replace('.' . $var_6 . '&', '.' . $var_6 . '?', $GLOBALS["geturl"]);
}
if(SCRIPT != 'search' && $_SERVER["QUERY_STRING"] && OoO0o0O0o() && $caiji_config["rewrite"] && (substr($_SERVER["REQUEST_URI"], "0", 2) == '/?' || (!$v_config["web_remark"] && substr($_SERVER["REQUEST_URI"], "0", 11) == '/index.php?') || preg_match('~^/' . $v_config["web_remark"] . '/\?~', $_SERVER["REQUEST_URI"]) || preg_match('~^/' . $v_config["web_remark"] . '/index.php\?~', $_SERVER["REQUEST_URI"]))){
    $GLOBALS["geturl"] = $var_125 . $var_122 . '/?' . $_SERVER["QUERY_STRING"];
}
if(stripos($GLOBALS["geturl"], '?') === false && stripos($GLOBALS["geturl"], '&') > -1){
    $GLOBALS["geturl"] = preg_replace('~\&~', '?', $GLOBALS["geturl"], 1);
}
$var_134 = "";
if($caiji_config["theme_open"]){
    $themedir = VV_TMPL . '/' . $caiji_config["theme_dir"];
    $var_135 = WEB_ROOT . '/';
    $var_136 = $var_135 . 'template/' . $caiji_config["theme_dir"];
    if(!is_dir($themedir)){
        exit('模板风格不存在：' . $caiji_config["theme_dir"]);
    }
    if(empty($_SERVER["QUERY_STRING"])){
        $var_134 = $themedir . '/index.html';
    }else{
        if($caiji_config["urlrules_other"]){
            $var_137 = explode("\n", $caiji_config["urlrules_other"]);
            foreach($var_137 as $var_5 => $var_6){
                $var_6 = trim($var_6);
                list($var_138, $var_139, $var_140) = explode('----', $var_6);
                if(is_themerule($GLOBALS["geturl"], $var_138)){
                    $var_134 = $themedir . '/' . $var_139;
                    if($var_140 == "0"){
                        $var_141 = file_get_contents(VV_DATA . '/flink.conf');
                        if($var_141) $var_141 = str_ireplace(array("\r\n", "\r", "\n"), '&nbsp;&nbsp;', $var_141);
                        $var_32 = $v_config;
                        $var_32["web_themepath"] = $var_136;
                        $var_32["web_root"] = $var_135;
                        $var_32["thisurl"] = thisurl();
                        $var_32["zdy"] = $var_49;
                        $var_32["flinks"] = $var_141;
                        if($var_142){
                            foreach($var_142 as $var_5 => $var_6){
                                $var_32["ad"][$var_5] = $var_6;
                            }
                        }
                        display($var_134, $var_32);
                        exit;
                    }
                }
            }
        }
        if(!$var_134 && $caiji_config["urlrules_list"]){
            if(is_themerule($GLOBALS["geturl"], $caiji_config["urlrules_list"] . "\n" . $caiji_config["urlrules_listpage"])){
                $var_134 = $themedir . '/list.html';
            }
        }
        if(!$var_134 && $caiji_config["urlrules_show"]){
            if(is_themerule($GLOBALS["geturl"], $caiji_config["urlrules_show"] . "\n" . $caiji_config["urlrules_showpage"])){
                $var_134 = $themedir . '/show.html';
            }
        }
    }
}
if(SCRIPT == 'search'){
    $var_7 = parse_url($var_130);
}else{
    $var_7 = parse_url($GLOBALS["geturl"]);
}
$GLOBALS["is_wwwroot"] = false;
if($var_14 == 'yulan'){
    $GLOBALS["is_wwwroot"] = true;
}
$var_143 = pathinfo($var_7["path"]);
$var_144 = $var_143["dirname"];
$var_145 = $var_143["basename"];
$var_146 = geturlpath($var_7);
if(stripos($_SERVER["HTTP_ACCEPT"], 'text/css') > -1){
    $GLOBALS["urlext"] = 'css';
}else if(SCRIPT == 'css'){
    $GLOBALS["urlext"] = 'css';
}else if(SCRIPT == 'js'){
    $GLOBALS["urlext"] = 'js';
}else{
    $GLOBALS["urlext"] = strtolower(pathinfo($var_7["path"], 4));
}
$var_147 = array('gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico');
if(SCRIPT == 'img' && !in_array($GLOBALS["urlext"], $var_147)){
    $GLOBALS["urlext"] = 'jpg';
}
if (strpos($_SERVER["QUERY_STRING"], '..') === false && @is_file(VV_ROOT . '/' . $_SERVER["QUERY_STRING"])){
    $var_148 = false;
    if(in_array($GLOBALS["urlext"], $var_147)){
        header("Content-type: image/{$GLOBALS["urlext"]}");
        $var_148 = true;
    }
    if ($GLOBALS["urlext"] == 'js'){
        header('Content-type: text/javascript');
        $var_148 = true;
    }
    if ($GLOBALS["urlext"] == 'css'){
        header('Content-type: text/css');
        $var_148 = true;
    }
    if($var_148){
        echo @file_get_contents(VV_ROOT . '/' . $_SERVER["QUERY_STRING"]);
        exit();
    }
}
if(isset($_SERVER["HTTP_REFERER"]) && ($GLOBALS["urlext"] == 'js' || $GLOBALS["urlext"] == 'css')){
    $var_149 = parse_url($_SERVER["HTTP_REFERER"]);
    if($var_149["path"] == '/search.php' && preg_match('~^https?://~i', "", $caiji_config["search_url"])){
        $GLOBALS["geturl"] = get_fullurl('/' . $_SERVER["QUERY_STRING"], $caiji_config["search_url"]);
    }
}
$var_133 = array('php', 'html', 'shtml', 'htm', 'jsp', 'xhtml', 'asp', 'aspx', 'txt' , 'action', 'xml', 'css', 'js', 'gif', 'jpg', 'jpeg', 'png', 'bmp', 'ico', 'swf');
foreach($var_133 as $var_6){
    $GLOBALS["geturl"] = str_replace('.' . $var_6 . '&', '.' . $var_6 . '?', $GLOBALS["geturl"]);
}
if($caiji_config["source_replace"]){
    $var_150 = explode("\n", $caiji_config["source_replace"]);
    foreach($var_150 as $var_5 => $var_6){
        $var_6 = trim($var_6);
        list($var_151, $var_152) = explode('----', $var_6);
        if($GLOBALS["geturl"] == $var_151){
            header("location: {$var_152}");
            exit();
        }
    }
}
define('VV_PLUS', true);
$GLOBALS["isplus"] = false;
plus_run('init');
plus_run('before_get');
if (in_array($GLOBALS["urlext"], $var_147)){
    if ($v_config["imgcache"] && OoO0o0O0o()){
        if($v_config["sifton"]){
            $var_4 = explode('[cutline]', $v_config["sifturl"]);
            foreach($var_4 as $var_5 => $var_6){
                if ($var_6 == $GLOBALS["geturl"]){
                    header('Content-type: image/png');
                    exit();
                }
            }
        }
        $var_10 = $v_config["imgcachetime"];
        $var_133 = array_merge($var_133, $var_147);
        if(@$_GET["debug"] != true){
            header("Content-type: image/{$GLOBALS["urlext"]}");
        }else{
            $GLOBALS["geturl"] = str_replace('?debug=true', "", $GLOBALS["geturl"]);
        }
        $var_11 = true;
        if($caiji_config["collect_close"]){
            if(is_file($cachefile)){
                $var_11 = false;
            }else{
                exit('not file');
            }
        }
        $cachefile = VV_CACHE . '/img/' . getHashDir($cacheid, 2) . '/' . substr(md5($cacheid), "0", 16) . '.jpg';
        if ($var_11 && (!$var_10 || !is_file($cachefile) || (@filemtime($cachefile) + ($var_10 * 3600)) <= time())){
            run_time(true);
            $v_110 = $caiji -> geturl($GLOBALS["geturl"]);
            if($v_110){
                if($v_config["web_404_str"] && strpos($v_110, $v_config["web_404_str"]) > -1){
                    display_404();
                }
            }
            $GLOBALS["debug"][] = '使用缓存：否';
            $GLOBALS["debug"][] = '采集用时：' . run_time() . 's';
            if($var_10){
                if (!empty($v_110)){
                    write($cachefile, $v_110);
                }else if(is_file($cachefile)){
                    $v_110 = file_get_contents($cachefile);
                    write($cachefile, $v_110);
                }
            }
        }else if(is_file($cachefile)){
            $GLOBALS["debug"][] = '使用缓存：是';
            $GLOBALS["debug"][] = '缓存路径：' . $cachefile;
            $v_110 = file_get_contents($cachefile);
        }
        echo $v_110;
        if($caiji_config["web_debug"] == 'on'){
            echo "\r\n" . '/*---调试信息 start---' . "\r\n" . implode("\r\n", $GLOBALS["debug"]) . "\r\n" . '---调试信息 end---*/' . "\r\n";
        }
        exit();
    }else{
        header('Content-Type: image/jpeg; charset=UTF-8');
        header("Location: {$GLOBALS["geturl"]}");
        exit;
    }
}
if ($GLOBALS["urlext"] == 'css'){
    header('Content-type: text/css');
    $var_10 = $v_config["csscachetime"];
    list($cacheid,) = explode('?', $GLOBALS["geturl"]);
    $cachefile = getcsscachefile($cacheid, $var_123);
    $v_config["cacheon"] = $v_config["csscache"];
}
if (SCRIPT == 'js' || $GLOBALS["urlext"] == 'js'){
    header('Content-type: text/javascript');
    $var_10 = $v_config["jscachetime"];
    list($cacheid,) = explode('?', $GLOBALS["geturl"]);
    $cachefile = getjscachefile($cacheid, $var_123);
    if(!$v_config["jscache"]){
        header("Location: {$GLOBALS["geturl"]}");
        exit;
    }
    $v_config["cacheon"] = $v_config["jscache"];
}
if ($GLOBALS["urlext"] == 'swf'){
    header('Content-type: application/x-shockwave-flash');
    header("Location: {$GLOBALS["geturl"]}");
    exit;
}
if ($GLOBALS["urlext"] == 'xml'){
    header('Content-type: text/xml');
}
if ($GLOBALS["urlext"] <> "" && !in_array($GLOBALS["urlext"], $var_133)){
}
include(VV_DATA . '/rules_get.php');
if(1 == 2 and $GLOBALS["html"] == "" || $GLOBALS["title"] == ""){
    $caiji_config = include($var_89);
    $var_153 = file(VV_ROOT . '/百度搜索数据-2017-02-27.txt');
    shuffle($var_153);
    list($var_154,) = explode('|', trim($var_153[1]));
    $caiji_config["from_url"] = $var_154;
    arr2file($var_89, $caiji_config);
    write(VV_ROOT . '/geturl.txt', $GLOBALS["geturl"] . "\r\n", 'a+');
    write(VV_ROOT . '/geturl2.txt', "http://temp2.cm/index.php?collectid={$var_2}\r\n", 'a+');
}
if ($var_14 == 'yulan'){
    $GLOBALS["html"] = _htmlspecialchars($GLOBALS["html"]);
    $GLOBALS["html"] = "	<script type=\"text/javascript\" src=\"../public/js/syntaxhighlighter/scripts/shCore.js\"></script>
	<script type=\"text/javascript\" src=\"../public/js/syntaxhighlighter/scripts/shBrushXml.js\"></script>
	<link type=\"text/css\" rel=\"stylesheet\" href=\"../public/js/syntaxhighlighter/styles/shCore.css\"/>
	<link type=\"text/css\" rel=\"stylesheet\" href=\"../public/js/syntaxhighlighter/styles/shThemeEditplus.css\"/>
	<script type=\"text/javascript\">
		SyntaxHighlighter.config.clipboardSwf = '../public/js/syntaxhighlighter/scripts/clipboard.swf';
		SyntaxHighlighter.config.tagName = 'textarea';
		SyntaxHighlighter.all();
	</script>
	<table width=\"99%\" border=\"0\" cellpadding=\"4\" cellspacing=\"1\" class=\"tableoutline\">
	<tbody>
		<tr nowrap class=\"tb_head\">
			<td><h2>源代码查看</h2></td>
		</tr>
	</tbody>
	<tr nowrap class=\"firstalt\">
		<td><b>以下为采集规则 [{$caiji_config["web_name"]}] 的源代码，你可以根据这个编写过滤规则:</b></td>
	</tr>
	<tr nowrap class=\"firstalt\">
		<form method=\"get\" action=\"caiji_config.php\">
		<input type=\"hidden\" name=\"ac\" value=\"{$var_14}\" />
		<input type=\"hidden\" name=\"collectid\" value=\"{$var_2}\" />
		<td><input type=\"text\" name=\"url\" size=\"80\" value=\"{$GLOBALS["geturl"]}\" onFocus=\"this.style.borderColor='#00CC00'\" onBlur=\"this.style.borderColor='#999999'\" > <input type=\"submit\" value=\"查看源代码\" /></td>
		</form>
	</tr>
	<tr nowrap class=\"firstalt\">
		<td><textarea style=\"height:500px\" class=\"brush: html;auto-links:false;\">{$GLOBALS["html"]}</textarea></td>
	</tr>
</table>
</body>
</html>";
    $GLOBALS["html"] = ADMIN_HEAD . $GLOBALS["html"];
    exit($GLOBALS["html"]);
}
if($GLOBALS["urlext"] == 'css' || $GLOBALS["urlext"] == 'js'){
    if(substr($GLOBALS["html"], "0", 1) == '?'){
        $GLOBALS["html"] = substr($GLOBALS["html"], 1);
    }
    if($caiji_config["web_debug"] == 'on'){
        echo '/*---调试信息 start---' . "\r\n" . implode("\r\n", $GLOBALS["debug"]) . "\r\n" . '---调试信息 end---*/' . "\r\n";
    }
    echo $GLOBALS["html"];
}else if(in_array($GLOBALS["urlext"], $var_133) || stripos($GLOBALS["html"], '<head>') > -1 || stripos($GLOBALS["html"], '<html>') > -1 || stripos($GLOBALS["html"], '<body>') > -1){
    $html = $GLOBALS["html"];
    if(substr($GLOBALS["html"], "0", 1) == '?'){
        $html = substr($GLOBALS["html"], 1);
    }
    if($caiji_config["theme_open"]){
        if(!isset($GLOBALS["all_links"])){
            run_time(true);
            $var_155 = getlinksdata($GLOBALS["geturl"]);
            if($var_155){
                $GLOBALS = array_merge($GLOBALS, $var_155);
            }else{
                $GLOBALS["all_links"] = get_all_link($GLOBALS["html"]);
                savelinksdata($GLOBALS["geturl"]);
            }
            $GLOBALS["debug"][] = '解析链接用时：' . run_time() . 's';
        }
        run_time(true);
        $var_156 = $GLOBALS["all_links_text"];
        $var_157 = $GLOBALS["all_links_pic"];
        $var_158 = $var_159 = array();
        if($caiji_config["urlrules_list"]){
            foreach($var_156 as $var_5 => $var_6){
                if(is_themerule($var_6["fromurl"], $caiji_config["urlrules_list"])){
                    $var_158[] = $var_6;
                    unset($var_156[$var_5]);
                }
            }
            foreach($var_157 as $var_5 => $var_6){
                if(is_themerule($var_6["fromurl"], $caiji_config["urlrules_list"])){
                    $var_159[] = $var_6;
                    unset($var_157[$var_5]);
                }
            }
        }
        $var_160 = $var_161 = array();
        if($caiji_config["urlrules_show"]){
            foreach($var_156 as $var_5 => $var_6){
                if(is_themerule($var_6["fromurl"], $caiji_config["urlrules_show"]) && strlen($var_6["title"]) > 6){
                    $var_160[] = $var_6;
                    unset($var_156[$var_5]);
                }
            }
            foreach($var_157 as $var_5 => $var_6){
                if(is_themerule($var_6["fromurl"], $caiji_config["urlrules_show"])){
                    $var_161[] = $var_6;
                    unset($var_157[$var_5]);
                }
            }
        }
        $var_162 = array();
        if($caiji_config["urlrules_listpage"]){
            $var_163 = array();
            foreach($var_156 as $var_5 => $var_6){
                if(is_themerule($var_6["fromurl"], $caiji_config["urlrules_listpage"])){
                    preg_match_all('~(\d+)~', $var_6["url"], $var_164);
                    $var_6["pagekey"] = $var_163[] = array_pop($var_164[1]);
                    $var_162[] = $var_6;
                    unset($var_156[$var_5]);
                }
            }
            array_multisort($var_163, 4, $var_162);
        }
        $var_165 = array();
        if($caiji_config["urlrules_showpage"]){
            $var_163 = array();
            foreach($var_156 as $var_5 => $var_6){
                if(is_themerule($var_6["fromurl"], $caiji_config["urlrules_showpage"])){
                    preg_match_all('~(\d+)~', $var_6["url"], $var_164);
                    $var_6["pagekey"] = $var_163[] = array_pop($var_164[1]);
                    $var_165[] = $var_6;
                    unset($var_156[$var_5]);
                }
            }
            array_multisort($var_163, 4, $var_165);
        }
        $GLOBALS["list_links_text"] = $var_158;
        $GLOBALS["list_links_pic"] = $var_159;
        $GLOBALS["show_links_text"] = $var_160;
        $GLOBALS["show_links_pic"] = $var_161;
        $GLOBALS["list_pages"] = $var_162;
        $GLOBALS["show_pages"] = $var_165;
        if($caiji_config["theme_showotherurl"]){
            $var_166 = $var_157;
            $var_167 = $var_156;
            $GLOBALS["other_links_text"] = $var_167;
            $GLOBALS["other_links_pic"] = $var_166;
        }
        if($caiji_config["urlrules_show"]){
            if(is_themerule($GLOBALS["geturl"], $caiji_config["urlrules_show"] . "\n" . $caiji_config["urlrules_showpage"])){
                $var_36 = "";
                if($caiji_config["rules_body"]){
                    $var_137 = explode("\n", $caiji_config["rules_body"]);
                    $caiji_config["siftags"] = array('iframe', object, 'script', 'form', 'input', 'textarea', 'botton', 'select', 'div',);
                    foreach($var_137 as $var_5 => $var_6){
                        $var_6 = trim($var_6);
                        $var_36 .= replace_sifttags(regxcut($var_6, $GLOBALS["html"]));
                    }
                }
            }
        }
        $GLOBALS["debug"][] = '超级模板处理用时：' . run_time() . 's';
        debug_flush();
        if($var_134 && is_file($var_134)){
            $var_32 = $v_config;
            $var_32["title"] = $var_168;
            $var_32["web_themepath"] = $var_136;
            $var_32["web_root"] = $var_135;
            $var_32["thisurl"] = $var_169;
            $var_32["body"] = $var_36;
            $var_32["zdy"] = $var_49;
            $var_32["flinks"] = $var_141;
            if($var_142){
                foreach($var_142 as $var_5 => $var_6){
                    $var_32["ad"][$var_5] = $var_6;
                }
            }
            display($var_134, $var_32);
            exit;
        }
    }
    $var_134 = VV_TMPL . '/index.html';
    if($caiji_config["tplfile"]){
        $caiji_config["tplfile"] = str_replace('..', "", $caiji_config["tplfile"]);
        $var_170 = VV_TMPL . '/' . $caiji_config["tplfile"];
        if(is_file($var_170)){
            $var_134 = $var_170;
        }
    }
    $html = $GLOBALS["html"];
    if(substr($html, "0", 1) == '?'){
        $html = substr($html, 1);
    }
    debug_flush();
    include($var_134);
}else{
    echo $GLOBALS["html"];
}
if(!abcdefg()){
    exit('error');
}
?>