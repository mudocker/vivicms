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
				iframe.style.width="430px";//��ͣ���Ŀ��
				iframe.style.height="350px";//��ͣ���ĸ߶�
				iframe.style.left=249/2+"px";//�����200���������Ŀ��-��ͣ���Ŀ�ȵĲ�
				iframe.style.top=94/2+"px";//�����200���������ĸ߶�-45��45��Ϊ����Ĵ������ph=h-45�е�45��-��ͣ���ĸ߶�
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
		alert("������ȱ����ȷ��������һ�����š�");
		window.location.href=ss_NextHref;
	}else{
		var buffer="/static/shuangtv/hc.html";  
		var paused="/static/shuangtv/zt.html";  //ΪQVOD��ͣ�������ҳ��,���޸�Ϊ���Ĺ��ҳ���ַ
		var pausedW=430;//��ͣ���Ŀ��
		var pausedH=350;//��ͣ���ĸ߶�
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