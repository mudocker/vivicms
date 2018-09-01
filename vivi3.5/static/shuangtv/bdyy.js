  var BDUrlBefore="";
  var BDUrlLast="";
  var install="/static/shuangtv/bdyy.htm";  
  var buffer="/static/shuangtv/hc.htm";  
  var pause="/static/shuangtv/zt.htm";  
  function showad(offest){
	var BaiduPlayer=document.getElementById('BaiduPlayer');
	if(BaiduPlayer!=null){
	  if(BaiduPlayer.IsPlaying()){
		document.getElementById('bdad').style.display = 'none';
		document.getElementById('bdztad').style.display = 'none';
		BaiduPlayer.height = 489;
	  }else if(BaiduPlayer.IsBuffing()){
		document.getElementById('bdad').style.display = 'block';
		document.getElementById('bdztad').style.display = 'none';
		document.getElementById("bdad").style.height = 489-80;
		BaiduPlayer.height = 80;
	  }else if(BaiduPlayer.IsPause()){
		document.getElementById('bdad').style.display = 'none';
		document.getElementById('bdztad').style.display = 'block';
		BaiduPlayer.height = 489;
	  }else{
		document.getElementById('bdad').style.display = 'block';
		document.getElementById('bdztad').style.display = 'none';
		document.getElementById("bdad").style.height = 489-80;
		BaiduPlayer.height = 80;
	  }
	}
  }
	
  function BdhdInstall(w,h){
	document.getElementById("bdplayer").innerHTML='<iframe border="0" src="'+install+'" marginWidth="0" frameSpacing="0" marginHeight="0" frameBorder="0" noResize scrolling="no" width="'+w+'" height="'+h+'" vspale="0"></iframe>';
  }

function addFlash(url,w,h){
	if(ss_PartLink==""){
		alert("本集暂缺，点确定进入下一集播放。");
		window.location.href=ss_NextHref;
	}else{
		var bdztW=w/2-212;
		var bdztH=(h-80)/2-168;
		if(url.indexOf('bdhd://')==0){
		  var BDUrlArray=url.split("|");
		  var SplitUrlName=new Array();
		  SplitUrlName[0]=BDUrlArray[2].substring(0,BDUrlArray[2].lastIndexOf("."));
		  SplitUrlName[1]=BDUrlArray[2].substring(BDUrlArray[2].lastIndexOf("."),BDUrlArray[2].length)
		  url=BDUrlArray[0]+'|'+BDUrlArray[1]+'|'+BDUrlBefore+SplitUrlName[0]+BDUrlLast+SplitUrlName[1]
		}
		  var adh=h-80;
		  document.write('<iframe marginWidth="0" marginHeight="0" src="'+buffer+'" frameBorder="0" width="'+w+'" scrolling="no" height="'+adh+'" id="bdad"></iframe>');
		  document.write('<iframe marginWidth="0" marginHeight="0" src="'+pause+'" frameBorder="0" scrolling="no" id="bdztad" style="position:absolute; left:'+bdztW+'px; top:'+bdztH+'px; width:430px; height:350px; display:none;"></iframe>');
		  var browser = navigator.appName;
		  if(browser == "Microsoft Internet Explorer"){
			document.write('<object classid="clsid:02E2D748-67F8-48B4-8AB4-0A085374BB99" width="'+w+'" height="'+h+'" id="BaiduPlayer" name="BaiduPlayer" onerror="BdhdInstall('+w+','+h+');">');
			document.write('<param name="URL" value="'+url+'">');
			document.write("<param name='LastWebPage' value='"+ss_PrevHref+"'>");
			document.write("<param name='NextWebPage' value='"+ss_NextHref+"'>");
			//document.write('<param name="NextCacheUrl" value="'+nexturl+'">');
			document.write('<param name="Autoplay" value="1">');
			document.write('<param name="OnPlay" value="onPlay">');
			document.write('<param name="OnPause" value="onPause">');
			document.write('<param name="OnFirstBufferingStart" value="onFirstBufferingStart">');
			document.write('<param name="OnFirstBufferingEnd" value="onFirstBufferingEnd">');
			document.write('<param name="OnPlayBufferingStart" value="onPlayBufferingStart">');
			document.write('<param name="OnPlayBufferingEnd" value="onPlayBufferingEnd">');
			document.write('<param name="OnComplete" value="onComplete">');
			document.write('<param name="ShowStartClient" value="1">')
			document.write('</object>');
		  }else if(browser == "Netscape" || browser == "Opera"){
			var install = true;
			for (var i=0;i<navigator.plugins.length;i++) {
				if(navigator.plugins[i].name == 'BaiduPlayer Browser Plugin'){
					install = false;break;
				}
			}
			if (!install){
			  //document.write('<object id="BaiduPlayer" name="BaiduPlayer" type="application/player-activex" width="'+w+'" height="'+h+'" progid="Xbdyy.PlayCtrl.1" param_URL="'+url+'" param_NextCacheUrl="'+nexturl+'" param_LastWebPage="'+prehref+'" param_NextWebPage="'+nexthref+'" param_OnPlay="onPlay" param_OnPause="onPause" param_OnFirstBufferingStart="onFirstBufferingStart" param_OnFirstBufferingEnd="onFirstBufferingEnd" param_OnPlayBufferingStart="onPlayBufferingStart" param_OnPlayBufferingEnd="onPlayBufferingEnd" param_OnComplete="onComplete" param_Autoplay="1" param_ShowStartClient="1"></object>');
			  document.write('<object id="BaiduPlayer" name="BaiduPlayer" type="application/player-activex" width="'+w+'" height="'+h+'" progid="Xbdyy.PlayCtrl.1" param_URL="'+url+'" param_LastWebPage="'+ss_PrevHref+'" param_NextWebPage="'+ss_NextHref+'" param_OnPlay="onPlay" param_OnPause="onPause" param_OnFirstBufferingStart="onFirstBufferingStart" param_OnFirstBufferingEnd="onFirstBufferingEnd" param_OnPlayBufferingStart="onPlayBufferingStart" param_OnPlayBufferingEnd="onPlayBufferingEnd" param_OnComplete="onComplete" param_Autoplay="1" param_ShowStartClient="1"></object>');
			}else{
				BdhdInstall(w,h);
			}
		  }else{
			  alert('请使用IE内核浏览器、360浏览器、Chrome、Firefox、Opera观看本站的影片。');
		  }
		  setInterval("showad()","60");
	}
}