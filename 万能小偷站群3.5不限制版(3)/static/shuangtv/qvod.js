var install="http://img.quanji.cc/www.quanji.cc/other/down.html";  
var QvodIEFF;
var hc=false;

function OnloadFun(){
	Obj = document.getElementById("QvodPlayer");
	//Obj.QvodTextAdUrl=textAdUrl;
	if(!window.ActiveXObject){
		var isInstall = false;
		for (var i=0;i<navigator.plugins.length;i++){
			if(navigator.plugins[i].name == 'QvodInsert'){
				isInstall = true;break;
			}
		}
		if (!isInstall){changeErr();}
	}
    setInterval("FixPos()",1000);
}

function FixPos(){
	if (Obj!=null){
		var duration = Obj.Duration;
		if(duration > 0){
			var iframe=document.getElementById("iframeke");
			if(Obj.PlayState == 3){//play
				iframe.style.display="none";
				document.getElementById("bufferke").style.display="none";
				document.getElementById("pausedke").style.display="none";
			}else if(Obj.PlayState == 2){//paused
				document.getElementById("install").style.display="none";
				document.getElementById("bufferke").style.display="none";
				document.getElementById("pausedke").style.display="block";
				iframe.style.width="430px";//暂停广告的宽度
				iframe.style.height="350px";//暂停广告的高度
				iframe.style.left=249/2+"px";//这里的200＝播放器的宽度-暂停广告的宽度的差
				iframe.style.top=94/2+"px";//这里的200＝播放器的高度-45（45即为下面的代码里的ph=h-45中的45）-暂停广告的高度
				iframe.style.display="block";
			}else{
				iframe.style.display="block";
				document.getElementById("bufferke").style.display="block";
				document.getElementById("install").style.display="none";
				document.getElementById("pausedke").style.display="none";
			}
		}
	}
}

function changeErr(){
	document.getElementById("bufferke").style.display="none";
	document.getElementById("install").style.display="block";
}

function addFlash(url,w,h){
	if(ss_PartLink==""){
		alert("本集暂缺，点确定进入下一集播放。");
		window.location.href=ss_NextHref;
	}else{
		var buffer="/static/shuangtv/hc.html";  
		var paused="/static/shuangtv/zt.html";  //为QVOD暂停广告所在页面,可修改为您的广告页面地址
		var pausedW=430;//暂停广告的宽度
		var pausedH=350;//暂停广告的高度
		var ph=h-45;
		var qurl="";  
		if(url.indexOf('qvod://')==0){
		  var qurlArray=url.split("|");
		  url=qurlArray[0]+'|'+qurlArray[1]+'|'+qurl+qurlArray[2]+'|'
		}
		document.write("<div id=\"qvodbox\"><div id=\"iframeke\" style=\"position:absolute; z-index:999999; top:0; width:100%; height: "+ph+"px; overflow:hidden\"><iframe marginWidth=\"0\" marginHeight=\"0\" frameBorder=\"0\" src=\""+buffer+"\" id=\"bufferke\" scrolling=\"no\" frameborder=\"0\" width=\"100%\" height=\"100%\"></iframe><iframe marginWidth=\"0\" style=\"display:none;\" marginHeight=\"0\" frameBorder=\"0\" src=\""+paused+"\" id=\"pausedke\" scrolling=\"no\" frameborder=\"0\" width=\"100%\" height=\"100%\"></iframe><iframe marginWidth=\"0\" style=\"display:none;\" marginHeight=\"0\" frameBorder=\"0\" src=\""+install+"\" id=\"install\" scrolling=\"no\" frameborder=\"0\" width=\"100%\" height=\"100%\"></iframe></div>");
		if(window.ActiveXObject){
			document.write("<object classid=\"clsid:F3D0D36F-23F8-4682-A195-74C92B03D4AF\" width=\"100%\" height=\""+h+"\" id=\"QvodPlayer\" name=\"QvodPlayer\" onerror=\"changeErr();\"><PARAM NAME='Showcontrol' VALUE='1'><PARAM NAME='URL' VALUE='"+url+"'><PARAM NAME='QvodAdUrl' VALUE='"+buffer+"'><PARAM NAME='Autoplay' VALUE='1'><PARAM NAME='NextWebPage' VALUE='"+ss_NextHref+"'></object>");
		}else{
			document.write("<embed id='QvodPlayer' name='QvodPlayer' width='100%' height='"+h+"' URL='"+url+"' type='application/qvod-plugin' Autoplay='1' QvodAdUrl='"+buffer+"' NextWebPage='"+ss_NextHref+"' Showcontrol='1'></embed>");
		}
		document.write("</div>");
		OnloadFun();
	}
}