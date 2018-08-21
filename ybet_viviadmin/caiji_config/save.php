<?php
if($ac == 'save'){
    $config = $_POST['con'];
    foreach($config as $k => $vo){
        if(is_array($config[$k])){
            foreach($config[$k]as $kk => $vv){
                $config[$k][$kk] = utf2gbk(get_magic(trim($vv)));
            }
        }else{
            $config[$k] = utf2gbk(get_magic(trim($config[$k])));
        }
    }
    $zdy = $_POST['zdy'];
    if($zdy){
        foreach($zdy as $k => $vo){
            foreach($vo as $kk => $vv){
                $zdy[$k][$kk] = utf2gbk(get_magic(trim($vv)));
                if(in_array($kk, array('name', 'ename')) && $zdy[$k][$kk] == ''){
                    unset($zdy[$k]);
                }
            }
        }
    }
    $config['zdy'] = $zdy;
    if($config['replacerules']){
        if(!preg_match('#\{vivicut\}#', $config['replacerules'])){
        }
    }
    if($config['plus']){
        $config['plus'] = implode(',', $config['plus']);
    }else{
        $config['plus'] = '';
    }
    if($config['siftrules']){
        $config['siftrules'] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $config['siftrules']);
        $siftrules = explode('[cutline]', $config['siftrules']);
        foreach($siftrules as $k => $vo){
            if(!preg_match('#\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}$#', trim($vo))){
                ajaxReturn(array('status' => 0, 'info' => "过滤规则的正则表达式格式不正确"));
            }
        }
        $config['siftrules'] = implode("[cutline]", $siftrules);
    }
    if($config['replacerules_before']){
        if(!preg_match('#\{vivicut\}#', $config['replacerules_before'])){
        }
    }
    if($config['siftrules_before']){
        $config['siftrules_before'] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $config['siftrules_before']);
        $siftrules_before = explode('[cutline]', $config['siftrules_before']);
        foreach($siftrules_before as $k => $vo){
            if(!preg_match('#\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}$#', trim($vo))){
                ajaxReturn(array('status' => 0, 'info' => "过滤规则的正则表达式格式不正确"));
            }
        }
        $config['siftrules_before'] = implode("[cutline]", $siftrules_before);
    }
    $file = VV_DATA . '/config/' . $id . '.php';
    if(is_file($file)){
        $caiji_config = require_once($file);
        $config = array_merge($caiji_config, $config);
    }
    $config = array_merge($config, array('siftags' => @$_POST['siftags'], 'time' => time()));
    $result = arr2file($file, $config);
    if($result === false){
        ajaxReturn(array('status' => 1, 'info' => "修改失败，检查文件写入权限！"));
    }
    ajaxReturn(array('status' => 1, 'info' => "恭喜你,修改成功！"));
}