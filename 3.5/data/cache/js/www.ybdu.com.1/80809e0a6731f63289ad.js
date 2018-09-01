function isMobileBrowser(){
    var result=false;
    var sUserAgent= navigator.userAgent.toLowerCase();  
    var bIsIpad= sUserAgent.match(/ipad/i) == "ipad";  
    var bIsIphoneOs= sUserAgent.match(/iphone os/i) == "iphone os";  
    var bIsMidp= sUserAgent.match(/midp/i) == "midp";  
    var bIsUc7= sUserAgent.match(/rv:1.2.3.4/i) == "rv:1.2.3.4";  
    var bIsUc= sUserAgent.match(/ucweb/i) == "ucweb";  
    var bIsAndroid= sUserAgent.match(/android/i) == "android";  
    var bIsCE= sUserAgent.match(/windows ce/i) == "windows ce";  
    var bIsWM= sUserAgent.match(/windows mobile/i) == "windows mobile";
    if(bIsIpad||(window.screen.height>=768&&window.screen.width>=1024)){
        result=false;
    }
    else if (bIsIphoneOs || bIsMidp || bIsUc7 || bIsUc || bIsAndroid || bIsCE || bIsWM) {  
        result=true; 
    }
    else
    {  
        result=false;
    }
    return result;
}

if(isMobileBrowser()){
var currentHref=location.href;
    currentHref=currentHref.replace("www.","m.");
    location.href=currentHref; 
}




function index_fumeiti(){
}
//end
//首页分享
function bd_share_index(){
	//document.writeln("");
	bd_share_list();
}

//栏目页分享
function bd_share_list(){
	//document.writeln("");
	}

//信息页分享
function bd_share_info(){
	//document.writeln("");
	bd_share_list();
}

//目录页分享
function bd_share_mulu(){
	//document.writeln("");
	
}

//关健词搜索
function kw_search(){
	//document.writeln("");
	document.writeln("<p style=\"margin-top:8px;font-size:14px;\">搜索关键字——<a href='"+url_articleinfo+"' target=\"_blank\">"+articlename+"TXT下载</a> <a href=?new/js/'"+url_articleinfo+"/' target='_blank'>"+articlename+"下载</a> 	<a href='"+url_index+"'>"+articlename+"全文阅读</a></p>");
}
function kws_search(){
	//document.writeln("");
	document.writeln("搜索关键字——<a href='"+url_index+"' >"+articlename+"</a> <a href='"+url_index+"' >"+articlename+"全文阅读</a> <a href='"+url_index+"'>"+articlename+"全集</a> <a href='"+url_articleinfo+"' target='_blank'>"+articlename+"TXT下载</a> <a href='"+url_articleinfo+"' target='_blank'>"+articlename+"下载</a> <a href='"+url_articleinfo+"' target='_blank'>"+articlename+"TXT</a>");
}
//首页搜索
function index_search(){
document.writeln("<div class=\"ui-search\"><form name=\"form\" method=\"get\" action=\"http://so.ybdu.com/cse/search\"  target=\"_blank\"><input type=\"hidden\" name=\"s\" value=\"14402670595036768243\"><input type=\"hidden\" name=\"entry\" value=\"1\"><input type=\"text\" name=\"q\" baidusug=\"2\" placeholder=\"输入书名或作者,宁可打少别打多\" autocomplete=\"off\" class=\"search-input\"> ");
document.writeln("<input type=\"submit\" id=\"searchbutton\"  class=\"search-button\" value=\"\" />");
document.writeln("</form></div>");
}


//内页搜索
function show_search(){
document.writeln("<form name=\"form\" method=\"get\" action=\"http://so.ybdu.com/cse/search\" target=\"_blank\">");
document.writeln("		  <input type=\"hidden\" name=\"s\" value=\"14402670595036768243\">             ");
document.writeln("          <input type=\"hidden\" name=\"entry\" value=\"1\">                                                       ");
document.writeln("          <input type=\"text\" name=\"q\" baidusug=\"2\" placeholder=\"宁少字,不多字\" autocomplete=\"off\" class=\"input\">  ");
document.writeln("		  <button type=\"submit\" class=\"button\">搜 索</button>		");
document.writeln("	</form>");
}
//文章列表页导航位广告960*90
function show_index(){
document.writeln("");
}

//文章列表页顶部广告960*90
function show_index1(){
document.writeln("<iframe src=\'https://c.v4dwkcv.com/html/click/14189_5070.html\' width=\'960\' height=\'90\' marginheight=\'0\' marginwidth=\'0\' scrolling=\'no\' frameborder=\'0\'></iframe>");
}

//文章目录分享
function show_index2(){
bd_share_mulu();
}

//文章列表页底部广告960*90
function show_index3(){
document.writeln("");
}


//文章阅读页顶部广告960x90
function show_style(){
document.writeln("<iframe src=\'https://c.v4dwkcv.com/html/click/14189_5070.html\' width=\'960\' height=\'90\' marginheight=\'0\' marginwidth=\'0\' scrolling=\'no\' frameborder=\'0\'></iframe>");
}
//文章阅读页三个360*300
function show_left(){
document.writeln("<iframe src=\'https://c.v4dwkcv.com/html/click/14189_5071.html\' width=\'300\' height=\'250\' marginheight=\'0\' marginwidth=\'0\' scrolling=\'no\' frameborder=\'0\'></iframe>");
}

function show_middle(){
document.writeln("<iframe src=\'https://c.v4dwkcv.com/html/click/14189_5072.html\' width=\'300\' height=\'250\' marginheight=\'0\' marginwidth=\'0\' scrolling=\'no\' frameborder=\'0\'></iframe>");
}

function show_right(){
document.writeln("<iframe src=\'https://c.v4dwkcv.com/html/click/14189_5073.html\' width=\'300\' height=\'250\' marginheight=\'0\' marginwidth=\'0\' scrolling=\'no\' frameborder=\'0\'></iframe>");
}
//文章阅读页底部广告960x90
function show_style2(){
document.writeln("<div class=\"infos\">");
document.writeln("<span><a href=\"\/modules\/article\/addbookcase.php?bid="+article_id+"&cid="+chapter_id+"\" style='color:red;' target='_blank'>加入书签<\/a><\/span>");
document.writeln("<span><a href=\"\/modules\/article\/addbookcase.php?bid="+article_id+"\" rel='nofollow' target='_blank'>加入书架<\/a><\/span>");
document.writeln("<span><a href=\"\/modules\/article\/uservote.php?id="+article_id+"\" rel='nofollow' target='_blank'>推荐投票<\/a><\/span>");
document.writeln("<span><a href='/xiazai/"+Math.floor(article_id/1000)+"/"+article_id+"/' rel='nofollow' target='_blank'>返回书页<\/a><\/span>");
document.writeln("<\/div>")
}

//文章阅读页尾部广告960x90
function show_style3(){
document.writeln("<script type=\'text/javascript\' src=\'https://www.ybdu.com/new/js/t.js\'></script>");
}

//全站对联广告（二维码）
function show_duilian(){
	document.write(unescape('%3Cscript charset="utf-8" src="http://znsv.baidu.com/customer_search/api/js?sid=14402670595036768243') + '&plate_url=' + (encodeURIComponent(window.location.href)) + '&t=' + (Math.ceil(new Date()/3600000)) + unescape('"%3E%3C/script%3E'));
}

//首页对联广告（二维码）
function index_fumeiti(){
	document.write(unescape('%3Cscript charset="utf-8" src="http://znsv.baidu.com/customer_search/api/js?sid=14402670595036768243') + '&plate_url=' + (encodeURIComponent(window.location.href)) + '&t=' + (Math.ceil(new Date()/3600000)) + unescape('"%3E%3C/script%3E'));
}

//全站富媒体广告
function show_fumeiti(){
document.writeln("<script type=\'text/javascript\' src=\'https://j.sdqoi2d.com/r/mr_14189_8519.js\'></script>");
}

//全站统计js
function show_tongji(){
		//tj
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?a1b17bf301c6a7aa3a0ba9cce1414f7a";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
document.writeln('<script charset="gbk" src="http://www.baidu.com/js/opensug.js"></script>');

		//搜索
		
		//share
		//document.writeln('<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"16"},"share":{}};with(document)0[(getElementsByTagName(\'head\')[0]||body).appendChild(createElement(\'script\')).src=\'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=\'+~(-new Date()/36e5)];</script>');//baidu share
		//show_login();
}

//分类列表页横幅广告
function show_sort(){
	document.writeln("");
}

//小说介绍页横幅广告
function show_info(){
	document.writeln("");
}

//小说介绍页下载下方广告
function show_info1(){
	document.writeln("");
}

function show_info2(){
	document.writeln("");
}
function show_info3(){
	document.writeln("");
}

function setCookies(cookieName,cookieValue, expirehours)
{
  var today = new Date();
  var expire = new Date();
  expire.setTime(today.getTime() + 3600000 * 356 * 24);
  document.cookie = cookieName+'='+escape(cookieValue)+ ';expires='+expire.toGMTString()+'; path=/';
}
function ReadCookies(cookieName)
{
	var theCookie=''+document.cookie;
	var ind=theCookie.indexOf(cookieName);
	if (ind==-1 || cookieName=='') return ''; 
	var ind1=theCookie.indexOf(';',ind);
	if (ind1==-1) ind1=theCookie.length;
	return unescape(theCookie.substring(ind+cookieName.length+1,ind1));
}
