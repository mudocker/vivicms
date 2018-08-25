<?php
$action = isset($_GET['action'])?$_GET['action']:'';
switch($action){
    case 'c1':echo checktime_log_out_1h();
        break;
    case 'c2':$file = VV_DATA . "/" . sha1_vxiaotou_com_php();
        (is_file($file) && stripos($_SERVER['HTTP_REFERER'], $_SERVER['HTTP_HOST']) > -1) and @unlink($file);
        break;
    case 'c3':$file = VV_DATA . "/" . sha1_vxiaotou_com_php();
        $code = isset($_POST['code'])?trim($_POST['code']):'';
        $result = checktime_log_out_1h($code);
        $result and write_sv_ln($code);
        echo $result;
        break;
    case 'c4':echo checktime_log_out_1h(0, 1);
        break;
    case 'c5':$file = isset($_GET['file'])?trim($_GET['file']):die('miss file');
        $code = @file_get_contents(VV_ROOT . "/public/js/" . $file);
        $key = isset($_GET['key'])?trim($_GET['key']):die('miss key');
        $result = replace_url($code, $key);
        header("Content-type: text/javascript; charset=gbk");
        echo $result . ';var submit=\'<tr class="firstalt"><td colspan="2" align="center"><input class="bginput" type="submit" name="submit" value=" �ύ ">&nbsp;&nbsp;<input class="bginput" type="reset" name="Input" value=" ���� "></td></tr>\';';
        break;
}