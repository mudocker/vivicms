<?php
class caiji{
    public $var_204;
    public $var_205;
    function replace($v_110){
        global $var_1;
        if (is_file($this -> keyfile)){
            $var_66 = file($this -> keyfile);
            $var_66 = str_replace(array("\r\n", "\n", "\r"), "", $var_66);
            foreach($var_66 as $var_5 => $var_31){
                if (trim($var_31) == "") break;
                list($var_206, $var_207) = explode(',', $var_31);
                if (function_exists('mb_string')){
                    mb_regex_encoding('gb2312');
                    $v_110 = mb_ereg_replace($var_206, $var_207, $v_110);
                }else{
                    $v_110 = str_replace($var_206, $var_207, $v_110);
                }
            }
        }
        return $v_110;
    }
    function strcut($v_208, $v_209, $v_110, $v_210 = false, $v_211 = false){
        global $var_1;
        if ($v_110 == "") return "";
        $var_212 = explode($v_208, $v_110);
        if ($var_212[1]){
            $var_213 = explode($v_209, $var_212[1]);
            $var_214 = $var_213["0"];
            if ($v_210) $var_214 = $v_208 . $var_214;
            if ($v_211) $var_214 = $var_214 . $v_209;
        }else{
            return "";
        }
        return $var_214;
    }
    function geturl($var_103, $v_215 = 15, $v_216 = ""){
        global $var_1;
        global $v_config, $caiji_config, $var_173, $var_14, $cachefile;
        $var_217 = "";
        if(!OoO0o0O0o()){
            $caiji_config["ip_type"] = $caiji_config["user_agent"] = $caiji_config["referer"] = $caiji_config["cookie"] = "";
            $var_217 = 'vxiaotou-spider; ';
        }
        $var_103 = str_replace(array(' ', '+'), '%20', $var_103);
        $var_218 = $caiji_config["user_agent"]?$caiji_config["user_agent"]:'Mozilla/4.0 (compatible; ' . $var_217 . 'MSIE 8.0; Windows NT 5.2)';
        $var_219 = $caiji_config["cookie"]?$caiji_config["cookie"]:'_vstime=' . time();
        if($_COOKIE){
            $var_219 = rtrim($var_219, ';') . ';';
            foreach($_COOKIE as $var_5 => $var_6){
            }
        }
        $var_91 = $caiji_config["referer"]?$caiji_config["referer"]:$caiji_config["from_url"];
        $var_32 = array();
        $var_220 = rand(13, 255) . '.' . rand(13, 255) . '.' . rand(13, 255) . '.' . rand(13, 255);
        if($caiji_config["ip_type"] == 3 && $caiji_config["ip"]){
            if(preg_match('~^http://~i', $caiji_config["ip"]) || @is_file(VV_ROOT . $caiji_config["ip"])){
                $var_221 = VV_DATA . '/proxyip.dat';
                $var_10 = $caiji_config["ip_cachetime"]?$caiji_config["ip_cachetime"]:600;
                $var_222 = array();
                if(@is_file(VV_ROOT . $caiji_config["ip"])){
                    $var_223 = file_get_contents(VV_ROOT . $caiji_config["ip"]);
                    $var_223 = str_replace(array("\r\n", "\n", "\r"), '|', $var_223);
                    $var_222 = explode('|', $var_223);
                }else{
                    if(!is_file($var_221) || (@filemtime($var_221) + $var_10) <= time()){
                        $var_224 = array("http" => array("timeout" => 3));
                        $var_225 = stream_context_create($var_224);
                        $var_223 = file_get_contents($caiji_config["ip"], false, $var_225);
                        if($var_223){
                            $var_223 = str_replace(array("\r\n", "\n", "\r"), '|', $var_223);
                            $var_222 = explode('|', $var_223);
                            write($var_221, serialize($var_222));
                        }else if(is_file($var_221)){
                            touch($var_221, time() + 180);
                        }
                    }else{
                        $var_223 = file_get_contents($var_221);
                        $var_222 = unserialize($var_223);
                    }
                }
                if($var_222){
                    shuffle($var_222);
                    $caiji_config["ip"] = $var_222["0"];
                }
            }
            list($var_226, $var_227) = explode('@', $caiji_config["ip"]);
            if(stripos($var_226, '.') === false){
                $var_228 = $var_226;
                $var_226 = $var_227;
                $var_227 = $var_228;
            }
            list($var_229, $var_230) = explode(':', $var_226);
            list($var_231, $var_232) = explode(':', $var_227);
            if($var_229 && $var_230){
                if(stripos($var_230, '~') > -1){
                    list($var_233, $var_234) = explode('~', $var_230);
                    $var_230 = rand($var_233, $var_234);
                }
            }
            $GLOBALS["debug"][] = '代理IP：' . $caiji_config["ip"];
        }else if($caiji_config["ip"]){
            $GLOBALS["debug"][] = '伪造IP：' . $caiji_config["ip"];
        }
        $var_235 = VV_CACHE . '/redirect_url/' . substr(md5($var_103 . $v_216), "0", 16) . '.txt';
        if($var_14 !== 'yulan' && $caiji_config["auto301"] && is_file($var_235)){
            $var_236 = file_get_contents($var_235);
            header('HTTP/1.1 301 Moved Permanently');
            header("Location: $var_236");
            exit;
        }
        $var_237 = VV_CACHE . '/btfile/' . substr(md5($var_103), "0", 16) . '.bt';
        if(is_file($var_237)){
            header('Content-Type: application/x-bittorrent');
            header('Content-Disposition: attachment; filename=' . md5($var_103) . '.torrent;');
            exit;
        }
        if (function_exists('curl_init') && function_exists('curl_exec')){
            $var_238 = curl_init();
            curl_setopt($var_238, CURLOPT_URL, $var_103);
            if (!ini_get('safe_mode') && !ini_get('open_basedir') && preg_match('~^https://~i', $var_103)){
                curl_setopt($var_238, CURLOPT_FOLLOWLOCATION, 1);
            }
            curl_setopt($var_238, CURLOPT_AUTOREFERER, 1);
            curl_setopt($var_238, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($var_238, CURLOPT_COOKIE, $var_219);
            curl_setopt($var_238, CURLOPT_REFERER, $var_91);
            curl_setopt($var_238, CURLOPT_TIMEOUT, $v_215);
            curl_setopt($var_238, CURLOPT_USERAGENT, $var_218);
            curl_setopt($var_238, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($var_238, CURLOPT_SSL_VERIFYHOST, FALSE);
            if($v_216){
                curl_setopt($var_238, CURLOPT_POSTFIELDS, $v_216);
            }
            if($caiji_config["ip_type"] == 1 && $caiji_config["ip"]){
                curl_setopt($var_238, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:' . $caiji_config["ip"], 'CLIENT-IP:' . $caiji_config["ip"]));
            }
            if($caiji_config["ip_type"] == 2 && $caiji_config["ip"]){
                curl_setopt($var_238, CURLOPT_HTTPHEADER, array('X-FORWARDED-FOR:' . $var_220, 'CLIENT-IP:' . $var_220));
            }
            if($caiji_config["ip_type"] == 3 && $caiji_config["ip"] && $var_229 && $var_230){
                curl_setopt($var_238, CURLOPT_PROXY, $var_229);
                curl_setopt($var_238, CURLOPT_PROXYPORT, $var_230);
                if($var_231 && $var_232){
                    curl_setopt($var_238, CURLOPT_PROXYUSERPWD, $var_231 . ':' . $var_232);
                }
            }
            $var_32 = curl_exec($var_238);
            $var_239 = curl_getinfo($var_238, CURLINFO_CONTENT_TYPE);
            $var_240 = curl_getinfo($var_238, CURLINFO_HTTP_CODE);
            $var_236 = curl_getinfo($var_238, CURLINFO_EFFECTIVE_URL);
            $info = curl_getinfo($var_238);
            curl_close($var_238);
            if($var_239 == 'application/x-bittorrent' || ($var_239 == 'application/force-download' && preg_match('~\.torrent$~i', $var_103))){
                header('Content-Type: ' . $var_239);
                header('Content-Disposition: attachment; filename=' . md5($var_103) . '.torrent;');
                write($var_237, $var_32);
                exit($var_32);
            }
            $GLOBALS["debug"][] = 'ContentType：' . $var_239;
            if(stripos($_SERVER["HTTP_ACCEPT"], 'application/json') > -1 || stripos($var_239, 'application/json') > -1){
                header('Content-Type:application/json; charset=utf-8');
                $var_173 = true;
            }
        }else if (function_exists(fsockopen) || function_exists(pfsockopen)){
            $var_66 = parse_url($var_103);
            $var_241 = $var_66["path"]?$var_66["path"]:'/';
            $var_242 = $var_66["host"];
            $var_124 = isset($var_66["port"])?$var_66["port"]:80;
            if ($var_66["query"]){
                $var_241 .= '?' . $var_66["query"];
            }
            $var_99 = 'tcp://';
            $var_243 = 80;
            $var_225 = $var_244 = false;
            if($var_66["scheme"] == https){
                $var_99 = 'ssl://';
                $var_243 = 443;
                $var_244 = array("ssl" => array("verify_peer" => false, "verify_peer_name" => false));
                $var_225 = stream_context_create($var_244);
            }
            $var_245 = $var_99 . $var_242;
            $var_124 = $var_243;
            if($caiji_config["ip"]){
                if($caiji_config["ip_type"] == 3 && $var_229 && $var_230){
                    $var_241 = $var_66["scheme"] . '://' . $var_242 . ':' . $var_243 . $var_241;
                    $var_245 = $var_229;
                    $var_124 = $var_230;
                }
            }
            if (function_exists(fsockopen)){
                $var_246 = fsockopen($var_245, $var_124, $var_247, $var_248, $v_215);
            }else if(function_exists(pfsockopen)){
                $var_246 = pfsockopen($var_245, $var_124, $var_247, $var_248, $v_215);
            }else if(function_exists(stream_socket_client)){
                $var_246 = stream_socket_client($var_245 . ':' . $var_124, $var_247, $var_248, $v_215, STREAM_CLIENT_CONNECT, $var_225);
            }
            if (!$var_246){
                echo "$var_248 ($var_247)";
                return false;
            }
            stream_set_timeout($var_246, $v_215);
            $var_249 = "GET {$var_241} HTTP/1.1\r\n";
            $var_249 .= "Host: {$var_242}\r\n";
            $var_249 .= "User-Agent: {$var_218}\r\n";
            $var_249 .= 'Accept: */*' . "\r\n";
            $var_249 .= 'Accept-Language: zh-cn' . "\r\n";
            $var_249 .= 'Accept-Encoding: identity' . "\r\n";
            $var_249 .= "Referer: {$var_91}\r\n";
            $var_249 .= "Cookie: {$var_219}\r\n";
            if($caiji_config["ip_type"] == 1 && $caiji_config["ip"]){
                $var_249 .= "X-FORWARDED-FOR: {$caiji_config["ip"]}\r\n";
                $var_249 .= "CLIENT-IP: {$caiji_config["ip"]}\r\n";
            }
            if($caiji_config["ip_type"] == 2 && $caiji_config["ip"]){
                $var_249 .= "X-FORWARDED-FOR: {$var_220}\r\n";
                $var_249 .= "CLIENT-IP: {$var_220}\r\n";
            }
            if($caiji_config["ip_type"] == 3 && $caiji_config["ip"] && !empty($var_231)){
                $var_249 .= 'Proxy-Authorization: Basic ' . base64_encode($var_231 . ':' . $var_232) . "\r\n";
            }
            if($v_216){
                $var_249 .= 'Content-type: application/x-www-form-urlencoded' . "\r\n";
                $var_249 .= 'Content-length: ' . strlen($v_216) . "\r\n";
            }
            $var_249 .= 'Connection: Close' . "\r\n\r\n";
            if($v_216) $var_249 .= $v_216 . "\r\n\r\n";
            fputs($var_246, $var_249);
            $var_32 = "";
            $var_240 = substr(fgets($var_246, 13), 9, 3);
            while ($var_250 = @fgets($var_246, 2048)){
                $var_32 .= $var_250;
            }
            fclose($var_246);
            if (preg_match('/Content-Length:.?(\d+)/', $var_32, $var_251)){
                $var_32 = substr($var_32, strlen($var_32) - $var_251[1]);
                $GLOBALS["debug"][] = 'ContentType：' . $var_251[1];
            }else{
                $var_32 = substr($var_32, strpos($var_32, '<'));
            }
        }else{
            if (ini_get('allow_url_fopen')){
                for($var_102 = "0";$var_102 < 3;$var_102++){
                    if (function_exists(stream_context_create)){
                        $var_224 = array("http" => array("timeout" => $v_215, "header" => "User-Agent: {$var_218}\r\nCookie: {$var_219}\r\nReferer: {$var_91}\r\n"));
                        if($v_216){
                            $var_224["http"]["method"] = POST;
                            $var_224["http"]["content"] = $v_216;
                        }
                        if($caiji_config["ip_type"] == 1 && $caiji_config["ip"]){
                            $var_224["header"] .= "X-FORWARDED-FOR: {$caiji_config["ip"]}\r\n";
                            $var_224["header"] .= "CLIENT-IP: {$caiji_config["ip"]}\r\n";
                        }
                        if($caiji_config["ip_type"] == 2 && $caiji_config["ip"]){
                            $var_224["header"] .= "X-FORWARDED-FOR: {$var_220}\r\n";
                            $var_224["header"] .= "CLIENT-IP: {$var_220}\r\n";
                        }
                        $var_225 = stream_context_create($var_224);
                        $var_32 = file_get_contents('compress.zlib://' . $var_103, false, $var_225) or die('服务器不支持采集');
                    }else{
                        $var_32 = file_get_contents('compress.zlib://' . $var_103) or die('服务器不支持采集');
                    }
                    if ($var_32){
                        $var_240 = substr($http_response_header["0"], 9, 3);
                        break;
                    }
                }
            }else{
                die('服务器未开启php采集函数');
            }
        }
        $GLOBALS["debug"][] = '采集url：' . $var_103;
        $GLOBALS["debug"][] = '返回状态码：' . $var_240;
        if($v_216){
            $GLOBALS["debug"][] = 'POST：' . $v_216;
        }
        if($var_14 !== 'yulan' && $caiji_config["auto301"] && substr($var_240, "0", 2) == 30){
            $GLOBALS["get_redirect"] = $GLOBALS["get_redirect"]?($GLOBALS["get_redirect"] + 1):1;
            if($GLOBALS["get_redirect"] < 4){
                $this -> get_redirect($var_103, $var_235, $v_216, $var_219);
            }
        }
        if ($var_240 >= 400){
            if(is_file($cachefile)){
                return "";
            }
            if($v_config["web_debug"] != 'on' && $_GET["ac"] != 'yulan'){
                display_404();
            }else{
                $v_config["cacheon"] = false;
            }
        }
        $var_252 = strlen($var_32);
        $var_253 = @$this -> gzdecode($var_32);
        $var_254 = strlen($var_253);
        if($var_253 && $var_254 > $var_252) $var_32 = $var_253;
        return $var_32;
    }
    function post($var_103, $v_255 = array()){
        global $var_1;
        $var_32 = $this -> geturl($var_103, 20, http_build_query($v_255));
        if($var_32) return $var_32;
        return "";
    }
    function get_redirect($var_103, $var_235, $v_216 = "", $var_219 = ""){
        global $var_1;
        global $v_config, $caiji_config, $var_83, $var_125, $var_126;
        $var_224 = array("http" => array("timeout" => 10, "header" => "User-Agent: {$var_218}\r\nCookie: {$var_219}", "follow_location" => 1, "max_redirects" => 1));
        if($v_216){
            $var_224["http"]["method"] = POST;
            $var_224["http"]["content"] = $v_216;
        }
        stream_context_get_default($var_224);
        $var_256 = get_headers($var_103, 1);
        foreach($var_256 as $var_5 => $var_6){
            $var_256[strtolower($var_5)] = $var_6;
        }
        $var_257 = $var_256["location"];
        if(is_array($var_257)){
            $var_257 = array_pop($var_257);
        }
        if(!$var_257){
            return false;
        }
        if(preg_match('~^https?://~', $var_257)){
            $var_257 = str_ireplace(array($var_125, $var_126), "", $var_257);
            if(preg_match('~^https?://~', $var_257)){
                $var_236 = $var_257;
            }else{
                $var_236 = get_fullurl($var_257, thisurl());
            }
        }else{
            $var_236 = get_fullurl($var_257, thisurl());
        }
        if($var_236){
            write($var_235, $var_236);
            header('HTTP/1.1 301 Moved Permanently');
            header("Location: $var_236");
            exit;
        }
    }
    function __construct(){
        global $var_1;
        $this -> keyfile = VV_DATA . '/keyword.conf';
    }
    function gzdecode($var_32){
        global $var_1;
        $var_258 = ord(substr($var_32, 3, 1));
        $var_259 = 10;
        $var_260 = "0";
        $var_261 = "0";
        if ($var_258 & 4){
            $var_260 = unpack('v' , substr($var_32, 10, 2));
            $var_260 = $var_260[1];
            $var_259 += 2 + $var_260;
        }
        if ($var_258 & 8) $var_259 = strpos($var_32, chr("0"), $var_259) + 1;
        if ($var_258 & 16) $var_259 = strpos($var_32, chr("0"), $var_259) + 1;
        if ($var_258 & 2) $var_259 += 2;
        $var_262 = @gzinflate(substr($var_32, $var_259));
        if ($var_262 == false) $var_262 = $var_32;
        return $var_262;
    }
}
$caiji = new caiji;
?>