<?php
function ShowMsg($v_350, $v_351, $v_352 = 0){
    global $var_1;
    $var_353 = '<html>' . "\r\n" . '<head>' . "\r\n" . '<title>提示信息</title>' . "\r\n" . '<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />' . "\r\n";
    $var_353 .= '<base target=\'_self\'/>' . "\r\n" . '<style>div{line-height:160%;}</style></head>' . "\r\n" . '<body leftmargin=\'0\' topmargin=\'0\' bgcolor=\'#FFFFFF\'>' . "\r\n" . '<center>' . "\r\n" . '<script>' . "\r\n";
    $var_354 = '</script>' . "\r\n" . '</center>' . "\r\n" . '</body>' . "\r\n" . '</html>' . "\r\n";
    $var_355 = ($v_352 == "0" ?1000 : $v_352);
    $var_356 = "";
    if ($v_351 == -1){
        if ($v_352 == "0") $var_355 = 5000;
        $v_351 = 'javascript:history.go(-1);';
    }
    $var_356 .= 'var pgo=0;fun' . "ction JumpUrl(){if(pgo==0){ location='$v_351'; pgo=1; }}\r\n";
    $var_357 = $var_356;
    $var_357 .= 'document.write("<br /><div style=\'width:450px;padding:0px;border:1px solid #c7ea6a;\'>';
    $var_357 .= '<div style=\'padding:6px;font-size:12px;border-bottom:1px solid #c7ea6a;background:#f5fde6 \';\'><b>vivi提示信息！</b></div>");' . "\r\n";
    $var_357 .= 'document.write("<div style=\'min-height:130px;font-size:10pt;background:#ffffff\'><br />");' . "\r\n";
    $var_357 .= 'document.write("' . str_replace('"', '“', $v_350) . '");' . "\r\n";
    $var_357 .= 'document.write("';
    $var_357 .= "<br /><a href='{$v_351}'>如果你的浏览器没反应，请点击这里...</a>";
    $var_357 .= '<br/></div>");' . "\r\n";
    $var_357 .= "setTimeout('JumpUrl()',$var_355);";
    $v_350 = $var_353 . $var_357 . $var_354;
    echo $v_350;
    exit;
}
function link_word($html, $var_71){
    global $var_1;
    if(empty($html)){
        return $html;
    }
    $var_358 = explode('</head>', $html);
    $html = $var_358[1]?$var_358[1]:$var_358["0"];
    preg_match_all('~(<[^>]+>)~iUs', $html, $var_164);
    $var_359 = array();
    if($var_164){
        foreach($var_164[1] as $var_5 => $var_6){
            $var_359[] = $var_360 = '|||' . base64_encode($var_6) . '|||';
            $html = str_replace($var_6, $var_360, $html);
        }
    }
    $var_66 = explode('|||', $var_71);
    $var_361 = -1;
    foreach($var_66 as $var_5 => $var_6){
        if(trim($var_6) == "") continue;
        list($var_206, $var_207) = explode(',', $var_6);
        $var_206 = str_replace('~', '\~', $var_206);
        $html = str_replace($var_206, '<a href="' . $var_207 . '" target="_blank">' . $var_206 . '</a>', $html);
    }
    if($var_359){
        foreach($var_359 as $var_5 => $var_6){
            $var_360 = base64_decode(substr($var_6, 2, -3));
            $html = str_replace($var_6, $var_360, $html);
        }
    }
    if($var_358[1]){
        $html = $var_358["0"] . '</head>' . $html;
    }
    return $html;
}
function geturlpath($var_7){
    global $var_1;
    $var_146 = $var_7["path"];
    $var_362 = pathinfo($var_7["path"], 4);
    if (empty($var_362)){
        if (substr($var_146, -1) != '/')$var_146 .= '/';
    }else{
        $var_143 = pathinfo($var_7["path"]);
        $var_144 = $var_143["dirname"];
        $var_145 = $var_143["basename"];
        $var_146 = str_replace($var_145, "", $var_7["path"]);
        if ($var_144 != '\\')$var_146 = $var_144 . '/';
    }
    if (substr($var_146, "0", 1) == '/'){
        $var_146 = substr($var_146, 1);
    }
    return $var_146;
}
?>