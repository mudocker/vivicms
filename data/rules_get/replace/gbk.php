<?php
$GLOBALS['urlext'] != 'js' and  $GLOBALS['html'] = replace_css($GLOBALS['html']);
if($GLOBALS['urlext'] != 'js' && $GLOBALS['urlext'] != 'css'){
    if($caiji_config['big52gbk'] && checktime_log_out_1h()){
        run_time(true);
        if(preg_match_all("#>\s*(\S*)\s*<#Us", $GLOBALS['html'], $arr)){
            $arr[1] = array_unique($arr[1]);
            $gbarr = $big5arr = array();
            include(VV_DATA . '/big5.php');
            if($caiji_config['big52gbk'] == 'togbk')$func = 'simplified';
            if($caiji_config['big52gbk'] == 'tobig5')$func = 'traditionalized';
            foreach($arr[1]as $k => $vo) if(preg_match('/[^\x00-\x80]/', $vo)){
                $gbarr[] = $arr[1][$k];
                $big5arr[] = $func($arr[1][$k]);
            }

            $GLOBALS['html'] = str_replace($gbarr, $big5arr, $GLOBALS['html']);
        }
        $GLOBALS['debug'][] = '繁简互转用时：' . run_time() . 's';
    }
    $GLOBALS['html'] = preg_replace("~<(script[^>]+)src\s*=\s*([\"|']?)none\\2([^>]*)>(.*?)<\/script>~si", "", $GLOBALS['html']);
    $GLOBALS['html'] = preg_replace("~<(a[^>]+)href\s*=\s*([\"|']?)none\\2([^>]*)>(.*?)<\/a>~si", "\\4", $GLOBALS['html']);
}