
var jieqiUserId = 0;
var jieqiUserName = '';
var jieqiUserPassword = '';
var jieqiUserGroup = 0;
var jieqiNewMessage = 0;
var jieqiUserVip = 0;
var jieqiUserHonor = '';
var jieqiUserGroupName = '';
var jieqiUserVipName = '';

if(document.cookie.indexOf('jieqiUserInfo') >= 0){
	var jieqiUserInfo = get_cookie_value('jieqiUserInfo');
	//document.write(jieqiUserInfo);
	start = 0;
	offset = jieqiUserInfo.indexOf(',', start); 
	while(offset > 0){
		tmpval = jieqiUserInfo.substring(start, offset);
		tmpidx = tmpval.indexOf('=');
		if(tmpidx > 0){
           tmpname = tmpval.substring(0, tmpidx);
		   tmpval = tmpval.substring(tmpidx+1, tmpval.length);
		   if(tmpname == 'jieqiUserId') jieqiUserId = tmpval;
		   else if(tmpname == 'jieqiUserName_un') jieqiUserName = tmpval;
		   else if(tmpname == 'jieqiUserPassword') jieqiUserPassword = tmpval;
		   else if(tmpname == 'jieqiUserGroup') jieqiUserGroup = tmpval;
		   else if(tmpname == 'jieqiNewMessage') jieqiNewMessage = tmpval;
		   else if(tmpname == 'jieqiUserVip') jieqiUserVip = tmpval;
		   else if(tmpname == 'jieqiUserHonor_un') jieqiUserHonor = tmpval;
		   else if(tmpname == 'jieqiUserGroupName_un') jieqiUserGroupName = tmpval;
		}
		start = offset+1;
		if(offset < jieqiUserInfo.length){
		  offset = jieqiUserInfo.indexOf(',', start); 
		  if(offset == -1) offset =  jieqiUserInfo.length;
		}else{
          offset = -1;
		}
	}
}


if(jieqiUserId != 0 && jieqiUserName != '' && (document.cookie.indexOf('PHPSESSID') != -1 || jieqiUserPassword != '')){
    document.write('<ul id="ui-login" class="ui-nav">');
	document.write('<li id="user-fav" class="nav-item"><a class="nav-link" href="?modules/article/bookcase.php" target="_self"><i class="ui-icon user-gb"></i>我的书架</a></li><li id="user-gb" class="nav-item"><a class="nav-link" href="?userdetail.php" target="_self"><i class="ui-icon user-fav"></i>查看资料</a></li><li id="user-logout" class="nav-item"><a class="nav-link" href="?logout.php" target="_self"><i class="ui-icon user-logout"></i>退出登录</a></li>');
	if(jieqiNewMessage > 0){ document.write('[<a href="?message.php?box=inbox"><span class="red">您有新消息</span></a>]'); }
}
else
{
document.writeln("<ul id=\"sign\" class=\"ui-nav\">");
document.writeln("<li id=\"loginbarx\" class=\"nav-item drop-down\"><a id=\"innermsg\" class=\"nav-link drop-title\"  href=\"\/login.php\"  target=\"_self\"><i class=\"ui-icon sign-nav\"><\/i>会员登录<\/a>");
document.writeln("<\/ul>");
}
function get_cookie_value(Name) { 
  var search = Name + "=";
　var returnvalue = ""; 
　if (document.cookie.length > 0) { 
　  offset = document.cookie.indexOf(search) 
　　if (offset != -1) { 
　　  offset += search.length 
　　  end = document.cookie.indexOf(";", offset); 
　　  if (end == -1) 
　　  end = document.cookie.length; 
　　  returnvalue=unescape(document.cookie.substring(offset, end));
　　} 
　 } 
　return returnvalue; 
  }