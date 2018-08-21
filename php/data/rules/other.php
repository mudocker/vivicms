<?php
include(VV_INC . "/delcache.php");
$ac = isset($_GET['ac'])?$_GET['ac']:'';
require_once(VV_DATA.'./rules/collectid.php');
$caiji_config = require(VV_DATA . "/config/{$collectid}.php");
require_once(VV_DATA.'./rules/web_urlencode.php');
list($_SERVER['QUERY_STRING'],) = explode('#', $_SERVER['QUERY_STRING']);
require_once (VV_DATA.'./rules/convert_query_charset.php');
require_once (VV_DATA.'./rules/convert_query_post_get.php');
require_once (VV_DATA.'./rules/resdomain.php');
require_once (VV_DATA.'./rules/from_url.php');
require_once (VV_DATA.'./rules/server_url.php');
require_once (VV_DATA.'./rules/WEB_ROOT.php');