<?php
$welcome = "您当前{$tips}，使用版本为：<span style='color: #FF6600'>{$version}</span>";
$temp_head = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312">
<link rel="stylesheet" type="text/css" href="../public/css/admin.css">
<link href="../public/css/jquery.css" rel="stylesheet" type="text/css">
<link href="../public/css/base.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../public/js/jquery.js"></script>
<script type="text/javascript" src="../public/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../public/js/vivi.js"></script>
<link href="../public/multi-select/css/multi-select.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../public/multi-select/js/jquery.multi-select.js"></script>
<style type="text/css">
.error_msg{
	color:red;
}
.success_msg{
	color:green;
}
</style>
</head>';

define('ADMIN_HEAD', $temp_head);