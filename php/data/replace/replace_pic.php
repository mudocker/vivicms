<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 10:23
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_pic extends BaseGlobal
{
    private $vo;
    function __construct(){
        foreach($this->allimg as  $this->vo){
            $this->scheme();
            $this->threeLink();
            $this->noThree();
        }
          $this->replacePic();

    }


    function replacePic(){
        $this->newpic and  $this->html = str_replace($this->allimg, $this->newpic, $this->html);
        $this->debug[] = '替换所有图片链接用时：' . run_time() . 's';
        run_time(true);
    }






    function noThree(){
        $vo=&$this->vo;
        if(isgoodurl($vo))return;
        is_resdomain($vo) and  $vo = WEB_ROOT . '/img.php?' . encode_source($this->collectid . '|' . $vo);
        $this->newpic[] = $vo;
    }




    function threeLink(){
        $vo=&$this->vo;
        if(!isgoodurl($vo))return;
        if(substr($vo, 0, 1) == '/')                                                                                    $vo = substr($vo, 1);
        else if(stripos($vo, '{') === false)                                                                           $vo = $this->urlpath . $vo;
        $this->newpic[] = get_showurl($vo, 'jpg');

    }
    function scheme(){
        $vo=&$this->vo;
        if(substr($vo, 0, 2) == '//'){
            if(preg_match('~^//[0-9a-zA-Z\.-]+\.[0-9a-zA-Z-]+/~', $vo)) $vo =  $_SERVER["REQUEST_SCHEME"]?  $_SERVER["REQUEST_SCHEME"] . ':'.$vo:$this->scheme . ':' . $vo;
            else $vo = substr($vo, 1);
        }
    }
}