<?php
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
    $GLOBALS['html'] = preg_replace('#content=\s*(["|\']*)\s*text/html;\s*charset[^"\']+\\1#i', 'content="text/html; charset=utf-8"', $GLOBALS['html']);
    $GLOBALS['html'] = preg_replace('#<meta charset="[^"]+">#i', '<meta charset="utf-8">', $GLOBALS['html']);
    $GLOBALS['html'] = preg_replace('#<meta charset=\'[^\']+\'>#i', '<meta charset="utf-8">', $GLOBALS['html']);
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