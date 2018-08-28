<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 10:45
 */

namespace md\data\replace;


use md\data\BaseGlobal;


class JS extends BaseGlobal
{
    private $vo;
   function __construct(){
       $isContinue=false;
       foreach($this->alljs as $this->vo){
            $this->scheme();
           $this->threeLink($isContinue);
           if ($isContinue)continue;
           $this->noThreeLink($isContinue);
           if ($isContinue)continue;
       }

    $this->replaceJs();

    }


    function noThreeLink(&$isContinue){
        $vo=&$this->vo;
        $isContinue=false;
        if (isgoodurl($vo))return;
        if(in_array('outjs',$this->caiji_config['siftags']))                                                               {
            $this->newjs[] = 'none';
            $isContinue=true;
            return;
        }
        is_resdomain($vo) and  $vo = WEB_ROOT . '/js.php?' . encode_source($this->collectid . '|' . $vo);
        $this->newjs[] = $vo;
    }
    function scheme(){
        $vo=&$this->vo;
        if(substr($vo, 0, 2) != '//')return;
        $vo = preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)? $_SERVER["REQUEST_SCHEME"]? $_SERVER["REQUEST_SCHEME"] . ':' . $vo: $this->scheme . ':' . $vo:substr($vo, 1);

    }

    function threeLink(&$isContinue){
        $vo=&$this->vo;
        $isContinue=false;
       if (!isgoodurl($vo))return;
        if(substr($vo, 0, 1) == '/')                                                                                    $vo = substr($vo, 1);
        else if(stripos($vo, '{') === false)                                                                           $vo = $this->urlpath . $vo;
        if(in_array('localjs', $this->caiji_config['siftags'])) {
            $this->newjs[] = 'none';
            $isContinue=true;
            return;
        }
        $this->newjs[] = get_showurl($vo, 'js');
    }
    function replaceJs(){
       $this->newjs and  $this->html = str_replace($this->alljs, $this->newjs, $this->html);
        $this->debug[] = '替换所有JS链接用时：' . run_time() . 's';
        run_time(true);
    }

}