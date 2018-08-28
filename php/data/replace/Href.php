<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 11:10
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class Href extends BaseGlobal
{


    private $vo;
    function __construct(){
        sort($allhref);
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


    function ttt(){
        sort($allhref);
        foreach($allhref as $k => $vo){
            if(strlen($vo) <= 1 || stripos($vo, 'javascript:') > -1)                                                      continue;

            $this->oldurl = $vo;
             $this->scheme();
            $this->threeLink($isContinue);
            if ($isContinue)continue;
            $this->noThreeLink();
        }
        $this->debug[] = '替换所有超链接用时：' . run_time() . 's';
    }



    function noThreeLink(){
        $vo=&$this->vo;
        if(preg_match('~^(magnet|thunder|ftp)~i', $vo)) return;
         if ( ! in_array('outa', $this->caiji_config['siftags']))return;
         $this->html = str_replace('"' . $this->oldurl . '"', '"none"', $this->html);
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
        if (!isgoodurl($vo))return;
        if(in_array('locala', $this->caiji_config['siftags'])){
            $this->html = preg_replace("~<a[^>]+href\s*=\s*([\"|']?){$vo}\\1[^>]+>(.*)</a>~i", '\\1', $this->html);
            $isContinue=true;
            return;
        }
        if(substr($vo, 0, 1) == '/')                                                                                 $vo = substr($vo, 1);
        else if(stripos($vo, '{') === false)                                                                       $vo = $this->urlpath . $vo;
        if(SCRIPT == 'search' && substr($vo, 0, 1) == '?')       {
            $isContinue=true;
            return;
        }                                        
        $this->newurl = get_showurl($vo, $this->v_config['web_urlencode_suffix']);
        strpos($this->html, '"' . $this->oldurl . '"') > -1                                                        and  $this->html = str_replace('"' . $this->oldurl . '"', '"' . $this->newurl . '"', $this->html);
        strpos($this->html, 'href=' . $this->oldurl) > -1                                                          and  $this->html = str_replace('href=' . $this->oldurl, 'href=' . $this->newurl, $this->html);
    }
    function replaceCss(){
        $this->debug[] = '替换所有超链接用时：' . run_time() . 's';
    }
}