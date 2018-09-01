<?php
require_once('data.php');
$v_config = require_once('../data/config.php');
require_once('checkAdmin.php');
$var_38 = require_once('../data/domain_config.php');
define('VV_PLUS', true);
$var_25 = isset($_GET["id"])?(int)$_GET["id"]:"";
$var_14 = isset($_GET["ac"])?$_GET["ac"]:"";
$var_39 = isset($_GET["page"])?intval($_GET["page"]):1;
$var_40 = isset($_GET["keywords"])?$_GET["keywords"]:(isset($_POST["keywords"])?$_POST["keywords"]:"");
if($var_14 == 'del'){
    $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
    if(@unlink($var_28)){
        reset_domain();
        ShowMsg('恭喜你,删除成功！', 'caiji_config.php?page=' . $var_39 . '&keywords=' . $var_40, 500);
    }
}
if($var_14 == 'yulan'){
    require(VV_INC . '/caiji.class.php');
    require(VV_DATA . '/rules.php');
    exit;
}
if($var_14 == 'savecollectid'){
    $var_2 = $_POST["collectid"]?$_POST["collectid"]:$_GET["collectid"];
    $var_30 = array("collectid" => $var_2);
    $var_30 = @array_merge($v_config, $var_30);
    if($var_30){
        arr2file(VV_DATA . '/config.php', $var_30);
    }
    ShowMsg('恭喜你,修改成功！', 'caiji_config.php?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'delselect'){
    if(empty($_POST["ids"])){
        ShowMsg('请选择需要删除的节点!', -1, 2000);
    }
    $var_15 = $_POST["ids"];
    foreach($var_15 as $var_41){
        $var_41 = intval($var_41);
        $var_28 = VV_DATA . '/config/' . $var_41 . '.php';
        @unlink($var_28);
    }
    reset_domain();
    ShowMsg('恭喜你,删除成功！', 'caiji_config.php?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'status'){
    $var_2 = (int)$_GET["collectid"];
    $var_28 = VV_DATA . '/config/' . $var_2 . '.php';
    $var_42 = intval($_GET["sid"]);
    if(!is_file($var_28))ShowMsg('采集配置文件不存在', -1, 3000);
    $caiji_config = require_once($var_28);
    if($caiji_config){
        $caiji_config["web_close"] = ($var_42?'off':'on');
        arr2file($var_28, $caiji_config);
    }
    reset_domain();
    ShowMsg('恭喜你,修改成功！', '?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'rewrite'){
    $var_2 = (int)$_GET["collectid"];
    $var_28 = VV_DATA . '/config/' . $var_2 . '.php';
    $var_42 = intval($_GET["sid"]);
    if(!is_file($var_28))ShowMsg('采集配置文件不存在', -1, 2000);
    $caiji_config = require_once($var_28);
    if($caiji_config){
        $caiji_config["rewrite"] = $var_42;
        arr2file($var_28, $caiji_config);
    }
    reset_domain();
    ShowMsg('恭喜你,修改成功！', '?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'collect_status'){
    $var_2 = (int)$_GET["collectid"];
    $var_28 = VV_DATA . '/config/' . $var_2 . '.php';
    $var_42 = intval($_GET["sid"]);
    if(!is_file($var_28))ShowMsg('采集配置文件不存在', -1, 2000);
    $caiji_config = require_once($var_28);
    if($caiji_config){
        $caiji_config["collect_close"] = $var_42;
        arr2file($var_28, $caiji_config);
    }
    reset_domain();
    ShowMsg('恭喜你,修改成功！', '?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'plus_save'){
    $var_43 = $_GET["name"];
    $var_43 = preg_replace('~[^\w]+~', "", $var_43);
    if(!is_dir(VV_DATA . '/plus/' . $var_43)){
        ajaxReturn(array("status" => "0", "info" => '插件不存在！！'));
    }
    $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
    if(!is_file($var_28)){
        ajaxReturn(array("status" => "0", "info" => '采集配置文件不存在！！'));
    }
    $caiji_config = require_once($var_28);
    if($caiji_config){
        $caiji_config["plus_" . $var_43 . '_config'] = ($_POST["con"]?$_POST["con"]:$_POST["plus"]);
        $var_44 = arr2file($var_28, $caiji_config);
        if($var_44 === false){
            ajaxReturn(array("status" => 1, "info" => '修改失败，检查文件写入权限！'));
        }
        ajaxReturn(array("status" => 1, "info" => '恭喜你,修改成功！'));
    }
}
if($var_14 == 'plus_set'){
    $var_43 = $_GET["name"];
    $var_43 = preg_replace('~[^\w]+~', "", $var_43);
    $var_45 = VV_DATA . '/config/' . $var_25 . '.php';
    $caiji_config = require_once($var_45);
    if(!is_dir(VV_DATA . '/plus/' . $var_43)){
        ajaxReturn(array("status" => "0", "info" => '插件不存在！！'));
    }
    $var_46 = VV_DATA . '/plus/' . $var_43 . '/' . $var_43 . '.class.php';
    if(!is_file($var_46)){
        ajaxReturn(array("status" => "0", "info" => '插件不存在！！'));
    }
    $plusconfig = $caiji_config["plus_" . $var_43 . '_config'];
    echo '<form method="post" name="plusform" id="plusform"><table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline plustable">';
    @include(VV_DATA . '/plus/' . $var_43 . '/' . $var_43 . '.form.html');
    echo '<tr class="firstalt">' . "\r\n\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<input type="submit" value=" 保存配置 " name="submit" class="bginput plusbtn" onclick="save_plus(\'' . $var_43 . '\');"></td>' . "\r\n\t\t" . '</tr></table></form>';
    exit;
}
if($var_14 == 'save'){
    $var_30 = $_POST["con"];
    $var_38 = @array_merge($var_38, array($var_30["web_domains"] => $var_25));
    foreach($var_38 as $var_5 => $var_6){
        if($var_5 == ""){
            unset($var_38[$var_5]);
        }
    }
    $var_38 = array_flip(array_flip($var_38));
    arr2file(VV_DATA . '/domain_config.php', $var_38);
    foreach($var_30 as $var_5 => $var_6){
        if(is_array($var_30[$var_5])){
            foreach($var_30[$var_5]as $var_47 => $var_48){
                $var_30[$var_5][$var_47] = utf2gbk(get_magic(trim($var_48)));
            }
        }else{
            $var_30[$var_5] = utf2gbk(get_magic(trim($var_30[$var_5])));
        }
    }
    $var_49 = $_POST["zdy"];
    if($var_49){
        foreach($var_49 as $var_5 => $var_6){
            foreach($var_6 as $var_47 => $var_48){
                $var_49[$var_5][$var_47] = utf2gbk(get_magic(trim($var_48)));
                if(in_array($var_47, array('name', 'ename')) && $var_49[$var_5][$var_47] == ""){
                    unset($var_49[$var_5]);
                }
            }
        }
    }
    $var_30["zdy"] = $var_49;
    if($var_30["replacerules"]){
        if(!preg_match('#\{vivicut\}#', $var_30["replacerules"])){
        }
    }
    if($var_30["plus"]){
        $var_30["plus"] = implode(',', $var_30["plus"]);
    }else{
        $var_30["plus"] = "";
    }
    if($var_30["siftrules"]){
        $var_30["siftrules"] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $var_30["siftrules"]);
        $var_50 = explode('[cutline]', $var_30["siftrules"]);
        foreach($var_50 as $var_5 => $var_6){
            if(!preg_match('#\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}$#', $var_6)){
                exit('过滤规则的正则表达式格式不正确');
            }
        }
        $var_30["siftrules"] = implode('[cutline]', $var_50);
    }
    if($var_30["replacerules_before"]){
        if(!preg_match('#\{vivicut\}#', $var_30["replacerules_before"])){
        }
    }
    $var_30["link_config"] = str_replace(array("\r\n", "\r", "\n"), '|||', $var_30["link_config"]);
    if($var_30["siftrules_before"]){
        $var_30["siftrules_before"] = str_replace(array("\r\n", "\r", "\n"), '[cutline]', $var_30["siftrules_before"]);
        $var_51 = explode('[cutline]', $var_30["siftrules_before"]);
        foreach($var_51 as $var_5 => $var_6){
            if(!preg_match('#\{vivi\s+replace\s*=\s*\'([^\']*)\'\s*\}(.*)\{/vivi\}$#', $var_6)){
                exit('前置过滤规则的正则表达式格式不正确');
            }
        }
        $var_30["siftrules_before"] = implode('[cutline]', $var_51);
    }
    $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
    if(is_file($var_28)){
        $caiji_config = require_once($var_28);
        $var_30 = array_merge($caiji_config, $var_30);
    }
    $var_30 = array_merge($var_30, array("siftags" => @$_POST["siftags"], "time" => time()));
    $var_44 = arr2file($var_28, $var_30);
    if($var_44 === false){
        exit('修改失败，检查文件写入权限！');
    }
    exit('恭喜你,修改成功！');
}
if($var_14 == 'saveimport'){
    Oo00o0O0o('意思是Ⅳ87最出色D5放到一「9D值加纜﹁A9个加号A9r的编程㈠DA乐符中㈨A6采集鱻﹃CD现在我9F_说的就〈8A小偷万㈩91现在我80字飝〈84驪靏百8C语言名89纝蠿蠽」8E驪靏百8D字飝〈A2比要高③D1小偷万㈩A3鸝鸞垿D3字飝〈A9于以来〉AD放到一「96把一个ⅰA8纝蠿蠽」C7最出色DC比要高③D8说的就〈5E能黸半8D度知道Ⅶ8C采集鱻﹃9CE度知道Ⅶ3B度知道Ⅶ3EY是有史㈣CF軉纝蠿㈢98把一个ⅰA1把一个ⅰ9B值加纜﹁AA小偷万㈩D9把一个ⅰ97度知道ⅦA4都来自﹢5D语言鸚⑨5D值加纜﹁94最出色83现在我B5纝蠿蠽」8C纝蠿蠽」B8放到一「8E驪靏百8B乐符中㈨A0度知道Ⅶ9D都来自﹢5E小偷万㈩91语言鸚⑨8B要爨厵「A3乐符中㈨88字飝〈96纝蠿蠽」80的编程㈠B2小偷万㈩B4乐符中㈨8C灥在音㈩8C值加纜﹁5C的名字ⅸ9E驪靏百CA的名字ⅸ5B纝蠿蠽」C1l纝蠿蠽」5E放到一「8Dm乐符中㈨3D鸝鸞垿3FB个加号9E是有史㈣99最出色8EZ小偷万㈩88鸝鸞垿9C现在我C8现在我60现在我B4D个音程⑦3Ekm驨囖两〈88纝蠿蠽」98度知道ⅦA2要爨厵「D5个加号9E軉纝蠿㈢9F。于是9D驪靏百A4的编程㈠97语言名8E个加号8A軉纝蠿㈢BA度知道Ⅶ91的名字ⅸ7B字飝〈A7的名字ⅸ86qc的名字ⅸ60d放到一「96把一个ⅰD5要爨厵「A7要爨厵「CA值加纜﹁9C是有史㈣CBfce字飝〈A4乐符中㈨CA于以来〉D4意思是Ⅳ8B意思是Ⅳ60kpkA语言名3A于以来〉9E是有史㈣9B。于是8EU。于是B3采集鱻﹃A1鸝鸞垿86灥在音㈩96，齈讞㈧A1驪靏百60灥在音㈩84i语言名A4比要高③5B把一个ⅰ8FY乐符中㈨8AY能黸半84。于是9A个音程⑦A8小偷万㈩AC小偷万㈩A2是有史㈣D6放到一「8C放到一「88的编程㈠98把一个ⅰA2语言名D5軉纝蠿㈢8AvngU字飝〈8FT采集鱻﹃B7小偷万㈩9A最出色A6，齈讞㈧DD灥在音㈩7F采集鱻﹃A3，齈讞㈧9Ca鸝鸞垿5C。于是E8纝蠿蠽」22的名字ⅸ01O灥在音㈩FD。于是0B驪靏百E7都来自﹢15要爨厵「DA。于是E00值加纜﹁18.字飝〈11说的就〈F8值加纜﹁0B7现在我F3个音程⑦F5语言名11比要高③086f0的名字ⅸ27驪靏百F0L要爨厵「06鸝鸞垿22值加纜﹁5Ce意思是Ⅳ5C说的就〈60驪靏百97的编程㈠60鸝鸞垿90i比要高③94gi是有史㈣60oonm軉纝蠿㈢40，齈讞㈧99字飝〈C9说的就〈89比要高③5C放到一「92现在我A7说的就〈A7，齈讞㈧8F的名字ⅸAFq值加纜﹁3C鸝鸞垿40o鸝鸞垿3BT现在我96的名字ⅸAB灥在音㈩A7p语言鸚⑨C7能黸半AB要爨厵「D6现在我94豓一起ⅷDD灥在音㈩96值加纜﹁A6说的就〈98纝蠿蠽」A4，齈讞㈧8A现在我8B度知道ⅦC6采集鱻﹃98现在我A3个加号C8都来自﹢CF个加号99个加号9E语言鸚⑨9A鸝鸞垿5C小偷万㈩92X语言名C5都来自﹢A4鸝鸞垿A9能黸半8Fm纝蠿蠽」3D豓一起ⅷ3FB，齈讞㈧3E都来自﹢3C鸝鸞垿8A把一个ⅰ9A值加纜﹁D6于以来〉A5现在我A1意思是Ⅳ98个音程⑦AB纝蠿蠽」A9度知道Ⅶ95意思是ⅣDB。于是C3要爨厵「D1说的就〈98度知道ⅦA0鸝鸞垿8B，齈讞㈧88采集鱻﹃A1放到一「9F小偷万㈩A9纝蠿蠽」AB小偷万㈩C7采集鱻﹃A0值加纜﹁8B采集鱻﹃5E是有史㈣5B语言名C7把一个ⅰA4是有史㈣A2个加号5EtB于以来〉3DoBmW都来自﹢CD字飝〈9Bv的编程㈠A4都来自﹢95。于是DA都来自﹢8C比要高③88，齈讞㈧98语言鸚⑨A2小偷万㈩D5。于是8AcbpBp最出色3Dm，齈讞㈧AFDp的编程㈠3B字飝〈ADBC值加纜﹁3EW的名字ⅸCC是有史㈣A2的名字ⅸD0都来自﹢98。于是A1说的就〈8D都来自﹢8F现在我96x驪靏百A3小偷万㈩B8意思是ⅣA5eW放到一「92要爨厵「C4都来自﹢A7鸝鸞垿9F軉纝蠿㈢9B采集鱻﹃9E軉纝蠿㈢CDc把一个ⅰ8B放到一「60度知道Ⅶ5B度知道ⅦCF是有史㈣96乐符中㈨5E能黸半5Cg现在我A5纝蠿蠽」9B意思是ⅣD6个加号60现在我9F豓一起ⅷ40n，齈讞㈧40。于是A2豓一起ⅷ9D放到一「5C把一个ⅰD2意思是ⅣD6是有史㈣C9是有史㈣9E軉纝蠿㈢8F，齈讞㈧D0比要高③C2灥在音㈩AC说的就〈94放到一「9D纝蠿蠽」5D軉纝蠿㈢8DW豓一起ⅷC2要爨厵「88放到一「80能黸半BC个加号7BjX灥在音㈩60aW于以来〉DA的名字ⅸ9E驨囖两〈DC采集鱻﹃A7说的就〈8D乐符中㈨60把一个ⅰB4D小偷万㈩3Ekm把一个ⅰCD字飝〈9DX乐符中㈨84语言名D1度知道ⅦAA字飝〈96====||||||||||||      vxiaotou.com采集程序      ||||||||||||====9C比要高③94意思是ⅣD3乐符中㈨95乐符中㈨D8是有史㈣95乐符中㈨9F灥在音㈩8EYSo乐符中㈨7E豓一起ⅷ83w值加纜﹁8A的编程㈠5C最出色8B_字飝〈88鸝鸞垿AB灥在音㈩9E灥在音㈩AF乐符中㈨A8度知道Ⅶ8B语言名8D度知道ⅦDFD个加号3A纝蠿蠽」83语言名81XQUU纝蠿蠽」86T现在我84RW都来自﹢86豓一起ⅷ85语言鸚⑨98是有史㈣A4是有史㈣B0驪靏百82个加号A6语言鸚⑨CDa放到一「8B，齈讞㈧EB采集鱻﹃27軉纝蠿㈢F0都来自﹢1F采集鱻﹃0B把一个ⅰ26度知道Ⅶ14乐符中㈨1F軉纝蠿㈢1E驪靏百06比要高③E7最出色0B驨囖两〈04现在我E4放到一「E3。于是FE个加号F1是有史㈣15比要高③EDJ能黸半06语言名294，齈讞㈧DC于以来〉D3驨囖两〈EF于以来〉8F。于是7E说的就〈89把一个ⅰAFs。于是C6纝蠿蠽」94小偷万㈩D7小偷万㈩9Cok值加纜﹁E8度知道Ⅶ5C要爨厵「26Oqu都来自﹢B1灥在音㈩A5XR驨囖两〈5Ca度知道Ⅶ8Da灥在音㈩95Yc軉纝蠿㈢9Cb个音程⑦60ebp语言名40pY意思是Ⅳ84S个加号84WYWT语言鸚⑨DFqn軉纝蠿㈢409值加纜﹁87能黸半CF放到一「A7軉纝蠿㈢A5值加纜﹁9A说的就〈A8小偷万㈩D9T鸝鸞垿A1R比要高③9C軉纝蠿㈢DE，齈讞㈧A2纝蠿蠽」9C比要高③A4小偷万㈩9D于以来〉9A。于是5B都来自﹢8Ds度知道Ⅶ8B_小偷万㈩88现在我AB纝蠿蠽」9E比要高③AF字飝〈A8軉纝蠿㈢8B豓一起ⅷ9FqAP最出色83能黸半81XQUU，齈讞㈧86X度知道ⅦC7都来自﹢A1驨囖两〈A5采集鱻﹃CC灥在音㈩9B放到一「97UvUW个加号D4纝蠿蠽」A8语言名D8现在我98比要高③D7把一个ⅰAA鸝鸞垿94h意思是Ⅳ91放到一「9DqnWP个加号83比要高③81XQUU语言鸚⑨8A最出色97驪靏百D3说的就〈A0现在我9D现在我CF驨囖两〈99PrY个加号AA能黸半A1，齈讞㈧D9语言鸚⑨9E语言鸚⑨D6把一个ⅰ9C要爨厵「C5个加号A3把一个ⅰA2把一个ⅰB1驨囖两〈99都来自﹢8A值加纜﹁C6采集鱻﹃C5个音程⑦AA小偷万㈩95要爨厵「99小偷万㈩95能黸半97豓一起ⅷ95小偷万㈩9A采集鱻﹃98个音程⑦D5，齈讞㈧98纝蠿蠽」C9Z比要高③A7的名字ⅸD8驪靏百97灥在音㈩97说的就〈94于以来〉AB现在我9A采集鱻﹃A3鸝鸞垿D2最出色9A个加号C7于以来〉98乐符中㈨8CY于以来〉5C纝蠿蠽」92语言名90比要高③D4能黸半C0鸝鸞垿D2。于是93字飝〈A4语言名83现在我BE度知道Ⅶ5BSa灥在音㈩5C軉纝蠿㈢8D于以来〉60能黸半88的名字ⅸ95的编程㈠A6字飝〈D4放到一「98把一个ⅰ99意思是Ⅳ9Cb豓一起ⅷ5E语言名5C字飝〈86，齈讞㈧88度知道ⅦB6S，齈讞㈧C8能黸半A0驪靏百9E_最出色5B是有史㈣27H能黸半3A。于是FA是有史㈣079驪靏百183说的就〈E5语言名E3值加纜﹁086驪靏百E8Q说的就〈00軉纝蠿㈢2A是有史㈣09现在我D3W意思是Ⅳ5EtB灥在音㈩3Do軉纝蠿㈢B6驪靏百C9字飝〈9F。于是D7都来自﹢9C现在我B4D都来自﹢3Ekm个音程⑦B7说的就〈9F现在我9F字飝〈DA鸝鸞垿AE把一个ⅰAB于以来〉98的名字ⅸ5DW语言鸚⑨1E比要高③F7纝蠿蠽」1D现在我18语言名0BX个加号E4能黸半EB能黸半EF軉纝蠿㈢08把一个ⅰEC灥在音㈩DB采集鱻﹃09字飝〈E52字飝〈11于以来〉1B都来自﹢DF的名字ⅸEE意思是ⅣF3的编程㈠FCM軉纝蠿㈢07最出色05Y现在我5C意思是Ⅳ8A放到一「8EiXak的名字ⅸ96d。于是94现在我5Brs驨囖两〈3C9放到一「B2F放到一「3F要爨厵「3C乐符中㈨C7语言鸚⑨AB采集鱻﹃D6e最出色CA说的就〈A0说的就〈A5都来自﹢9C度知道Ⅶ5C，齈讞㈧86采集鱻﹃CA语言名CD驪靏百A3要爨厵「95说的就〈8F字飝〈85豓一起ⅷ9B。于是A0乐符中㈨A3采集鱻﹃9B意思是ⅣCF。于是9B小偷万㈩8DmDp纝蠿蠽」3B字飝〈83个加号9D小偷万㈩A8采集鱻﹃AC语言名80度知道ⅦD9灥在音㈩A0把一个ⅰ8CU小偷万㈩1D鸝鸞垿DE度知道Ⅶ08把一个ⅰE9字飝〈F8E的编程㈠90豓一起ⅷ19把一个ⅰF3字飝〈F8N度知道Ⅶ14驨囖两〈01值加纜﹁EA。于是DB豓一起ⅷD8軉纝蠿㈢07V驨囖两〈90Y要爨厵「9A。于是C7豓一起ⅷ9B都来自﹢9A要爨厵「9E比要高③98驨囖两〈98值加纜﹁A2能黸半D4乐符中㈨9F，齈讞㈧CD最出色9A纝蠿蠽」92语言鸚⑨A7于以来〉A1小偷万㈩A7小偷万㈩5B乐符中㈨8E的编程㈠96把一个ⅰ94g语言名60的编程㈠8C纝蠿蠽」9C', 866);
}
echo ADMIN_HEAD;;
echo '<body>' . "\r\n" . '<div class="right">' . "\r\n" . ' ';
include 'welcome.php';
echo '  <div class="right_main">' . "\r\n";
if($var_14 == ""){
    set_time_limit(600);
    $var_52 = VV_DATA . '/config';
    $var_53 = scandirs($var_52);
    rsort($var_53, 1);
    $var_54 = array();
    $var_55 = 15;
    if(!$var_40){
        $var_56 = count($var_53)-2;
        $var_57 = $var_56?ceil($var_56 / $var_55):1;
        $var_53 = array_slice($var_53, ($var_39-1) * $var_55, $var_55);
    }
    foreach($var_53 as $var_28){
        if($var_28 <> '.' && $var_28 <> '..'){
            if(is_file("$var_52/$var_28")){
                if(!preg_match('#^\d+\.php$#', $var_28)){
                    continue;
                }
                $var_58 = str_replace('.php', "", $var_28);
                $var_28 = VV_DATA . '/config/' . $var_28;
                $caiji_config = require_once($var_28);
                if($caiji_config["web_close"] == 'on'){
                }
                if($var_40 && stripos($caiji_config["web_domains"], $var_40) === false && stripos($caiji_config["from_url"], $var_40) === false && stripos($caiji_config["from_title"], $var_40) === false && stripos($caiji_config["web_name"], $var_40) === false && stripos($caiji_config["web_url"], $var_40) === false){
                    continue;
                }
                $var_54[] = array_merge($caiji_config, array("id" => $var_58));
            }
        }
    }
    foreach($var_54 as $var_59 => $var_60){
        $var_61[$var_59] = $var_60["id"];
    }
    if($var_40){
        @array_multisort($var_61, 3, $var_54);
        $var_56 = count($var_54);
        $var_57 = $var_56?ceil($var_56 / $var_55):1;
        $var_54 = array_slice($var_54, ($var_39-1) * $var_55, $var_55);
    }
    $var_62 = '?page={!page!}';
    if($var_40){
        $var_62 .= '&keywords=' . $var_40;
    }
    $var_63 = get_page($var_39, $var_57, $var_62);
    if(!OoO0o0O0o())$var_54 = array_slice($var_54, "0", 2);;
    echo '<style type="text/css">' . "\r\n" . '.page{clear:both;padding:20px 0;color:#0066ff;text-align:center;font-size:14px;}' . "\r\n" . '.page span,.page a{display:inline-block;padding:2px 6px;}' . "\r\n" . '.page span{margin:0 5px;color:#fff;background:#3399ff;}' . "\r\n" . '.page a{color:#0066ff;margin:0 5px;border:1px solid #3399ff;border-radius:3px;font-weight:700;}' . "\r\n" . '.page a:hover{color:#fff;background-color:#3399ff;text-decoration:none;}' . "\r\n" . '</style>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'function checkall(form, prefix, checkall) {' . "\r\n\t" . 'var checkall = checkall ? checkall : \'chkall\';' . "\r\n\t" . 'count = 0;' . "\r\n\t" . 'for(var i = 0; i < form.elements.length; i++) {' . "\r\n\t\t" . 'var e = form.elements[i];' . "\r\n\t\t" . 'if(e.name && e.name != checkall && e.type==\'checkbox\' && !e.disabled && (!prefix || (prefix && e.name.match(prefix)))) {' . "\r\n\t\t\t" . 'e.checked = form.elements[checkall].checked;' . "\r\n\t\t\t" . 'if(e.checked) {' . "\r\n\t\t\t\t" . 'count++;' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '}' . "\r\n\t" . '}' . "\r\n\t" . 'return count;' . "\r\n" . '}' . "\r\n" . '</script>' . "\r\n" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td colspan="13">采集节点管理&nbsp;&nbsp;-&nbsp;<a href="?ac=add" style=\'color:red\'>添加</a>&nbsp;-&nbsp;<a href="?ac=import" style=\'color:red\'>导入</a>&nbsp;-&nbsp;<a href="http://www.vxiaotou.com" target="_blank" style=\'color:red\'>获取更多规则</a>' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td colspan="13"><form action="" method="post"><input type="text" name="keywords" size="20" value="" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;<input type="submit" value="搜索" />&nbsp;&nbsp;<font color="blue">默认规则ID为</font>[<font size="" color="red">';
    echo $v_config["collectid"];
    echo '</font>]&nbsp;&nbsp;<font color="#dd00b0">注：采集开关为关闭时，将停止采集仅使用缓存！</font></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t";
    if($var_40){;
        echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td colspan="13"><font color="blue">搜索“ <font color="red">';
        echo $var_40;;
        echo '</font> ”的结果，<a href="?">返回全部</a></font></td>' . "\r\n\t" . '</tr>' . "\r\n\t";
    };
    echo "\t" . '</tbody>' . "\r\n" . '<form action="" method="post" name="form" id="form">' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="20" align="center">选择</td>' . "\r\n\t\t" . '<td width="30" align="center">默认</td>' . "\r\n\t\t" . '<td width="30" align="center">ID</td>' . "\r\n\t\t" . '<td align="center">网站名称</td>' . "\r\n\t\t" . '<td align="center" width="150">目标站</td>' . "\r\n\t\t" . '<td align="center">绑定域名</td>' . "\r\n\t\t" . '<td width="30" align="center">说明</td>' . "\r\n\t\t" . '<td width="60" align="center">采集开关</td>' . "\r\n\t\t" . '<td width="40" align="center">状态</td>' . "\r\n\t\t" . '<td width="100" align="center">超级模板</td>' . "\r\n\t\t" . '<td width="60" align="center">伪静态</td>' . "\r\n\t\t" . '<td width="110" align="center">修改时间</td>' . "\r\n\t\t" . '<td width="210" align="center">操作</td>' . "\r\n\t" . '</tr>' . "\r\n";
    if($var_54){
        foreach($var_54 as $var_5 => $var_6){;
            echo "\t" . '<tr nowrap onmouseover=this.bgColor=\'#EDF8FE\'; onmouseout=this.bgColor=\'#ffffff\'; bgcolor=\'#ffffff\'>' . "\r\n\t\t" . '<td align="center"><input name=\'ids[]\' type=\'checkbox\' value=\'';
            echo $var_6["id"];
            echo '\'></td>' . "\r\n\t\t" . '<td align="center">' . "\r\n\t\t\t";
            echo $var_6["id"] == $v_config["collectid"]?'<font color="red">默认</font>':'<a href="?ac=savecollectid&collectid=' . $var_6["id"] . '&sid=0&page=' . $var_39 . '" title="点击设为默认节点">设为</a>';
            echo "\t\t" . '</td>' . "\r\n\t\t" . '<td align="center">';
            echo $var_6["id"];
            echo '</td>' . "\r\n\t\t" . '<td><div style="padding-left:5px;max-width:130px;overflow: hidden;white-space: nowrap;"><a title="';
            echo $var_6["web_name"];
            echo '" href="?ac=xiugai&id=';
            echo $var_6["id"];
            echo '&page=';
            echo $var_39;
            echo '&keywords=';
            echo $var_40;
            echo '">';
            echo $var_6["web_name"];
            echo '</a></div></td>' . "\r\n\t\t" . '<td nowrap><div style="padding-left:5px;;max-width:140px;overflow: hidden;" title="';
            echo $var_6["from_url"];
            echo '">';
            echo $var_6["from_title"]?$var_6["from_title"]:$var_6["from_url"];
            echo '</div></td>' . "\r\n\t\t" . '<td><div style="padding-left:5px;;max-width:120px;overflow: hidden;" title="';
            echo $var_6["web_domains"];
            echo '">';
            echo $var_6["web_domains"]?$var_6["web_domains"]:'<font color="red">未绑定</font>';
            echo '</div></td>' . "\r\n\t\t" . '<td align="center"><a href="javascript:" onclick=\'alert("';
            echo!empty($var_6["licence"])?str_replace(array("\r\n", "\r", "\n"), '\n', $var_6["licence"]):'无';;
            echo '");\'>点我</a></td>' . "\r\n\t\t" . '<td align="center">';
            echo $var_6["collect_close"]?'<a href="?ac=collect_status&collectid=' . $var_6["id"] . '&sid=0&page=' . $var_39 . '" title="点击开启"><font color="red">已关闭</font></a>':'<a href="?ac=collect_status&collectid=' . $var_6["id"] . '&sid=1&page=' . $var_39 . '" title="点击关闭"><font color="green">已开启</font></a>';
            echo '</td>' . "\r\n\r\n\t\t" . '<td align="center">';
            echo $var_6["web_close"] == 'on'?'<a href="?ac=status&collectid=' . $var_6["id"] . '&sid=1&page=' . $var_39 . '" title="点击开启"><font color="red">关闭</font></a>':'<a href="?ac=status&collectid=' . $var_6["id"] . '&sid=0&page=' . $var_39 . '" title="点击关闭"><font color="green">正常</font></a>';
            echo '</td>' . "\r\n\r\n\t\t" . '<td align="center" style="color:#666">';
            echo($var_6["theme_open"]?'<font color="green">开启</font>':'<font color="red">关闭</font>');
            echo '/';
            echo($var_6["theme_dir"]?$var_6["theme_dir"]:'无');
            echo '</td>' . "\r\n\t\t" . '<td align="center">';
            echo!$var_6["rewrite"]?'<a href="?ac=rewrite&collectid=' . $var_6["id"] . '&sid=1&page=' . $var_39 . '" title="点击开启"><font color="red">已关闭</font></a>':'<a href="?ac=rewrite&collectid=' . $var_6["id"] . '&sid=0&page=' . $var_39 . '" title="点击关闭"><font color="green">已开启</font></a>';
            echo '</td>' . "\r\n\t\t" . '<td align="center">';
            echo date('Y-m-d H:i', $var_6["time"]);
            echo '</td>' . "\r\n\t\t" . '<td align="center"><a target="_blank" href="?ac=yulan&collectid=';
            echo $var_6["id"];
            echo '">源代码</a>/<a href="delcache.php?collectid=';
            echo $var_6["id"];
            echo '">缓存</a>/<a href="?ac=xiugai&id=';
            echo $var_6["id"];
            echo '">修改</a>/<a href="?ac=export&id=';
            echo $var_6["id"];
            echo '">导出</a>/<a href="?ac=import&id=';
            echo $var_6["id"];
            echo '">导入</a>/<a href="?ac=del&id=';
            echo $var_6["id"];
            echo '&page=';
            echo $var_39;
            echo '" onClick="return confirm(\'确定删除?\')">删除</a></td>' . "\r\n\t" . '</tr>' . "\r\n";
        };
        echo "\t" . '<tbody>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td colspan="13">' . "\r\n\t\t\t\t" . '<input name="chkall" type="checkbox" id="chkall" onclick="checkall(this.form)" value="checkbox">&nbsp;<label for="chkall">全选/反选</label>' . "\r\n\t\t\t\t" . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . "\r\n\t\t\t\t" . '<input type="submit" value="删除选中" class="bginput" onClick="if(confirm(\'确定要删除吗?\')){form.action=\'?ac=delselect&page=';
        echo $var_39;
        echo '\';}else{return false}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td align="center" colspan="13"><ul class="page">';
        echo $var_63;
        echo '</ul></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n" . '</form>' . "\r\n";
    }else{;
        echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td colspan="13" align="center">没有找到采集节点！</td>' . "\r\n\t" . '</tr>' . "\r\n";
    };
    echo '</table>' . "\r\n";
}elseif($var_14 == 'export'){
    $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
    if(!is_file($var_28))ShowMsg('采集配置文件不存在', -1, 3000);
    $caiji_config = require_once($var_28);
    $var_64 = 'VIVI:' . base64_encode(serialize($caiji_config)) . ':END';;
    echo '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td><h2>导出采集规则</h2></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td><b>以下为规则 [';
    echo $caiji_config["web_name"];
    echo '] 的配置，你可以共享给你的朋友:</b></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td align="center"><textarea style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $var_64;
    echo '</textarea></td>' . "\r\n\t" . '</tr>' . "\r\n" . '</table>' . "\r\n";
}elseif($var_14 == 'import'){
    $var_65 = "";
    if($var_25){
        $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
        if(!is_file($var_28))ShowMsg('采集配置文件不存在', -1, 3000);
        $caiji_config = require_once($var_28);
        $var_65 = '( 覆盖[' . $caiji_config["web_name"] . ']？)<input type="hidden" name="id" value="' . $var_25 . '" />';
    };
    echo '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n" . '<form action="?ac=saveimport" method="post">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td><h2>导入采集规则</h2></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td><b>请在下面输入你要导入的采集配置</b><font color="red">';
    echo $var_65;
    echo '</font>：</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td align="center"><textarea name="import_text" style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td align="center" colspan="2">' . "\r\n\t\t\t" . '<input type="submit" value=" 提交 " name="submit" class="bginput">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" value=" 返回 " name="Input" class="bginput"></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n" . '</form>' . "\r\n" . '</table>' . "\r\n";
}elseif($var_14 == 'xiugai' || $var_14 == 'add'){
    if($var_14 == 'xiugai'){
        $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
        if(!is_file($var_28))ShowMsg('采集配置文件不存在', -1, 3000);
        $caiji_config = require_once($var_28);
        if($caiji_config["siftrules"]){
            $caiji_config["siftrules"] = implode("\r\n", explode('[cutline]', $caiji_config["siftrules"]));
        }
        if($caiji_config["siftrules_before"]){
            $caiji_config["siftrules_before"] = implode("\r\n", explode('[cutline]', $caiji_config["siftrules_before"]));
        }
        if(empty($caiji_config["siftags"]))$caiji_config["siftags"] = array(123);
        $caiji_config["resdomain"] = $caiji_config["resdomain"]?$caiji_config["resdomain"]:$caiji_config["other_imgurl"];
    }else{
        $caiji_config = array("name" => "", "replace" => "", "charset" => 'auto', "from_url" => "", "resdomain" => "", "siftags" => array(), "siftrules" => "", "replacerules" => "", "rewrite" => "", "licence" => "", "from_title" => "", "search_url" => "",);
        $var_66 = glob(VV_DATA . '/config/*.php');
        $var_25 = 1;
        if($var_66){
            $var_66 = array_map(basename, $var_66);
            $var_66 = array_map(intval, $var_66);
            $var_25 = max($var_66) + 1;
        }
    };
    echo '<script type="text/javascript">' . "\r\n" . 'function tab(no,n){' . "\r\n\t" . 'for(var i=1;i<=n;i++){' . "\r\n\t\t" . '$(\'#tab\'+i).removeClass(\'cur\');' . "\r\n\t\t" . '$(\'#config\'+i).hide();' . "\r\n\t" . '}' . "\r\n\t" . '$(\'#config\'+no).fadeIn();' . "\r\n\t" . '$(\'#tab\'+no).addClass(\'cur\');' . "\r\n" . '}' . "\r\n" . '$(function() {' . "\r\n\t" . 'var urlhash=location.hash;' . "\r\n\t" . 'if(urlhash){' . "\r\n\t\t" . 'no=urlhash.substr(1);' . "\r\n\t\t" . 'if(no!=\'1\') tab(no,10);' . "\r\n\t" . '}' . "\r\n" . '});' . "\r\n" . 'function lockinput(elem,s){' . "\r\n\t" . 'if(s==1){' . "\r\n\t\t" . '$(elem).attr(\'readonly\',\'readonly\').removeClass(\'lockinput\').addClass(\'lockinput\');' . "\r\n\t" . '}else{' . "\r\n\t\t" . '$(elem).removeAttr("readonly").removeClass(\'lockinput\');' . "\r\n\t" . '}' . "\r\n" . '}' . "\r\n" . '</script>' . "\r\n" . '<style type="text/css">' . "\r\n" . 'li.cur { background: #eefffd;}' . "\r\n" . '.lockinput{ background: #eee;cursor: not-allowed;}' . "\r\n" . '</style>' . "\r\n" . '<div id="dialog"></div>' . "\r\n" . '<form action="?ac=save&id=';
    echo $var_25;
    echo '" method="post" id="form">' . "\r\n" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t" . '<tbody>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td colspan="2"><div style=\'float:left;padding:5px;\'>采集节点设置：</div>&nbsp;&nbsp;<div style=\'float:left;padding:5px;border:1px dotted #ff6600;background:#ffffee\'>过滤替换规则是在程序处理之后执行，请按照采集后的页面源代码进行编写，不是目标站原始源代码，保存后打开<font color="red">本站前台</font>页面查看源代码</div></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<ul class="do_nav">' . "\r\n\t\t\t\t\t" . '<li id="tab1" class="cur"><a onclick="tab(1,10);" href="#1">基本设置</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab2"><a onclick="tab(2,10);" href="#2">目标站设置</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab3"><a onclick="tab(3,10);" href="#3">替换过滤</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab4"><a onclick="tab(4,10);" href="#4">自定义标签</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab5"><a onclick="tab(5,10);" href="#5">资源替换</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab6"><a onclick="tab(6,10);" href="#6">高级功能</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab9"><a onclick="tab(9,10);" href="#9">泛域名/子域名</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab10"><a onclick="tab(10,10);" href="#10">超级模板规则</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab7"><a onclick="tab(7,10);" href="#7">破防采集</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab8"><a onclick="tab(8,10);" href="#8">独立设置</a></li>' . "\r\n\t\t\t\t" . '</ul>' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config9" style="display:none">' . "\r\n\t\t\t\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>你的根域名</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">如: www.<font color="red">abc.com，红色部分才是</font></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[my_domain]" id="my_domain" size="30" value="';
    echo $caiji_config["my_domain"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > <select name="con[my_domain_auto]" onchange="lockinput(\'#my_domain\',this.value);">' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["my_domain_auto"] == "0")echo ' selected';
    echo '>手动填写</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["my_domain_auto"])echo ' selected';
    echo '>自动获取</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<script type="text/javascript">';
    if($caiji_config["my_domain_auto"])echo 'lockinput(\'#my_domain\',1);';
    echo '</script>' . "\r\n\t\t\t\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>目标站根域名</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">如: www.<font color="red">baidu.com，红色部分才是</font></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[from_domain]" id="from_domain" size="30" value="';
    echo $caiji_config["from_domain"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > <select name="con[from_domain_auto]" onchange="lockinput(\'#from_domain\',this.value);">' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["from_domain_auto"] == "0")echo ' selected';
    echo '>手动填写</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["from_domain_auto"])echo ' selected';
    echo '>自动获取</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<script type="text/javascript">';
    if($caiji_config["from_domain_auto"])echo 'lockinput(\'#from_domain\',1);';
    echo '</script>' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>泛域名设置：</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>开启泛站群模式</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">开启后，页面上的链接将变成随机泛域名<br>一般是用来做蜘蛛池</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[domain_fanmod]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["domain_fanmod"] == "0")echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["domain_fanmod"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '</select> <font color="red">需先在基本设置，绑定域名里添加泛域名</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>开启域名互链</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">开启后，将从绑定域名里提取域名进行互链<br>否则使用当前域名</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[domain_fanmod]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["domain_fanmod"] == "0")echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["domain_fanmod"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>泛域名前缀位数</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">如: <font color="red">www</font>.baidu.com，红色部分为前缀</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[domain_num_min]" size="3" value="';
    echo $caiji_config["domain_num_min"]?$caiji_config["domain_num_min"]:3;
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > - <input type="text" name="con[domain_num_max]" size="3" value="';
    echo $caiji_config["domain_num_max"]?$caiji_config["domain_num_max"]:8;
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 位，随机生成</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>子域名映射：</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td colspan="2"><font color="blue">提示：当你想采集目标站子域名的时候可以填写此项，否则忽略! <font color="red">泛域名模式下无效</font></font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>开启子域名映射</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">是否开启子域名映射</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[domain_fan]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["domain_fan"] == "0")echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["domain_fan"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>子域名映射</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">每行一条映射规则，格式如下：<br>' . "\r\n\t\t\t\t\t" . '<font color="red">目标站子域名前缀----你的域名前缀</font><br>' . "\r\n\t\t\t\t\t" . '目标站子域名为 news.baidu.com<br>' . "\r\n\t\t\t\t\t" . '你的子域名为 mynews.abc.com<br>' . "\r\n\t\t\t\t\t" . '则这样写：<font color="red">news----mynews</font><br>' . "\r\n\t\t\t\t\t" . '<hr>' . "\r\n\t\t\t\t\t" . '如果子域名前缀和目标站一样<br>' . "\r\n\t\t\t\t\t" . '则可以这样：<font color="red">*</font><br>' . "\r\n\t\t\t\t\t" . '<hr>' . "\r\n\t\t\t\t\t" . '如果想设置标题和关键词描述<br>' . "\r\n\t\t\t\t\t" . '则可以这样：<br><font color="red">news----mynews----标题----关键词----描述</font>' . "\r\n\t\t\t\t" . '</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[domain_rules]" style="height: 200px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["domain_rules"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config1">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>网站名称</b><br></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[web_name]" size="30" value="';
    echo $caiji_config["web_name"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>网站长标题</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">用在首页，有利于优化</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[web_seo_name]" size="30" value="';
    echo $caiji_config["web_seo_name"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 如设置为空则使用目标站的</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>首页关键字</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">首页关键字keywords</font></td>' . "\r\n\t\t\t\t" . '<td><input name="con[web_keywords]" type="text" value="';
    echo $caiji_config["web_keywords"];
    echo '" size="55" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 如设置为空则使用目标站的</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>首页网站描述</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">首页描述</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[web_description]" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["web_description"];
    echo '</textarea> 如设置为空则使用目标站的</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>绑定域名</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">多个用符号,分隔，如： <font color="red">a.com,b.com</font><br>' . "\r\n\t\t\t\t\t" . '泛域名格式：<font color="red">*.b.com</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[web_domains]" size="80" value="';
    echo $caiji_config["web_domains"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="checkurl(this.id);this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign="top"><b>统计代码</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">流量统计代码<br></font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[web_tongji]" cols="80" style="height: 70px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["web_tongji"];
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>是否关闭站点</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">是否关闭站点</font></td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<input type="radio" name="con[web_close]" value="off" ';
    if($caiji_config["web_close"] == 'off' || !$caiji_config["web_close"])echo ' checked';
    echo ' onclick="$(\'#closecon\').hide();" />否 ' . "\r\n\t\t\t\t\t" . '<input type="radio" name="con[web_close]" value="on" ';
    if($caiji_config["web_close"] == 'on')echo ' checked';
    echo ' onclick="$(\'#closecon\').show();" />是 ' . "\r\n\t\t\t\t\t\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt" id="closecon" ';
    if($caiji_config["web_close"] == 'off' || !$caiji_config["web_close"])echo 'style=\'display:none\'';
    echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign="top"><b>关闭站点的原因</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">站点关闭时出现的提示信息<br></font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[web_closecon]" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["web_closecon"];
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>调试模式</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">开启调试模式后，将输出调试信息，便于发现解决错误</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[web_debug]" >' . "\r\n\t\t\t\t\t" . '<option value="off" ';
    if($caiji_config["web_debug"] == 'off')echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t" . '<option value="on" ';
    if($caiji_config["web_debug"] == 'on')echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>使用说明</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">填写作者信息、使用协议或说明、注意事项</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[licence]" style="height: 80px; width: 550px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["licence"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config2" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>目标网站名称</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">多个用符号  * 分隔</font><br><font color="red">注：不要只填写字母或者域名，否则替换出错</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[from_title]" id="from_title" size="50" value="';
    echo $caiji_config["from_title"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>目标站地址</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">需要采集的目标网站地址, http://开头</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[from_url]" id="from_url" size="50" value="';
    echo $caiji_config["from_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;<select name="con[charset]" >' . "\r\n\t\t\t\t\t" . '<option value="auto" ';
    if($caiji_config["charset"] == 'auto' || empty($caiji_config["charset"]))echo ' selected';
    echo '>自动识别</option>' . "\r\n\t\t\t\t\t" . '<option value="gb2312" ';
    if($caiji_config["charset"] == 'gb2312')echo ' selected';
    echo '>gb2312</option>' . "\r\n\t\t\t\t\t" . '<option value="utf-8" ';
    if($caiji_config["charset"] == 'utf-8')echo ' selected';
    echo '>utf-8</option>' . "\r\n\t\t\t\t\t" . '<option value="gbk" ';
    if($caiji_config["charset"] == 'gbk')echo ' selected';
    echo '>gbk</option>' . "\r\n\t\t\t\t\t" . '<option value="big5" ';
    if($caiji_config["charset"] == 'big5')echo ' selected';
    echo '>big5</option>' . "\r\n\t\t\t\t" . '</select>&nbsp;目标站编码</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>其他域名(非子域名)</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">目标站多个域名绑定一个站点时填写<br>每个域名用半角逗号分隔<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>如: baidu.com<font color="red">,</font>www.baidu.com</div></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[other_url]" id="other_url" size="50" value="';
    echo $caiji_config["other_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>目标站资源域名</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">可填写需要采集的css图片等资源域名<br>每个域名用半角逗号分隔<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>如: img1.baidu.com<font color="red">,</font>*.baidu.com</div></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[resdomain]" id="resdomain" size="50" value="';
    echo $caiji_config["resdomain"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<style type="text/css">' . "\r\n\t\t\t" . 'input[disabled="disabled"] {' . "\r\n\t\t\t\t" . 'background: #eee;' . "\r\n\t\t\t\t" . 'cursor: not-allowed;' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '</style>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>图片属性名称</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">当目标站图片使用延迟加载的时候使用<br>每个用半角逗号分隔<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>如: data-src<font color="red">,</font>_src</div></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[img_delay_name]" size="50" value="';
    echo $caiji_config["img_delay_name"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > <font color="red">一般不用设置</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>搜索设置：</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>自动替换搜索地址</b><br>' . "\r\n\t\t\t" . '<font color="#666666">选择此项就不用填写目标站搜索地址了</font></td>' . "\r\n\t\t\t" . '<td><select name="con[auto_get_search]" onchange="lockinput(\'#search_url\',this.value)" >' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($caiji_config["auto_get_search"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if($var_25 && !$caiji_config["auto_get_search"])echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>目标站搜索地址</b><br>' . "\r\n\t\t\t" . '<font color="#666666">目标站搜索地址，即搜索框中form的action地址，如果是js的话不用填写</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[search_url]" id="search_url" size="50" value="';
    echo $caiji_config["search_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t\r\n\t\t" . '<script type="text/javascript">' . "\r\n\t\t";
    if($caiji_config["auto_get_search"])echo 'lockinput(\'#search_url\',1);';
    echo "\t\t" . '</script>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>搜索页面的编码</b></td>' . "\r\n\t\t\t" . '<td><select name="con[search_charset]" >' . "\r\n\t\t\t\t" . '<option value="auto" ';
    if($caiji_config["search_charset"] == 'auto' || empty($caiji_config["charset"]))echo ' selected';
    echo '>自动识别</option>' . "\r\n\t\t\t\t" . '<option value="gb2312" ';
    if($caiji_config["search_charset"] == 'gb2312')echo ' selected';
    echo '>gb2312</option>' . "\r\n\t\t\t\t" . '<option value="utf-8" ';
    if($caiji_config["search_charset"] == 'utf-8')echo ' selected';
    echo '>utf-8</option>' . "\r\n\t\t\t\t" . '<option value="gbk" ';
    if($caiji_config["search_charset"] == 'gbk')echo ' selected';
    echo '>gbk</option>' . "\r\n\t\t\t\t" . '<option value="big5" ';
    if($caiji_config["search_charset"] == 'big5')echo ' selected';
    echo '>big8</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>其他设置：</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>跟随重定向</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">是否跟随目标站重定向</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[auto301]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["auto301"] == "0")echo ' selected';
    echo '>否</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["auto301"])echo ' selected';
    echo '>是</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>强制编码转换</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">强制执行选中的目标站编码</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[charset_force]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["charset_force"] == "0")echo ' selected';
    echo '>否</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["charset_force"])echo ' selected';
    echo '>是</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>屏蔽js错误</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">是否屏蔽js错误</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[hidejserror]" >' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["hidejserror"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["hidejserror"] == "0")echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>禁止移动搜索转码</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">此选项可禁止百度移动搜索转码</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[no_siteapp]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["no_siteapp"] == "0")echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["no_siteapp"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t\r\n\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config3" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>主体区域截取</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">当只想采集某个区域的时候使用<br>仅支持截取body之间<br><font color="red">一般留空</font></font></td>' . "\r\n\t\t\t\t" . '<td>开始标记 ' . "\r\n\t\t\t\t\t" . '<textarea name="con[body_start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["body_start"]);
    echo '</textarea>&nbsp;结束标记' . "\r\n\t\t\t\t\t" . '<textarea name="con[body_end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["body_end"]);
    echo '</textarea>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>标签过滤</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">采集页面时过滤掉这些标签<br><font color="red">慎用</font>,否则将可能出现采集不完整和错位现象</font></td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="iframe" ';
    if(in_array('iframe', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> iframe' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="object" ';
    if(in_array(object, $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> object' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="script" ';
    if(in_array('script', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> script' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="form" ';
    if(in_array('form', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> form' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="input" ';
    if(in_array('input', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> input' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="textarea" ';
    if(in_array('textarea', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> textarea' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="botton" ';
    if(in_array('botton', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> botton' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="select" ';
    if(in_array('select', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> select' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="div" ';
    if(in_array('div', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> div' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="table" ';
    if(in_array('table', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> table' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="th" ';
    if(in_array('tr', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> th' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="tr" ';
    if(in_array('tr', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> tr' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="td" ';
    if(in_array('td', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> td' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="span" ';
    if(in_array('span', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> span' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="img" ';
    if(in_array('img', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> img' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="font" ';
    if(in_array('font', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> font' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="a" ';
    if(in_array('a', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> a' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="html" ';
    if(in_array('html', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> html' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="style" ';
    if(in_array('style', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> style' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>站内外过滤</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">可过滤站内或站外不必要的链接或文件</font>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="outa" ';
    if(in_array('outa', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="red">站外</font>链接' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="outjs" ';
    if(in_array('outjs', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="red">站外</font>js文件' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="outcss" ';
    if(in_array('outcss', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="red">站外</font>css文件' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="locala" ';
    if(in_array('locala', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="blue">站内</font>链接' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="localjs" ';
    if(in_array('localjs', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="blue">站内</font>js文件' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="localcss" ';
    if(in_array('localcss', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="blue">站内</font>css文件' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\' style="background:#fafafa"><b>字符串替换规则</b><br>' . "\r\n\t\t\t" . '<font color="#666666">替换前和替换后直接用<font color="red">******</font>分隔<br>每一对替换后面用下面的字符分隔开来<br><font color="red">##########</font><br>例子：<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>我是替换前<font color="red">******</font>我是替换后<br><font color="red">##########</font><br>百度<font color="red">******</font>{web_name}</font><br><font color="red">##########</font></div>' . "\r\n\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t" . '<b>标签说明：</b><br>' . "\r\n\t\t\t\t\t" . '{web_name} -> 网站名称<br>' . "\r\n\t\t\t\t\t" . '{web_url} -> 网站地址<br>' . "\r\n\t\t\t\t\t" . '{web_domain} -> 当前域名<br>' . "\r\n\t\t\t\t\t" . '{web_thisurl} -> 当前页面url<br>' . "\r\n\t\t\t\t\t" . '{web_remark} -> 伪静态标示符<br>' . "\r\n\t\t\t\t\t" . '{ad.广告标识} -> 广告标签<br>' . "\r\n\t\t\t\t\t" . '{zdy.标签} -> 自定义标签<br>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t" . '<b>页面区分：</b><br>' . "\r\n\t\t\t\t\t" . '在替换规则开头加<br><font color="red">index@@</font>表示只替换首页<br><font color="red">other@@</font>表示只替换内页' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t" . '</font>' . "\r\n\t\t\t" . '</td>' . "\r\n";
    if($var_14 == 'add' && $caiji_config["replacerules"] == ""){
        $caiji_config["replacerules"] = '/----------------文字替换（本行格式为注释,仅用于方便查看,下同）----------------/' . "\r\n" . '##########' . "\r\n" . '这里可以写替换规则' . "\r\n" . '##########' . "\r\n" . '/----------------图片替换----------------/' . "\r\n" . '##########' . "\r\n" . '这里可以写替换规则' . "\r\n" . '##########' . "\r\n" . '/----------------广告替换----------------/' . "\r\n" . '##########' . "\r\n" . '这里可以写替换规则' . "\r\n" . '##########' . "\r\n" . '/----------------其他替换----------------/' . "\r\n" . '##########' . "\r\n" . '这里可以写替换规则' . "\r\n" . '##########';
    };
    echo "\t\t\t\t" . '<td><textarea name="con[replacerules]" style="height: 450px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["replacerules"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>正则替换规则</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">正则替换表达式，一行一个，格式如下：<br>' . "\r\n\t\t\t\t" . '<div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>' . "\r\n\t\t\t\t\t" . '<font color="red">{vivi replace=\'</font>替换后<font color="red">\'}</font>正则表达式<font color="red">{/vivi}</font><br>' . "\r\n\t\t\t\t\t" . '<font color="blue">替换后如含有单引号则使用[d]代替如：</font><br>' . "\r\n\t\t\t\t\t" . '<font color="red">{vivi replace=\'</font>[d]替换后[d]<font color="red">\'}</font>正则<font color="red">{/vivi}</font>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t\t" . '<b>标签说明：</b><br>同上' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[siftrules]" style="height: 250px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["siftrules"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>开启前置替换</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">替换最开始的代码（即目标站的原始html）<br><font color="red">特殊用途，一般不用开启</font></font></td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<label><input type="radio" id="replace_before_on" name="con[replace_before_on]" value="1" ';
    if($caiji_config["replace_before_on"])echo ' checked';
    echo ' />开启</label>' . "\r\n\t\t\t\t\t" . '<label><input type="radio" id="replace_before_off" name="con[replace_before_on]" value="0" ';
    if(!$caiji_config["replace_before_on"])echo ' checked';
    echo ' />关闭</label>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt replace_before_body"';
    if(!$caiji_config["replace_before_on"])echo ' style=\'display:none\'';
    echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>前置字符串替换规则</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">使用方法同上面的替换规则一致</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[replacerules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["replacerules_before"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt replace_before_body"';
    if(!$caiji_config["replace_before_on"])echo ' style=\'display:none\'';
    echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>前置正则替换规则</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666"><font color="#666666">使用方法同上面的正则替换规则一致</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[siftrules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["siftrules_before"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n" . '<script>' . "\r\n" . '$(function() {' . "\r\n\t" . '$("#replace_before_on").click(function(){' . "\r\n\t\t" . '$(".replace_before_body").show();' . "\r\n\t" . '});' . "\r\n\t" . '$("#replace_before_off").click(function(){' . "\r\n\t\t" . '$(".replace_before_body").hide();' . "\r\n\t" . '});' . "\r\n" . '});' . "\r\n" . '</script>' . "\r\n" . '<style type="text/css">' . "\r\n" . '#quick td {' . "\r\n" . '    border-bottom: 1px solid #eee;' . "\r\n" . '}' . "\r\n" . '</style>' . "\r\n\t\t" . '<tbody id="config4" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td colspan="2" align="left">' . "\r\n\t\t\t\t\t" . '1. 设置的标签可在模板中调用，也可在替换规则中使用<br>' . "\r\n\t\t\t\t\t" . '2. <font color="red">标签的标识不可重复！！！</font><font color="blue">模板中使用$zdy数组变量进行调用，如：$zdy[\'标识\']</font><br>' . "\r\n\t\t\t\t\t" . '3. <font color="green">正则截取只获取第一个匹配内容，格式如：&lt;title&gt;(.*)&lt;/title&gt;</font><br>' . "\r\n\t\t\t\t\t" . '4. <font color="red">注：如没有模板，此处无需设置</font><br>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td colspan="2" align="left">' . "\r\n\t\t\t\t\t" . '<table cellpadding="3" cellspacing="1" id="quick">' . "\r\n\t\t\t\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t\t\t" . '  <td width="30" class="title_bg" align="center">编号</td>' . "\r\n\t\t\t\t\t\t" . '  <td width="100" class="title_bg" align="center">标签名称(中文)</td>' . "\r\n\t\t\t\t\t\t" . '  <td width="100" align=\'center\'>标识(英文字母)</td>' . "\r\n\t\t\t\t\t\t" . '  <td width="100" align=\'center\'>类型</td>' . "\r\n\t\t\t\t\t\t" . '  <td align=\'center\'>设置</td>' . "\r\n\t\t\t\t\t\t" . '  <td width="50" align="center"><button type="button" class="add">增加</button></td>' . "\r\n\t\t\t\t\t\t" . '  <td align=\'center\'>&nbsp;</td>' . "\r\n\t\t\t\t\t\t" . '</tr>' . "\r\n";
    if(empty($caiji_config["zdy"])){
        $caiji_config["zdy"] = array(array("name" => "", "ename" => "", "body" => "",),);
    }
    foreach($caiji_config["zdy"]as $var_5 => $var_6){;
        echo "\t\t\t\t\t\t" . '<tr class="firstalt item';
        echo $var_5;
        echo '" itemid="';
        echo $var_5;
        echo '">' . "\r\n\t\t\t\t\t\t\t" . '<td align="center">';
        echo $var_5 + 1;
        echo '</td>' . "\r\n\t\t\t\t\t\t\t" . '<td align="center"><input type="text" name="zdy[';
        echo $var_5;
        echo '][name]" style="width:100px" class="input" value="';
        echo _htmlspecialchars($var_6["name"]);
        echo '"></td>' . "\r\n\t\t\t\t\t\t\t" . '<td align=\'center\'><input type="text" name="zdy[';
        echo $var_5;
        echo '][ename]" style="width:70px" class="input" value="';
        echo _htmlspecialchars($var_6["ename"]);
        echo '"></td>' . "\r\n\t\t\t\t\t\t\t" . '<td align=\'center\'><select name="zdy[';
        echo $var_5;
        echo '][type]" onchange="zdytype(this);">' . "\r\n\t\t\t\t\t\t\t\t" . '<option value="0"';
        if($var_6["type"] == "0")echo ' selected';
        echo '>自定义内容</option>' . "\r\n\t\t\t\t\t\t\t\t" . '<option value="1"';
        if($var_6["type"] == 1)echo ' selected';
        echo '>普通截取</option>' . "\r\n\t\t\t\t\t\t\t\t" . '<option value="2"';
        if($var_6["type"] == 2)echo ' selected';
        echo '>正则截取</option>' . "\r\n\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t" . '<td align="center">' . "\r\n\r\n\t\t\t\t\t\t\t" . '<div class="zdy_body_';
        echo $var_5;
        echo '"';
        if($var_6["type"])echo ' style="display:none"';
        echo '><textarea name="zdy[';
        echo $var_5;
        echo '][body]" style="height: 100px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
        echo _htmlspecialchars($var_6["body"]);
        echo '</textarea></div>' . "\r\n\r\n\t\t\t\t\t\t\t" . '<div class="zdy_regx_';
        echo $var_5;
        echo '"';
        if($var_6["type"] != 2)echo ' style="display:none"';
        echo '><textarea name="zdy[';
        echo $var_5;
        echo '][regx]" style="height: 100px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
        echo _htmlspecialchars($var_6["regx"]);
        echo '</textarea></div>' . "\r\n\r\n\t\t\t\t\t\t\t" . '<div class="zdy_replace_';
        echo $var_5;
        echo '"';
        if($var_6["type"] != 1)echo ' style="display:none"';
        echo '>' . "\r\n\t\t\t\t\t\t\t\t" . '开始标记 <textarea name="zdy[';
        echo $var_5;
        echo '][start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
        echo _htmlspecialchars($var_6["start"]);
        echo '</textarea>' . "\r\n\t\t\t\t\t\t\t\t" . '&nbsp;结束标记' . "\r\n\t\t\t\t\t\t\t\t" . '<textarea name="zdy[';
        echo $var_5;
        echo '][end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
        echo _htmlspecialchars($var_6["end"]);
        echo '</textarea>' . "\r\n\t\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t" . '<td align=\'center\'><a href="javascript:" onclick="deltr(this);">删除</a></td>' . "\r\n\t\t\t\t\t\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t\t\t\t\t" . '</tr>' . "\r\n";
    };
    echo "\t\t\t\t\t" . '</table>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'function deltr(elem){' . "\r\n\t" . 'var itemid=$(elem).parents(\'tr\').attr(\'itemid\');' . "\r\n\t" . '$(elem).parents(".item"+itemid).remove();' . "\r\n" . '}' . "\r\n" . 'function zdytype(_this){' . "\r\n\t" . 'var itemid=$(_this).parents(\'tr\').attr(\'itemid\');' . "\r\n\t" . 'var id=_this.value;' . "\r\n\t" . '$(\'.zdy_body_\'+itemid).hide();' . "\r\n\t" . '$(\'.zdy_regx_\'+itemid).hide();' . "\r\n\t" . '$(\'.zdy_replace_\'+itemid).hide();' . "\r\n\t" . 'if(id==\'0\'){' . "\r\n\t\t" . '$(\'.zdy_body_\'+itemid).fadeIn();' . "\r\n\t" . '}else if(id==\'1\'){' . "\r\n\t\t" . '$(\'.zdy_replace_\'+itemid).fadeIn();' . "\r\n\t" . '}else if(id==\'2\'){' . "\r\n\t\t" . '$(\'.zdy_regx_\'+itemid).fadeIn();' . "\r\n\t" . '}' . "\r\n" . '}' . "\r\n" . '$(document).ready(function(){' . "\r\n\t" . '$("#quick .add").click(function(){' . "\r\n\t\t" . 'var id = $("#quick tr").prevAll("tr").length+1;' . "\r\n\t\t" . 'var input=\'<tr class="firstalt item\'+id+\'" itemid="\'+id+\'">\';' . "\r\n\t\t" . 'input+=\'<td align="center">\'+id+\'</td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><input type="text" name="zdy[\'+id+\'][name]" style="width:100px" class="input"></td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><input type="text" name="zdy[\'+id+\'][ename]" style="width:70px" class="input"></td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><select name="zdy[\'+id+\'][type]" onchange="zdytype(this);"><option value="0">自定义内容</option><option value="1">普通截取</option><option value="2">正则截取</option></select></td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><div class="zdy_body_\'+id+\'"><textarea name="zdy[\'+id+\'][body]" style="height: 100px; width: 450px" onFocus="this.style.borderColor=\\\"#00CC00\\\"" onBlur="this.style.borderColor=\\\"#dcdcdc\\\"" ></textarea></div><div class="zdy_regx_\'+id+\'" style="display:none"><textarea name="zdy[\'+id+\'][regx]" style="height: 100px; width: 450px" onFocus="this.style.borderColor=\\\"#00CC00\\\"" onBlur="this.style.borderColor=\\\"#dcdcdc\\\"" ></textarea></div><div style="display:none" class="zdy_replace_\'+id+\'">开始标记 <textarea name="zdy[\'+id+\'][start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\\\"#00CC00\\\"" onBlur="this.style.borderColor=\\\"#dcdcdc\\\"" ></textarea>&nbsp;结束标记<textarea name="zdy[\'+id+\'][end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\\\"#00CC00\\\"" onBlur="this.style.borderColor=\\\"#dcdcdc\\\"" ></textarea></div></td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><a href="javascript:" onclick="deltr(this);">删除</a></td>\';' . "\r\n\t\t" . 'input+=\'<td>&nbsp;</td></tr>\';' . "\r\n\t\t" . '$("#quick").append(input);' . "\r\n\t" . '});' . "\r\n\t" . '$("#form").submit(function(e){' . "\r\n\t\t" . '$(\'.firstalt input[type="submit"]\').attr(\'disabled\',\'disabled\').val(\' 正在保存... \');' . "\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'type:"post",' . "\r\n\t\t\t" . 'url:"?ac=save&id=';
    echo $var_25;
    echo '",' . "\r\n\t\t\t" . 'data:$("#form").serialize(),' . "\r\n\t\t\t" . 'global:false,' . "\r\n\t\t\t" . 'success:function(data){' . "\r\n\t\t\t\t" . 'alert(data);' . "\r\n\t\t\t\t" . '$(\'.firstalt input[type="submit"]\').attr(\'disabled\',false).val(\' 提交 \');' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '});' . "\r\n\t\t" . 'return false;' . "\r\n\t" . '});' . "\r\n" . '});' . "\r\n" . '</script>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config5" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b>资源替换</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">一行一个，必须带http://和域名，格式如下：<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">目标站资源url----你的资源url，如下</font><br>' . "\r\n\t\t\t\t\t\t" . '<font color="green">http://a.cn/logo.jpg----http://b.cc/a.jpg</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">注：目标站资源必须带http://</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[source_replace]" style="height: 150px; width:650px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["source_replace"]);
    echo '</textarea>&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">注：目标站资源必须带http://</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>自定义css</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">css代码，一行一个，格式如下：<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'><font color="red">.a{color:red}</font></div></font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[css]" style="height: 100px; width: 550px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["css"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config6" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>高级功能：</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>繁简互转</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">繁体简体中文之间互转，影响速度</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[big52gbk]" >' . "\r\n\t\t\t\t\t" . '<option value="togbk" ';
    if($caiji_config["big52gbk"] == 'togbk')echo ' selected';
    echo '>繁转简</option>' . "\r\n\t\t\t\t\t" . '<option value="tobig5" ';
    if($caiji_config["big52gbk"] == 'tobig5')echo ' selected';
    echo '>简转繁</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["big52gbk"])echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>伪原创开关</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">开启伪原创</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[replace]" >' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["replace"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["replace"])echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>伪静态开关</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">伪静态的采集规则和动态的可能不一样</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[rewrite]" >' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["rewrite"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["rewrite"])echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>单模板文件名</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">将模板上传到template文件夹内<br>然后填写其文件名，<font color="red">一般留空</font></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[tplfile]" id="tplfile" size="10" value="';
    echo $caiji_config["tplfile"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 留空则默认为index.html</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>错误页设置：</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>错误页输出方式</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">采集到错误页，显示错误页内容或者跳转</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[web_404_type]" >' . "\r\n\t\t\t\t\t" . '<option value="display" ';
    if($caiji_config["web_close"] == 'display')echo ' selected';
    echo '>输出模板内容</option>' . "\r\n\t\t\t\t\t" . '<option value="jump" ';
    if($caiji_config["web_close"] == 'jump' || !$caiji_config["web_close"])echo ' selected';
    echo '>跳转方式</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>模板/跳转地址：</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">填写模板文件路径或者跳转url</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[web_404_url]" id="web_404_url" size="40" value="';
    echo $caiji_config["web_404_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="checkurl(this.id);this.style.borderColor=\'#dcdcdc\'" > 相对于根目录，如：/404.html 或者 跳转方式： http://xxx.com/404.html</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>自定义错误检测</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">当目标站网页中包含填写的代码时，认定为错误页<br><font color="red">填写错误页独有的一段代码或文字</font></font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[web_404_str]" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["web_404_str"];
    echo '</textarea> 一般不用填写</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>插件设置：</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n";
    $var_67 = array();
    if($caiji_config["plus"]){
        $var_67 = explode(',', $caiji_config["plus"]);
    }
    if(is_dir(VV_DATA . '/plus')){
        $var_66 = scandirs(VV_DATA . '/plus');
        unset($var_66["0"], $var_66[1]);
    };
    echo "\t\t" . '<style type="text/css">' . "\r\n" . '.custom-header{' . "\r\n" . '  text-align: center;' . "\r\n" . '  padding: 3px;' . "\r\n" . '  background: #000;' . "\r\n" . '  color: #fff;' . "\r\n" . '}' . "\r\n" . '</style>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>使用插件</b><br>' . "\r\n\t\t\t" . '<font color="#666666">插件位于/data/plus/文件夹<br>编写方法看示例</td>' . "\r\n\t\t\t" . '<td><select name="con[plus][]" multiple=\'multiple\' class="selectmultiple">' . "\r\n\t\t\t";
    if($var_66){
        $var_52 = VV_DATA . '/plus';
        foreach($var_66 as $var_5 => $var_6){
            $var_68 = $var_52 . '/' . $var_6 . '/' . $var_6 . '.class.php';
            if(!is_dir($var_52 . '/' . $var_6) || !is_file($var_68)){
                continue;
            }
            require_once($var_68);
            $var_69 = new $var_6;
            $var_70 = $var_69 -> info;;
            echo "\t\t\t\t" . '<option value="';
            echo $var_6;
            echo '" ';
            if(in_array($var_6, $var_67))echo ' selected';
            echo '>';
            echo $var_70["name"];
            echo '</option>' . "\r\n\t\t\t";
        }
    };
    echo "\t\t\t" . '</select> <script type="text/javascript">$(\'.selectmultiple\').multiSelect({ keepOrder: true,selectableHeader: "<div class=\'custom-header\'>未使用的插件</div>",selectionHeader: "<div class=\'custom-header\'>正在使用的插件</div>" });</script></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config7" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>自定义cookie</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">使用该cookie访问目标站<br>一般用于需要登陆才能采集的站点</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[cookie]" style="height: 100px; width: 550px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["cookie"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>自定义浏览器标识（user-agent）</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">可伪造浏览器，伪造蜘蛛爬行</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[user_agent]" id="user_agent" style="width:300px;" value="';
    echo $caiji_config["user_agent"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;<select onchange="$(\'#user_agent\').val(this.value);">' . "\r\n\t\t\t\t\t" . '<option value="">自定义</option>' . "\r\n\t\t\t\t\t" . '<option value="Baiduspider/2.0+(+http://www.baidu.com/search/spider.htm)" ';
    if($caiji_config["user_agent"] == 'Baiduspider/2.0+(+http://www.baidu.com/search/spider.htm)')echo ' selected';
    echo '>模拟百度蜘蛛</option>' . "\r\n\t\t\t\t\t" . '<option value="Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)" ';
    if($caiji_config["user_agent"] == 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)')echo ' selected';
    echo '>模拟谷歌蜘蛛</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>自定义来路</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">伪造来路，不填写则自动伪造为目标站url</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[referer]" style="width:300px;" value="';
    echo $caiji_config["referer"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>伪造IP</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">自定义IP格式 127.0.0.1<br>代理IP的格式 127.0.0.1:8080@user:pass' . "\r\n\t\t\t\t" . '<br><br>' . "\r\n\t\t\t\t" . '<div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>' . "\r\n\t\t\t\t\t" . '<font color="black">选代理IP：<br>文件形式：填写txt路径如：/data/daili.txt<br>' . "\r\n\t\t\t\t\t" . 'api形式：填写API 如：http://a.com/api.php<br><br>' . "\r\n\t\t\t\t\t" . '每行一个代理，格式如下：<br></font>' . "\r\n\t\t\t\t\t" . '<font color="red">127.0.0.1:8081</font><br>' . "\r\n\t\t\t\t\t" . '<font color="red">127.0.0.1:8080@user:pass</font><br>...' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '<br>' . "\r\n\t\t\t\t";
    if(function_exists('curl_init') && function_exists('curl_exec')){
        echo '<font color="green">你的空间支持curl，支持代理IP功能</font>';
    }else{
        echo '<font color="red">你的空间不支持curl，不能使用代理IP功能</font>';
    };
    echo "\t\t\t\t\r\n\t\t\t\t\r\n\t\t\t\t" . '</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[ip_cachetime]" style="width:50px;" value="';
    echo $caiji_config["ip_cachetime"]?$caiji_config["ip_cachetime"]:600;
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 秒，间隔时间<br><br>' . "\r\n\t\t\t\t" . '<input type="text" name="con[ip]" style="width:300px;" value="';
    echo $caiji_config["ip"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;<select name="con[ip_type]">' . "\r\n\t\t\t\t\t" . '<option value="1"';
    if($caiji_config["ip_type"] == 1)echo ' selected';
    echo '>自定义IP</option>' . "\r\n\t\t\t\t\t" . '<option value="2"';
    if($caiji_config["ip_type"] == 2)echo ' selected';
    echo '>随机IP</option>' . "\r\n\t\t\t\t\t" . '<option value="3"';
    if($caiji_config["ip_type"] == 3)echo ' selected';
    echo '>代理IP</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config8" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t" . '<dl id="slide">' . "\r\n\t\t\t\t\t\t" . '<dt>缓存设置</dt>' . "\r\n\t\t\t\t\t\t" . '<dd>' . "\r\n\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<h2>缓存设置：</h2>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>缓存独立设置</b> <br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">开启后可独立设置该节点的缓存，否则使用全局缓存设置</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[cache_set]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["cache_set"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["cache_set"])echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>css缓存开关</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">开启css缓存，加快速度</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[csscache]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["csscache"])echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["csscache"])echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>js缓存开关</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">开启js缓存，加快速度，<font color="red">一般不需要开启</font></font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[jscache]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["jscache"])echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["jscache"])echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>图片缓存/破解防盗链开关</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="red">如未防盗链可不开启</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[imgcache]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["imgcache"])echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["imgcache"])echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>页面缓存开关</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">开启页面缓存，节省服务器CPU资源</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[cacheon]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["cacheon"])echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["cacheon"])echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>自动清理缓存开关</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">开启后，超过缓存大小限制就自动清理缓存</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[deloldcache]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["deloldcache"])echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["deloldcache"])echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>蜘蛛记录开关</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">记录各大搜索引擎蜘蛛爬行动态</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[robotlogon]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["robotlogon"])echo 'selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["robotlogon"])echo 'selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>首页缓存保存时间</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[indexcache]" size="25" maxlength="50" value="';
    echo $caiji_config["indexcache"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般24小时内</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>其他页缓存保存时间</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[othercache]" size="25" maxlength="50" value="';
    echo $caiji_config["othercache"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般72小时内</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>图片缓存保存时间</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[imgcachetime]" size="25" maxlength="50" value="';
    echo $caiji_config["imgcachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 如果设置为0或不填，则不生成缓存' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>css缓存保存时间</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[csscachetime]" size="25" maxlength="50" value="';
    echo $caiji_config["csscachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般999小时内' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>js缓存保存时间</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>小时</font>为单位,1为1小时</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[jscachetime]" size="25" maxlength="50" value="';
    echo $caiji_config["jscachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般999小时内' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>缓存大小限制</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">超过设定值自动清除缓存,单位为 MB</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[delcache]" size="25" maxlength="50" value="';
    echo $caiji_config["delcache"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > 一般200内</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>定时检查缓存大小时间间隔</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">单位为天，间隔多少天自动扫描一次缓存大小</font><br><font color="red">扫描耗时长,建议不要设置太小值</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[delcachetime]" size="25" maxlength="50" value="';
    echo $caiji_config["delcachetime"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >  一般3天内</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</dd>' . "\r\n\t\t\t\t\t\t" . '<dt>关键词内链</dt>' . "\r\n\t\t\t\t\t\t" . '<dd style="display:none">' . "\r\n\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<h2>关键词内链：</h2>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>内链独立设置</b> <br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">开启后可独立设置该节点的内链，否则使用全局内链设置</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[linkword_set]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["linkword_set"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["linkword_set"])echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>关键词内链开关</b> <br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">是否开启关键词内链，仅内页</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[linkword_on]" >' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["linkword_on"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["linkword_on"])echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<b>设置的链接</b></font>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t\t";
    $var_71 = @implode("\r\n", @explode('|||', $caiji_config["link_config"]));;
    echo "\t\t\t\t\t\t\t\t\t" . '<td>每行一个关键词和链接，用“,”隔开<br> 如：<br> 百度,http://baidu.com<br>腾讯,http://qq.com<br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<textarea name="con[link_config]" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $var_71;
    echo '</textarea>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</dd>' . "\r\n\t\t\t\t\t\t" . '<dt>友情链接</dt>' . "\r\n\t\t\t\t\t\t" . '<dd style="display:none">' . "\r\n\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="tb_head">  ' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<h2>友情链接设置</h2>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>友情链接独立设置</b> <br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">开启后可独立设置该节点的友情链接，否则使用全局友情链接设置</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[flink_set]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["flink_set"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["flink_set"])echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>是否自动加到首页底部</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">如不自动添加，则可以使用{flinks}进行调用</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[flinks_auto_insert]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["flinks_auto_insert"] == 1 || $caiji_config["flinks_auto_insert"] == "")echo 'selected';
    echo '>是</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="2" ';
    if($caiji_config["flinks_auto_insert"] == 2)echo 'selected';
    echo '>否</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260" align="center">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<b>友情链接设置</b>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>  ' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td>每行一个链接<br>如：&lt;a target="_blank" href=\'http://baidu.com\' &gt;百度&lt;/a&gt;<br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<textarea name="con[flink]" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["flink"];
    echo '</textarea>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</dd>' . "\r\n\t\t\t\t\t\t" . '<dt>插件配置</dt>' . "\r\n\t\t\t\t\t\t" . '<dd style="display:none">' . "\r\n\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="tb_head">  ' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<h2>已启用的插件配置<font color="red">（在【高级功能】里启用插件后，刷新这里才会显示）</font></h2>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<style type="text/css">' . "\r\n\t\t\t\t\t\t\t\t\t" . '.plustable{ background-color: #fff;}' . "\r\n\t\t\t\t\t\t\t\t\t" . '.plustable td{border-bottom: 1px solid #EBEBEB;}' . "\r\n\t\t\t\t\t\t\t\t" . '</style>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="firstalt">  ' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline plustable">' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="50" align="center"><b>ID</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="120" align="center"><b>插件名称</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="200" align="center"><b>插件说明</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="100" align="center"><b>作者</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="130" align="center"><b>版本</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="130" align="center"><b>独立配置</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="150" align="center"><b>操作</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t";
    $var_67 = array();
    $var_72 = VV_DATA . '/plus';
    if($caiji_config["plus"]){
        $var_67 = explode(',', $caiji_config["plus"]);
        foreach($var_67 as $var_5 => $var_6){
            $var_68 = $var_72 . '/' . $var_6 . '/' . $var_6 . '.class.php';
            if(!is_file($var_68)){
                continue;
            }
            require_once($var_68);
            $var_69 = new $var_6;
            $var_70 = $var_69 -> info;;
            echo "\t\t\t\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td align="center">';
            echo $var_5;
            echo '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td style="padding-left:20px">';
            echo $var_70["name"];
            echo '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td align="center">';
            echo $var_70["info"];
            echo '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td align="center">';
            echo $var_70["author"];
            echo '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td align="center">';
            echo $var_70["version"];
            echo '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td align="center">' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<select name="con[plus_';
            echo $var_6;
            echo '_set]">' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
            if($caiji_config["plus_" . $var_6 . '_set'])echo ' selected';
            echo '>开启</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
            if(!$caiji_config["plus_" . $var_6 . '_set'])echo ' selected';
            echo '>关闭</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '</select>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td align="center">';
            if(@is_file(VV_DATA . '/plus/' . $var_6 . '/config.php')){;
                echo '<a onclick="plus_set_dialog(\'';
                echo $var_6;
                echo '\',\'';
                echo $var_70["name"];
                echo '\');" href="javascript:">配置</a>';
            }else{;
                echo '<font color="red">无需配置</font>';
            };
            echo '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t";
        }
    };
    echo "\t\t\t\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<script type="text/javascript">' . "\r\n\t\t\t\t\t\t\t\t" . 'function save_plus(name){' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.firstalt .plusbtn\').attr(\'disabled\',\'disabled\').val(\' 正在保存... \');' . "\r\n\t\t\t\t\t\t\t\t\t" . '$.ajax({' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'type:"post",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'url: \'?ac=plus_save&id=';
    echo $var_25;
    echo '&name=\'+name,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'data:$("form").serialize(),' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'dataType: \'json\',' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'success: function(data){' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . 'if(data.status==1){' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . 'alert(data.info);' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '$(\'.keybox\').dialog(\'destroy\');' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . 'alert(data.info);' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '$(\'.firstalt .plusbtn\').attr(\'disabled\',false).val(\' 保存配置 \');' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t\t" . '});' . "\r\n\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t" . 'function plus_set_dialog(name,title){' . "\r\n\t\t\t\t\t\t\t\t\t" . 'if($(\'.keybox\').length<1){' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '$(\'body\').append(\'<div class="keybox" style="line-height:30px;"></div>\');' . "\r\n\t\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.keybox\').html(\'<p align="center" style="margin-top:100px"><img src="../public/img/load.gif"> 载入中</p>\');' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.keybox\').dialog({' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'width: 850,height: 440,modal: !0,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'title: "插件独立配置【"+title+"】",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'close: function(event, ui) {' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '$(".ui-dialog .ui-dialog-titlebar-close").hide();' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '},' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'buttons: {}' . "\r\n\t\t\t\t\t\t\t\t\t" . '});' . "\r\n\t\t\t\t\t\t\t\t\t" . '$.ajax({' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'url: \'?ac=plus_set&id=';
    echo $var_25;
    echo '&name=\'+name,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'dataType: \'html\',' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'success: function(data){' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '$(".keybox").html(data);' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t\t" . '});' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(".ui-dialog .ui-dialog-titlebar-close").show();' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.ui-icon\').css({ \'text-indent\':\'0\' });' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.ui-icon-closethick\').html(\'关闭\');' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(".ui-dialog .ui-dialog-titlebar-close").css({ \'width\':\'auto\' });' . "\r\n\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t" . '</script>' . "\r\n\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</dd>' . "\r\n\t\t\t\t\t" . '  </dl>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<script type="text/javascript">' . "\r\n\t\t\t" . '$("#slide").KandyTabs({' . "\r\n\t\t\t\t" . 'action:"slide",' . "\r\n\t\t\t\t" . 'trigger:"click"' . "\r\n\t\t\t" . '});' . "\r\n\t\t\t" . '</script>' . "\r\n\t\t\t" . '<style type="text/css">' . "\r\n\t\t\t\t" . '#slide { padding:0; border:1px solid #DDD; overflow:hidden;}' . "\r\n\t\t\t\t" . '#slide .tabtitle { line-height:28px }' . "\r\n\t\t\t\t" . '#slide .tabtitle .tabbtn { background:none; border-width:0 0 0 1px;padding: 2px 20px; cursor:pointer;text-align:center; border-radius:0; margin:0 0 0 -1px }' . "\r\n\t\t\t\t" . '#slide .tabtitle .tabcur { background:#fff;}' . "\r\n\t\t\t\t" . '#slide .tabbody { border-width:1px 0 0 }' . "\r\n\t\t\t" . '</style>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config10" style="display:none;">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td><b>超级模板开关</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">是否启用超级模板</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[theme_open]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["theme_open"] == "0")echo ' selected';
    echo '>关闭</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["theme_open"])echo ' selected';
    echo '>开启</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n";
    $var_73 = array();
    $var_52 = VV_TMPL;
    $var_73 = scandirs($var_52);
    foreach($var_73 as $var_5 => $var_6){
        $var_74 = $var_52 . '/' . $var_6 . '/index.html';
        if($var_6 == '.' || $var_6 == '..' || !is_dir($var_52 . '/' . $var_6) || !is_file($var_74)){
            unset($var_73[$var_5]);
        }
    };
    echo "\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td><b>选择模板</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">选择模板风格文件夹</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[theme_dir]" >' . "\r\n\t\t\t\t" . '<option value="">无</option>' . "\r\n\t\t\t\t";
    foreach($var_73 as $var_5 => $var_6){;
        echo "\t\t\t\t\t\t" . '<option value="';
        echo $var_6;
        echo '" ';
        if($caiji_config["theme_dir"] == $var_6)echo ' selected';
        echo '>';
        echo $var_6;
        echo '</option>' . "\r\n\t\t\t\t";
    };
    echo "\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td><b>非匹配链接显示</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">是否显示URL规则以外的链接</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[theme_showotherurl]" >' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["theme_showotherurl"])echo ' selected';
    echo '>是</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["theme_showotherurl"] == "0")echo ' selected';
    echo '>否</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">栏目页</u>URL规则</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">一行一个，一般带http://和域名，格式如下：<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">http://a.com/list/{数字}.html</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">可用通配符：{数字}、{字母}、{数字字母}、{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_list]" style="height: 100px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_list"]);
    echo '</textarea>&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">注：是根据目标站url来写，不是本站的</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">栏目页分页</u>URL规则</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">一行一个，一般带http://和域名，格式如下：<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">http://a.com/list/{数字}_{数字}.html</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">可用通配符：{数字}、{字母}、{数字字母}、{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_listpage]" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_listpage"]);
    echo '</textarea>&nbsp;&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">注：是根据目标站url来写，不是本站的</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">内容页</u>URL规则</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">一行一个，一般带http://和域名，格式如下：<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">http://a.com/html/{数字}.html</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">可用通配符：{数字}、{字母}、{数字字母}、{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_show]" style="height: 100px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_show"]);
    echo '</textarea>&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">注：是根据目标站url来写，不是本站的</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">内容页分页</u>URL规则</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">一行一个，一般带http://和域名，格式如下：<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">http://a.com/html/{数字}_{数字}.html</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">可用通配符：{数字}、{字母}、{数字字母}、{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_showpage]" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_showpage"]);
    echo '</textarea>&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">注：是根据目标站url来写，不是本站的</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b>内容页内容区域</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">一行一个正则，截取内容区域，如：<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">&lt;div class="content"&gt;(.*)&lt;/div&gt;</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">填写正则</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[rules_body]" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["rules_body"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">自定义模板</u>URL规则</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">一行一个，一般带http://和域名，格式如下：<br>' . "\r\n\t\t\t\t\t\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">' . "\r\n\t\t\t\t\t\t\t" . 'url规则----模板文件名----是否采集<br>' . "\r\n\t\t\t\t\t\t\t" . '/tag_{*}.html----tags.html----1<br>' . "\r\n\t\t\t\t\t\t\t" . '/about.html----about.html----0<br>' . "\r\n\t\t\t\t\t\t" . '</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">可用通配符：{数字}、{字母}、{数字字母}、{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_other]" style="height: 100px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_other"]);
    echo '</textarea>&nbsp;<font color="red">注：不采集时，将直接渲染模板，享有最高优先权</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b>url地址过滤</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">一行一个需要过滤的目标站地址</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[theme_sifturl]" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["theme_sifturl"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td> </td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t" . '<input type="submit" value=" 提交 " name="submit" class="bginput">&nbsp;&nbsp;<input type="button" onclick="location.href=\'?page=';
    echo $var_39;
    echo '&keywords=';
    echo $var_40;
    echo '\';" value=" 返回 " name="Input" class="bginput"></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '</form>' . "\r\n";
};
echo '</div>' . "\r\n" . '</div>' . "\r\n";
include 'footer.php';
echo '</body>' . "\r\n" . '</html>';
