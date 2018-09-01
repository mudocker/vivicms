<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
if(isset($_GET["del"]) && $_GET["del"] == 'yes'){
    @unlink(VV_DATA . '/zhizhu.txt');
    ShowMsg('蜘蛛访问清除完毕！', 'zhizhu.php', 500);
}
echo ADMIN_HEAD; ;
echo '<style type="text/css">' . "\r\n" . '<!--' . "\r\n" . 'body,td,th {' . "\r\n\t" . 'font-size: 12px;' . "\r\n" . '}' . "\r\n" . 'p {' . "\t\r\n\t" . 'margin: 0 0 10px 5px;' . "\r\n" . '}' . "\r\n" . '.f {color: #CCCCCC}' . "\r\n" . '-->' . "\r\n" . '</style>' . "\r\n\r\n" . '<body>' . "\r\n\r\n" . '<div class="right">' . "\r\n" . '  ';
include 'welcome.php'; ;
echo '  <div class="right_main">' . "\r\n\r\n" . ' <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n" . ' <tr nowrap  class="tb_head">' . "\r\n" . '      <td colspan="5" id="a"><h2>蜘蛛访问记录（仅显示最近3万条）&nbsp;&nbsp;<a href="?del=yes" style=\'color:red\'>清除记录</a></h2></td>' . "\r\n" . ' </tr>' . "\r\n";
$var_28 = VV_DATA . '/zhizhu.txt';
$var_99 = isset($_GET["type"])?$_GET["type"]:"";
$var_44 = "";
if(is_file($var_28)){
    $var_66 = file($var_28);
    $var_100 = count($var_66);
    $var_101 = array("baidu" => "0", "baidu_today" => "0", "baidu_yestoday" => "0", "360" => "0", "360_today" => "0", "360_yestoday" => "0", "google" => "0", "google_today" => "0", "google_yestoday" => "0", "shenma" => "0", "shenma_today" => "0", "shenma_yestoday" => "0", "sogou" => "0", "sogou_today" => "0", "sogou_yestoday" => "0", "yahoo" => "0", "yahoo_today" => "0", "yahoo_yestoday" => "0", "other" => "0", "other_today" => "0", "other_yestoday" => "0",);
    if($var_66){
        foreach ($var_66 as $var_102 => $var_31){
            if(trim($var_66[$var_102]) == "") continue;
            $var_25 = $var_100 - $var_102;
            list($var_29, $var_43, $var_103, $var_104) = explode('---', $var_66[$var_102]);
            if($var_43 == 'Baidu'){
                $var_101["baidu"]++;
            }else if($var_43 == '360搜索'){
                $var_101["360"]++;
            }else if($var_43 == 'Google'){
                $var_101["google"]++;
            }else if($var_43 == '神马搜索'){
                $var_101["shenma"]++;
            }else if($var_43 == 'Sogou'){
                $var_101["sogou"]++;
            }else if($var_43 == 'Yahoo!'){
                $var_101["yahoo"]++;
            }else{
                $var_101["other"]++;
            }
            if($var_99 && $var_99 != $var_43){
                continue;
            }
            if(date('Y-m-d') == date('Y-m-d', strtotime($var_104))){
                $var_104 = '<font color=red>' . $var_104 . '</font>';
                if($var_43 == 'Baidu'){
                    $var_101["baidu_today"]++;
                }else if($var_43 == '360搜索'){
                    $var_101["360_today"]++;
                }else if($var_43 == 'Google'){
                    $var_101["google_today"]++;
                }else if($var_43 == '神马搜索'){
                    $var_101["shenma_today"]++;
                }else if($var_43 == 'Sogou'){
                    $var_101["sogou_today"]++;
                }else if($var_43 == 'Yahoo!'){
                    $var_101["yahoo_today"]++;
                }else{
                    $var_101["other_today"]++;
                }
            }
            if(date('Y-m-d', strtotime($var_104)) == date('Y-m-d', strtotime('-1 day'))){
                if($var_43 == 'Baidu'){
                    $var_101["baidu_yestoday"]++;
                }else if($var_43 == '360搜索'){
                    $var_101["360_yestoday"]++;
                }else if($var_43 == 'Google'){
                    $var_101["google_yestoday"]++;
                }else if($var_43 == '神马搜索'){
                    $var_101["shenma_yestoday"]++;
                }else if($var_43 == 'Sogou'){
                    $var_101["sogou_yestoday"]++;
                }else if($var_43 == 'Yahoo!'){
                    $var_101["yahoo_yestoday"]++;
                }else{
                    $var_101["other_yestoday"]++;
                }
            }
            $var_103 = htmlspecialchars($var_103);
            $var_105 = $var_103;
            if(strlen($var_103) > 65) $var_105 = substr($var_103, "0", 65) . '...';
            $var_103 = '<a target=_blank title="打开此链接" href=' . $var_103 . '>' . $var_105 . '</a>';
            $var_44[] = array("id" => $var_25, "name" => $var_43, "ip" => $var_29, "url" => $var_103, "time" => $var_104);
        }
        $var_39 = isset($_GET["page"])?$_GET["page"]:1;
        $var_55 = 15;
        $var_56 = count($var_44);
        $var_106 = ceil($var_56 / $var_55);
        if($var_39 > $var_106){
            $var_39 = $var_106;
        }
        $var_44 = array_slice($var_44, ($var_39-1) * $var_55, $var_55);
        $var_62 = '?page={!page!}';
        if($var_99){
            $var_62 .= '&type=' . $var_99;
        }
        $var_107 = get_page($var_39, $var_106, $var_62);
    }
} ;
echo '<style type="text/css">' . "\r\n" . '.page{clear:both;padding:20px 0;color:#0066ff;text-align:center;font-size:14px;}' . "\r\n" . '.page span,.page a{display:inline-block;padding:2px 6px;}' . "\r\n" . '.page span{margin:0 5px;color:#fff;background:#3399ff;}' . "\r\n" . '.page a{color:#0066ff;margin:0 5px;border:1px solid #3399ff;border-radius:3px;font-weight:700;}' . "\r\n" . '.page a:hover{color:#fff;background-color:#3399ff;text-decoration:none;}' . "\r\n" . '.rtable td {border-bottom: 1px solid #EBEBEB;}' . "\r\n" . '.rtable {background-color: #fff;}' . "\r\n" . '.headt a{color:#3333cc}' . "\r\n" . '</style>' . "\r\n" . '<tr class="firstalt">' . "\r\n\t" . '<td colspan="5">' . "\r\n\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="0" class="tableoutline rtable">' . "\r\n\t\t\t" . '<tr class="firstalt headt">' . "\r\n\t\t\t\t" . '<td>类型</td>' . "\r\n\t\t\t\t" . '<td><a href="?type=Baidu">百度</a></td>' . "\r\n\t\t\t\t" . '<td><a href="?type=360搜索">360</a></td>' . "\r\n\t\t\t\t" . '<td><a href="?type=Google">Google</a></td>' . "\r\n\t\t\t\t" . '<td><a href="?type=神马搜索">神马</a></td>' . "\r\n\t\t\t\t" . '<td><a href="?type=Sogou">Sogou</a></td>' . "\r\n\t\t\t\t" . '<td><a href="?type=Yahoo!">Yahoo!</a></td>' . "\r\n\t\t\t\t" . '<td>其他</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td><font color="red">今日</font></td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["baidu_today"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["360_today"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["google_today"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["shenma_today"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["sogou_today"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["yahoo_today"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["other_today"];
echo '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td>昨日</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["baidu_yestoday"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["360_yestoday"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["google_yestoday"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["shenma_yestoday"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["sogou_yestoday"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["yahoo_yestoday"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["other_yestoday"];
echo '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td>合计</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["baidu"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["360"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["google"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["shenma"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["sogou"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["yahoo"];
echo '</td>' . "\r\n\t\t\t\t" . '<td>';
echo $var_101["other"];
echo '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</table>' . "\r\n\t" . '</td>' . "\r\n" . '</tr>' . "\r\n";
if($var_99){;
    echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td colspan="8"><font color="blue">当前为“ <font color="red">';
    echo $var_99; ;
    echo '</font> ”的结果，<a href="?">查看全部</a></font></td>' . "\r\n\t" . '</tr>' . "\r\n\t";
} ;
echo ' <tr nowrap class="firstalt">' . "\r\n" . '   <td width="50" height="30"><div align="center">ID</div></td>' . "\r\n" . '   <td width="70"><div align="center">蜘蛛</div></td>' . "\r\n" . '   <td width="120"><div align="center">蜘蛛IP</div></td>' . "\r\n" . '   <td>来访页面</td>' . "\r\n" . '   <td width="200">来访时间</td>' . "\r\n" . ' </tr>' . "\r\n";
if($var_44){
    foreach($var_44 as $var_5 => $var_6){;
        echo "\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td>';
        echo $var_6["id"];
        echo '</td>' . "\r\n\t\t" . '<td>';
        echo $var_6["name"];
        echo '</td>' . "\r\n\t\t" . '<td>';
        echo $var_6["ip"];
        echo '</td>' . "\r\n\t\t" . '<td>';
        echo $var_6["url"];
        echo '</td>' . "\r\n\t\t" . '<td>';
        echo $var_6["time"];
        echo '</td>' . "\r\n\t" . '</tr>' . "\r\n";
    } ;
    echo "\t" . '<tr class="firstalt">' . "\r\n\t\t" . '<td align="center" colspan="5"><ul class="page">';
    echo $var_107;
    echo '</ul></td>' . "\r\n\t" . '</tr>' . "\r\n";
}else{;
    echo "\t" . '<tr align=center class="firstalt"><td colspan=5>暂时还没有蜘蛛访问</td></tr>' . "\r\n";
} ;
echo ' </table>' . "\r\n" . '</div>' . "\r\n" . '</div>' . "\r\n";
include 'footer.php'; ;
echo '</body>' . "\r\n" . '</html>';
?>