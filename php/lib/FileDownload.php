<?php

namespace md\lib;




class FileDownload{

    private $_speed = 512;


    /** 下载
    * @param String  $file_path   要下载的文件路径
    * @param String  $file_name   文件名称,为空则与下载的文件名称一样
    * @param boolean $reload 是否开启断点续传
    */
    public function download($file_path, $file_name='', $reload=true){
        if(!file_exists($file_path))return '';
            $file_name=='' and  $file_name = basename($file_path);
            $fp = fopen($file_path, 'rb');
            $file_size = filesize($file_path);
            $ranges = $this->getRange($file_size);
            header('cache-control:public');
            header('content-type:application/octet-stream');
            header('content-disposition:attachment; filename='.$file_name);
            if($reload && $ranges!=null) $this->reload($fp,$ranges,$file_size);
            else{
                header('HTTP/1.1 200 OK');
                header('content-length:'.$file_size);
            }

            while(!feof($fp)){
                echo fread($fp, round($this->_speed*1024,0));
                ob_flush();
                //sleep(1); // 用于测试,减慢下载速度
            }
          $fp!=null and  fclose($fp);
    }

    function reload(&$fp,&$ranges,&$file_size){
        header('HTTP/1.1 206 Partial Content');
        header('Accept-Ranges:bytes');
        header(sprintf('content-length:%u',$ranges['end']-$ranges['start']));                                // 剩余长度
        header(sprintf('content-range:bytes %s-%s/%s', $ranges['start'], $ranges['end'], $file_size));    // range信息
        fseek($fp, sprintf('%u', $ranges['start']));                                                            // fp指针跳到断点位置
    }

    public function setSpeed($speed){
        (is_numeric($speed) && $speed>16 && $speed<4096) and  $this->_speed = $speed;
    }


    private function getRange($file_size){
        if (!isset($_SERVER['HTTP_RANGE']))  return null;
        if (empty($_SERVER['HTTP_RANGE'])) return null;
        $range = $_SERVER['HTTP_RANGE'];
        $range = preg_replace('/[\s|,].*/', '', $range);
        $range = explode('-', substr($range, 6));
        count($range)<2 and  $range[1] = $file_size;
        $range = array_combine(array('start','end'), $range);
        empty($range['start']) and  $range['start'] = 0;
        empty($range['end']) and  $range['end'] = $file_size;
        return $range;

    }

}





?>
