<?php
@ini_set('display_errors', 'On');
error_reporting(E_ALL & ~E_NOTICE);
@set_time_limit(120);
@ini_set('pcre.backtrack_limit', 1000000);
date_default_timezone_set('PRC');
header("Content-type: text/html; charset=gbk");
define('VV_INC', str_replace("\\", '/', dirname(__FILE__)));
define('VV_ROOT', str_replace("\\", '/', substr(VV_INC, 0, -4)));
@ini_set('memory_limit', '64M');
@ini_set('memory_limit', '128M');
@ini_set('memory_limit', '256M');
@ini_set('memory_limit', '384M');
@set_error_handler('errorHandler');
@register_shutdown_function('fatalErrorHandler');
function errorHandler($errno, $errstr, $errfile, $errline){
    $errortype = array(E_ERROR => 'Error', E_WARNING => 'Warning', E_PARSE => 'Parsing Error', E_NOTICE => 'Notice', E_CORE_ERROR => 'Core Error', E_CORE_WARNING => 'Core Warning', E_COMPILE_ERROR => 'Compile Error', E_COMPILE_WARNING => 'Compile Warning', E_USER_ERROR => 'User Error', E_USER_WARNING => 'User Warning', E_USER_NOTICE => 'User Notice', E_STRICT => 'Runtime Notice',);
    $emsg = date('Y-m-d H:i:s') . ' - [' . $errortype[$errno] . ']:' . $errstr . ' [file]:' . $errfile . '[' . $errline . ']' . "<br>\r\n";
    if($errno == E_ERROR || $errno == E_PARSE || $errno == E_CORE_ERROR || $errno == E_COMPILE_ERROR || $errno == E_USER_ERROR){
        echo $emsg;
    }
}
function fatalErrorHandler(){
    if(!function_exists('error_get_last')){
        set_error_handler(create_function('$errno,$errstr,$errfile,$errline,$errcontext', '
					global $__error_get_last_retval__;
					$__error_get_last_retval__ = array(
						\'type\'        => $errno,
						\'message\'        => $errstr,
						\'file\'        => $errfile,
						\'line\'        => $errline
					);
					return false;
				'));
        function error_get_last(){
            global $__error_get_last_retval__;
            if(!isset($__error_get_last_retval__)){
                return null;
            }
            return $__error_get_last_retval__;
        }
    }
    if($e = error_get_last()){
        switch($e['type']){
        case E_ERROR: case E_PARSE: case E_CORE_ERROR: case E_COMPILE_ERROR: case E_USER_ERROR: errorHandler($e['type'], $e['message'], $e['file'], $e['line']);
            break;
        }
    }
}
require(VV_INC . '/sys.php');
?>