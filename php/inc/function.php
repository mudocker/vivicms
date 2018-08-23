<?php
require_once('encry_fuc.php');
if(!function_exists('getallheaders')){
    function getallheaders(){
        foreach($_SERVER as $name => $value) substr($name, 0, 5) == 'HTTP_' and $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
        return $headers;
    }
}

function plus_run($func = ''){
    global $caiji_config;
    if(!isset($GLOBALS['plusclass'])){
        $plusArr = explode(',', $caiji_config['plus']);
        foreach($plusArr as $k => $vo){
            $plusfile = VV_DATA . '/plus/' . $vo . '/' . $vo . '.class.php';
            if(is_file($plusfile)){
                require($plusfile);
                $GLOBALS['plusclass'][$vo] = new $vo;
                $GLOBALS['isplus'] = true;
            }
        }
    }
    !$GLOBALS['isplus'] and $GLOBALS['plusclass'] = [];

    if($func == '' || empty($GLOBALS['plusclass'])) return '';

    foreach($GLOBALS['plusclass']as $k => $vo) method_exists($vo, $func) and  $vo -> $func();


}
function get_ads_body($mark){
    global $config_ads;
    foreach($config_ads as $k => $vo){
        if($vo['mark'] == $mark) return $vo['body'];

    }
}

function geturlpath($parse_url){
     $urlpath = $parse_url['path'];
     $urlpathext = pathinfo($parse_url['path'], PATHINFO_EXTENSION);
     if(empty($urlpathext)){
         if(substr($urlpath, -1) != '/')$urlpath .= '/';
         }else{
         $urlpathinfo = pathinfo($parse_url['path']);
         $urldirname = $urlpathinfo['dirname'];
         $urlbasename = $urlpathinfo['basename'];
         $urlpath = str_replace($urlbasename, '', $parse_url['path']);
         if($urldirname != '\\')$urlpath = $urldirname . '/';
         }
     if(substr($urlpath, 0, 1) == '/'){
         $urlpath = substr($urlpath, 1);
         }
     return $urlpath;
    }
function run_time($isMicrotime = false){
     static $time = 0;
     if($isMicrotime)       $time = microtime(true);
         else             return sprintf('%.5f', microtime(true) - $time);
}
function arr2file($file, $param2){
     if(is_array($param2)) $var_export = var_export($param2, true);
         else                   $var_export = $param2;
     return write($file, "<?php\r\n" . 'return ' . $var_export . ';' . "\r\n?>");
}
function banip(){
     $banip_conf = VV_DATA . "/banip.conf";
     $file_content_banip = @file_get_contents($banip_conf);
     if($file_content_banip){
         $banip_rep = str_replace(array("\r\n", "\r", "\n"), '|||', $file_content_banip);
         $REMOTE_ADDR = $_SERVER['REMOTE_ADDR'];
         $banip_rep = explode('|||', $banip_rep);
         foreach($banip_rep as $IIIIIIIIIll1){
             $IIIIIIIIIl1I = str_replace(array('*', '.'), array('\\d+', '\.'), $IIIIIIIIIl1I);
             if(preg_match('/^' . $IIIIIIIIIll1 . '$/', $REMOTE_ADDR)) die('Your IP banned access!');

             }
         }
}
function removedir($dir){
     if(!is_dir($dir)) return false;

     $opendir = @opendir($dir);
     while(($readir = @readdir($opendir)) !== false){
         if($readir != '.' && $readir != '..'){
             $dir_readdir = $dir . '/' . $readir;
             is_dir($dir_readdir)?removeDir($dir_readdir):@unlink($dir_readdir);
             }
         }
     closedir($opendir);
     return rmdir($dir);
    }
function getcachefile($cacheid){
     return VV_CACHE . "/html/" . getHashDir($cacheid, 2) . '/' . substr(md5($cacheid), 0, 16) . '.html';
    }
function getimgcachefile($images_name, $ext = 'jpg'){
     return VV_CACHE . "/img/" . substr(md5($images_name), 0, 16) . '.' . $ext;
}
function getcsscachefile($cacheid){
     return VV_CACHE . "/css/" . substr(md5($cacheid), 0, 16) . '.css';
}
function getjscachefile($cacheid){
     return VV_CACHE . "/js/" . substr(md5($cacheid), 0, 16) . '.js';
    }
function getHashDir($param1, $param2 = 2){
         $lresult = [];
         $param1 = str_split(md5($param1), 2);
         for($ii = 0;$ii < $param2;$ii++) $lresult[] = $param1[$ii];
         $result = str_replace('\\', '/', implode(DIRECTORY_SEPARATOR, $lresult));
         return $result;
    }
isset($_SERVER['HTTP_X_ORIGINAL_URL']) and   $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
isset($_SERVER['HTTP_X_REWRITE_URL']) and  $_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];

function ShowMsg($IIIIIIIIllll, $IIIIIIIIlll1, $IIIIIIIIll1I = 0){
    $IIIIIIIIll1l = "<html>\r\n<head>\r\n<title>提示信息</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=gb2312\" />\r\n";
    $IIIIIIIIll1l .= "<base target='_self'/>\r\n<style>div{line-height:160%;}</style></head>\r\n<body leftmargin='0' topmargin='0' bgcolor='#FFFFFF'>\r\n<center>\r\n<script>\r\n";
    $IIIIIIIIll11 = "</script>\r\n</center>\r\n</body>\r\n</html>\r\n";
    $IIIIIIIIl1II = ($IIIIIIIIll1I == 0?1000:$IIIIIIIIll1I);
    $IIIIIIIIl1Il = '';
    if($IIIIIIIIlll1 == '-1'){
        if($IIIIIIIIll1I == 0)$IIIIIIIIl1II = 5000;
        $IIIIIIIIlll1 = "javascript:history.go(-1);";
    }
    $IIIIIIIIl1Il .= "var pgo=0;function JumpUrl(){if(pgo==0){ location='$IIIIIIIIlll1'; pgo=1; }}\r\n";
    $IIIIIIIIl1I1 = $IIIIIIIIl1Il;
    $IIIIIIIIl1I1 .= "document.write(\"<br /><div style='width:450px;padding:0px;border:1px solid #c7ea6a;'>";
    $IIIIIIIIl1I1 .= "<div style='padding:6px;font-size:12px;border-bottom:1px solid #c7ea6a;background:#f5fde6 ';'><b>vivi提示信息！</b></div>\");\r\n";
    $IIIIIIIIl1I1 .= "document.write(\"<div style='min-height:130px;font-size:10pt;background:#ffffff'><br />\");\r\n";
    $IIIIIIIIl1I1 .= "document.write(\"" . str_replace("\"", "“", $IIIIIIIIllll) . "\");\r\n";
    $IIIIIIIIl1I1 .= "document.write(\"";
    $IIIIIIIIl1I1 .= "<br /><a href='{$IIIIIIIIlll1}'>如果你的浏览器没反应，请点击这里...</a>";
    $IIIIIIIIl1I1 .= "<br/></div>\");\r\n";
    $IIIIIIIIl1I1 .= "setTimeout('JumpUrl()',$IIIIIIIIl1II);";
    $IIIIIIIIllll = $IIIIIIIIll1l . $IIIIIIIIl1I1 . $IIIIIIIIll11;
    echo $IIIIIIIIllll;
    exit;
    }
function match_host(){
     $host = $_SERVER['HTTP_HOST'];
     $host_arr = parse_url($host);
     $host = isset($host_arr['host'])?$host_arr['host']:$host_arr['path'];
     $host = strtolower($host);
     if(strpos($host, '/') !== false){
         $host_arr = @parse_url($host);
         $host = $host_arr['host'];
    }
     $domain_suffix = $GLOBALS['domain_suffix'];
     $array_suffix_explode = '';
     foreach($domain_suffix as $domain_suffix_one) $array_suffix_explode .= ($array_suffix_explode?'|':'') . $domain_suffix_one;

     $domain_suffix_reg = "[^\.]+\.(?:(" . $array_suffix_explode . ")|\w{2}|((" . $array_suffix_explode . ")\.\w{2}))$";
     if(preg_match("/" . $domain_suffix_reg . "/ies", $host, $match_result))                                           $result = $match_result['0'];
         else                                                                                                           $result = $host;
     return $result;
    }
function sha1_vxiaotou_com_php(){
     return substr(sha1(match_host() . 'vxiaotou.com'), 10, 16) . '.php';
    }

function update(){
    global $vipcode;
    $qq = checktime_log_out_1h(0, 1)?'&qq=' . checktime_log_out_1h(0, 1):'';
    $data = downfile('http://www.vxiaotou.com/update.php?m=check&a=update&type=wanneng&vs=' . VV_VERSION . $qq . '&code=' . urlencode($vipcode) . '&_t=' . time());
    if($data == '')ShowMsg("无法连接服务器", "-1", 30000);
    list($status, $title, $msg) = explode('|', $data);
    if($status == '')ShowMsg("连接服务器错误", "-1", 30000);
    if($status == "0"){
        ShowMsg($title . '<br>', "admin_index.php", 5000);
        exit;
    }else{
        ShowMsg($title . "<br><div style='text-align:left;margin:10px 0;padding:10px;max-height:100px;overflow:auto;color:#555;max-width: 450px;'>" . $msg . "</div><a href='?t=updatenow'><br><font color=red>>>>点击这里在线升级<<<</font></a><br>", "admin_index.php", 1200000);
    }
}
function updatenow(){
    global $vipcode;
    !test_write(VV_ROOT)                                                                                                 and  ShowMsg("根目录需给读写权限！", "-1", 3000);

    $data = downfile('http://www.vxiaotou.com/update.php?m=download&type=wanneng&vs=' . VV_VERSION . '&code=' . urlencode($vipcode) . '&_t=' . time());
    empty($data)                                                                                                          and ShowMsg("下载升级文件失败！", "-1", 3000);

    $file = VV_DATA . '/vvupdate.dat';
    !write($file, $data)                                                                                                     and  ShowMsg("升级失败，无法写入文件", "-1", 300000);

    $admindir = @basename(@getcwd());
    require_once(VV_INC . '/pclzip.class.php');
    $archive = new PclZip($file);
    if($archive -> extract(PCLZIP_OPT_PATH, VV_ROOT, PCLZIP_OPT_REPLACE_NEWER) == 0) ShowMsg("解压失败，Error : " . $archive -> errorInfo(true), "-1", 300000);
    else{
        if($admindir && $admindir != '@admin'){
            if(is_dir(VV_ROOT . '/@admin')){
                copydirs(VV_ROOT . '/@admin', getcwd());
                @removedir(VV_ROOT . '/@admin');
            }
        }
        @unlink($file);
        ShowMsg('恭喜您,升级成功!', "admin_index.php", 0, 5000);
    }
}

function copydirs($src, $dst){
     $dir = opendir($src);
     !is_dir($dst)                                                                                                       and @mkdir($dst);
     while(false !== ($file = readdir($dir))){
         if(($file != '.') && ($file != '..')){
             if(is_dir($src . '/' . $file))                                                                             copydirs($src . '/' . $file, $dst . '/' . $file);
                 else                                                                                                   @copy($src . '/' . $file, $dst . '/' . $file);

             }
         }
     closedir($dir);
    }
function mkdirs($dir, $mode = 0777){
     if(is_dir($dir))return true;
     mkdir($dir, $mode, true);
}
function write($filename, $data, $mode = "w"){
     mkdirs(dirname($filename));
     if(is_file($filename) && !is_writable($filename)) return false;

     if($mode == 'w') return file_put_contents($filename, $data);

     $fopen = fopen($filename, $mode);
     flock($fopen, LOCK_EX);
     $result = fwrite($fopen, $data);
     fclose($fopen);
     return $result;
    }
function downfile($url){
     set_time_limit(0);
     $data = '';
     $brower = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.2)';
     if(function_exists('curl_init') && function_exists('curl_exec')){
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $url);
         curl_setopt($ch, CURLOPT_TIMEOUT, 300);
         @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_USERAGENT, $brower);
         curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_REFERER']);
         $data = curl_exec($ch);
         curl_close($ch);
         }else if(ini_get('allow_url_fopen')){
         $opt = ['http' => ['method' => 'GET', 'header' => "referer: " . $_SERVER['HTTP_REFERER'], 'timeout' => 300]];
         $context = stream_context_create($opt)or die('服务器不支持 stream_context_create');
         for($i = 0;$i < 3;$i++){
             $data = @file_get_contents($url, false, $context);
             if($data)break;
           }
     }
     return $data;
    }
function recursive_mkdir($dir, $mode = 0777){
     $dirArr = explode('/', $dir);
     $dirCout = count($dirArr);
     $dir = '.';
     for($ii = 0;$ii < $dirCout;++$ii){
         $dir .= '/' . $dirArr[$ii];
         if(!is_dir($dir) && !mkdir($dir, $mode)) return false;
     }
    return true;
}
function getip(){
     if(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))                        $ip = getenv("HTTP_CLIENT_IP");
         else if(getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")) $ip = getenv("HTTP_X_FORWARDED_FOR");
         else if(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")) $ip = getenv("REMOTE_ADDR");
         else if(isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")) $ip = $_SERVER['REMOTE_ADDR'];
        else $ip = "unknown";

     return($ip);
    }
function get_magic($html){
     get_magic_quotes_gpc() and  $html = stripslashes($html);

     return $html;
}
function getDirSize($dir){
    if($opendir = opendir($dir)){
        while(($readir = readdir($opendir)) !== false){
            if($readir != "." && $readir != ".."){
               !isset($result) and $result = 0;
                if(is_dir("$dir/$readir")) $result += getDirSize("$dir/$readir");
                else                       $result += filesize("$dir/$readir");

            }
        }
    }
    closedir($opendir);
    return $result;
}
function getRealSize($param){
    $dw = 1024 * 1024;
    return round($param / $dw, 2);
}
function scandirs($param){
    $readdir = array();
    if(!function_exists('scandir')){
        $opendir = @opendir($param);
        while(($readdir[] = @readdir($opendir)) !== false){}
        @closedir($opendir);
        $readdir = array_filter($readdir);
    }else $readdir = @scandir($param);

    return $readdir;
}
function realurlcode($url){
    return urldecode(str_replace("\xC8\x66", "\x25", $url));
}
function replaceurl($url, $sw){
    $unserialize = unserialize(base64_decode(strrev(VV_ENCODEKEYS)));
    $unserialize = array_map('realurlcode', $unserialize);
    $result_0 = [];
    $count_unserial = count($unserialize);
    switch($sw){
        case 0:$result_1 = urlencode($url);
            $explode = explode("\x25", $result_1);
            $count = count($explode);
            $intval = intval($count / 2);
            foreach($explode as $key => $item){
                if($key != ($count-1)){
                    if($key == $intval){
                        $result_0[] = $item . $unserialize[0];
                        continue;
                    }
                    $result_0[] = $item . $unserialize[rand(1, ($count_unserial-1))];
                }else $result_0[] = $item;

            }
            return implode('', $result_0);
            break;
        case 1:$result_1 = str_replace($unserialize, "\x25", $url);
            $result_1 = urldecode($result_1);
            return $result_1;
            break;
    }
}

function P($data, $die = false){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    $die and die();
}


function debug_time(){
     list($t1, $t2) = explode(' ', microtime());
     return $t2 + $t1;
    }

function getallimg($html){
     global $geturl, $caiji_config, $scheme;
     $regx = "~(<img\s+[^>]+>)~iUs";
     preg_match_all($regx, $html, $match);
     $imgArr = array();
     if($match){
         foreach($match[1]as $k => $vo){
             if(preg_match('~src\s*=\s*(["|\']?)\s*([^"\'\s>\\\\]+)\s*\\1~i', $vo, $imgmatch)){
                 $imgArr[] = $imgmatch[2];
                 }
             }
         $imgArr = array_unique($imgArr);
         }
     if($caiji_config['img_delay_name']){
         $img_delay_Arr = explode(',', $caiji_config['img_delay_name']);
         $regx = "~(<img\s+[^>]+>)~iUs";
         preg_match_all($regx, $html, $match);
         if($match){
             foreach($img_delay_Arr as $k => $img_delay){
                 $arr = array();
                 foreach($match[1]as $kk => $vv){
                     if(preg_match('~' . $img_delay . '\s*=\s*(["|\']?)\s*([^"\'\s>]+)\s*\\1~i', $vv, $imgmatch)){
                         $arr[] = $imgmatch[2];
                         }
                     }
                 if(!$arr){
                     continue;
                     }
                 if($imgArr){
                     $imgArr = array_merge($imgArr, $arr);
                     }else{
                     $imgArr = $arr;
                     }
                 }
             }
         }
     if($imgArr && ISOUTURL){
         foreach($imgArr as $k => $vo){
             $imgArr[$k] = get_fullurl($vo, $geturl);
             }
         }
     sort($imgArr);
     return $imgArr;
    }
function getalljs($html){
     $regx = "~(<script\s+[^>]+>)~iUs";
     preg_match_all($regx, $html, $match);
     $jsArr = array();
     if($match){
         foreach($match[1]as $k => $vo){
             if(preg_match('~src\s*=\s*(["|\']?)\s*([^"\'\s>\\\\]+)\s*\\1~i', $vo, $jsmatch)){
                 $jsArr[] = $jsmatch[2];
                 }
             }
         $jsArr = array_unique($jsArr);
         }
     sort($jsArr);
     return $jsArr;
    }
function getallcss($html){
     $regx = "~(<link[^>]+>)~iUs";
     preg_match_all($regx, $html, $match);
     $cssHrefArr = array();
     if($match){
         foreach($match[1]as $k => $vo){
             if(!preg_match('~rel\s*=\s*(["|\']?)\s*stylesheet\s*\\1~i', $vo)){
                 unset($match[1][$k]);
                 continue;
                 }
             if(preg_match('~href\s*=\s*(["|\']?)\s*([^"\'\s>\\\\]+)\s*\\1~i', $vo, $hrefmatch)){
                 $cssHrefArr[] = $hrefmatch[2];
                 }
             }
         $cssHrefArr = array_unique($cssHrefArr);
         }
     sort($cssHrefArr);
     return $cssHrefArr;
    }
function getalllink($html){
     $regx = "~(<a\s+[^>]+>.*</a>)~iUs";
     preg_match_all($regx, $html, $match);
     $linkArr = array();
     if($match){
         foreach($match[1]as $k => $vo){
             if(preg_match('~href\s*=\s*(["|\']?)\s*([^"\'\s>\\\\]+)\\1[^>]*>(.*)</a>~iUs', $vo, $linkmatch)){
                 $linkArr[] = array('url' => $linkmatch[2], 'title' => $linkmatch[3]);
                 }
             }
         }
     return $linkArr;
    }
function getallhref($html){
     $regx = "~(<a\s+[^>]+>)~iUs";
     preg_match_all($regx, $html, $match);
     $linkArr = [];
     if($match){
         foreach($match[1]as $k => $vo) if(preg_match('~href\s*=\s*(["|\']?)\s*([^"\'\s>\\\\]+)\s*\\1~i', $vo, $linkmatch)) $linkArr[] = $linkmatch[2];
         $linkArr = array_unique($linkArr);
         }
     sort($linkArr);
     return $linkArr;
    }
function get_fullurl($srcurl, $baseurl = ''){
     !$baseurl && $baseurl = $GLOBALS['collect_baseurl'];
     if(!$baseurl)return $srcurl;
     $baseinfo = parse_url($baseurl);
     if(substr($srcurl, 0, 1) == '?') $srcurl = $baseinfo['path'] . $srcurl;

     $srcinfo = parse_url($srcurl);
     if(isset($srcinfo['scheme'])) return $srcurl;

     if(stripos($baseinfo['path'], '.') === false && stripos($baseinfo['path'], '?') === false)$baseinfo['path'] .= '/1';
     $url = $baseinfo['scheme'] . '://' . $baseinfo['host'];
     if(substr($srcinfo['path'], 0, 1) == '/') $path = $srcinfo['path'];
         else $path = dirname($baseinfo['path']) . '/' . $srcinfo['path'];
     $rst = [];
     $path_array = explode('/', $path);
     if(!$path_array[0]) $rst[] = '';

     foreach($path_array AS $key => $dir){
         if($dir == '..'){
                 if(end($rst) == '..')                                                                                          $rst[] = '..';
                 elseif(!array_pop($rst))                                                                                   $rst[] = '..';
         }
         elseif($dir && $dir != '.')                                                                                   $rst[] = $dir;
         }
     !end($path_array) and  $rst[] = '';

     $url .= implode('/', $rst);
     $url = str_replace('\\', '/', $url);
     $url = preg_replace('~([\w]+)/{2,}~', '\\1/', $url);
     if(isset($srcinfo['query']))$url .= '?' . $srcinfo['query'];
     return $url;
    }
function convert_query($str, $charset){
     preg_match('~%\w{2}~', $str)                                                                                           and  $str = urldecode($str);

     if(is_utf8($str) && $charset != 'utf-8'){
         if(PATH_SEPARATOR == ':')                                                                                      $str = mb_convert_encoding($str, "gbk", "utf-8");
             else                                                                                                           $str = iconv('utf-8', 'gbk//IGNORE', $str);

         }else if(!is_utf8($str) && $charset == 'utf-8'){
         if(PATH_SEPARATOR == ':')                                                                                   $str = mb_convert_encoding($str, "utf-8", "gbk");
         else                                                                                                           $str = iconv('gbk', 'utf-8//IGNORE', $str);

         }else if(is_utf8($str) && $charset == 'utf-8' && !preg_match('~%\w{2}~', $str)){
             $str = rawurlencode($str);
             $str = str_ireplace('%2F', '/', $str);
         }
     return $str;
    }
function is_utf8_old($str){
     $len = strlen($str);
     for($i = 0;$i < $len;$i++){
         $c = ord($str[$i]);
         if($c > 128){
             if(($c > 247))return false;
             elseif($c > 239)$bytes = 4;
             elseif($c > 223)$bytes = 3;
             elseif($c > 191)$bytes = 2;
             else return false;
             if(($i + $bytes) > $len)return false;
             while($bytes > 1){
                 $i++;
                 $b = ord($str[$i]);
                 if($b < 128 || $b > 191)return false;
                 $bytes--;
                 }
             }
         }
     return true;
    }
function is_utf8($word){
     if(trim($word) == '')return false;
     if(@preg_match("/^([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){1}/", $word) == true || @preg_match("/([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){1}$/", $word) == true || @preg_match("/([" . chr(228) . "-" . chr(233) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}[" . chr(128) . "-" . chr(191) . "]{1}){2,}/", $word) == true){
         if(is_utf8_old($word))return true;
         }
     return false;
    }
function _htmlspecialchars($str){
     static $fh = array('&' => '&amp;', '<' => '&lt;', '>' => '&gt;', '\'' => '&#39;', '"' => '&quot;');
     return strtr($str, $fh);
    }
function is_resdomain($url){
     global $caiji_config;
     if(preg_match('~^data:image/~', $url)){
         return false;
         }
     if(!$caiji_config['resdomain'])return false;
     $resdomain = explode(',', $caiji_config['resdomain']);
     $parse_url = parse_url($url);
     foreach($resdomain as $k => $vo){
         $vo = trim($vo);
         if($vo == '')continue;
         $vo = str_replace('.', '\.', $vo);
         $vo = str_replace('*', '([\w-]+)', $vo);
         if(preg_match('~' . $vo . '~i', $parse_url['host'])) return true;

     }
   return false;
 }
function get_showurl($path, $suffix = ''){
     global $v_config;
     global $sign;
     if(!isgoodurl($url)){
         return $path;
         }
     $suffix = $suffix?'.' . $suffix:'';
     if($v_config['web_urlencode']){
         $path = encode_id($path) . $suffix;
         }
     return $sign . $path;
    }
function isgoodurl($url){
    return preg_match('~^(magnet|thunder|ftp|javascript|https|http|file|mailto|data|#):~i', $url) ?false:true;
}
function strcut($start, $end, $str, $lt = false, $gt = false){
     if($str == '')return '';
     if($start == '' && $end == '')return $str;
     if($start == '' || $end == '')return '';
     $strarr = explode($start, $str);
     if($strarr[1]){
         $strarr2 = explode($end, $strarr[1]);
         $return = $strarr2[0];
         if($lt)$return = $start . $return;
         if($gt)$return = $return . $end;
         }else{
         return '';
         }
     return $return;
    }
function link_word($html, $link_config){
     if(empty($html)){
         return $html;
         }
     $htmlArr = explode('</head>', $html);
     $html = $htmlArr[1]?$htmlArr[1]:$htmlArr[0];
     preg_match_all('~(<[^>]+>)~iUs', $html, $match);
     $newStrArr = array();
     if($match){
         foreach($match[1]as $k => $vo){
             $newStrArr[] = $newstr = '|||' . base64_encode($vo) . '|||';
             $html = str_replace($vo, $newstr, $html);
             }
         }
     $arr = explode('|||', $link_config);
     $limit = -1;
     foreach($arr as $k => $vo){
         if(trim($vo) == '')continue;
         list($l, $r) = explode(',', $vo);
         $l = str_replace('~', '\~', $l);
         $html = str_replace($l, '<a href="' . $r . '" target="_blank">' . $l . '</a>', $html);
         }
     if($newStrArr){
         foreach($newStrArr as $k => $vo){
             $newstr = base64_decode(substr($vo, 2, -3));
             $html = str_replace($vo, $newstr, $html);
             }
         }
     if($htmlArr[1]){
         $html = $htmlArr[0] . '</head>' . $html;
         }
     return $html;
    }
function encode_id($id){
     global $v_config;
     switch($v_config['web_urlencode_type']){
     case 'base64':$id = base64code($id);
         break;
     case 'strrev':$id = strrev($id);
         break;
     case 'str_rot13':$id = str_rot13($id);
         break;
     case 'jiandan':$id = str_replace(array('/', '-', '|', '@'), array('|', '@', '-', '/'), $id);
         break;
         }
     return $id;
    }
function decode_id($id){
     global $v_config;
     switch($v_config['web_urlencode_type']){
     case 'base64':$id = base64code($id, 'DECODE');
         break;
     case 'strrev':$id = strrev($id);
         break;
     case 'str_rot13':$id = str_rot13($id);
         break;
     case 'jiandan':$id = str_replace(array('/', '-', '|', '@'), array('|', '@', '-', '/'), $id);
         break;
         }
     return $id;
    }
function _base64_encode($data){
     return str_rot13(rtrim(strtr(base64_encode($data), '+/', '!;'), '='));
    }
function _base64_decode($data){
     return base64_decode(str_pad(strtr(str_rot13($data), '!;', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }
function base64code($string, $aciton = 'ENCODE', $hash = ''){
     global $v_config;
     $code = '';
     $aciton != 'ENCODE' && $string = _base64_decode($string);
     !$hash && $hash = $v_config['web_urlencode_key'];
     $keylen = strlen($hash);
     $strlen = strlen($string);
     for($i = 0;$i < strlen($string);$i++){
         $k = $i % $keylen;
         $code .= $string[$i] ^ $hash[$k];
         }
     return($aciton != 'DECODE'?_base64_encode($code):$code);
    }
function replace_css($str, $isout = false){
     global $scheme, $urlpath, $caiji_config, $collectid, $geturl;
     $newcss = array();
     $regx = "~@import\s*url\s*\(\s*([\"|']?)\s*([^\)]+)\s*\\1\)~i";
     if(preg_match_all($regx, $str, $match)){
         $match = array_map('trim', array_unique($match[2]));
         foreach($match as $k => $vo){
             if(substr($vo, 0, 2) == '//'){
                 if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)){
                     $vo = $scheme . '://';
                     }else{
                     $vo = substr($vo, 1);
                     }
                 }
             if(ISOUTURL)$vo = get_fullurl($vo, $geturl);
             if(isgoodurl($vo)){
                 if(substr($vo, 0, 1) == '/'){
                     $vo = substr($vo, 1);
                     }else if(substr($vo, 0, 3) == '../'){
                     $vo = $urlpath . $vo;
                     }else{
                     $vo = $urlpath . $vo;
                     }
                 $newcss[] = get_showurl($vo, 'css');
                 }else{
                 if(is_resdomain($vo)){
                     $vo = WEB_ROOT . '/css.php?' . encode_source($collectid . '|' . $vo);
                     }
                 $newcss[] = $vo;
                 }
             }
         if($newcss)$str = str_replace($match, $newcss, $str);
         }
     $newcssimg = array();
     $regx = "~\s*[,|:]\s*url\s*\(\s*([\"|']?)\s*([^\)]+)\s*\\1\)~i";
     if(preg_match_all($regx, $str, $match)){
         $match = array_map('trim', array_unique($match[2]));
         foreach($match as $k => $vo){
             if(substr($vo, 0, 2) == '//'){
                 if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)){
                     $vo = $scheme . ':' . $vo;
                     }else{
                     $vo = substr($vo, 1);
                     }
                 }
             if(ISOUTURL){
                 $vo = get_fullurl($vo, $geturl);
                 }
             if(isgoodurl($vo)){
                 if(substr($vo, 0, 1) == '/'){
                     $vo = substr($vo, 1);
                     }else if(substr($vo, 0, 3) == '../'){
                     $vo = $urlpath . $vo;
                     }else{
                     $vo = $urlpath . $vo;
                     }
                 $newcssimg[] = get_showurl($vo, 'jpg');
                 }else{
                 if(is_resdomain($vo)){
                     $vo = WEB_ROOT . '/img.php?' . encode_source($collectid . '|' . $vo);
                     }
                 $newcssimg[] = $vo;
                 }
             }
         $str = str_replace($match, $newcssimg, $str);
         }
     return $str;
    }
function encode_source($str){
     return rawurlencode(strrev(_base64_encode($str)));
    }
function decode_source($str){
     return _base64_decode(strrev(rawurldecode($str)));
    }
function replace_zdy($str){
     global $caiji_config, $caiji;
     if($caiji_config['siftags'] && is_array($caiji_config['siftags'])){
         if(in_array('iframe', $caiji_config['siftags']))$str = preg_replace("/<(iframe.*?)>(.*?)<(\/iframe.*?)>/si", "", $str);
         if(in_array('object', $caiji_config['siftags']))$str = preg_replace("/<(object.*?)>(.*?)<(\/object.*?)>/si", "", $str);
         if(in_array('script', $caiji_config['siftags']))$str = preg_replace("/<(script.*?)>(.*?)<\/script>/si", "", $str);
         if(in_array('form', $caiji_config['siftags']))$str = preg_replace("~<(|/)form([^>]*)>~i", "", $str);
         if(in_array('input', $caiji_config['siftags']))$str = preg_replace("~<input([^>]*)>~i", "", $str);
         if(in_array('textarea', $caiji_config['siftags']))$str = preg_replace("/<(textarea.*?)>(.*?)<\/textarea>/si", "", $str);
         if(in_array('botton', $caiji_config['siftags']))$str = preg_replace("/<(botton.*?)>(.*?)<\/botton>/si", "", $str);
         if(in_array('select', $caiji_config['siftags']))$str = preg_replace("/<(select.*?)>(.*?)<\/select>/si", "", $str);
         if(in_array('div', $caiji_config['siftags']))$str = preg_replace("~<(|/)div([^>]*)>~i", "", $str);
         if(in_array('table', $caiji_config['siftags']))$str = preg_replace("~<(|/)table([^>]*)>~i", "", $str);
         if(in_array('tr', $caiji_config['siftags']))$str = preg_replace("~<(|/)tr([^>]*)>~i", "", $str);
         if(in_array('td', $caiji_config['siftags']))$str = preg_replace("~<(|/)td([^>]*)>~i", "", $str);
         if(in_array('th', $caiji_config['siftags']))$str = preg_replace("~<(|/)th([^>]*)>~i", "", $str);
         if(in_array('span', $caiji_config['siftags']))$str = preg_replace("~<(|/)span([^>]*)>~i", "", $str);
         if(in_array('img', $caiji_config['siftags']))$str = preg_replace("~<img([^>]+)>~i", "", $str);
         if(in_array('font', $caiji_config['siftags']))$str = preg_replace("~<(|/)font([^>]*)>~i", "", $str);
         if(in_array('a', $caiji_config['siftags']))$str = preg_replace("~<(|/)a([^>]*)>~i", "", $str);
         if(in_array('html', $caiji_config['siftags']))$str = preg_replace("~<(|/)html([^>]*)>~i", "", $str);
         if(in_array('style', $caiji_config['siftags']))$str = preg_replace("/<(style.*?)>(.*?)<\/style>/si", "", $str);
         }
     if($caiji_config['replacerules']){
         $caiji_config['replacerules'] = str_ireplace('{vivicut}', '******', $caiji_config['replacerules']);
         $caiji_config['replacerules'] = str_ireplace('{vivicutline}', '##########', $caiji_config['replacerules']);
         $replacerules = explode('##########', $caiji_config['replacerules']);
         $replacerules = array_map('trim', $replacerules);
         foreach($replacerules as $k => $vo){
             list($fromstr, $tostr) = explode('******', $vo);
             $fromstr = str_replace('{vivisign}', $sign, ltrim($fromstr));
             $tostr = str_replace('{vivisign}', WEB_ROOT . '/', rtrim($tostr));
             if(preg_match('~^index@@~', $fromstr) && !empty($_SERVER['QUERY_STRING'])) continue;
             if(preg_match('~^other@@~', $fromstr) && empty($_SERVER['QUERY_STRING'])) continue;

             $fromstr = preg_replace('~^index@@~', '', $fromstr);
             $fromstr = preg_replace('~^other@@~', '', $fromstr);
             $str = str_replace($fromstr, $tostr, $str);
             }
         }
     if($caiji_config['siftrules']){
         $siftrules = explode('[cutline]', $caiji_config['siftrules']);
         foreach($siftrules as $k => $vo){
             $vo = trim($vo);
             if(preg_match('~^index@@~', $vo) && !empty($_SERVER['QUERY_STRING'])) continue;

             if(preg_match('~^other@@~', $vo) && empty($_SERVER['QUERY_STRING'])) continue;

             $vo = preg_replace('~^index@@~', '', $vo);
             $vo = preg_replace('~^other@@~', '', $vo);
             preg_match('#^\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}#', $vo, $match);
             if(isset($match[2]) && !empty($match[2])){
                 $match[2] = str_replace('~', '\~', $match[2]);
                 $match[2] = str_replace('"', '\"', $match[2]);
                 $match[2] = str_replace('[d]', "'", $match[2]);
                 $str = preg_replace("~" . $match[2] . "~iUs", $match[1], $str);
               }
           }
      }
     if($caiji_config['replace'] && checktime_log_out_1h()) $str = $caiji -> replace($str);

     $str = replace_tags($str);
     return $str;
    }
function replace_before($str){
     global $caiji_config, $caiji;
     if($caiji_config['replacerules_before']){
         $caiji_config['replacerules_before'] = str_ireplace('{vivicut}', '******', $caiji_config['replacerules_before']);
         $caiji_config['replacerules_before'] = str_ireplace('{vivicutline}', '##########', $caiji_config['replacerules_before']);
         $replacerules_before = explode('##########', $caiji_config['replacerules_before']);
         $replacerules_before = array_map('trim', $replacerules_before);
         foreach($replacerules_before as $k => $vo){
             list($fromstr, $tostr) = explode('******', $vo);
             $fromstr = str_replace('{vivisign}', $sign, ltrim($fromstr));
             $tostr = str_replace('{vivisign}', WEB_ROOT . '/', rtrim($tostr));
             if(preg_match('~^index@@~', $fromstr) && !empty($_SERVER['QUERY_STRING'])){
                 continue;
                 }
             if(preg_match('~^other@@~', $fromstr) && empty($_SERVER['QUERY_STRING'])){
                 continue;
                 }
             $fromstr = preg_replace('~^index@@~', '', $fromstr);
             $fromstr = preg_replace('~^other@@~', '', $fromstr);
             $str = str_replace($fromstr, $tostr, $str);
             }
         }
     if($caiji_config['siftrules_before']){
         $siftrules_before = explode('[cutline]', $caiji_config['siftrules_before']);
         foreach($siftrules_before as $k => $vo){
             $vo = trim($vo);
             if(preg_match('~^index@@~', $vo) && !empty($_SERVER['QUERY_STRING'])){
                 continue;
                 }
             if(preg_match('~^other@@~', $vo) && empty($_SERVER['QUERY_STRING'])){
                 continue;
                 }
             $vo = preg_replace('~^index@@~', '', $vo);
             $vo = preg_replace('~^other@@~', '', $vo);
             preg_match('#^\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}#', $vo, $match);
             if(isset($match[2]) && !empty($match[2])){
                 $match[2] = str_replace('~', '\~', $match[2]);
                 $match[2] = str_replace('"', '\"', $match[2]);
                 $match[2] = str_replace('[d]', "'", $match[2]);
                 $str = preg_replace("~" . $match[2] . "~iUs", $match[1], $str);
                 }
             }
         }
     $str = replace_tags($str);
     return $str;
    }
function replace_tags($str){
     global $thisurl, $v_config;
     $str = str_replace(array('{web_thisurl}', '{web_domain}'), array($thisurl, $_SERVER['HTTP_HOST']), $str);
     foreach($v_config as $k => $vo){
         $str = str_replace('{' . $k . '}', $vo, $str);
         }
     return $str;
    }
function ajaxReturn($data){
     if(func_num_args() > 2){
         $args = func_get_args();
         array_shift($args);
         $info = array();
         $info['data'] = $data;
         $info['info'] = array_shift($args);
         $info['status'] = array_shift($args);
         $data = $info;
         $type = $args?array_shift($args):'';
         }
     header('Content-Type:application/json; charset=gbk');
     $data['info'] = to_utf8($data['info']);
     exit(json_encode($data));
    }
function to_utf8($str){
     if(!is_utf8($str)){
         if(PATH_SEPARATOR == ':'){
             $str = mb_convert_encoding($str, "utf-8", "gbk");
             }else{
             $str = iconv('gbk', 'utf-8//IGNORE', $str);
             }
         }
     return $str;
    }
function utf2gbk($str){
     if(is_utf8($str)){
         if(PATH_SEPARATOR == ':'){
             $str = mb_convert_encoding($str, "gbk", "utf-8");
             }else{
             $str = iconv('utf-8', 'gbk//IGNORE', $str);
             }
         }
     return $str;
    }
function echo_debug($arr){
     echo '<div id="vxiaotou_debug" style="margin:0;width:auto;text-align:left;border:1px dashed #ddd;background: #f8f8f8;padding:10px;font-size:12px;"><div style="color:#aaa;"><span style="font-weight:700;font-size:13px;">������Ϣ</span><span style="float:right;">vxiaotou.com</div><div style="color:#666;line-height:20px;padding:5px 0;margin-top:5px;border-top:1px dashed #ddd;">' . implode("<br>", $arr) . "</div></div><br>";
    }
function test_write($d){
     $tfile = '_vivi_test.txt';
     if(is_dir($d)){
         $d = preg_replace("#\/$#", '', $d);
         $fp = @fopen($d . '/' . $tfile, 'w');
         if(!$fp){
             return false;
             }else{
             fclose($fp);
             $rs = @unlink($d . '/' . $tfile);
             if($rs)return true;
             else return false;
             }
         }else if(is_file($d)){
         return is_writable($d);
         }
     return false;
    }
function regxcut($regx, $str){
     if(preg_match('~' . $regx . '~iUs', $str, $match)){
         return trim($match[1]);
         }
     return false;
    }
if(!function_exists('get_page')){
     function get_page($currentPage, $totalPages, $url, $halfPer = 5, $pagego = false){
         if($totalPages < 2)return false;
         $linkPage = '';
         $linkPage .= ($currentPage > 1)?'<a href="' . str_replace('{!page!}', 1, $url) . '">��ҳ</a><a href="' . str_replace('{!page!}', ($currentPage-1), $url) . '">��һҳ</a>':'';
         for($i = $currentPage - $halfPer, $i > 1 || $i = 1, $j = $currentPage + $halfPer, $j < $totalPages || $j = $totalPages;$i < $j + 1;$i++){
             $linkPage .= ($i == $currentPage)?'<span>' . $i . '</span>':'<a href="' . str_replace('{!page!}', $i, $url) . '">' . $i . '</a>';
             }
         $linkPage .= ($currentPage < $totalPages && $totalPages > $halfPer)?'<i>...</i><a href="' . str_replace('{!page!}', $totalPages, $url) . '">' . $totalPages . '</a><a href="' . str_replace('{!page!}', ($currentPage + 1), $url) . '">��һҳ</a>':'';
         if(!empty($pagego)){
             $linkPage .= '&nbsp;<input type="input" name="page"/><input type="button" value="�� ת" onclick="' . $pagego . '"/>';
             }
         return $linkPage;
         }
    }
function ret_true(){
     return true;
 }
?>
