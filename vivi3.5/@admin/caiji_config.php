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
        ShowMsg('��ϲ��,ɾ���ɹ���', 'caiji_config.php?page=' . $var_39 . '&keywords=' . $var_40, 500);
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
    ShowMsg('��ϲ��,�޸ĳɹ���', 'caiji_config.php?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'delselect'){
    if(empty($_POST["ids"])){
        ShowMsg('��ѡ����Ҫɾ���Ľڵ�!', -1, 2000);
    }
    $var_15 = $_POST["ids"];
    foreach($var_15 as $var_41){
        $var_41 = intval($var_41);
        $var_28 = VV_DATA . '/config/' . $var_41 . '.php';
        @unlink($var_28);
    }
    reset_domain();
    ShowMsg('��ϲ��,ɾ���ɹ���', 'caiji_config.php?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'status'){
    $var_2 = (int)$_GET["collectid"];
    $var_28 = VV_DATA . '/config/' . $var_2 . '.php';
    $var_42 = intval($_GET["sid"]);
    if(!is_file($var_28))ShowMsg('�ɼ������ļ�������', -1, 3000);
    $caiji_config = require_once($var_28);
    if($caiji_config){
        $caiji_config["web_close"] = ($var_42?'off':'on');
        arr2file($var_28, $caiji_config);
    }
    reset_domain();
    ShowMsg('��ϲ��,�޸ĳɹ���', '?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'rewrite'){
    $var_2 = (int)$_GET["collectid"];
    $var_28 = VV_DATA . '/config/' . $var_2 . '.php';
    $var_42 = intval($_GET["sid"]);
    if(!is_file($var_28))ShowMsg('�ɼ������ļ�������', -1, 2000);
    $caiji_config = require_once($var_28);
    if($caiji_config){
        $caiji_config["rewrite"] = $var_42;
        arr2file($var_28, $caiji_config);
    }
    reset_domain();
    ShowMsg('��ϲ��,�޸ĳɹ���', '?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'collect_status'){
    $var_2 = (int)$_GET["collectid"];
    $var_28 = VV_DATA . '/config/' . $var_2 . '.php';
    $var_42 = intval($_GET["sid"]);
    if(!is_file($var_28))ShowMsg('�ɼ������ļ�������', -1, 2000);
    $caiji_config = require_once($var_28);
    if($caiji_config){
        $caiji_config["collect_close"] = $var_42;
        arr2file($var_28, $caiji_config);
    }
    reset_domain();
    ShowMsg('��ϲ��,�޸ĳɹ���', '?page=' . $var_39 . '&keywords=' . $var_40, 500);
}
if($var_14 == 'plus_save'){
    $var_43 = $_GET["name"];
    $var_43 = preg_replace('~[^\w]+~', "", $var_43);
    if(!is_dir(VV_DATA . '/plus/' . $var_43)){
        ajaxReturn(array("status" => "0", "info" => '��������ڣ���'));
    }
    $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
    if(!is_file($var_28)){
        ajaxReturn(array("status" => "0", "info" => '�ɼ������ļ������ڣ���'));
    }
    $caiji_config = require_once($var_28);
    if($caiji_config){
        $caiji_config["plus_" . $var_43 . '_config'] = ($_POST["con"]?$_POST["con"]:$_POST["plus"]);
        $var_44 = arr2file($var_28, $caiji_config);
        if($var_44 === false){
            ajaxReturn(array("status" => 1, "info" => '�޸�ʧ�ܣ�����ļ�д��Ȩ�ޣ�'));
        }
        ajaxReturn(array("status" => 1, "info" => '��ϲ��,�޸ĳɹ���'));
    }
}
if($var_14 == 'plus_set'){
    $var_43 = $_GET["name"];
    $var_43 = preg_replace('~[^\w]+~', "", $var_43);
    $var_45 = VV_DATA . '/config/' . $var_25 . '.php';
    $caiji_config = require_once($var_45);
    if(!is_dir(VV_DATA . '/plus/' . $var_43)){
        ajaxReturn(array("status" => "0", "info" => '��������ڣ���'));
    }
    $var_46 = VV_DATA . '/plus/' . $var_43 . '/' . $var_43 . '.class.php';
    if(!is_file($var_46)){
        ajaxReturn(array("status" => "0", "info" => '��������ڣ���'));
    }
    $plusconfig = $caiji_config["plus_" . $var_43 . '_config'];
    echo '<form method="post" name="plusform" id="plusform"><table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline plustable">';
    @include(VV_DATA . '/plus/' . $var_43 . '/' . $var_43 . '.form.html');
    echo '<tr class="firstalt">' . "\r\n\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t" . '<td colspan="2">' . "\r\n\t\t\t" . '<input type="submit" value=" �������� " name="submit" class="bginput plusbtn" onclick="save_plus(\'' . $var_43 . '\');"></td>' . "\r\n\t\t" . '</tr></table></form>';
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
                exit('���˹����������ʽ��ʽ����ȷ');
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
                exit('ǰ�ù��˹����������ʽ��ʽ����ȷ');
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
        exit('�޸�ʧ�ܣ�����ļ�д��Ȩ�ޣ�');
    }
    exit('��ϲ��,�޸ĳɹ���');
}
if($var_14 == 'saveimport'){
    Oo00o0O0o('��˼�Ǣ�87���ɫD5�ŵ�һ��9Dֵ���|��A9���Ӻ�A9r�ı�̢�DA�ַ��Т�A6�ɼ�����CD������9F_˵�ľ͡�8AС͵���91������80���y��84�P�g��8C������89�}�X�V��8E�P�g��8D���y��A2��Ҫ�ߢ�D1С͵���A3�Z�[��D3���y��A9��������AD�ŵ�һ��96��һ����A8�}�X�V��C7���ɫDC��Ҫ�ߢ�D8˵�ľ͡�5E���u��8D��֪����8C�ɼ�����9CE��֪����3B��֪����3EY����ʷ��CF܆�}�X��98��һ����A1��һ����9Bֵ���|��AAС͵���D9��һ����97��֪����A4�����ԩ�5D�����W��5Dֵ���|��94���ɫ83������B5�}�X�V��8C�}�X�V��B8�ŵ�һ��8E�P�g��8B�ַ��Т�A0��֪����9D�����ԩ�5EС͵���91�����W��8BҪ������A3�ַ��Т�88���y��96�}�X�V��80�ı�̢�B2С͵���B4�ַ��Т�8C��������8Cֵ���|��5C�����֢�9E�P�g��CA�����֢�5B�}�X�V��C1l�}�X�V��5E�ŵ�һ��8Dm�ַ��Т�3D�Z�[��3FB���Ӻ�9E����ʷ��99���ɫ8EZС͵���88�Z�[��9C������C8������60������B4D�����̢�3Ekm�N������88�}�X�V��98��֪����A2Ҫ������D5���Ӻ�9E܆�}�X��9F������9D�P�g��A4�ı�̢�97������8E���Ӻ�8A܆�}�X��BA��֪����91�����֢�7B���y��A7�����֢�86qc�����֢�60d�ŵ�һ��96��һ����D5Ҫ������A7Ҫ������CAֵ���|��9C����ʷ��CBfce���y��A4�ַ��Т�CA��������D4��˼�Ǣ�8B��˼�Ǣ�60kpkA������3A��������9E����ʷ��9B������8EU������B3�ɼ�����A1�Z�[��86��������96���Pח��A1�P�g��60��������84i������A4��Ҫ�ߢ�5B��һ����8FY�ַ��Т�8AY���u��84������9A�����̢�A8С͵���ACС͵���A2����ʷ��D6�ŵ�һ��8C�ŵ�һ��88�ı�̢�98��һ����A2������D5܆�}�X��8AvngU���y��8FT�ɼ�����B7С͵���9A���ɫA6���Pח��DD��������7F�ɼ�����A3���Pח��9Ca�Z�[��5C������E8�}�X�V��22�����֢�01O��������FD������0B�P�g��E7�����ԩ�15Ҫ������DA������E00ֵ���|��18.���y��11˵�ľ͡�F8ֵ���|��0B7������F3�����̢�F5������11��Ҫ�ߢ�086f0�����֢�27�P�g��F0LҪ������06�Z�[��22ֵ���|��5Ce��˼�Ǣ�5C˵�ľ͡�60�P�g��97�ı�̢�60�Z�[��90i��Ҫ�ߢ�94gi����ʷ��60oonm܆�}�X��40���Pח��99���y��C9˵�ľ͡�89��Ҫ�ߢ�5C�ŵ�һ��92������A7˵�ľ͡�A7���Pח��8F�����֢�AFqֵ���|��3C�Z�[��40o�Z�[��3BT������96�����֢�AB��������A7p�����W��C7���u��ABҪ������D6������94�Vһ��DD��������96ֵ���|��A6˵�ľ͡�98�}�X�V��A4���Pח��8A������8B��֪����C6�ɼ�����98������A3���Ӻ�C8�����ԩ�CF���Ӻ�99���Ӻ�9E�����W��9A�Z�[��5CС͵���92X������C5�����ԩ�A4�Z�[��A9���u��8Fm�}�X�V��3D�Vһ��3FB���Pח��3E�����ԩ�3C�Z�[��8A��һ����9Aֵ���|��D6��������A5������A1��˼�Ǣ�98�����̢�AB�}�X�V��A9��֪����95��˼�Ǣ�DB������C3Ҫ������D1˵�ľ͡�98��֪����A0�Z�[��8B���Pח��88�ɼ�����A1�ŵ�һ��9FС͵���A9�}�X�V��ABС͵���C7�ɼ�����A0ֵ���|��8B�ɼ�����5E����ʷ��5B������C7��һ����A4����ʷ��A2���Ӻ�5EtB��������3DoBmW�����ԩ�CD���y��9Bv�ı�̢�A4�����ԩ�95������DA�����ԩ�8C��Ҫ�ߢ�88���Pח��98�����W��A2С͵���D5������8AcbpBp���ɫ3Dm���Pח��AFDp�ı�̢�3B���y��ADBCֵ���|��3EW�����֢�CC����ʷ��A2�����֢�D0�����ԩ�98������A1˵�ľ͡�8D�����ԩ�8F������96x�P�g��A3С͵���B8��˼�Ǣ�A5eW�ŵ�һ��92Ҫ������C4�����ԩ�A7�Z�[��9F܆�}�X��9B�ɼ�����9E܆�}�X��CDc��һ����8B�ŵ�һ��60��֪����5B��֪����CF����ʷ��96�ַ��Т�5E���u��5Cg������A5�}�X�V��9B��˼�Ǣ�D6���Ӻ�60������9F�Vһ��40n���Pח��40������A2�Vһ��9D�ŵ�һ��5C��һ����D2��˼�Ǣ�D6����ʷ��C9����ʷ��9E܆�}�X��8F���Pח��D0��Ҫ�ߢ�C2��������AC˵�ľ͡�94�ŵ�һ��9D�}�X�V��5D܆�}�X��8DW�Vһ��C2Ҫ������88�ŵ�һ��80���u��BC���Ӻ�7BjX��������60aW��������DA�����֢�9E�N������DC�ɼ�����A7˵�ľ͡�8D�ַ��Т�60��һ����B4DС͵���3Ekm��һ����CD���y��9DX�ַ��Т�84������D1��֪����AA���y��96====||||||||||||      vxiaotou.com�ɼ�����      ||||||||||||====9C��Ҫ�ߢ�94��˼�Ǣ�D3�ַ��Т�95�ַ��Т�D8����ʷ��95�ַ��Т�9F��������8EYSo�ַ��Т�7E�Vһ��83wֵ���|��8A�ı�̢�5C���ɫ8B_���y��88�Z�[��AB��������9E��������AF�ַ��Т�A8��֪����8B������8D��֪����DFD���Ӻ�3A�}�X�V��83������81XQUU�}�X�V��86T������84RW�����ԩ�86�Vһ��85�����W��98����ʷ��A4����ʷ��B0�P�g��82���Ӻ�A6�����W��CDa�ŵ�һ��8B���Pח��EB�ɼ�����27܆�}�X��F0�����ԩ�1F�ɼ�����0B��һ����26��֪����14�ַ��Т�1F܆�}�X��1E�P�g��06��Ҫ�ߢ�E7���ɫ0B�N������04������E4�ŵ�һ��E3������FE���Ӻ�F1����ʷ��15��Ҫ�ߢ�EDJ���u��06������294���Pח��DC��������D3�N������EF��������8F������7E˵�ľ͡�89��һ����AFs������C6�}�X�V��94С͵���D7С͵���9Cokֵ���|��E8��֪����5CҪ������26Oqu�����ԩ�B1��������A5XR�N������5Ca��֪����8Da��������95Yc܆�}�X��9Cb�����̢�60ebp������40pY��˼�Ǣ�84S���Ӻ�84WYWT�����W��DFqn܆�}�X��409ֵ���|��87���u��CF�ŵ�һ��A7܆�}�X��A5ֵ���|��9A˵�ľ͡�A8С͵���D9T�Z�[��A1R��Ҫ�ߢ�9C܆�}�X��DE���Pח��A2�}�X�V��9C��Ҫ�ߢ�A4С͵���9D��������9A������5B�����ԩ�8Ds��֪����8B_С͵���88������AB�}�X�V��9E��Ҫ�ߢ�AF���y��A8܆�}�X��8B�Vһ��9FqAP���ɫ83���u��81XQUU���Pח��86X��֪����C7�����ԩ�A1�N������A5�ɼ�����CC��������9B�ŵ�һ��97UvUW���Ӻ�D4�}�X�V��A8������D8������98��Ҫ�ߢ�D7��һ����AA�Z�[��94h��˼�Ǣ�91�ŵ�һ��9DqnWP���Ӻ�83��Ҫ�ߢ�81XQUU�����W��8A���ɫ97�P�g��D3˵�ľ͡�A0������9D������CF�N������99PrY���Ӻ�AA���u��A1���Pח��D9�����W��9E�����W��D6��һ����9CҪ������C5���Ӻ�A3��һ����A2��һ����B1�N������99�����ԩ�8Aֵ���|��C6�ɼ�����C5�����̢�AAС͵���95Ҫ������99С͵���95���u��97�Vһ��95С͵���9A�ɼ�����98�����̢�D5���Pח��98�}�X�V��C9Z��Ҫ�ߢ�A7�����֢�D8�P�g��97��������97˵�ľ͡�94��������AB������9A�ɼ�����A3�Z�[��D2���ɫ9A���Ӻ�C7��������98�ַ��Т�8CY��������5C�}�X�V��92������90��Ҫ�ߢ�D4���u��C0�Z�[��D2������93���y��A4������83������BE��֪����5BSa��������5C܆�}�X��8D��������60���u��88�����֢�95�ı�̢�A6���y��D4�ŵ�һ��98��һ����99��˼�Ǣ�9Cb�Vһ��5E������5C���y��86���Pח��88��֪����B6S���Pח��C8���u��A0�P�g��9E_���ɫ5B����ʷ��27H���u��3A������FA����ʷ��079�P�g��183˵�ľ͡�E5������E3ֵ���|��086�P�g��E8Q˵�ľ͡�00܆�}�X��2A����ʷ��09������D3W��˼�Ǣ�5EtB��������3Do܆�}�X��B6�P�g��C9���y��9F������D7�����ԩ�9C������B4D�����ԩ�3Ekm�����̢�B7˵�ľ͡�9F������9F���y��DA�Z�[��AE��һ����AB��������98�����֢�5DW�����W��1E��Ҫ�ߢ�F7�}�X�V��1D������18������0BX���Ӻ�E4���u��EB���u��EF܆�}�X��08��һ����EC��������DB�ɼ�����09���y��E52���y��11��������1B�����ԩ�DF�����֢�EE��˼�Ǣ�F3�ı�̢�FCM܆�}�X��07���ɫ05Y������5C��˼�Ǣ�8A�ŵ�һ��8EiXak�����֢�96d������94������5Brs�N������3C9�ŵ�һ��B2F�ŵ�һ��3FҪ������3C�ַ��Т�C7�����W��AB�ɼ�����D6e���ɫCA˵�ľ͡�A0˵�ľ͡�A5�����ԩ�9C��֪����5C���Pח��86�ɼ�����CA������CD�P�g��A3Ҫ������95˵�ľ͡�8F���y��85�Vһ��9B������A0�ַ��Т�A3�ɼ�����9B��˼�Ǣ�CF������9BС͵���8DmDp�}�X�V��3B���y��83���Ӻ�9DС͵���A8�ɼ�����AC������80��֪����D9��������A0��һ����8CUС͵���1D�Z�[��DE��֪����08��һ����E9���y��F8E�ı�̢�90�Vһ��19��һ����F3���y��F8N��֪����14�N������01ֵ���|��EA������DB�Vһ��D8܆�}�X��07V�N������90YҪ������9A������C7�Vһ��9B�����ԩ�9AҪ������9E��Ҫ�ߢ�98�N������98ֵ���|��A2���u��D4�ַ��Т�9F���Pח��CD���ɫ9A�}�X�V��92�����W��A7��������A1С͵���A7С͵���5B�ַ��Т�8E�ı�̢�96��һ����94g������60�ı�̢�8C�}�X�V��9C', 866);
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
    echo '<style type="text/css">' . "\r\n" . '.page{clear:both;padding:20px 0;color:#0066ff;text-align:center;font-size:14px;}' . "\r\n" . '.page span,.page a{display:inline-block;padding:2px 6px;}' . "\r\n" . '.page span{margin:0 5px;color:#fff;background:#3399ff;}' . "\r\n" . '.page a{color:#0066ff;margin:0 5px;border:1px solid #3399ff;border-radius:3px;font-weight:700;}' . "\r\n" . '.page a:hover{color:#fff;background-color:#3399ff;text-decoration:none;}' . "\r\n" . '</style>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'function checkall(form, prefix, checkall) {' . "\r\n\t" . 'var checkall = checkall ? checkall : \'chkall\';' . "\r\n\t" . 'count = 0;' . "\r\n\t" . 'for(var i = 0; i < form.elements.length; i++) {' . "\r\n\t\t" . 'var e = form.elements[i];' . "\r\n\t\t" . 'if(e.name && e.name != checkall && e.type==\'checkbox\' && !e.disabled && (!prefix || (prefix && e.name.match(prefix)))) {' . "\r\n\t\t\t" . 'e.checked = form.elements[checkall].checked;' . "\r\n\t\t\t" . 'if(e.checked) {' . "\r\n\t\t\t\t" . 'count++;' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '}' . "\r\n\t" . '}' . "\r\n\t" . 'return count;' . "\r\n" . '}' . "\r\n" . '</script>' . "\r\n" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td colspan="13">�ɼ��ڵ����&nbsp;&nbsp;-&nbsp;<a href="?ac=add" style=\'color:red\'>���</a>&nbsp;-&nbsp;<a href="?ac=import" style=\'color:red\'>����</a>&nbsp;-&nbsp;<a href="http://www.vxiaotou.com" target="_blank" style=\'color:red\'>��ȡ�������</a>' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td colspan="13"><form action="" method="post"><input type="text" name="keywords" size="20" value="" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;<input type="submit" value="����" />&nbsp;&nbsp;<font color="blue">Ĭ�Ϲ���IDΪ</font>[<font size="" color="red">';
    echo $v_config["collectid"];
    echo '</font>]&nbsp;&nbsp;<font color="#dd00b0">ע���ɼ�����Ϊ�ر�ʱ����ֹͣ�ɼ���ʹ�û��棡</font></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t";
    if($var_40){;
        echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td colspan="13"><font color="blue">������ <font color="red">';
        echo $var_40;;
        echo '</font> ���Ľ����<a href="?">����ȫ��</a></font></td>' . "\r\n\t" . '</tr>' . "\r\n\t";
    };
    echo "\t" . '</tbody>' . "\r\n" . '<form action="" method="post" name="form" id="form">' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td width="20" align="center">ѡ��</td>' . "\r\n\t\t" . '<td width="30" align="center">Ĭ��</td>' . "\r\n\t\t" . '<td width="30" align="center">ID</td>' . "\r\n\t\t" . '<td align="center">��վ����</td>' . "\r\n\t\t" . '<td align="center" width="150">Ŀ��վ</td>' . "\r\n\t\t" . '<td align="center">������</td>' . "\r\n\t\t" . '<td width="30" align="center">˵��</td>' . "\r\n\t\t" . '<td width="60" align="center">�ɼ�����</td>' . "\r\n\t\t" . '<td width="40" align="center">״̬</td>' . "\r\n\t\t" . '<td width="100" align="center">����ģ��</td>' . "\r\n\t\t" . '<td width="60" align="center">α��̬</td>' . "\r\n\t\t" . '<td width="110" align="center">�޸�ʱ��</td>' . "\r\n\t\t" . '<td width="210" align="center">����</td>' . "\r\n\t" . '</tr>' . "\r\n";
    if($var_54){
        foreach($var_54 as $var_5 => $var_6){;
            echo "\t" . '<tr nowrap onmouseover=this.bgColor=\'#EDF8FE\'; onmouseout=this.bgColor=\'#ffffff\'; bgcolor=\'#ffffff\'>' . "\r\n\t\t" . '<td align="center"><input name=\'ids[]\' type=\'checkbox\' value=\'';
            echo $var_6["id"];
            echo '\'></td>' . "\r\n\t\t" . '<td align="center">' . "\r\n\t\t\t";
            echo $var_6["id"] == $v_config["collectid"]?'<font color="red">Ĭ��</font>':'<a href="?ac=savecollectid&collectid=' . $var_6["id"] . '&sid=0&page=' . $var_39 . '" title="�����ΪĬ�Ͻڵ�">��Ϊ</a>';
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
            echo $var_6["web_domains"]?$var_6["web_domains"]:'<font color="red">δ��</font>';
            echo '</div></td>' . "\r\n\t\t" . '<td align="center"><a href="javascript:" onclick=\'alert("';
            echo!empty($var_6["licence"])?str_replace(array("\r\n", "\r", "\n"), '\n', $var_6["licence"]):'��';;
            echo '");\'>����</a></td>' . "\r\n\t\t" . '<td align="center">';
            echo $var_6["collect_close"]?'<a href="?ac=collect_status&collectid=' . $var_6["id"] . '&sid=0&page=' . $var_39 . '" title="�������"><font color="red">�ѹر�</font></a>':'<a href="?ac=collect_status&collectid=' . $var_6["id"] . '&sid=1&page=' . $var_39 . '" title="����ر�"><font color="green">�ѿ���</font></a>';
            echo '</td>' . "\r\n\r\n\t\t" . '<td align="center">';
            echo $var_6["web_close"] == 'on'?'<a href="?ac=status&collectid=' . $var_6["id"] . '&sid=1&page=' . $var_39 . '" title="�������"><font color="red">�ر�</font></a>':'<a href="?ac=status&collectid=' . $var_6["id"] . '&sid=0&page=' . $var_39 . '" title="����ر�"><font color="green">����</font></a>';
            echo '</td>' . "\r\n\r\n\t\t" . '<td align="center" style="color:#666">';
            echo($var_6["theme_open"]?'<font color="green">����</font>':'<font color="red">�ر�</font>');
            echo '/';
            echo($var_6["theme_dir"]?$var_6["theme_dir"]:'��');
            echo '</td>' . "\r\n\t\t" . '<td align="center">';
            echo!$var_6["rewrite"]?'<a href="?ac=rewrite&collectid=' . $var_6["id"] . '&sid=1&page=' . $var_39 . '" title="�������"><font color="red">�ѹر�</font></a>':'<a href="?ac=rewrite&collectid=' . $var_6["id"] . '&sid=0&page=' . $var_39 . '" title="����ر�"><font color="green">�ѿ���</font></a>';
            echo '</td>' . "\r\n\t\t" . '<td align="center">';
            echo date('Y-m-d H:i', $var_6["time"]);
            echo '</td>' . "\r\n\t\t" . '<td align="center"><a target="_blank" href="?ac=yulan&collectid=';
            echo $var_6["id"];
            echo '">Դ����</a>/<a href="delcache.php?collectid=';
            echo $var_6["id"];
            echo '">����</a>/<a href="?ac=xiugai&id=';
            echo $var_6["id"];
            echo '">�޸�</a>/<a href="?ac=export&id=';
            echo $var_6["id"];
            echo '">����</a>/<a href="?ac=import&id=';
            echo $var_6["id"];
            echo '">����</a>/<a href="?ac=del&id=';
            echo $var_6["id"];
            echo '&page=';
            echo $var_39;
            echo '" onClick="return confirm(\'ȷ��ɾ��?\')">ɾ��</a></td>' . "\r\n\t" . '</tr>' . "\r\n";
        };
        echo "\t" . '<tbody>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td colspan="13">' . "\r\n\t\t\t\t" . '<input name="chkall" type="checkbox" id="chkall" onclick="checkall(this.form)" value="checkbox">&nbsp;<label for="chkall">ȫѡ/��ѡ</label>' . "\r\n\t\t\t\t" . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . "\r\n\t\t\t\t" . '<input type="submit" value="ɾ��ѡ��" class="bginput" onClick="if(confirm(\'ȷ��Ҫɾ����?\')){form.action=\'?ac=delselect&page=';
        echo $var_39;
        echo '\';}else{return false}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td align="center" colspan="13"><ul class="page">';
        echo $var_63;
        echo '</ul></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n" . '</form>' . "\r\n";
    }else{;
        echo "\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td colspan="13" align="center">û���ҵ��ɼ��ڵ㣡</td>' . "\r\n\t" . '</tr>' . "\r\n";
    };
    echo '</table>' . "\r\n";
}elseif($var_14 == 'export'){
    $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
    if(!is_file($var_28))ShowMsg('�ɼ������ļ�������', -1, 3000);
    $caiji_config = require_once($var_28);
    $var_64 = 'VIVI:' . base64_encode(serialize($caiji_config)) . ':END';;
    echo '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td><h2>�����ɼ�����</h2></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td><b>����Ϊ���� [';
    echo $caiji_config["web_name"];
    echo '] �����ã�����Թ�����������:</b></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td align="center"><textarea style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $var_64;
    echo '</textarea></td>' . "\r\n\t" . '</tr>' . "\r\n" . '</table>' . "\r\n";
}elseif($var_14 == 'import'){
    $var_65 = "";
    if($var_25){
        $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
        if(!is_file($var_28))ShowMsg('�ɼ������ļ�������', -1, 3000);
        $caiji_config = require_once($var_28);
        $var_65 = '( ����[' . $caiji_config["web_name"] . ']��)<input type="hidden" name="id" value="' . $var_25 . '" />';
    };
    echo '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n" . '<form action="?ac=saveimport" method="post">' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td><h2>����ɼ�����</h2></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td><b>��������������Ҫ����Ĳɼ�����</b><font color="red">';
    echo $var_65;
    echo '</font>��</td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t" . '<td align="center"><textarea name="import_text" style="height: 350px;width:95%;padding:5px;background:#eee;" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></textarea></td>' . "\r\n\t" . '</tr>' . "\r\n\t" . '<tbody>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td align="center" colspan="2">' . "\r\n\t\t\t" . '<input type="submit" value=" �ύ " name="submit" class="bginput">&nbsp;&nbsp;<input type="button" onclick="history.go(-1);" value=" ���� " name="Input" class="bginput"></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t" . '</tbody>' . "\r\n" . '</form>' . "\r\n" . '</table>' . "\r\n";
}elseif($var_14 == 'xiugai' || $var_14 == 'add'){
    if($var_14 == 'xiugai'){
        $var_28 = VV_DATA . '/config/' . $var_25 . '.php';
        if(!is_file($var_28))ShowMsg('�ɼ������ļ�������', -1, 3000);
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
    echo '" method="post" id="form">' . "\r\n" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t" . '<tbody>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t" . '<td colspan="2"><div style=\'float:left;padding:5px;\'>�ɼ��ڵ����ã�</div>&nbsp;&nbsp;<div style=\'float:left;padding:5px;border:1px dotted #ff6600;background:#ffffee\'>�����滻�������ڳ�����֮��ִ�У��밴�ղɼ����ҳ��Դ������б�д������Ŀ��վԭʼԴ���룬������<font color="red">��վǰ̨</font>ҳ��鿴Դ����</div></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<ul class="do_nav">' . "\r\n\t\t\t\t\t" . '<li id="tab1" class="cur"><a onclick="tab(1,10);" href="#1">��������</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab2"><a onclick="tab(2,10);" href="#2">Ŀ��վ����</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab3"><a onclick="tab(3,10);" href="#3">�滻����</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab4"><a onclick="tab(4,10);" href="#4">�Զ����ǩ</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab5"><a onclick="tab(5,10);" href="#5">��Դ�滻</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab6"><a onclick="tab(6,10);" href="#6">�߼�����</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab9"><a onclick="tab(9,10);" href="#9">������/������</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab10"><a onclick="tab(10,10);" href="#10">����ģ�����</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab7"><a onclick="tab(7,10);" href="#7">�Ʒ��ɼ�</a></li>' . "\r\n\t\t\t\t\t" . '<li id="tab8"><a onclick="tab(8,10);" href="#8">��������</a></li>' . "\r\n\t\t\t\t" . '</ul>' . "\r\n\t\t\t" . '</td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config9" style="display:none">' . "\r\n\t\t\t\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��ĸ�����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��: www.<font color="red">abc.com����ɫ���ֲ���</font></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[my_domain]" id="my_domain" size="30" value="';
    echo $caiji_config["my_domain"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > <select name="con[my_domain_auto]" onchange="lockinput(\'#my_domain\',this.value);">' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["my_domain_auto"] == "0")echo ' selected';
    echo '>�ֶ���д</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["my_domain_auto"])echo ' selected';
    echo '>�Զ���ȡ</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<script type="text/javascript">';
    if($caiji_config["my_domain_auto"])echo 'lockinput(\'#my_domain\',1);';
    echo '</script>' . "\r\n\t\t\t\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>Ŀ��վ������</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��: www.<font color="red">baidu.com����ɫ���ֲ���</font></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[from_domain]" id="from_domain" size="30" value="';
    echo $caiji_config["from_domain"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > <select name="con[from_domain_auto]" onchange="lockinput(\'#from_domain\',this.value);">' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["from_domain_auto"] == "0")echo ' selected';
    echo '>�ֶ���д</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["from_domain_auto"])echo ' selected';
    echo '>�Զ���ȡ</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<script type="text/javascript">';
    if($caiji_config["from_domain_auto"])echo 'lockinput(\'#from_domain\',1);';
    echo '</script>' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>���������ã�</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>������վȺģʽ</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">������ҳ���ϵ����ӽ�������������<br>һ����������֩���</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[domain_fanmod]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["domain_fanmod"] == "0")echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["domain_fanmod"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '</select> <font color="red">�����ڻ������ã�����������ӷ�����</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>������������</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�����󣬽��Ӱ���������ȡ�������л���<br>����ʹ�õ�ǰ����</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[domain_fanmod]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["domain_fanmod"] == "0")echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["domain_fanmod"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>������ǰ׺λ��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��: <font color="red">www</font>.baidu.com����ɫ����Ϊǰ׺</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[domain_num_min]" size="3" value="';
    echo $caiji_config["domain_num_min"]?$caiji_config["domain_num_min"]:3;
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > - <input type="text" name="con[domain_num_max]" size="3" value="';
    echo $caiji_config["domain_num_max"]?$caiji_config["domain_num_max"]:8;
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > λ���������</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>������ӳ�䣺</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td colspan="2"><font color="blue">��ʾ��������ɼ�Ŀ��վ��������ʱ�������д����������! <font color="red">������ģʽ����Ч</font></font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>����������ӳ��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�Ƿ���������ӳ��</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[domain_fan]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["domain_fan"] == "0")echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["domain_fan"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>������ӳ��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">ÿ��һ��ӳ����򣬸�ʽ���£�<br>' . "\r\n\t\t\t\t\t" . '<font color="red">Ŀ��վ������ǰ׺----�������ǰ׺</font><br>' . "\r\n\t\t\t\t\t" . 'Ŀ��վ������Ϊ news.baidu.com<br>' . "\r\n\t\t\t\t\t" . '���������Ϊ mynews.abc.com<br>' . "\r\n\t\t\t\t\t" . '������д��<font color="red">news----mynews</font><br>' . "\r\n\t\t\t\t\t" . '<hr>' . "\r\n\t\t\t\t\t" . '���������ǰ׺��Ŀ��վһ��<br>' . "\r\n\t\t\t\t\t" . '�����������<font color="red">*</font><br>' . "\r\n\t\t\t\t\t" . '<hr>' . "\r\n\t\t\t\t\t" . '��������ñ���͹ؼ�������<br>' . "\r\n\t\t\t\t\t" . '�����������<br><font color="red">news----mynews----����----�ؼ���----����</font>' . "\r\n\t\t\t\t" . '</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[domain_rules]" style="height: 200px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["domain_rules"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config1">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��վ����</b><br></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[web_name]" size="30" value="';
    echo $caiji_config["web_name"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��վ������</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">������ҳ���������Ż�</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[web_seo_name]" size="30" value="';
    echo $caiji_config["web_seo_name"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > ������Ϊ����ʹ��Ŀ��վ��</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��ҳ�ؼ���</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��ҳ�ؼ���keywords</font></td>' . "\r\n\t\t\t\t" . '<td><input name="con[web_keywords]" type="text" value="';
    echo $caiji_config["web_keywords"];
    echo '" size="55" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > ������Ϊ����ʹ��Ŀ��վ��</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��ҳ��վ����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��ҳ����</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[web_description]" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["web_description"];
    echo '</textarea> ������Ϊ����ʹ��Ŀ��վ��</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>������</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">����÷���,�ָ����磺 <font color="red">a.com,b.com</font><br>' . "\r\n\t\t\t\t\t" . '��������ʽ��<font color="red">*.b.com</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[web_domains]" size="80" value="';
    echo $caiji_config["web_domains"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="checkurl(this.id);this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign="top"><b>ͳ�ƴ���</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">����ͳ�ƴ���<br></font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[web_tongji]" cols="80" style="height: 70px; width: 450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["web_tongji"];
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>�Ƿ�ر�վ��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�Ƿ�ر�վ��</font></td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<input type="radio" name="con[web_close]" value="off" ';
    if($caiji_config["web_close"] == 'off' || !$caiji_config["web_close"])echo ' checked';
    echo ' onclick="$(\'#closecon\').hide();" />�� ' . "\r\n\t\t\t\t\t" . '<input type="radio" name="con[web_close]" value="on" ';
    if($caiji_config["web_close"] == 'on')echo ' checked';
    echo ' onclick="$(\'#closecon\').show();" />�� ' . "\r\n\t\t\t\t\t\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt" id="closecon" ';
    if($caiji_config["web_close"] == 'off' || !$caiji_config["web_close"])echo 'style=\'display:none\'';
    echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign="top"><b>�ر�վ���ԭ��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">վ��ر�ʱ���ֵ���ʾ��Ϣ<br></font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[web_closecon]" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["web_closecon"];
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>����ģʽ</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��������ģʽ�󣬽����������Ϣ�����ڷ��ֽ������</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[web_debug]" >' . "\r\n\t\t\t\t\t" . '<option value="off" ';
    if($caiji_config["web_debug"] == 'off')echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t" . '<option value="on" ';
    if($caiji_config["web_debug"] == 'on')echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>ʹ��˵��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��д������Ϣ��ʹ��Э���˵����ע������</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[licence]" style="height: 80px; width: 550px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["licence"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config2" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>Ŀ����վ����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">����÷���  * �ָ�</font><br><font color="red">ע����Ҫֻ��д��ĸ���������������滻����</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[from_title]" id="from_title" size="50" value="';
    echo $caiji_config["from_title"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>Ŀ��վ��ַ</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��Ҫ�ɼ���Ŀ����վ��ַ, http://��ͷ</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[from_url]" id="from_url" size="50" value="';
    echo $caiji_config["from_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;<select name="con[charset]" >' . "\r\n\t\t\t\t\t" . '<option value="auto" ';
    if($caiji_config["charset"] == 'auto' || empty($caiji_config["charset"]))echo ' selected';
    echo '>�Զ�ʶ��</option>' . "\r\n\t\t\t\t\t" . '<option value="gb2312" ';
    if($caiji_config["charset"] == 'gb2312')echo ' selected';
    echo '>gb2312</option>' . "\r\n\t\t\t\t\t" . '<option value="utf-8" ';
    if($caiji_config["charset"] == 'utf-8')echo ' selected';
    echo '>utf-8</option>' . "\r\n\t\t\t\t\t" . '<option value="gbk" ';
    if($caiji_config["charset"] == 'gbk')echo ' selected';
    echo '>gbk</option>' . "\r\n\t\t\t\t\t" . '<option value="big5" ';
    if($caiji_config["charset"] == 'big5')echo ' selected';
    echo '>big5</option>' . "\r\n\t\t\t\t" . '</select>&nbsp;Ŀ��վ����</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��������(��������)</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">Ŀ��վ���������һ��վ��ʱ��д<br>ÿ�������ð�Ƕ��ŷָ�<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>��: baidu.com<font color="red">,</font>www.baidu.com</div></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[other_url]" id="other_url" size="50" value="';
    echo $caiji_config["other_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>Ŀ��վ��Դ����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">����д��Ҫ�ɼ���cssͼƬ����Դ����<br>ÿ�������ð�Ƕ��ŷָ�<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>��: img1.baidu.com<font color="red">,</font>*.baidu.com</div></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[resdomain]" id="resdomain" size="50" value="';
    echo $caiji_config["resdomain"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<style type="text/css">' . "\r\n\t\t\t" . 'input[disabled="disabled"] {' . "\r\n\t\t\t\t" . 'background: #eee;' . "\r\n\t\t\t\t" . 'cursor: not-allowed;' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '</style>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>ͼƬ��������</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��Ŀ��վͼƬʹ���ӳټ��ص�ʱ��ʹ��<br>ÿ���ð�Ƕ��ŷָ�<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>��: data-src<font color="red">,</font>_src</div></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[img_delay_name]" size="50" value="';
    echo $caiji_config["img_delay_name"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > <font color="red">һ�㲻������</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>�������ã�</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>�Զ��滻������ַ</b><br>' . "\r\n\t\t\t" . '<font color="#666666">ѡ�����Ͳ�����дĿ��վ������ַ��</font></td>' . "\r\n\t\t\t" . '<td><select name="con[auto_get_search]" onchange="lockinput(\'#search_url\',this.value)" >' . "\r\n\t\t\t\t" . '<option value="1" ';
    if($caiji_config["auto_get_search"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '<option value="0" ';
    if($var_25 && !$caiji_config["auto_get_search"])echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>Ŀ��վ������ַ</b><br>' . "\r\n\t\t\t" . '<font color="#666666">Ŀ��վ������ַ������������form��action��ַ�������js�Ļ�������д</font></td>' . "\r\n\t\t\t" . '<td><input type="text" name="con[search_url]" id="search_url" size="50" value="';
    echo $caiji_config["search_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t\r\n\t\t" . '<script type="text/javascript">' . "\r\n\t\t";
    if($caiji_config["auto_get_search"])echo 'lockinput(\'#search_url\',1);';
    echo "\t\t" . '</script>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>����ҳ��ı���</b></td>' . "\r\n\t\t\t" . '<td><select name="con[search_charset]" >' . "\r\n\t\t\t\t" . '<option value="auto" ';
    if($caiji_config["search_charset"] == 'auto' || empty($caiji_config["charset"]))echo ' selected';
    echo '>�Զ�ʶ��</option>' . "\r\n\t\t\t\t" . '<option value="gb2312" ';
    if($caiji_config["search_charset"] == 'gb2312')echo ' selected';
    echo '>gb2312</option>' . "\r\n\t\t\t\t" . '<option value="utf-8" ';
    if($caiji_config["search_charset"] == 'utf-8')echo ' selected';
    echo '>utf-8</option>' . "\r\n\t\t\t\t" . '<option value="gbk" ';
    if($caiji_config["search_charset"] == 'gbk')echo ' selected';
    echo '>gbk</option>' . "\r\n\t\t\t\t" . '<option value="big5" ';
    if($caiji_config["search_charset"] == 'big5')echo ' selected';
    echo '>big8</option>' . "\r\n\t\t\t" . '</select></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>�������ã�</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>�����ض���</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�Ƿ����Ŀ��վ�ض���</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[auto301]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["auto301"] == "0")echo ' selected';
    echo '>��</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["auto301"])echo ' selected';
    echo '>��</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>ǿ�Ʊ���ת��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">ǿ��ִ��ѡ�е�Ŀ��վ����</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[charset_force]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["charset_force"] == "0")echo ' selected';
    echo '>��</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["charset_force"])echo ' selected';
    echo '>��</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>����js����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�Ƿ�����js����</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[hidejserror]" >' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["hidejserror"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["hidejserror"] == "0")echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��ֹ�ƶ�����ת��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��ѡ��ɽ�ֹ�ٶ��ƶ�����ת��</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[no_siteapp]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["no_siteapp"] == "0")echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["no_siteapp"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t\r\n\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config3" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>���������ȡ</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��ֻ��ɼ�ĳ�������ʱ��ʹ��<br>��֧�ֽ�ȡbody֮��<br><font color="red">һ������</font></font></td>' . "\r\n\t\t\t\t" . '<td>��ʼ��� ' . "\r\n\t\t\t\t\t" . '<textarea name="con[body_start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["body_start"]);
    echo '</textarea>&nbsp;�������' . "\r\n\t\t\t\t\t" . '<textarea name="con[body_end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["body_end"]);
    echo '</textarea>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��ǩ����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�ɼ�ҳ��ʱ���˵���Щ��ǩ<br><font color="red">����</font>,���򽫿��ܳ��ֲɼ��������ʹ�λ����</font></td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="iframe" ';
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
    echo ' /> style' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>վ�������</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�ɹ���վ�ڻ�վ�ⲻ��Ҫ�����ӻ��ļ�</font>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="outa" ';
    if(in_array('outa', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="red">վ��</font>����' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="outjs" ';
    if(in_array('outjs', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="red">վ��</font>js�ļ�' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="outcss" ';
    if(in_array('outcss', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="red">վ��</font>css�ļ�' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="locala" ';
    if(in_array('locala', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="blue">վ��</font>����' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="localjs" ';
    if(in_array('localjs', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="blue">վ��</font>js�ļ�' . "\r\n\t\t\t\t\t" . '<input name="siftags[]" type="checkbox" value="localcss" ';
    if(in_array('localcss', $caiji_config["siftags"])){;
        echo 'checked';
    };
    echo ' /> <font color="blue">վ��</font>css�ļ�' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\' style="background:#fafafa"><b>�ַ����滻����</b><br>' . "\r\n\t\t\t" . '<font color="#666666">�滻ǰ���滻��ֱ����<font color="red">******</font>�ָ�<br>ÿһ���滻������������ַ��ָ�����<br><font color="red">##########</font><br>���ӣ�<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>�����滻ǰ<font color="red">******</font>�����滻��<br><font color="red">##########</font><br>�ٶ�<font color="red">******</font>{web_name}</font><br><font color="red">##########</font></div>' . "\r\n\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t" . '<b>��ǩ˵����</b><br>' . "\r\n\t\t\t\t\t" . '{web_name} -> ��վ����<br>' . "\r\n\t\t\t\t\t" . '{web_url} -> ��վ��ַ<br>' . "\r\n\t\t\t\t\t" . '{web_domain} -> ��ǰ����<br>' . "\r\n\t\t\t\t\t" . '{web_thisurl} -> ��ǰҳ��url<br>' . "\r\n\t\t\t\t\t" . '{web_remark} -> α��̬��ʾ��<br>' . "\r\n\t\t\t\t\t" . '{ad.����ʶ} -> ����ǩ<br>' . "\r\n\t\t\t\t\t" . '{zdy.��ǩ} -> �Զ����ǩ<br>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t" . '<b>ҳ�����֣�</b><br>' . "\r\n\t\t\t\t\t" . '���滻����ͷ��<br><font color="red">index@@</font>��ʾֻ�滻��ҳ<br><font color="red">other@@</font>��ʾֻ�滻��ҳ' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t" . '</font>' . "\r\n\t\t\t" . '</td>' . "\r\n";
    if($var_14 == 'add' && $caiji_config["replacerules"] == ""){
        $caiji_config["replacerules"] = '/----------------�����滻�����и�ʽΪע��,�����ڷ���鿴,��ͬ��----------------/' . "\r\n" . '##########' . "\r\n" . '�������д�滻����' . "\r\n" . '##########' . "\r\n" . '/----------------ͼƬ�滻----------------/' . "\r\n" . '##########' . "\r\n" . '�������д�滻����' . "\r\n" . '##########' . "\r\n" . '/----------------����滻----------------/' . "\r\n" . '##########' . "\r\n" . '�������д�滻����' . "\r\n" . '##########' . "\r\n" . '/----------------�����滻----------------/' . "\r\n" . '##########' . "\r\n" . '�������д�滻����' . "\r\n" . '##########';
    };
    echo "\t\t\t\t" . '<td><textarea name="con[replacerules]" style="height: 450px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["replacerules"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>�����滻����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�����滻���ʽ��һ��һ������ʽ���£�<br>' . "\r\n\t\t\t\t" . '<div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>' . "\r\n\t\t\t\t\t" . '<font color="red">{vivi replace=\'</font>�滻��<font color="red">\'}</font>������ʽ<font color="red">{/vivi}</font><br>' . "\r\n\t\t\t\t\t" . '<font color="blue">�滻���纬�е�������ʹ��[d]�����磺</font><br>' . "\r\n\t\t\t\t\t" . '<font color="red">{vivi replace=\'</font>[d]�滻��[d]<font color="red">\'}</font>����<font color="red">{/vivi}</font>' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<div style="margin:8px 0;padding:5px 0;border-top:1px solid #eee;">' . "\r\n\t\t\t\t\t\t" . '<b>��ǩ˵����</b><br>ͬ��' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[siftrules]" style="height: 250px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["siftrules"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>����ǰ���滻</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�滻�ʼ�Ĵ��루��Ŀ��վ��ԭʼhtml��<br><font color="red">������;��һ�㲻�ÿ���</font></font></td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t\t" . '<label><input type="radio" id="replace_before_on" name="con[replace_before_on]" value="1" ';
    if($caiji_config["replace_before_on"])echo ' checked';
    echo ' />����</label>' . "\r\n\t\t\t\t\t" . '<label><input type="radio" id="replace_before_off" name="con[replace_before_on]" value="0" ';
    if(!$caiji_config["replace_before_on"])echo ' checked';
    echo ' />�ر�</label>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt replace_before_body"';
    if(!$caiji_config["replace_before_on"])echo ' style=\'display:none\'';
    echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>ǰ���ַ����滻����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">ʹ�÷���ͬ������滻����һ��</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[replacerules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["replacerules_before"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt replace_before_body"';
    if(!$caiji_config["replace_before_on"])echo ' style=\'display:none\'';
    echo '>' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>ǰ�������滻����</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666"><font color="#666666">ʹ�÷���ͬ����������滻����һ��</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[siftrules_before]" style="height: 150px; width: 750px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["siftrules_before"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n" . '<script>' . "\r\n" . '$(function() {' . "\r\n\t" . '$("#replace_before_on").click(function(){' . "\r\n\t\t" . '$(".replace_before_body").show();' . "\r\n\t" . '});' . "\r\n\t" . '$("#replace_before_off").click(function(){' . "\r\n\t\t" . '$(".replace_before_body").hide();' . "\r\n\t" . '});' . "\r\n" . '});' . "\r\n" . '</script>' . "\r\n" . '<style type="text/css">' . "\r\n" . '#quick td {' . "\r\n" . '    border-bottom: 1px solid #eee;' . "\r\n" . '}' . "\r\n" . '</style>' . "\r\n\t\t" . '<tbody id="config4" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td colspan="2" align="left">' . "\r\n\t\t\t\t\t" . '1. ���õı�ǩ����ģ���е��ã�Ҳ�����滻������ʹ��<br>' . "\r\n\t\t\t\t\t" . '2. <font color="red">��ǩ�ı�ʶ�����ظ�������</font><font color="blue">ģ����ʹ��$zdy����������е��ã��磺$zdy[\'��ʶ\']</font><br>' . "\r\n\t\t\t\t\t" . '3. <font color="green">�����ȡֻ��ȡ��һ��ƥ�����ݣ���ʽ�磺&lt;title&gt;(.*)&lt;/title&gt;</font><br>' . "\r\n\t\t\t\t\t" . '4. <font color="red">ע����û��ģ�壬�˴���������</font><br>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td colspan="2" align="left">' . "\r\n\t\t\t\t\t" . '<table cellpadding="3" cellspacing="1" id="quick">' . "\r\n\t\t\t\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t\t\t" . '  <td width="30" class="title_bg" align="center">���</td>' . "\r\n\t\t\t\t\t\t" . '  <td width="100" class="title_bg" align="center">��ǩ����(����)</td>' . "\r\n\t\t\t\t\t\t" . '  <td width="100" align=\'center\'>��ʶ(Ӣ����ĸ)</td>' . "\r\n\t\t\t\t\t\t" . '  <td width="100" align=\'center\'>����</td>' . "\r\n\t\t\t\t\t\t" . '  <td align=\'center\'>����</td>' . "\r\n\t\t\t\t\t\t" . '  <td width="50" align="center"><button type="button" class="add">����</button></td>' . "\r\n\t\t\t\t\t\t" . '  <td align=\'center\'>&nbsp;</td>' . "\r\n\t\t\t\t\t\t" . '</tr>' . "\r\n";
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
        echo '>�Զ�������</option>' . "\r\n\t\t\t\t\t\t\t\t" . '<option value="1"';
        if($var_6["type"] == 1)echo ' selected';
        echo '>��ͨ��ȡ</option>' . "\r\n\t\t\t\t\t\t\t\t" . '<option value="2"';
        if($var_6["type"] == 2)echo ' selected';
        echo '>�����ȡ</option>' . "\r\n\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t" . '<td align="center">' . "\r\n\r\n\t\t\t\t\t\t\t" . '<div class="zdy_body_';
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
        echo '>' . "\r\n\t\t\t\t\t\t\t\t" . '��ʼ��� <textarea name="zdy[';
        echo $var_5;
        echo '][start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
        echo _htmlspecialchars($var_6["start"]);
        echo '</textarea>' . "\r\n\t\t\t\t\t\t\t\t" . '&nbsp;�������' . "\r\n\t\t\t\t\t\t\t\t" . '<textarea name="zdy[';
        echo $var_5;
        echo '][end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
        echo _htmlspecialchars($var_6["end"]);
        echo '</textarea>' . "\r\n\t\t\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t" . '<td align=\'center\'><a href="javascript:" onclick="deltr(this);">ɾ��</a></td>' . "\r\n\t\t\t\t\t\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t\t\t\t\t" . '</tr>' . "\r\n";
    };
    echo "\t\t\t\t\t" . '</table>' . "\r\n" . '<script type="text/javascript">' . "\r\n" . 'function deltr(elem){' . "\r\n\t" . 'var itemid=$(elem).parents(\'tr\').attr(\'itemid\');' . "\r\n\t" . '$(elem).parents(".item"+itemid).remove();' . "\r\n" . '}' . "\r\n" . 'function zdytype(_this){' . "\r\n\t" . 'var itemid=$(_this).parents(\'tr\').attr(\'itemid\');' . "\r\n\t" . 'var id=_this.value;' . "\r\n\t" . '$(\'.zdy_body_\'+itemid).hide();' . "\r\n\t" . '$(\'.zdy_regx_\'+itemid).hide();' . "\r\n\t" . '$(\'.zdy_replace_\'+itemid).hide();' . "\r\n\t" . 'if(id==\'0\'){' . "\r\n\t\t" . '$(\'.zdy_body_\'+itemid).fadeIn();' . "\r\n\t" . '}else if(id==\'1\'){' . "\r\n\t\t" . '$(\'.zdy_replace_\'+itemid).fadeIn();' . "\r\n\t" . '}else if(id==\'2\'){' . "\r\n\t\t" . '$(\'.zdy_regx_\'+itemid).fadeIn();' . "\r\n\t" . '}' . "\r\n" . '}' . "\r\n" . '$(document).ready(function(){' . "\r\n\t" . '$("#quick .add").click(function(){' . "\r\n\t\t" . 'var id = $("#quick tr").prevAll("tr").length+1;' . "\r\n\t\t" . 'var input=\'<tr class="firstalt item\'+id+\'" itemid="\'+id+\'">\';' . "\r\n\t\t" . 'input+=\'<td align="center">\'+id+\'</td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><input type="text" name="zdy[\'+id+\'][name]" style="width:100px" class="input"></td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><input type="text" name="zdy[\'+id+\'][ename]" style="width:70px" class="input"></td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><select name="zdy[\'+id+\'][type]" onchange="zdytype(this);"><option value="0">�Զ�������</option><option value="1">��ͨ��ȡ</option><option value="2">�����ȡ</option></select></td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><div class="zdy_body_\'+id+\'"><textarea name="zdy[\'+id+\'][body]" style="height: 100px; width: 450px" onFocus="this.style.borderColor=\\\"#00CC00\\\"" onBlur="this.style.borderColor=\\\"#dcdcdc\\\"" ></textarea></div><div class="zdy_regx_\'+id+\'" style="display:none"><textarea name="zdy[\'+id+\'][regx]" style="height: 100px; width: 450px" onFocus="this.style.borderColor=\\\"#00CC00\\\"" onBlur="this.style.borderColor=\\\"#dcdcdc\\\"" ></textarea></div><div style="display:none" class="zdy_replace_\'+id+\'">��ʼ��� <textarea name="zdy[\'+id+\'][start]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\\\"#00CC00\\\"" onBlur="this.style.borderColor=\\\"#dcdcdc\\\"" ></textarea>&nbsp;�������<textarea name="zdy[\'+id+\'][end]" style="height: 100px; width: 200px" onFocus="this.style.borderColor=\\\"#00CC00\\\"" onBlur="this.style.borderColor=\\\"#dcdcdc\\\"" ></textarea></div></td>\';' . "\r\n\t\t" . 'input+=\'<td align="center"><a href="javascript:" onclick="deltr(this);">ɾ��</a></td>\';' . "\r\n\t\t" . 'input+=\'<td>&nbsp;</td></tr>\';' . "\r\n\t\t" . '$("#quick").append(input);' . "\r\n\t" . '});' . "\r\n\t" . '$("#form").submit(function(e){' . "\r\n\t\t" . '$(\'.firstalt input[type="submit"]\').attr(\'disabled\',\'disabled\').val(\' ���ڱ���... \');' . "\r\n\t\t" . '$.ajax({' . "\r\n\t\t\t" . 'type:"post",' . "\r\n\t\t\t" . 'url:"?ac=save&id=';
    echo $var_25;
    echo '",' . "\r\n\t\t\t" . 'data:$("#form").serialize(),' . "\r\n\t\t\t" . 'global:false,' . "\r\n\t\t\t" . 'success:function(data){' . "\r\n\t\t\t\t" . 'alert(data);' . "\r\n\t\t\t\t" . '$(\'.firstalt input[type="submit"]\').attr(\'disabled\',false).val(\' �ύ \');' . "\r\n\t\t\t" . '}' . "\r\n\t\t" . '});' . "\r\n\t\t" . 'return false;' . "\r\n\t" . '});' . "\r\n" . '});' . "\r\n" . '</script>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config5" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b>��Դ�滻</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">һ��һ���������http://����������ʽ���£�<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">Ŀ��վ��Դurl----�����Դurl������</font><br>' . "\r\n\t\t\t\t\t\t" . '<font color="green">http://a.cn/logo.jpg----http://b.cc/a.jpg</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">ע��Ŀ��վ��Դ�����http://</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[source_replace]" style="height: 150px; width:650px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["source_replace"]);
    echo '</textarea>&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">ע��Ŀ��վ��Դ�����http://</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260" valign=\'top\'><b>�Զ���css</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">css���룬һ��һ������ʽ���£�<br><div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'><font color="red">.a{color:red}</font></div></font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[css]" style="height: 100px; width: 550px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["css"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config6" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>�߼����ܣ�</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>����ת</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">�����������֮�以ת��Ӱ���ٶ�</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[big52gbk]" >' . "\r\n\t\t\t\t\t" . '<option value="togbk" ';
    if($caiji_config["big52gbk"] == 'togbk')echo ' selected';
    echo '>��ת��</option>' . "\r\n\t\t\t\t\t" . '<option value="tobig5" ';
    if($caiji_config["big52gbk"] == 'tobig5')echo ' selected';
    echo '>��ת��</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["big52gbk"])echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>αԭ������</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">����αԭ��</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[replace]" >' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["replace"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["replace"])echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>α��̬����</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">α��̬�Ĳɼ�����Ͷ�̬�Ŀ��ܲ�һ��</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[rewrite]" >' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["rewrite"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["rewrite"])echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>��ģ���ļ���</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��ģ���ϴ���template�ļ�����<br>Ȼ����д���ļ�����<font color="red">һ������</font></font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[tplfile]" id="tplfile" size="10" value="';
    echo $caiji_config["tplfile"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > ������Ĭ��Ϊindex.html</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>����ҳ���ã�</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>����ҳ�����ʽ</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�ɼ�������ҳ����ʾ����ҳ���ݻ�����ת</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[web_404_type]" >' . "\r\n\t\t\t\t\t" . '<option value="display" ';
    if($caiji_config["web_close"] == 'display')echo ' selected';
    echo '>���ģ������</option>' . "\r\n\t\t\t\t\t" . '<option value="jump" ';
    if($caiji_config["web_close"] == 'jump' || !$caiji_config["web_close"])echo ' selected';
    echo '>��ת��ʽ</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>ģ��/��ת��ַ��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��дģ���ļ�·��������תurl</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[web_404_url]" id="web_404_url" size="40" value="';
    echo $caiji_config["web_404_url"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="checkurl(this.id);this.style.borderColor=\'#dcdcdc\'" > ����ڸ�Ŀ¼���磺/404.html ���� ��ת��ʽ�� http://xxx.com/404.html</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>�Զ��������</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��Ŀ��վ��ҳ�а�����д�Ĵ���ʱ���϶�Ϊ����ҳ<br><font color="red">��д����ҳ���е�һ�δ��������</font></font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[web_404_str]" cols="80" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["web_404_str"];
    echo '</textarea> һ�㲻����д</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t" . '<h2>������ã�</h2>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n";
    $var_67 = array();
    if($caiji_config["plus"]){
        $var_67 = explode(',', $caiji_config["plus"]);
    }
    if(is_dir(VV_DATA . '/plus')){
        $var_66 = scandirs(VV_DATA . '/plus');
        unset($var_66["0"], $var_66[1]);
    };
    echo "\t\t" . '<style type="text/css">' . "\r\n" . '.custom-header{' . "\r\n" . '  text-align: center;' . "\r\n" . '  padding: 3px;' . "\r\n" . '  background: #000;' . "\r\n" . '  color: #fff;' . "\r\n" . '}' . "\r\n" . '</style>' . "\r\n\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t" . '<td width="260"><b>ʹ�ò��</b><br>' . "\r\n\t\t\t" . '<font color="#666666">���λ��/data/plus/�ļ���<br>��д������ʾ��</td>' . "\r\n\t\t\t" . '<td><select name="con[plus][]" multiple=\'multiple\' class="selectmultiple">' . "\r\n\t\t\t";
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
    echo "\t\t\t" . '</select> <script type="text/javascript">$(\'.selectmultiple\').multiSelect({ keepOrder: true,selectableHeader: "<div class=\'custom-header\'>δʹ�õĲ��</div>",selectionHeader: "<div class=\'custom-header\'>����ʹ�õĲ��</div>" });</script></td>' . "\r\n\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config7" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>�Զ���cookie</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">ʹ�ø�cookie����Ŀ��վ<br>һ��������Ҫ��½���ܲɼ���վ��</font></td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[cookie]" style="height: 100px; width: 550px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["cookie"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>�Զ����������ʶ��user-agent��</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">��α���������α��֩������</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[user_agent]" id="user_agent" style="width:300px;" value="';
    echo $caiji_config["user_agent"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;<select onchange="$(\'#user_agent\').val(this.value);">' . "\r\n\t\t\t\t\t" . '<option value="">�Զ���</option>' . "\r\n\t\t\t\t\t" . '<option value="Baiduspider/2.0+(+http://www.baidu.com/search/spider.htm)" ';
    if($caiji_config["user_agent"] == 'Baiduspider/2.0+(+http://www.baidu.com/search/spider.htm)')echo ' selected';
    echo '>ģ��ٶ�֩��</option>' . "\r\n\t\t\t\t\t" . '<option value="Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)" ';
    if($caiji_config["user_agent"] == 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)')echo ' selected';
    echo '>ģ��ȸ�֩��</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>�Զ�����·</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">α����·������д���Զ�α��ΪĿ��վurl</font></td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[referer]" style="width:300px;" value="';
    echo $caiji_config["referer"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" ></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td width="260"><b>α��IP</b><br>' . "\r\n\t\t\t\t" . '<font color="#666666">�Զ���IP��ʽ 127.0.0.1<br>����IP�ĸ�ʽ 127.0.0.1:8080@user:pass' . "\r\n\t\t\t\t" . '<br><br>' . "\r\n\t\t\t\t" . '<div style=\'padding:5px;border:1px dotted #ff6600;background:#f6f6f6\'>' . "\r\n\t\t\t\t\t" . '<font color="black">ѡ����IP��<br>�ļ���ʽ����дtxt·���磺/data/daili.txt<br>' . "\r\n\t\t\t\t\t" . 'api��ʽ����дAPI �磺http://a.com/api.php<br><br>' . "\r\n\t\t\t\t\t" . 'ÿ��һ��������ʽ���£�<br></font>' . "\r\n\t\t\t\t\t" . '<font color="red">127.0.0.1:8081</font><br>' . "\r\n\t\t\t\t\t" . '<font color="red">127.0.0.1:8080@user:pass</font><br>...' . "\r\n\t\t\t\t" . '</div>' . "\r\n\t\t\t\t" . '<br>' . "\r\n\t\t\t\t";
    if(function_exists('curl_init') && function_exists('curl_exec')){
        echo '<font color="green">��Ŀռ�֧��curl��֧�ִ���IP����</font>';
    }else{
        echo '<font color="red">��Ŀռ䲻֧��curl������ʹ�ô���IP����</font>';
    };
    echo "\t\t\t\t\r\n\t\t\t\t\r\n\t\t\t\t" . '</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><input type="text" name="con[ip_cachetime]" style="width:50px;" value="';
    echo $caiji_config["ip_cachetime"]?$caiji_config["ip_cachetime"]:600;
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > �룬���ʱ��<br><br>' . "\r\n\t\t\t\t" . '<input type="text" name="con[ip]" style="width:300px;" value="';
    echo $caiji_config["ip"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >&nbsp;<select name="con[ip_type]">' . "\r\n\t\t\t\t\t" . '<option value="1"';
    if($caiji_config["ip_type"] == 1)echo ' selected';
    echo '>�Զ���IP</option>' . "\r\n\t\t\t\t\t" . '<option value="2"';
    if($caiji_config["ip_type"] == 2)echo ' selected';
    echo '>���IP</option>' . "\r\n\t\t\t\t\t" . '<option value="3"';
    if($caiji_config["ip_type"] == 3)echo ' selected';
    echo '>����IP</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config8" style="display:none">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t" . '<dl id="slide">' . "\r\n\t\t\t\t\t\t" . '<dt>��������</dt>' . "\r\n\t\t\t\t\t\t" . '<dd>' . "\r\n\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<h2>�������ã�</h2>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>�����������</b> <br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">������ɶ������øýڵ�Ļ��棬����ʹ��ȫ�ֻ�������</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[cache_set]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["cache_set"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["cache_set"])echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>css���濪��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">����css���棬�ӿ��ٶ�</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[csscache]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["csscache"])echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["csscache"])echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>js���濪��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">����js���棬�ӿ��ٶȣ�<font color="red">һ�㲻��Ҫ����</font></font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[jscache]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["jscache"])echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["jscache"])echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>ͼƬ����/�ƽ����������</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="red">��δ�������ɲ�����</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[imgcache]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["imgcache"])echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["imgcache"])echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>ҳ�滺�濪��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">����ҳ�滺�棬��ʡ������CPU��Դ</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[cacheon]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["cacheon"])echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["cacheon"])echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>�Զ������濪��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">�����󣬳��������С���ƾ��Զ�������</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[deloldcache]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["deloldcache"])echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["deloldcache"])echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>֩���¼����</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">��¼������������֩�����ж�̬</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[robotlogon]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["robotlogon"])echo 'selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["robotlogon"])echo 'selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>��ҳ���汣��ʱ��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[indexcache]" size="25" maxlength="50" value="';
    echo $caiji_config["indexcache"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��24Сʱ��</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>����ҳ���汣��ʱ��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[othercache]" size="25" maxlength="50" value="';
    echo $caiji_config["othercache"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��72Сʱ��</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>ͼƬ���汣��ʱ��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[imgcachetime]" size="25" maxlength="50" value="';
    echo $caiji_config["imgcachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > �������Ϊ0��������ɻ���' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>css���汣��ʱ��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[csscachetime]" size="25" maxlength="50" value="';
    echo $caiji_config["csscachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��999Сʱ��' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>js���汣��ʱ��</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666"><font color=\'red\'>Сʱ</font>Ϊ��λ,1Ϊ1Сʱ</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[jscachetime]" size="25" maxlength="50" value="';
    echo $caiji_config["jscachetime"];
    echo '"onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��999Сʱ��' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>�����С����</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">�����趨ֵ�Զ��������,��λΪ MB</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[delcache]" size="25" maxlength="50" value="';
    echo $caiji_config["delcache"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" > һ��200��</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt cacheset">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>��ʱ��黺���Сʱ����</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">��λΪ�죬����������Զ�ɨ��һ�λ����С</font><br><font color="red">ɨ���ʱ��,���鲻Ҫ����̫Сֵ</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><input type="text" name="con[delcachetime]" size="25" maxlength="50" value="';
    echo $caiji_config["delcachetime"];
    echo '" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >  һ��3����</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t\r\n\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</dd>' . "\r\n\t\t\t\t\t\t" . '<dt>�ؼ�������</dt>' . "\r\n\t\t\t\t\t\t" . '<dd style="display:none">' . "\r\n\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="tb_head">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<h2>�ؼ���������</h2>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>������������</b> <br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">������ɶ������øýڵ������������ʹ��ȫ����������</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[linkword_set]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["linkword_set"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["linkword_set"])echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>�ؼ�����������</b> <br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">�Ƿ����ؼ�������������ҳ</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[linkword_on]" >' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["linkword_on"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["linkword_on"])echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<b>���õ�����</b></font>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t\t";
    $var_71 = @implode("\r\n", @explode('|||', $caiji_config["link_config"]));;
    echo "\t\t\t\t\t\t\t\t\t" . '<td>ÿ��һ���ؼ��ʺ����ӣ��á�,������<br> �磺<br> �ٶ�,http://baidu.com<br>��Ѷ,http://qq.com<br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<textarea name="con[link_config]" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $var_71;
    echo '</textarea>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</dd>' . "\r\n\t\t\t\t\t\t" . '<dt>��������</dt>' . "\r\n\t\t\t\t\t\t" . '<dd style="display:none">' . "\r\n\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="tb_head">  ' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<h2>������������</h2>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>�������Ӷ�������</b> <br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">������ɶ������øýڵ���������ӣ�����ʹ��ȫ��������������</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[flink_set]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["flink_set"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
    if(!$caiji_config["flink_set"])echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260"><b>�Ƿ��Զ��ӵ���ҳ�ײ�</b><br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<font color="#666666">�粻�Զ���ӣ������ʹ��{flinks}���е���</font></td>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td><select name="con[flinks_auto_insert]">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["flinks_auto_insert"] == 1 || $caiji_config["flinks_auto_insert"] == "")echo 'selected';
    echo '>��</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<option value="2" ';
    if($caiji_config["flinks_auto_insert"] == 2)echo 'selected';
    echo '>��</option>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</select></td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td width="260" align="center">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<b>������������</b>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>  ' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td>ÿ��һ������<br>�磺&lt;a target="_blank" href=\'http://baidu.com\' &gt;�ٶ�&lt;/a&gt;<br>' . "\r\n\t\t\t\t\t\t\t\t\t" . '<textarea name="con[flink]" cols="80" style="height:120px; width:450px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo $caiji_config["flink"];
    echo '</textarea>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</dd>' . "\r\n\t\t\t\t\t\t" . '<dt>�������</dt>' . "\r\n\t\t\t\t\t\t" . '<dd style="display:none">' . "\r\n\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline">' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="tb_head">  ' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<h2>�����õĲ������<font color="red">���ڡ��߼����ܡ������ò����ˢ������Ż���ʾ��</font></h2>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<style type="text/css">' . "\r\n\t\t\t\t\t\t\t\t\t" . '.plustable{ background-color: #fff;}' . "\r\n\t\t\t\t\t\t\t\t\t" . '.plustable td{border-bottom: 1px solid #EBEBEB;}' . "\r\n\t\t\t\t\t\t\t\t" . '</style>' . "\r\n\t\t\t\t\t\t\t\t" . '<tr class="firstalt">  ' . "\r\n\t\t\t\t\t\t\t\t\t" . '<td colspan="2">' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '<table width="98%" border="0" cellpadding="4" cellspacing="1" class="tableoutline plustable">' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="50" align="center"><b>ID</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="120" align="center"><b>�������</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="200" align="center"><b>���˵��</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="100" align="center"><b>����</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="130" align="center"><b>�汾</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="130" align="center"><b>��������</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td width="150" align="center"><b>����</b></td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t";
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
            echo '>����</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t\t" . '<option value="0" ';
            if(!$caiji_config["plus_" . $var_6 . '_set'])echo ' selected';
            echo '>�ر�</option>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '</select>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td align="center">';
            if(@is_file(VV_DATA . '/plus/' . $var_6 . '/config.php')){;
                echo '<a onclick="plus_set_dialog(\'';
                echo $var_6;
                echo '\',\'';
                echo $var_70["name"];
                echo '\');" href="javascript:">����</a>';
            }else{;
                echo '<font color="red">��������</font>';
            };
            echo '</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '<td>&nbsp;</td>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t\t\t\t";
        }
    };
    echo "\t\t\t\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t\t\t\t" . '</td>' . "\r\n\t\t\t\t\t\t\t\t" . '</tr>' . "\r\n\t\t\t\t\t\t\t\t" . '<script type="text/javascript">' . "\r\n\t\t\t\t\t\t\t\t" . 'function save_plus(name){' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.firstalt .plusbtn\').attr(\'disabled\',\'disabled\').val(\' ���ڱ���... \');' . "\r\n\t\t\t\t\t\t\t\t\t" . '$.ajax({' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'type:"post",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'url: \'?ac=plus_save&id=';
    echo $var_25;
    echo '&name=\'+name,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'data:$("form").serialize(),' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'dataType: \'json\',' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'success: function(data){' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . 'if(data.status==1){' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . 'alert(data.info);' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . '$(\'.keybox\').dialog(\'destroy\');' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '}else{' . "\r\n\t\t\t\t\t\t\t\t\t\t\t\t" . 'alert(data.info);' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '$(\'.firstalt .plusbtn\').attr(\'disabled\',false).val(\' �������� \');' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t\t" . '});' . "\r\n\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t" . 'function plus_set_dialog(name,title){' . "\r\n\t\t\t\t\t\t\t\t\t" . 'if($(\'.keybox\').length<1){' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '$(\'body\').append(\'<div class="keybox" style="line-height:30px;"></div>\');' . "\r\n\t\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.keybox\').html(\'<p align="center" style="margin-top:100px"><img src="../public/img/load.gif"> ������</p>\');' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.keybox\').dialog({' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'width: 850,height: 440,modal: !0,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'title: "����������á�"+title+"��",' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'close: function(event, ui) {' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '$(".ui-dialog .ui-dialog-titlebar-close").hide();' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '},' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'buttons: {}' . "\r\n\t\t\t\t\t\t\t\t\t" . '});' . "\r\n\t\t\t\t\t\t\t\t\t" . '$.ajax({' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'url: \'?ac=plus_set&id=';
    echo $var_25;
    echo '&name=\'+name,' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'dataType: \'html\',' . "\r\n\t\t\t\t\t\t\t\t\t\t" . 'success: function(data){' . "\r\n\t\t\t\t\t\t\t\t\t\t\t" . '$(".keybox").html(data);' . "\r\n\t\t\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t\t" . '});' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(".ui-dialog .ui-dialog-titlebar-close").show();' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.ui-icon\').css({ \'text-indent\':\'0\' });' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(\'.ui-icon-closethick\').html(\'�ر�\');' . "\r\n\t\t\t\t\t\t\t\t\t" . '$(".ui-dialog .ui-dialog-titlebar-close").css({ \'width\':\'auto\' });' . "\r\n\t\t\t\t\t\t\t\t" . '}' . "\r\n\t\t\t\t\t\t\t\t" . '</script>' . "\r\n\t\t\t\t\t\t\t" . '</table>' . "\r\n\t\t\t\t\t\t" . '</dd>' . "\r\n\t\t\t\t\t" . '  </dl>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<script type="text/javascript">' . "\r\n\t\t\t" . '$("#slide").KandyTabs({' . "\r\n\t\t\t\t" . 'action:"slide",' . "\r\n\t\t\t\t" . 'trigger:"click"' . "\r\n\t\t\t" . '});' . "\r\n\t\t\t" . '</script>' . "\r\n\t\t\t" . '<style type="text/css">' . "\r\n\t\t\t\t" . '#slide { padding:0; border:1px solid #DDD; overflow:hidden;}' . "\r\n\t\t\t\t" . '#slide .tabtitle { line-height:28px }' . "\r\n\t\t\t\t" . '#slide .tabtitle .tabbtn { background:none; border-width:0 0 0 1px;padding: 2px 20px; cursor:pointer;text-align:center; border-radius:0; margin:0 0 0 -1px }' . "\r\n\t\t\t\t" . '#slide .tabtitle .tabcur { background:#fff;}' . "\r\n\t\t\t\t" . '#slide .tabbody { border-width:1px 0 0 }' . "\r\n\t\t\t" . '</style>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody id="config10" style="display:none;">' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td><b>����ģ�忪��</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">�Ƿ����ó���ģ��</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[theme_open]" >' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["theme_open"] == "0")echo ' selected';
    echo '>�ر�</option>' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["theme_open"])echo ' selected';
    echo '>����</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n";
    $var_73 = array();
    $var_52 = VV_TMPL;
    $var_73 = scandirs($var_52);
    foreach($var_73 as $var_5 => $var_6){
        $var_74 = $var_52 . '/' . $var_6 . '/index.html';
        if($var_6 == '.' || $var_6 == '..' || !is_dir($var_52 . '/' . $var_6) || !is_file($var_74)){
            unset($var_73[$var_5]);
        }
    };
    echo "\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td><b>ѡ��ģ��</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">ѡ��ģ�����ļ���</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[theme_dir]" >' . "\r\n\t\t\t\t" . '<option value="">��</option>' . "\r\n\t\t\t\t";
    foreach($var_73 as $var_5 => $var_6){;
        echo "\t\t\t\t\t\t" . '<option value="';
        echo $var_6;
        echo '" ';
        if($caiji_config["theme_dir"] == $var_6)echo ' selected';
        echo '>';
        echo $var_6;
        echo '</option>' . "\r\n\t\t\t\t";
    };
    echo "\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td><b>��ƥ��������ʾ</b> <br>' . "\r\n\t\t\t\t" . '<font color="#666666">�Ƿ���ʾURL�������������</font></td>' . "\r\n\t\t\t\t" . '<td><select name="con[theme_showotherurl]" >' . "\r\n\t\t\t\t\t" . '<option value="1" ';
    if($caiji_config["theme_showotherurl"])echo ' selected';
    echo '>��</option>' . "\r\n\t\t\t\t\t" . '<option value="0" ';
    if($caiji_config["theme_showotherurl"] == "0")echo ' selected';
    echo '>��</option>' . "\r\n\t\t\t\t" . '</select></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">��Ŀҳ</u>URL����</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">һ��һ����һ���http://����������ʽ���£�<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">http://a.com/list/{����}.html</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">����ͨ�����{����}��{��ĸ}��{������ĸ}��{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_list]" style="height: 100px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_list"]);
    echo '</textarea>&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">ע���Ǹ���Ŀ��վurl��д�����Ǳ�վ��</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">��Ŀҳ��ҳ</u>URL����</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">һ��һ����һ���http://����������ʽ���£�<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">http://a.com/list/{����}_{����}.html</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">����ͨ�����{����}��{��ĸ}��{������ĸ}��{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_listpage]" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_listpage"]);
    echo '</textarea>&nbsp;&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">ע���Ǹ���Ŀ��վurl��д�����Ǳ�վ��</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">����ҳ</u>URL����</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">һ��һ����һ���http://����������ʽ���£�<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">http://a.com/html/{����}.html</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">����ͨ�����{����}��{��ĸ}��{������ĸ}��{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_show]" style="height: 100px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_show"]);
    echo '</textarea>&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">ע���Ǹ���Ŀ��վurl��д�����Ǳ�վ��</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">����ҳ��ҳ</u>URL����</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">һ��һ����һ���http://����������ʽ���£�<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">http://a.com/html/{����}_{����}.html</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">����ͨ�����{����}��{��ĸ}��{������ĸ}��{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_showpage]" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_showpage"]);
    echo '</textarea>&nbsp;' . "\r\n\t\t\t\t\t" . '<font color="red">ע���Ǹ���Ŀ��վurl��д�����Ǳ�վ��</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b>����ҳ��������</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">һ��һ�����򣬽�ȡ���������磺<br>' . "\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">&lt;div class="content"&gt;(.*)&lt;/div&gt;</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">��д����</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[rules_body]" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["rules_body"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b><u style="font-size:14px;">�Զ���ģ��</u>URL����</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">һ��һ����һ���http://����������ʽ���£�<br>' . "\r\n\t\t\t\t\t\r\n\t\t\t\t\t" . '<div style="padding:5px;border:1px dotted #ff6600;background:#f6f6f6;margin:5px 0;">' . "\r\n\t\t\t\t\t\t" . '<font color="red">' . "\r\n\t\t\t\t\t\t\t" . 'url����----ģ���ļ���----�Ƿ�ɼ�<br>' . "\r\n\t\t\t\t\t\t\t" . '/tag_{*}.html----tags.html----1<br>' . "\r\n\t\t\t\t\t\t\t" . '/about.html----about.html----0<br>' . "\r\n\t\t\t\t\t\t" . '</font>' . "\r\n\t\t\t\t\t" . '</div>' . "\r\n\t\t\t\t\t" . '<font color="blue">����ͨ�����{����}��{��ĸ}��{������ĸ}��{*}</font></font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[urlrules_other]" style="height: 100px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["urlrules_other"]);
    echo '</textarea>&nbsp;<font color="red">ע�����ɼ�ʱ����ֱ����Ⱦģ�壬�����������Ȩ</font></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t\t" . '<tr nowrap class="firstalt">' . "\r\n\t\t\t\t" . '<td valign="top"><b>url��ַ����</b><br>' . "\r\n\t\t\t\t\t" . '<font color="#666666">һ��һ����Ҫ���˵�Ŀ��վ��ַ</font>' . "\r\n\t\t\t\t" . '</td>' . "\r\n\t\t\t\t" . '<td><textarea name="con[theme_sifturl]" style="height: 70px; width: 350px" onFocus="this.style.borderColor=\'#00CC00\'" onBlur="this.style.borderColor=\'#dcdcdc\'" >';
    echo _htmlspecialchars($caiji_config["theme_sifturl"]);
    echo '</textarea></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n\t\t" . '<tbody>' . "\r\n\t\t\t" . '<tr class="firstalt">' . "\r\n\t\t\t\t" . '<td> </td>' . "\r\n\t\t\t\t" . '<td>' . "\r\n\t\t\t\t" . '<input type="submit" value=" �ύ " name="submit" class="bginput">&nbsp;&nbsp;<input type="button" onclick="location.href=\'?page=';
    echo $var_39;
    echo '&keywords=';
    echo $var_40;
    echo '\';" value=" ���� " name="Input" class="bginput"></td>' . "\r\n\t\t\t" . '</tr>' . "\r\n\t\t" . '</tbody>' . "\r\n" . '</table>' . "\r\n" . '</form>' . "\r\n";
};
echo '</div>' . "\r\n" . '</div>' . "\r\n";
include 'footer.php';
echo '</body>' . "\r\n" . '</html>';
