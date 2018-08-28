<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 11:02
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class css extends BaseGlobal
{


    private $vo;
    function __construct(){
        $isContinue=false;
        foreach($this->allcss as $this->vo){
            $this->scheme();
            $this->threeLink($isContinue);
            if ($isContinue)continue;
            $this->noThreeLink($isContinue);
            if ($isContinue)continue;
        }

        $this->replaceCss();

    }



    function noThreeLink(&$isContinue){
        $vo=&$this->vo;
        $isContinue=false;
        if(in_array('outcss', $this->caiji_config['siftags'])){
            $this->newcss[] = 'none';
            $isContinue=true;
            return;
        }
        is_resdomain($vo) and      $vo = WEB_ROOT . '/css.php?' . encode_source($this->collectid . '|' . $vo);
        $this->newcss[] = $vo;
    }
    function scheme(){
        $vo=&$this->vo;
        if(substr($vo, 0, 2) != '//')return;

            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)){
                if($_SERVER["REQUEST_SCHEME"])                                                                          $vo = $_SERVER["REQUEST_SCHEME"] . ':' . $vo;
                else                                                                                                         $vo =  $this->scheme . ':' . $vo;

            }else $vo = substr($vo, 1);


    }

    function threeLink(&$isContinue){
        $vo=&$this->vo;
        $isContinue=false;
        if(substr($vo, 0, 1) == '/')                             $vo = substr($vo, 1);
        else if(stripos($vo, '{') === false)                    $vo = $this->urlpath . $vo;

        if(in_array('localcss', $this->caiji_config['siftags'])){
            $this->newcss[] = 'none';
            $isContinue=true;
            return;

        }
        $this->newcss[] = get_showurl($vo, 'css');
    }
    function replaceCss(){
        $this->newcss and $this->html = str_replace($this->allcss, $this->newcss, $this->html);

        $this->debug[] = '替换所有css链接用时：' . run_time() . 's';
        run_time(true);
    }
}