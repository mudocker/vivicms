<?php
function _unset($var_66, $var_59){
    if(isset($var_66[$var_59])){
        unset($var_66[$var_59]);
    }
    return $var_66;
}
function replace_before($v_110, $v_301){
    global $var_1;
    global $caiji;
    $caiji_config = $v_301;
    if ($caiji_config["replacerules_before"]){
        $caiji_config["replacerules_before"] = str_ireplace('{vivicut}', '******', $caiji_config["replacerules_before"]);
        $caiji_config["replacerules_before"] = str_ireplace('{vivicutline}', '##########', $caiji_config["replacerules_before"]);
        $var_302 = explode('##########', $caiji_config["replacerules_before"]);
        $var_302 = array_map(trim, $var_302);
        foreach($var_302 as $var_5 => $var_6){
            list($var_303, $var_304) = explode('******', $var_6);
            $var_303 = str_replace('{vivisign}', $var_83, ltrim($var_303));
            $var_304 = str_replace('{vivisign}', WEB_ROOT . '/', rtrim($var_304));
            if(preg_match('~^index@@~', $var_303) && !empty($_SERVER["QUERY_STRING"])){
                continue;
            }
            if(preg_match('~^other@@~', $var_303) && empty($_SERVER["QUERY_STRING"])){
                continue;
            }
            $var_303 = preg_replace('~^index@@~', "", $var_303);
            $var_303 = preg_replace('~^other@@~', "", $var_303);
            $v_110 = str_replace($var_303, $var_304, $v_110);
        }
    }
    if ($caiji_config["siftrules_before"]){
        $var_51 = explode('[cutline]', $caiji_config["siftrules_before"]);
        foreach($var_51 as $var_5 => $var_6){
            $var_6 = trim($var_6);
            if(preg_match('~^index@@~', $var_6) && !empty($_SERVER["QUERY_STRING"])){
                continue;
            }
            if(preg_match('~^other@@~', $var_6) && empty($_SERVER["QUERY_STRING"])){
                continue;
            }
            $var_6 = preg_replace('~^index@@~', "", $var_6);
            $var_6 = preg_replace('~^other@@~', "", $var_6);
            preg_match('#^\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}#', $var_6, $var_164);
            if (isset($var_164[2]) && !empty($var_164[2])){
                $var_164[2] = str_replace('~', '\~', $var_164[2]);
                $var_164[2] = str_replace('"', '\"', $var_164[2]);
                $var_164[2] = str_replace('[d]', '\'', $var_164[2]);
                $v_110 = preg_replace('~' . $var_164[2] . '~iUs', $var_164[1], $v_110);
            }
        }
    }
    $v_110 = replace_tags($v_110);
    return $v_110;
}
function updatenow(){
    global $var_1;
    global $var_274, $var_271;
    if(!test_write(VV_ROOT)){
        ShowMsg('根目录需给读写权限！', -1, 3000);
    }
    $var_103 = 'http://www.vxiaotou.com/update.php?m=download&type=' . $var_271 . '&vs=' . VV_VERSION . $var_305 . '&code=' . urlencode($var_274) . '&_t=' . time();
    $var_32 = downfile($var_103);
    if(empty($var_32)){
        ShowMsg('下载升级文件失败！', -1, 3000);
    }
    $var_28 = VV_DATA . '/vvupdate.dat';
    if(!write($var_28, $var_32)){
        ShowMsg('升级失败，无法写入文件', -1, 300000);
    }
    $var_306 = @basename(@getcwd());
    require_once(VV_INC . '/pclzip.class.php');
    $var_81 = new PclZip($var_28);
    if ($var_81 -> extract(PCLZIP_OPT_PATH, VV_ROOT, PCLZIP_OPT_REPLACE_NEWER) == "0"){
        ShowMsg('解压失败，Error : ' . $var_81 -> errorInfo(true), -1, 300000);
    }else{
        if($var_306 && $var_306 != '@admin'){
            if(is_dir(VV_ROOT . '/@admin')){
                copydirs(VV_ROOT . '/@admin', getcwd());
                @removedir(VV_ROOT . '/@admin');
            }
        }
        @unlink($var_28);
        ShowMsg('恭喜您,升级成功!', 'admin_index.php', "0", 5000);
    }
}
?>