<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 9:46
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class meta_content_frame extends BaseGlobal
{

   function __construct(){


    $this->replaceHeaderBody();
    $this->getBodyStartEnd();
    $this->toUtf8();
    $this->base();
    $this->delApplet();
    $this->delNoframes();
    $this->replaceHeaderBody();
    $this->hrefToDoubleQuotationMarks();


     $this->replaceHref();
   }


   function hrefToDoubleQuotationMarks(){
       $this->html = preg_replace('#<(a[^>]+)href\s*=\s*\'([^\']+)\'#i', '<\\1href="\\2"', $this->html);
   }

    function replaceHref(){
        $this->html = str_ireplace('href', 'href', $this->html);
    }

    function replaceDocTypeWH(){
       $this->html = str_ireplace('?<!DOCTYPE', '<!DOCTYPE', $this->html);
   }

   function replaceMetaContent(){
       $this->html = preg_replace('#content=\s*(["|\']*)([^"\'>]+)\\1\s*name\s*=\s*(["|\']*)keywords\\3#i', 'name="keywords" content="\\2"', $this->html);
       $this->html = preg_replace('#content=\s*(["|\']*)([^"\'>]+)\\1\s*name\s*=\s*(["|\']*)description\\3#i', 'name="description" content="\\2"', $this->html);
       $this->html = preg_replace('#<meta[^>]+name\s*=\s*(["|\']*)keywords[^>]+content\s*=\s*(["|\']*)([^"\'>\s*]+)\\2#i', '<meta name="keywords" content="\\3"', $this->html);
       $this->html = preg_replace('#<meta[^>]+name\s*=\s*(["|\']*)description[^>]+content\s*=\s*(["|\']*)([^"\'>\s*]+)\\2#i', '<meta name="description" content="\\3"', $this->html);
   }

   function delNoframes(){
       $this->html = preg_replace("/<(noframes.*?)>(.*?)<(\/noframes.*?)>/si", "", $this->html);
       $this->html = preg_replace("/<(\/?noframes.*?)>/si", "", $this->html);
   }
   function  delApplet(){
       $this->html = preg_replace("/<(applet.*?)>(.*?)<(\/applet.*?)>/si", "", $this->html);
       $this->html = preg_replace("/<(\/?applet.*?)>/si", "", $this->html);
   }

    function base(){

        if(!preg_match("~<base\s*href\s*=\s*([\"|']?)([^\"'>]+)\\1~iUs", $this->html, $match))return;
            if($match[2]){
                $this->parse_url = parse_url($match[2]);
                $this->urlpath = geturlpath($this->parse_url);
            }
            $this->html = preg_replace("/<base[^>]+>/si", "", $this->html);

    }
   function getBodyStartEnd(){
       if (!$this->caiji_config['body_start'])return;
       if (!$this->caiji_config['body_end'])return;
       list($headstr, $str2) = explode('<body>', $this->html);
        list($bodystr, $str3) = explode('</body>', $str2);
       $bodystr = strcut($this->caiji_config['body_start'], $this->caiji_config['body_end'], $bodystr);
        $bodystr and $this->html = $headstr . '<body>' . $bodystr . '</body>' . $str3;

   }

     function replaceHeaderBody(){
        $this->html = str_ireplace('</head>', '</head>', $this->html);
        $this->html = str_ireplace('</body>', '</body>', $this->html);
         $this->html = preg_replace('~<(/?body[^>]*)>~i', '<\\1>', $this->html);
    }



    function toUtf8(){
        $this->html = preg_replace('#content=\s*(["|\']*)\s*text/html;\s*charset[^"\']+\\1#i', 'content="text/html; charset=utf-8"', $this->html);
        $this->html = preg_replace('#<meta charset="[^"]+">#i', '<meta charset="utf-8">', $this->html);
        $this->html = preg_replace('#<meta charset=\'[^\']+\'>#i', '<meta charset="utf-8">', $this->html);
    }




}