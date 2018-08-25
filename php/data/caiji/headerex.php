<?php
namespace md\data\caiji;

class headerex{


    private $url;
    private $post;

    public function __construct($url,$post,&$cacheurlfile,&$lasturl,&$btcachefile)
    {
        $this->url=$url;
        $this->post=$post;
        $this->downUrl($cacheurlfile,$lasturl);
        $this->downBtFile($btcachefile);

    }

    function downUrl(&$cacheurlfile,&$lasturl){
        $cacheurlfile = VV_CACHE . "/redirect_url/" . substr(md5($this->url . $this->post), 0, 16) . '.txt';
        if(is_file($cacheurlfile)){
            $lasturl = file_get_contents($cacheurlfile);
            header('HTTP/1.1 301 Moved Permanently');
            header("Location: $lasturl");
            exit;
        }
    }

    function downBtFile(&$btcachefile){
        $btcachefile = VV_CACHE . "/btfile/" . substr(md5($this->url), 0, 16) . '.bt';
        if(is_file($btcachefile)){
            header("Content-Type: application/x-bittorrent");
            header("Content-Disposition: attachment; filename=" . md5($this->url) . ".torrent;");
            exit;
        }
    }

}
