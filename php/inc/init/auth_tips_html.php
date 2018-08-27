<?php
$tips = checktime_log_timeout()?'<span style="color: green">已授权</span>':'<span style="color: #FF0000">未授权(<a href="javascript:" onclick="o();">录入授权码</a>)</span> 功能受限制，授权开放全部功能';