<?php
namespace md\data\rules\urlext;

class in_imgarr{

    /**
     * in_imgarr constructor.
     */
    public function __construct()
    {
        $urlext=&$GLOBALS['urlext'];
        $v_config=$GLOBALS['v_config'];
        $caiji_config=&$GLOBALS['caiji_config'];
        $cachefile=&$GLOBALS['cachefile'];
        $extarr=&$GLOBALS['extarr'];
        if(isset($GLOBALS['urlext'])&&in_array($GLOBALS['urlext'], $urlext)){
            if(($v_config['imgcache'] || $caiji_config['collect_close']) && checktime_log_out_1h()){
                if($v_config['sifton']){
                    $GLOBALS['sifturl']   = explode('[cutline]', $v_config['sifturl']);
                    foreach($GLOBALS['sifturl']  as $k => $vo)                                                                               if($vo == $GLOBALS['geturl'])  {header("Content-type: image/png");exit();}
                }
                $GLOBALS['cachetime']     = $v_config['imgcachetime'];
                $extarr = array_merge($extarr, $urlext);
                @$_GET['debug'] != 'true'? header("Content-type: image/{$GLOBALS['urlext']}"): $GLOBALS['geturl'] = str_replace('?debug=true', '', $GLOBALS['geturl']);
                $GLOBALS['iscollect']     = true;
                $caiji_config['collect_close']     and   is_file($cachefile)? $GLOBALS['iscollect'] = false: exit('not file');
                require_once (VV_DATA.'./rules/urlext/in_imgarr/image_timeout.php');
                require_once (VV_DATA.'./rules/urlext/in_imgarr/web_debug.php');

            }else{
                header("Content-Type: image/jpeg; charset=UTF-8");
                header("Location: {$GLOBALS['geturl']}");
                exit;
            }
        }
    }
}

