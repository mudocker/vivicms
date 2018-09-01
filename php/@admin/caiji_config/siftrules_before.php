<?php
if($config['siftrules_before']){
    $config['siftrules_before'] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $config['siftrules_before']);
    $siftrules_before = explode('[cutline]', $config['siftrules_before']);
    foreach($siftrules_before as $k => $vo){
        !preg_match('#\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}$#', trim($vo)) and  ajaxReturn(array('status' => 0, 'info' => "过滤规则的正则表达式格式不正确"));
    }
    $config['siftrules_before'] = implode("[cutline]", $siftrules_before);
}