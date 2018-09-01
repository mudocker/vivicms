<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_2 = isset($_GET ["collectid"])?$_GET ["collectid"]:"";
$var_14 = isset($_GET ["ac"])?$_GET ["ac"]:"";
$var_2 = intval($var_2);
$var_89 = VV_DATA . "/config/{$var_2}.php";
if($var_2 && is_file($var_89)){
    $caiji_config = require($var_89);
    $var_7 = parse_url($caiji_config["from_url"]);
    $var_90 = $var_7["host"] . '.' . $var_2;
}else{
    $var_90 = "";
}
if ($var_14 == ""){
    echo ADMIN_HEAD; ;
    echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . ' ';
    include 'welcome.php';
    echo '  <div class="right_main">' . "\r\n" . '<table width="98%" cellspacing="1" cellpadding="4" border="0" class="tableoutline">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr class="tb_head">' . "\r\n\t\t\t" . '<td><h2>';
    echo $var_2?'节点':'全局';
    echo '缓存清除：</h2></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tbody id="config2">' . "\r\n\t\t" . '<tr align=center class="firstalt">' . "\r\n" . '          <td width="30%">缓存说明</td>' . "\r\n" . '          <td width="30%">缓存目录</td>' . "\r\n\t\t" . '  <td width="20%">缓存大小</td>' . "\r\n" . '          <td width="20%">操作</td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr align=center class="firstalt">' . "\r\n" . '          <td>首页缓存</td>' . "\r\n" . '          <td>../data/cache/index/';
    echo $var_90;
    echo '</td>' . "\r\n\t\t" . '  <td style="color: #FF0000;" id="getindexsize"><a href="javascript:" onclick=\'getdirsize("index");\'>点击获取</a></td>' . "\r\n" . '          <td style="text-align:center"><input type="button" class="bginput" style="height:19px; font-size:12px" value="清除" onClick="javascript:location.href=\'?ac=del&del=index&collectid=';
    echo $var_2;
    echo '\';" name="Input"></td>' . "\r\n" . '        </tr>' . "\r\n" . '        <tr align=center class="firstalt">' . "\r\n" . '          <td>其他页缓存</td>' . "\r\n" . '          <td >../data/cache/html/';
    echo $var_90;
    echo '</td>' . "\r\n\t\t" . '  <td style="color: #FF0000;" id="gethtmlsize"><a href="javascript:" onclick=\'getdirsize("html");\'>点击获取</a></td>' . "\r\n" . '          <td style="text-align:center"><input type="button" class="bginput" style="height:19px; font-size:12px" value="清除" onClick="javascript:location.href=\'?ac=del&del=other&collectid=';
    echo $var_2;
    echo '\';" name="Input"></td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr align=center class="firstalt">' . "\r\n" . '          <td>css缓存</td>' . "\r\n" . '          <td >../data/cache/css/';
    echo $var_90;
    echo '</td>' . "\r\n\t\t" . '  <td style="color: #FF0000;" id="getcsssize"><a href="javascript:" onclick=\'getdirsize("css");\'>点击获取</a></td>' . "\r\n" . '          <td style="text-align:center"><input type="button" class="bginput" style="height:19px; font-size:12px" value="清除" onClick="javascript:location.href=\'?ac=del&del=css&collectid=';
    echo $var_2;
    echo '\';" name="Input"></td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr align=center class="firstalt">' . "\r\n" . '          <td>js缓存</td>' . "\r\n" . '          <td >../data/cache/js/';
    echo $var_90;
    echo '</td>' . "\r\n\t\t" . '  <td style="color: #FF0000;" id="getjssize"><a href="javascript:" onclick=\'getdirsize("js");\'>点击获取</a></td>' . "\r\n" . '          <td style="text-align:center"><input type="button" class="bginput" style="height:19px; font-size:12px" value="清除" onClick="javascript:location.href=\'?ac=del&del=js&collectid=';
    echo $var_2;
    echo '\';" name="Input"></td>' . "\r\n" . '        </tr>' . "\r\n\t";
    if(!$var_2){;
        echo "\t\t" . '<tr align=center class="firstalt">' . "\r\n" . '          <td>图片缓存</td>' . "\r\n" . '          <td >../data/cache/img</td>' . "\r\n\t\t" . '  <td style="color: #FF0000;" id="getimgsize"><a href="javascript:" onclick=\'getdirsize("img");\'>点击获取</a></td>' . "\r\n" . '          <td style="text-align:center"><input type="button" class="bginput" style="height:19px; font-size:12px" value="清除" onClick="javascript:location.href=\'?ac=del&del=img\';" name="Input"></td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr align=center class="firstalt">' . "\r\n" . '          <td>URL重定向缓存</td>' . "\r\n" . '          <td >../data/cache/redirect_url</td>' . "\r\n\t\t" . '  <td style="color: #FF0000;" id="getredirectsize"><a href="javascript:" onclick=\'getdirsize("redirect");\'>点击获取</a></td>' . "\r\n" . '          <td style="text-align:center"><input type="button" class="bginput" style="height:19px; font-size:12px" value="清除" onClick="javascript:location.href=\'?ac=del&del=redirect\';" name="Input"></td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr align=center class="firstalt">' . "\r\n" . '          <td>蜘蛛爬行记录</td>' . "\r\n" . '          <td >../data/zhizhu.txt</td>' . "\r\n\t\t" . '  <td style="color: #FF0000;">';
        echo @round(@filesize(VV_DATA . '/zhizhu.txt') / 1024, 2);
        echo ' KB</td>' . "\r\n" . '          <td style="text-align:center"><input type="button" class="bginput" style="height:19px; font-size:12px" value="清除" onClick="javascript:location.href=\'?ac=del&del=zhizhu\';" name="Input"></td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr align=center class="firstalt">' . "\r\n" . '          <td >一键清除全部缓存</td>' . "\r\n" . '          <td >&nbsp;</td>' . "\r\n\t\t" . '  <td>&nbsp;</td>' . "\r\n" . '          <td style="text-align:center"><input type="button" class="bginput" style="height:19px; font-size:12px" value="清除" onClick="javascript:location.href=\'?ac=del&del=all\';" name="Input"></td>' . "\r\n" . '        </tr>' . "\r\n\t";
    } ;
    echo "\t";
    if($var_2){;
        echo "\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td align="center" colspan="10">' . "\r\n\t\t\t" . '<input type="button" onclick="javascript:location.href=\'caiji_config.php\';" value=" 返回节点 " name="Input" class="bginput"></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t";
    } ;
    echo "\t" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'function getdirsize(id){' . "\r\n\t" . 'var elem=\'#get\'+id+\'size\';' . "\r\n\t" . '$(elem).html(\'<img src="../public/img/load.gif"> 计算中...\');' . "\r\n\t" . '$.get("?ac=get"+id+"size&collectid=';
    echo $var_2;
    echo '&_t="+Math.random()*10,function(data){' . "\r\n\t" . '  $(elem).html(data);' . "\r\n\t" . '});' . "\r\n" . '}' . "\r\n" . '</script>' . "\r\n";
    include 'footer.php';
    echo '</body>' . "\r\n" . '</html>' . "\r\n";
}elseif($var_14 == 'getindexsize'){
    $var_52 = $var_2?'/' . $var_90:"";
    echo @getRealSize(@getDirSize(VV_CACHE . '/index' . $var_52)) . ' MB';
}elseif($var_14 == 'gethtmlsize'){
    $var_52 = $var_2?'/' . $var_90:"";
    $var_52 = VV_CACHE . '/html' . $var_52;
    echo @getRealSize(@getDirSize($var_52)) . ' MB';
}elseif($var_14 == 'getjssize'){
    $var_52 = $var_2?'/' . $var_90:"";
    echo @getRealSize(@getDirSize(VV_CACHE . '/js' . $var_52)) . ' MB';
}elseif($var_14 == 'getredirectsize'){
    echo @getRealSize(@getDirSize(VV_CACHE . '/redirect_url')) . ' MB';
}elseif($var_14 == 'getcsssize'){
    $var_52 = $var_2?'/' . $var_90:"";
    echo @getRealSize(@getDirSize(VV_CACHE . '/css' . $var_52)) . ' MB';
}elseif($var_14 == 'getimgsize'){
    echo @getRealSize(@getDirSize(VV_CACHE . '/img')) . ' MB';
}elseif($var_14 == 'del'){
    $var_52 = $var_2?'/' . $var_90:"";
    if($_GET["del"] == 'zhizhu'){
        @unlink(VV_DATA . '/zhizhu.txt');
    }elseif($_GET["del"] == 'index'){
        @removedir(VV_CACHE . '/index' . $var_52);
    }elseif($_GET["del"] == 'other'){
        @removedir(VV_CACHE . '/html' . $var_52);
    }elseif($_GET["del"] == 'css'){
        @removedir(VV_CACHE . '/css' . $var_52);
    }elseif($_GET["del"] == 'js'){
        @removedir(VV_CACHE . '/js' . $var_52);
    }elseif($_GET["del"] == 'img'){
        @removedir(VV_CACHE . '/img');
    }elseif($_GET["del"] == 'redirect'){
        @removedir(VV_CACHE . '/redirect_url');
    }elseif($_GET["del"] == 'all'){
        @removedir(VV_CACHE);
        @unlink(VV_DATA . '/zhizhu.txt');
    }
    $var_91 = $var_2?('delcache.php?collectid=' . $var_2):'delcache.php';
    ShowMsg('恭喜你,缓存清除成功！', $var_91, 2000);
}
?>