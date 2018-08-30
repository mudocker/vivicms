<?php
namespace md\inc;


use md\data\caiji\headerex;

class caiji{
     public $keyfile;
     function replace($str){
         if(is_file($this -> keyfile)){
             $arr = file($this -> keyfile);
             $arr = str_replace(array("\r\n", "\n", "\r"), '', $arr);
             foreach($arr as $k => $v){
                 if(trim($v) == '')break;
                 list($l, $r) = explode(',', $v);
                 if(function_exists('mb_string')){
                     mb_regex_encoding("gb2312");
                     $str = mb_ereg_replace($l, $r, $str);
                     }else $str = str_replace($l, $r, $str);
                 }
             }
         return $str;
         }
     function strcut($start, $end, $html, $lt = false, $gt = false){
         if($html == '')return '$false$';
         $strarr = explode($start, $html);
         if($strarr[1]){
             $strarr2 = explode($end, $strarr[1]);
             $return = $strarr2[0];
             $lt and $return = $start . $return;
             $gt and $return = $return . $end;
             }else return '$false$';

         return $return;
         }
     function geturl($url, $timeout = 10, $post = ''){
       require_once (VV_DATA.'/caiji/http_header.php');
         $data = array();
         require_once (VV_DATA.'/caiji/ip.php');
        new headerex($url,$post,$cacheurlfile,$lasturl,$btcachefile);
         require_once (VV_DATA.'/caiji/curl.php');
         require_once (VV_DATA.'/caiji/data.php');
         return $data;
     }
     function post($url, $params = array()){
         $data = $this -> geturl($url, 10, http_build_query($params));
         return $data? $data: '';
      }
     function get_redirect($url, $cacheurlfile, $post = '', $cookie = ''){
         global $v_config, $caiji_config, $sign;
     //    HTTP_USER_AGENT
         $user_agent='';
         $opt = array('http' => array('timeout' => 10, 'header' => "User-Agent: {$user_agent}\r\nCookie: {$cookie}", 'follow_location' => 1, 'max_redirects' => 1));
         if($post){
             $opt['http']['method'] = 'POST';
             $opt['http']['content'] = $post;
             }
         stream_context_get_default($opt);
         $header = get_headers($url, 1);
         $tourl = $header['Location'];
         is_array($tourl) and  $tourl = array_pop($tourl);

         $arr = parse_url($tourl);
         $sign = $v_config['web_remark']?'/' . $v_config['web_remark'] . '/':'/';
         !$caiji_config['rewrite'] and $sign = '?';
         if($arr['path'] && $arr['path'] != '/') $lasturl = $sign . ltrim($arr['path'], '/') . ($arr['query']?'?' . $arr['query']:'');

         if($lasturl){
             write($cacheurlfile, $lasturl);
             header('HTTP/1.1 301 Moved Permanently');
             header("Location: $lasturl");
             exit;
          }
       }
     function __construct(){
         $this -> keyfile = VV_CONF . "/keyword.conf";
      }
     function gzdecode($data){
         $flags = ord(substr($data, 3, 1));
         $headerlen = 10;
         if($flags & 4){
             $extralen = unpack('v', substr($data, 10, 2));
             $extralen = $extralen[1];
             $headerlen += 2 + $extralen;
         }
         $flags & 8 and $headerlen = strpos($data, chr(0), $headerlen) + 1;
        $flags & 16 and $headerlen = strpos($data, chr(0), $headerlen) + 1;
         $flags & 2 and $headerlen += 2;
         $unpacked = @gzinflate(substr($data, $headerlen));
         $unpacked == false and $unpacked = $data;
         return $unpacked;
         }
    }


?>