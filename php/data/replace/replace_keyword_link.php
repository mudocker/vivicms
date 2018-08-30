<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/29
 * Time: 18:39
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class replace_keyword_link extends BaseGlobal
{
    function __construct(){
        if (!isCanReplaceHtml())return;
        if(!$this->v_config['linkword_on'])return;
        $link_config = getKeyworkLink();
        if(!$link_config)return;
        run_time(true);
        $this->html = link_word($this->html, $link_config);
        $this->debug[] = '关键词内链用时：' . run_time() . 's';

    }

    function link_word($html, $link_config){
        if(empty($html)) return $html;

        $htmlArr = explode('</head>', $html);
        $html = $htmlArr[1]?$htmlArr[1]:$htmlArr[0];
        preg_match_all('~(<[^>]+>)~iUs', $html, $match);
        $newStrArr = array();
        if($match){
            foreach($match[1]as $k => $vo){
                $newStrArr[] = $newstr = '|||' . base64_encode($vo) . '|||';
                $html = str_replace($vo, $newstr, $html);
            }
        }
        $arr = explode('|||', $link_config);

        foreach($arr as $k => $vo){
            if(trim($vo) == '')continue;
            list($l, $r) = explode(',', $vo);
            $l = str_replace('~', '\~', $l);
            $html = str_replace($l, '<a href="' . $r . '" target="_blank">' . $l . '</a>', $html);
        }
        if($newStrArr){
            foreach($newStrArr as $k => $vo){
                $newstr = base64_decode(substr($vo, 2, -3));
                $html = str_replace($vo, $newstr, $html);
            }
        }
        $htmlArr[1] and  $html = $htmlArr[0] . '</head>' . $html;

        return $html;
    }
}