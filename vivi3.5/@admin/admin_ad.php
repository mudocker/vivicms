<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_2 = isset($_GET ["ac"])?$_GET ["ac"]:"";
if($var_2 == 'save'){
    $var_3 = array();
    foreach($_POST["marks"] as $var_4 => $var_5){
        $var_3[$var_4]["sm"] = trim($_POST["sm"][$var_4]);
        $var_3[$var_4]["mark"] = trim($_POST["marks"][$var_4]);
        $var_3[$var_4]["body"] = get_magic(trim($_POST["bodys"][$var_4]));
    }
    $var_6 = serialize($var_3);
    write($var_7, $var_6);
    ShowMsg('恭喜你,修改成功！', '?', 2000);
    exit;
}
if($var_2 == 'insert'){
    $var_8 = trim($_POST["sm"]);
    $var_9 = trim($_POST["mark"]);
    $var_10 = get_magic(trim($_POST["body"]));
    if("" == $var_9){
        ShowMsg('请填写广告标识', -1, 3000);
        exit;
    }
    if($var_11){
        foreach($var_11 as $var_4 => $var_5){
            if($var_5["mark"] == $var_9){
                ShowMsg('广告标识已存在，请另起一个', -1, 3000);
                exit;
            }
        }
    }
    $var_11[] = array("mark" => $var_9, "body" => $var_10, "sm" => $var_8);
    $var_6 = serialize($var_11);
    write($var_7, $var_6);
    ShowMsg('恭喜你,添加成功！', '?', 2000);
    exit;
}
if($var_2 == 'del'){
    $var_9 = trim($_GET["mark"]);
    foreach($var_11 as $var_4 => $var_5){
        if($var_5["mark"] == $var_9){
            unset($var_11[$var_4]);
        }
    }
    $var_11 = array_values($var_11);
    $var_6 = serialize($var_11);
    write($var_7, $var_6);
    ShowMsg('恭喜你,删除成功！', '?', 2000);
    exit;
}
echo ADMIN_HEAD; ;
echo "\r\n\r\n";
echo '<s';
echo 'tyle type="text/css">' . "\r\n" . '.tips {' . "\r\n" . '  border: 1px #fff1b9 solid;' . "\r\n" . '  background: #fffef1;' . "\r\n" . '  line-height: 20px;' . "\r\n" . '  padding: 9px 16px;' . "\r\n" . '  color: #555;' . "\r\n" . '}' . "\r\n" . '</style>' . "\r\n" . '<body>' . "\r\n" . ' ';
if($var_2 == 'preview'){
    $var_9 = trim($_GET["mark"]);
    $var_10 = get_ads_body($var_9);
    echo $var_10;
    exit;
} ;
echo '<div class="right">' . "\r\n";
include 'welcome.php';
echo '  <div class="right_main">' . "\r\n" . '    <table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n";
if ($var_2 == ""){;
    echo "\t" . '<form action="?ac=save" method="post">' . "\r\n" . '      <tbody>' . "\r\n\t\t" . '<tr nowrap  class="tb_head">' . "\r\n" . '          <td colspan="6"><h2><font color="red">广告代码为HTML格式</font> - &nbsp;<a href="?ac=add"><font color="blue">添加广告</font></a></h2></td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr align=\'center\' class="firstalt">' . "\r\n\t\t\t" . '<td width="80">id</td>' . "\r\n\t\t\t" . '<td width="120">广告标识</td>' . "\r\n\t\t\t" . '<td width="200">替换标签</td>' . "\r\n\t\t\t" . '<td width="150">广告说明</td>' . "\r\n\t";
    echo "\t\t" . '<td>广告代码（html代码）</td>' . "\r\n\t\t\t" . '<td width="90">操作</td>' . "\r\n\t\t" . '</tr>' . "\r\n";
    if($var_11){
        krsort($var_11);
        foreach($var_11 as $var_4 => $var_5){
            $var_12 = "";
            if($var_5["mark"] == 'top' || $var_5["mark"] == 'bottom'){
                $var_12 = 'readonly';
            } ;
            echo "\t\t" . '<tr nowrap class="firstalt">' . "\r\n" . '          <td align="center">';
            echo $var_4 + 1;
            echo '</td>' . "\r\n\t\t" . '  <td><input name="marks[]" type="text" value="';
            echo $var_5["mark"];
            echo '" maxlength="50" style="width:90px" ';
            echo $var_12;
            echo '></td>  ' . "\r\n\t\t" . '  <td><p class="tips" style="font-size:11px">{ad.';
            echo $var_5["mark"];
            echo '}</p></td>' . "\r\n\t\t" . '  <td><input name="sm[]" type="text" value="';
            echo $var_5["sm"];
            echo '" style="width:130px"></td>  ' . "\r\n\t\t" . '  <td><textarea name="bodys[]" rows="3" style="width:98%">';
            echo _htmlspecialchars($var_5["body"]);
            echo '</textarea></td>   ' . "\r\n\t\t" . '  <td align="center"><a href="?ac=preview&mark=';
            echo $var_5["mark"];
            echo '" target="_blank">预览</a>&nbsp;&nbsp;';
            if(!$var_12){;
                echo '<a href="?ac=del&mark=';
                echo $var_5["mark"];
                echo '" onClick="return confirm(\'确定要删除吗?\')">删除</a>';
            }else{
                echo '<font color="red">内置</font>';
            } ;
            echo '</td>' . "\r\n" . '        </tr>' . "\r\n";
        }
    }else{;
        echo "\t" . '<tr nowrap class="firstalt" align=\'center\'>' . "\r\n\t\t" . '<td colspan="6">没有广告</td>' . "\r\n\t" . '</tr>' . "\r\n";
    } ;
    echo "\t\t" . '</tbody>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n" . '          <td colspan="6" align="center">' . "\r\n" . '            <input class="bginput" type="submit" name="submit" value=" 保存 " >' . "\r\n" . '            <input class="bginput" type="button" onclick="history.back();" name="Input" value=" 返回 " >' . "\r\n" . '          </td>' . "\r\n" . '        </tr>' . "\r\n" . '      </form>' . "\r\n" . '    </table>' . "\r\n";
}elseif($var_2 == 'add'){;
    echo '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n" . '<form action="?ac=insert" method="post">' . "\r\n\t\t" . '<tr nowrap  class="tb_head">' . "\r\n" . '          <td colspan="2"><h2>添加广告 - <font color="red">广告代码为HTML格式</font></a></h2></td>' . "\r\n" . '        </tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t" . '  <td width="120" align="right">广告标识：</td>' . "\r\n\t\t" . '  <td><input name="mark" type="text" class="input" maxlength="50';
    echo '" value="" style="width:200px"> * 注：禁止使用中文</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t" . '  <td width="120" align="right">广告说明：</td>' . "\r\n\t\t" . '  <td><input name="sm" type="text" class="input" maxlength="50" value="" style="width:200px"></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t" . '  <td align="right">广告代码：</td>' . "\r\n\t\t" . '  <td><textarea name="body" cols="80" style="height:100px; width:400px"></textarea> * 注：广告代';
    echo '码为HTML格式</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td>&nbsp;</td>' . "\r\n" . '          <td >' . "\r\n" . '            <input class="bginput" type="submit" name="submit" value=" 添加 " >' . "\r\n" . '            <input class="bginput" type="button" onclick="history.back();" name="Input" value=" 返回 " >' . "\r\n" . '          </td>' . "\r\n" . '        </tr>' . "\r\n\t" . '</form>' . "\r\n" . '    </table>' . "\r\n";
} ;
echo "\t\t\r\n\r\n" . '  </div>' . "\r\n" . '</div>' . "\r\n";
include 'footer.php'; ;
echo '</body>' . "\r\n" . '</html>';
?>