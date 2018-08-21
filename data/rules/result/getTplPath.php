<?php
$tplfile = VV_TMPL . '/index.html';
if($caiji_config['tplfile']){
    $caiji_config['tplfile'] = str_replace('..', '', $caiji_config['tplfile']);
    $caiji_tplfile = VV_TMPL . '/' . $caiji_config['tplfile'];
    is_file($caiji_tplfile) and $tplfile = $caiji_tplfile;
}