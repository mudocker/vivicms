<?php
if($config['siftrules']){
    $config['siftrules'] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $config['siftrules']);
    $siftrules = explode('[cutline]', $config['siftrules']);
    foreach($siftrules as $k => $vo){
        !preg_match('#\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}$#', trim($vo)) and  ajaxReturn(array('status' => 0, 'info' => "过滤规则的正则表达式格式不正确"));
    }
    $config['siftrules'] = implode("[cutline]", $siftrules);
}