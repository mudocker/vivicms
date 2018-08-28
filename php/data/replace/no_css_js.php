<?php
/**
 * Created by PhpStorm.
 * User: ACER-VERITON
 * Date: 2018/8/28
 * Time: 11:55
 */

namespace md\data\replace;


use md\data\BaseGlobal;

class no_css_js extends BaseGlobal
{

   function __construct(){

        $this->hidejserror();
        $this->no_siteapp();
        $this->caiji_config_css();
        $this->noQS();

       $this->html = preg_replace('~=(["\']*)//(\w+)/~i', '=\\1/\\2/', $this->html);

    }

    function no_siteapp(){
        if(!$this->caiji_config['no_siteapp'])return;

        $this->html = str_ireplace('<head>', '<head><meta http-equiv="Cache-Control" content="no-transform" /><meta http-equiv="Cache-Control" content="no-siteapp" />', $this->html);

    }
    function hidejserror(){
       if (!$this->caiji_config['hidejserror'])  return;

        $this->html = str_ireplace('<head>', '<head><script>var V_PATH="' . WEB_ROOT . '/' . '";window.onerror=function(){ return true; };</script>', $this->html);

    }

    function caiji_config_css(){
        if($this->caiji_config['css']){
            $css = str_replace('{webpath}', WEB_ROOT . '/', $this->caiji_config['css']);
            $this->html = str_ireplace('</head>', '<style>' . $css . '</style></head>', $this->html);
            $this->html = str_ireplace('</body>', '<style>' . $css . '</style></body>', $this->html);
        }
    }
    function noQS(){
        if(empty($_SERVER['QUERY_STRING'])){
            if($this->web_keywords) $this->html = preg_replace('#name\s*=\s*(["|\']*)keywords\\1\s*content=\s*(["|\']*)[^"\']+\\2#i', 'name="keywords" content="' . $this->web_keywords . '"', $this->html);
            if($this->web_description) $this->html = preg_replace('#name\s*=\s*(["|\']*)description\\1\s*content=\s*(["|\']*)[^"\']+\\2#i', 'name="description" content="' . $this->web_description . '"', $this->html);
            if($this->web_seo_name) $this->html = preg_replace('#<title>(.*)</title>#i', '<title>' . $this->web_seo_name . '</title>', $this->html);
            if(is_file(VV_DATA . '/flink.conf')){
                $flinks = file_get_contents(VV_DATA . '/flink.conf');
                if($flinks){
                    $flinks = str_ireplace(array("\r\n", "\r", "\n"), '&nbsp;&nbsp;', $flinks);
                    $this->flinks_auto_insert != 2 and  $this->html = str_ireplace('</body>', '<div style="text-align:center;">' . $flinks . '</div></body>', $this->html);
                }
            }
        }
        $this->html = str_ireplace('{flinks}', $flinks, $this->html);
    }
    function __get($name)
    {
        $value=  parent::__get($name);
        (null===$value )and $value=isset( $this->v_config[$name])? $this->v_config[$name]:null;
        return $value;
    }
    
}