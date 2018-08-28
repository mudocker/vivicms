<?php

    $GLOBALS['html'] = preg_replace('~<(body[^>]*)>~i', '<\\1>' . $topad, $GLOBALS['html'], 1);
    $GLOBALS['html'] = preg_replace('~</body>~i', '<div style="text-align:center;">' . $v_config['web_tongji'] . $bottomad . '</div></body>', $GLOBALS['html'], 1);
    if($caiji_config['hidejserror']) $GLOBALS['html'] = str_ireplace('<head>', '<head><script>var V_PATH="' . WEB_ROOT . '/' . '";window.onerror=function(){ return true; };</script>', $GLOBALS['html']);

    if($caiji_config['no_siteapp']) $GLOBALS['html'] = str_ireplace('<head>', '<head><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" />', $GLOBALS['html']);

    if($caiji_config['css']){
        $css = str_replace('{webpath}', WEB_ROOT . '/', $caiji_config['css']);
        $GLOBALS['html'] = str_ireplace('</head>', '<style>' . $css . '</style></head>', $GLOBALS['html']);
        $GLOBALS['html'] = str_ireplace('</body>', '<style>' . $css . '</style></body>', $GLOBALS['html']);
    }
    if(empty($_SERVER['QUERY_STRING'])){
        if($v_config['web_keywords']) $GLOBALS['html'] = preg_replace('#name\s*=\s*(["|\']*)keywords\\1\s*content=\s*(["|\']*)[^"\']+\\2#i', 'name="keywords" content="' . $v_config['web_keywords'] . '"', $GLOBALS['html']);
        if($v_config['web_description']) $GLOBALS['html'] = preg_replace('#name\s*=\s*(["|\']*)description\\1\s*content=\s*(["|\']*)[^"\']+\\2#i', 'name="description" content="' . $v_config['web_description'] . '"', $GLOBALS['html']);
        if($v_config['web_seo_name']) $GLOBALS['html'] = preg_replace('#<title>(.*)</title>#i', '<title>' . $v_config['web_seo_name'] . '</title>', $GLOBALS['html']);
        if(is_file(VV_DATA . '/flink.conf')){
            $flinks = file_get_contents(VV_DATA . '/flink.conf');
            if($flinks){
                $flinks = str_ireplace(array("\r\n", "\r", "\n"), '&nbsp;&nbsp;', $flinks);
                $v_config['flinks_auto_insert'] != 2 and  $GLOBALS['html'] = str_ireplace('</body>', '<div style="text-align:center;">' . $flinks . '</div></body>', $GLOBALS['html']);
            }
        }
    }
    $GLOBALS['html'] = str_ireplace('{flinks}', $flinks, $GLOBALS['html']);
    $GLOBALS['html'] = preg_replace('~=(["\']*)//(\w+)/~i', '=\\1/\\2/', $GLOBALS['html']);
    $GLOBALS['title'] = $caiji -> strcut('<title>', '</title>', $GLOBALS['html']);
    foreach(array(' ', '|', '-', '_', ',')as $vo) $GLOBALS['title'] = str_replace($vo . $v_config['web_name'], '', $GLOBALS['title']);
    $GLOBALS['title'] = trim(trim($GLOBALS['title']), '-');
    $GLOBALS['title'] = trim($GLOBALS['title']);
    $GLOBALS['debug'][] = '获取当前title标题：' . $GLOBALS['title'];
    $title = $GLOBALS['title'];
