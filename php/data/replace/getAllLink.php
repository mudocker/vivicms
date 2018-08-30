<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 10:16
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class getAllLink extends BaseGlobal
{


     function __construct(){
        if (!isCanReplaceHtml())return;
        $this->getAllLink();
        $this->countLinkDebug();
        $this->siftags();
    }

    function siftags(){
        $this->caiji_config['siftags'] = $this->caiji_config['siftags']? $this->caiji_config['siftags']:array();
        run_time(true);
    }

    function countLinkDebug(){
        $this->debug[] = '获取所有资源链接用时：' . run_time() . 's';
        $this->debug[] = '超链接总数：' . count($this->allhtml);
        $this->debug[] = '图片链接总数：' . count($this->allimg);
        $this->debug[] = 'css链接总数：' . count($this->allcss);
        $this->debug[] = 'js链接总数：' . count($this->alljs);
    }
    function getAllLink(){
        $this->allhtml    = $this->allcss = $this->alljs = $this->allimg = $this->newhref = $this->newcss = $this->newjs = $this->newimg = array();
        run_time(true);
        $this->allhtml     = getallhref($this->html);


        $this->allimg      = getallimg($this->html);
        $this->alljs       = getalljs($this->html);
        $this->allcss      = getallcss($this->html);
    //    $this->allhtml     = array_diff($this->allhtml, $this->allcss, $this->alljs, $this->allimg);
    }




}