<?php
 require_once("data.php");
$v_config = require_once("../data/config.php");
require_once("checkAdmin.php");
echo ADMIN_HEAD;
echo '<html>
 <head>
  <script type="text/javascript">$(document).bind("contextmenu",function(){return false;});</script> 
 </head>
 <body background="../public/img/top10.gif">
  <style type="text/css">html{overflow-x: hidden;}</style>
  <div style="width:170px"> 
   <img src="../public/img/top11.gif" /> 
   <div class="expand" onclick="h(1)" id="main1"> 
    <div class="expand_title">
     系统设置
    </div> 
   </div> 
   <div class="expand_sub" id="sub1"> 
    <ul> 
     <li><a target="content" href="admin_index.php">网站状态</a></li> 
     <li><a target="content" href="admin_main.php">基本设置</a></li> 
     <li><a target="content" href="admin_admin.php">修改密码</a></li> 
     <li><a target="content" href="update.php?t=update">在线升级</a></li> 
    </ul> 
   </div> 
   <div class="expand" onclick="h(2)" id="main2"> 
    <div class="expand_title">
     采集管理
    </div> 
   </div> 
   <div class="expand_sub" id="sub2"> 
    <ul> 
     <li><a target="content" href="caiji_config.php">采集节点</a></li> 
     <li><a target="content" href="caiji_sift.php">过滤屏蔽</a> <img src="../public/img/vip.gif" style="cursor: pointer;vertical-align: middle;" title="vip功能" width="19" height="18" /></li>
     <li><a target="content" href="caiji_linkword.php">关键词内链</a> <img src="../public/img/vip.gif" style="cursor: pointer;vertical-align: middle;" title="vip功能" width="19" height="18" /></li> 
     <li><a target="content" href="replace.php">伪原创词汇</a><img src="../public/img/vip.gif" style="cursor: pointer;vertical-align: middle;" title="vip功能" width="19" height="18" /></li>
     <li><a target="content" href="caiji_url.php">URL规则设置</a><img src="../public/img/vip.gif" style="cursor: pointer;vertical-align: middle;" title="vip功能" width="19" height="18" /></li>
     <li><a target="content" href="caiji_plus.php"><font color="red">插件管理</font></a><img src="../public/img/vip.gif" style="cursor: pointer;vertical-align: middle;" title="vip功能" width="19" height="18" /></li> 
    </ul> 
   </div> 
   <div class="expand" onclick="h(3)" id="main3"> 
    <div class="expand_title">
     缓存管理 
     <img src="../public/img/vip.gif" style="cursor: pointer;vertical-align: middle;" title="vip功能" width="19" height="18" />
    </div> 
   </div> 
   <div class="expand_sub" id="sub3"> 
    <ul> 
     <li><a target="content" href="cache.php">缓存设置</a></li> 
     <li><a target="content" href="delcache.php">清除缓存</a></li> 
    </ul> 
   </div> 
   <div class="expand" onclick="h(4)" id="main4"> 
    <div class="expand_title">
     其他管理
    </div> 
   </div> 
   <div class="expand_sub" id="sub4"> 
    <ul> 
     <li><a target="content" href="flink.php">友情链接</a></li>
     <li><a target="content" href="admin_ad.php">广告管理</a></li> 
     <li><a target="content" href="admin_ip.php">IP 屏蔽</a></li> 
     <li><a target="content" href="zhizhu_ban.php">蜘蛛屏蔽</a></li> 
     <li><a target="content" href="zhizhu.php">蜘蛛访问记录</a></li> 
    </ul> 
   </div> 
  </div>
 </body>
</html>
';
?>