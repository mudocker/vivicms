//window.onerror=Function("return true");
if(!document.all)document.addEventListener("DOMContentLoaded", function(){document.readyState='complete';}, false);
String.prototype.trim=function(){var tmp=this.replace(/(^\s+)|(\s+$)/g,"");return tmp.replace(/\s+/g, " ");};
//����id��ȡ������
function $() {
  var elements = new Array();

  for (var i = 0; i < arguments.length; i++) {
    var element = arguments[i];
    if (typeof element == 'string')
      element = document.getElementById(element);

    if (arguments.length == 1)
      return element;

    elements.push(element);
  }

  return elements;
}
//��ȡ����ľ���λ��
function getAbsolutePosition(element) 
{ 
	if ( arguments.length != 1 || element == null ) 
	{ 
		return null; 
	}

	var top = element.offsetTop; 
	var left = element.offsetLeft; 
	var width = element.offsetWidth; 
	var height = (element.offsetHeight > element.scrollHeight) ? element.offsetHeight : element.scrollHeight; 
	while( element = element.offsetParent ) 
	{ 
		if ( element.style.position == 'absolute' || element.style.position == 'relative'  
			|| ( element.style.overflow != 'visible' && element.style.overflow != '' ) ) 
		{ 
			break; 
		}  
		top += element.offsetTop; 
		left += element.offsetLeft; 
	} 
	return { top: top, left: left, width: width, height: height }; 
}
//����ȫ������
function inputChk(obj)
{
	var c1 = new Array("��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��", "��");
	var c2 = new Array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "-", ",", "@", ".");
	if(obj.value)
	{
		var str = obj.value;
		for(var i=0;i<c1.length;i++)
		{
			var re = new RegExp(c1[i], "g");
			str=str.replace(re, c2[i]);
		}
		obj.value=str;
	}
}
//ȷ����Ϣ
function chkMsg(s)
{
    return confirm(typeof(s)=="undefined"?"ȷ��ɾ��?":s);
}
//Author:UFO
//QQ:47210879
//Web:http://www.800abc.cn
//JSȡ��URL����
function QueryString(para)
{
    var retval="",s=location.search.replace("?","");
    if(s=="")return "";s = s.split("&");
    for(var i=0;i<s.length;i++)
      if(s[i].toUpperCase().indexOf(para.toUpperCase() + "=")==0)
       retval+=((retval==""?"":", ")+s[i].substr(s[i].indexOf("=")+1,s[i].length));
    return retval;
}
//**********************************************************
function HigheLine()
{
	if(arguments.length==0 || arguments[0]=="")return;
	var obj	=	document.getElementsByTagName("a");
	for(i=0;i<obj.length;i++)
	{
		if(obj[i].getAttribute("s")==null)continue;
		for(var j=0;j<arguments.length;j++)
		{
			var str=arguments[j].replace(/([\\\^\$\*\+\?\{\}\.\(\)\[\]\|\+])/g,"\\$1");
			var re=new RegExp("(" + str + ")","ig");
			var tmp = obj[i].innerHTML;
			var maches = tmp.match(new RegExp("<.*?>", "g"));
			if (maches != null) {
			    for (var iter = 0; iter < maches.length; iter++) {
			        tmp = tmp.replace(maches[iter], "maches_" + iter)
			    }
			}
			tmp = tmp.replace(re, "<span class='searchkey'>$1</span>");
			if (maches != null) {
			    for (var iter = 0; iter < maches.length; iter++) {
			        tmp = tmp.replace("maches_" + iter, maches[iter])
			    }
			}
			obj[i].innerHTML = tmp;
		}
	}
}
//�����ڲ�����
function PersonInSearch()
{
    var retval = "";
    var tmp = new Array("ST", "HY", "GZ", "DQ", "KW");
    for(var i=0;i<tmp.length;i++)
    {
        var v = $(tmp[i]).value;
        if(v!="")retval += (retval==""?"":"&") + tmp[i] + "=" + escape(v);
    }
    return retval;
}
//��ҵ�ڲ�����
function CompanyInSearch()
{
    var retval = "";
    var tmp = new Array("KW", "XL", "ZY", "JY","XB");
    for(var i=0;i<tmp.length;i++)
    {
        var v = $(tmp[i]).value;
        if(v!="")retval += (retval==""?"":"&") + tmp[i] + "=" + escape(v);
    }
    return retval;
}
//��������
function CommonSearch()
{
    var retval = "";
    var tmp = new Array("ST", "DQ", "KW");
    for(var i=0;i<tmp.length;i++)
    {
        var v = $(tmp[i]).value;
        if(v.indexOf("�ؼ���")!=-1)v="";
        if(v!="")retval += (retval==""?"":"&") + tmp[i] + "=" + escape(v);
    }
    return retval;
}
//��ʾ��ʾְλ
function showTipJobs(e, cid)
{
    if(document.readyState!="complete")return;
    if(window.ajax){window.ajax.transport.abort()};
    if(cid<=0)return;
    
    var url		= '/ajax.ashx';
	var param	= 'method=ShowJobs&id=' + cid;
	var x = 0, y = 0;
	if(document.all){x = e.x; y = e.y;}else{x = e.clientX; y = e.clientY;}
	if(window.Cache)
	{
	    if(window.Cache[cid])
	    {
	        showTip({x: x, y: y}, window.Cache[cid]);
	        return;
	    }
	}
	var option	=
	{
		method:"get",
		parameters: param,
		onFailure:function(){
			showTip({x: x, y: y}, "��ȡ����ʧ�ܣ������ԣ�");
		},	
		onSuccess:function(transport)
		{
		    if(!window.Cache){window.Cache = new Object();}
		    var msg = transport.responseText;
		    window.Cache[cid] = msg;
			showTip({x: x, y: y}, msg);
		}
	}
	window.ajax = new Ajax.Request(url, option);
}
//��ʾ����
function initJobData(cid, jid, content)
{
    var obj = $("_" + cid);
    obj.style.display = "";
    var isObject = typeof(content)=='object';
    if(isObject)
    {
        obj.removeChild(content);
        obj.insertBefore(content, obj.firstChild==null?null:obj.firstChild);
    }
    else
    {
        var supportsDOMRanges = document.implementation.hasFeature("Range", "2.0"); 
        if(supportsDOMRanges)
        {
            var range=document.createRange();
            range.setStartBefore(obj);
            var Frag=range.createContextualFragment(content);
            obj.insertBefore(Frag, null);
        }
        else
        {
            obj.insertAdjacentHTML("beforeEnd", content);
        }
    }
    if(window.lastObject)window.lastObject.style.backgroundColor = "";
    window.lastObject = $("_" + jid + "_" + cid);
    if(isObject)content.style.backgroundColor="#ff6600";
}
//����ְλ
function hiddenJobs(cid)
{
    $("_" + cid).style.display = "none";
}
//��������
function wopen(url,width,height,left,top)
{
    open(url,"NewWindow","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=yes,width="+width+",height="+height+",left="+left+",top="+top+"");
}
function initTips()
{
    var o = document.getElementsByTagName("INPUT");
    for(var i=0;i<o.length;i++)
    {
        var obj = o[i];
        if(obj.type && (obj.type == "text" || obj.type == "password") && obj.id.substring(0, 3)=="txt")
        {
            if(obj.onfocus == null)
            {
                obj.onfocus = Function("Tips.change(this);");
            }
            else
            {
                var fun = obj.onfocus.toString();
                fun = fun.replace("function anonymous()\n{", "");
                fun = fun.replace(/\}$/, "");
                obj.onfocus = Function("Tips.change(this);" + fun);
            }
            if(obj.onblur == null)
            {
                obj.onblur = Function("Tips.reset(this);");
            }
            else
            {
                var fun = obj.onblur.toString();
                fun = fun.replace("function anonymous()\n{", "");
                fun = fun.replace(/\}$/, "");
                obj.onblur = Function("Tips.reset(this);" + fun);
            }            
        }
    }
}
//**************����ְλ**************************
function showTip(e, inp)
{
    if(document.readyState!="complete")return;
	if(!e)e=window.event;
	var oDiv = createDiv();
	oDiv.innerHTML = inp;
	oDiv.style.display = "";
	var docWidth = document.documentElement.scrollWidth;
	var docHeight = document.documentElement.scrollTop;
	var x = e.x,y = e.y;
	if(!e.x)
	{
	    x = e.clientX;y = e.clientY;
	}
	if(oDiv.offsetWidth + x + 30 >= docWidth)
	{
		oDiv.style.left = (docWidth - oDiv.offsetWidth - 30) + "px";
		oDiv.style.top = (y + docHeight + 25) + "px";
	}
	else
	{
		oDiv.style.left = (x + 10) + "px";
		oDiv.style.top = (y + docHeight) + "px";
	}
}
function createDiv()
{
	var oDiv = document.getElementById("tips");
	if(oDiv==null)
	{
		oDiv = document.createElement("DIV");
		oDiv.id="tips";
		oDiv.style.border="#858585 1px solid";
		oDiv.style.position="absolute";
		oDiv.style.backgroundColor = "#FFFFF1";
		oDiv.style.padding = "5px";
		oDiv.style.color="#333333";
		oDiv.style.lineHeight = "150%";
		document.body.appendChild(oDiv);
		oDiv.style.width = "230px";
		oDiv.style.display = "none";
	}
	oDiv.innerHTML = "���ڶ�ȡ����,���Ե�...";
	return oDiv;
}
function hideTip()
{
	var oDiv = document.getElementById("tips");
	if(oDiv)
	{
		oDiv.style.display = "none";
		oDiv.style.left = "0px";
		oDiv.style.top = "0px";
	}
}
//*********************��ҳ�л�****************************
function adSwitch(index)
{
    return;
    setTimeout("adSwitch1(" + index + ")", 200);
}
function adSwitch1(index)
{
    for(var i=1;i<=5;i++)
    {
        $("sw" + i).style.display="none";
        $("s" + i).className=(i!=5?"left good":"left good1");
    }
    $("sw" + index).style.display="";
    $("s" + index).className=index!=5?"left good_1":"left good1_1";
}
//*************************�����л�**************************
function navSwitch()
{
    var url = document.location.href.toLowerCase();
    if(url.indexOf("search.aspx?st=1")!=-1)navSwitch1(2);
    if(url.indexOf("search.aspx?st=2")!=-1)navSwitch1(3);
}
function navSwitch1(index)
{
    $("n" + index).className="hi";
    $("n1").className = "navy";
}
//**********************************************************
function Preview()
{
    var domain = $("PersonHead1_d").value;
    var host = location.host.split(".");
    
    while(host.length>=3)
    {
        host.shift();
    }
    host = new Array("rc" + domain).concat(host);
    window.open("http://" + host.join("."));
}

function CompanyDomain()
{
    var domain = $("CompanyHead1_d").value;
    var host = location.host.split(".");
    
    while(host.length>=3)
    {
        host.shift();
    }
    host = new Array(domain).concat(host);
    window.open("http://" + host.join("."));
}
//�ж��Ƿ�������
function Myorder(text)
{
    inputChk(text);
    if(isNaN(text.value)||text.value=="")
    {
         text.value="0";
    }
}

function companyTemplte(v)
{
	if(v=="")return;
	var con = new Array(
		"��л����ӦƸ��\r\n���ļ����������յ����ᾡ��������������Ҫ��Լ����̸��",
		"����ʱ��:XXXX��XX��XX��\r\n���Ե�ַ:XXXXXXXXXXXXXXXXXXX\r\n��ϵ��:" + LinkMan + " ��ϵ�绰:" + Tel + "\r\nлл!",
		"��л����ӦƸ��\r\n����ְλ������,������Ҫ���ǽ���ϵ��!",
		"���ѱ�¼��,��ǰ������\r\n����ʱ��:XXXX��XX��XX��\r\n������ַ:XXXXXXXXXXXXXXXXXXX\r\n��ϵ��:" + LinkMan + " ��ϵ�绰:" + Tel + "\r\nлл!");
	
	this.$("M_txt3").value = con[parseInt(v)];
}

function defaultSwitch(o)
{
    switch(o)
    {
        case 1:
            $("re1").style.display="none";
            $("ire1").style.display="none";
            $("re2").style.display="";
            $("ire2").style.display="";
            break;
        case 2:
            $("re1").style.display="";
            $("ire1").style.display="";
            $("re2").style.display="none";
            $("ire2").style.display="none";
            break;
    }
}
/******************************************************************************************************************************/
/*                                              �¼ӹ���                                                                      */
/******************************************************************************************************************************/

//URL,�ύ����,����,�ص�����,�۽��ؼ�ID
document.write("<div id='systemWorking' style='display:none;position:absolute;left:0px;top:0px;background-Color:#ffffaa;border:1px solid red;'><img src='/images/waiting.gif' align='absmiddle'>���ݶ�ȡ��.���Ժ�...</div>");
function AjaxMethod(url, method, parame, callBack, objID, allowCount) {
    if(parame==""){alert("����Ϊ��");return;}
    allowCount = allowCount || 0;
    if(Ajax.activeRequestCount>allowCount)return;

    var myGlobalHandlers = {
        onCreate: function(){
            $("systemWorking").style.top = document.documentElement.scrollTop + "px";
            $("systemWorking").style.left = document.documentElement.scrollLeft + "px";
            Element.show('systemWorking');
        },
        onComplete: function() {
            if(Ajax.activeRequestCount == 0){
                Element.hide('systemWorking');
            }
        }
    };
    if(callBack!=null)Ajax.Responders.register(myGlobalHandlers);
	var option	=
    {
	    method:method||"get",
	    parameters: parame + "&" + Math.random(),
	    onFailure:function(){
		   // alert("�ύ������ʧ��!");
	    },	
	    onSuccess:function(transport)
	    {
	        if(callBack!=null)callBack(transport, objID);
	    }
    }
    new Ajax.Request(url, option);
}

//���ؿؼ�
function hideObject(controlID)
{
    $(controlID).style.display = "none";
    if($("hidden_layer"))$("hidden_layer").style.display = "none";
}

function InitObjectPos(obj)
{
	var scrollTop = document.documentElement.scrollTop;
	var scrollHeight = document.documentElement.scrollHeight;
	var clientHeight = document.documentElement.clientHeight;
	
	var scrollLeft = document.documentElement.scrollLeft;
	var scrollWidth = document.documentElement.scrollWidth;
	var clientWidth = document.documentElement.clientWidth;
	
	var offsetWidth = document.documentElement.offsetWidth;	
	var offsetHeight = document.documentElement.offsetHeight;
	
	var Obj_offsetWidth = document.all?obj.firstChild.offsetWidth:obj.firstChild.width;
	var Obj_offsetHeight = obj.firstChild.offsetHeight;
	
	var layer = $("hidden_layer");
	if(!layer)
	{
        layer = document.createElement("div");
        if(document.all)
            layer.style.filter = "Alpha(Opacity=40)";
        else
            layer.style.opacity = "0.4";
        layer.style.position="absolute";
        layer.id = "hidden_layer";
        layer.style.backgroundColor = "#ccc";
        document.body.appendChild(layer);
    }
    else
    {
        layer.style.display = "";
    }
	
	obj.style.position = "absolute";
	obj.style.border = "1px solid red";
	
	var myOffsetLeft = 0, myOffsetTop = 0;
	if(offsetHeight>Obj_offsetHeight)
	{
	    myOffsetTop = parseInt(clientHeight / 2 - Obj_offsetHeight / 2 + scrollTop);
	}
	else
	{
	    myOffsetTop = scrollTop;
	}
	
	if(offsetWidth>Obj_offsetWidth)
	{
	    myOffsetLeft = parseInt(clientWidth / 2 - Obj_offsetWidth / 2 + scrollLeft);
	}
	else
	{
	    myOffsetLeft = scrollLeft;
	}
	
	obj.style.left = myOffsetLeft + "px";
	obj.style.top = myOffsetTop + "px";
	obj.style.width = Obj_offsetWidth + "px";
	
	layer.style.zIndex='998';
    layer.style.left = "0px";
    layer.style.top = "0px";
    layer.style.width = scrollWidth + "px";
    layer.style.height = scrollHeight + "px";
    
    document.onkeydown = function(e){if(!e)e=event;if(e.keyCode==27)hideObject(obj.id);}
}

//��ȡ����ľ���λ��
function getAbsolutePosition(element) 
{ 
	if ( arguments.length != 1 || element == null ) 
	{ 
		return null; 
	} 

	var top = element.offsetTop; 
	var left = element.offsetLeft; 
	var width = element.offsetWidth; 
	var height = (element.offsetHeight > element.scrollHeight) ? element.offsetHeight : element.scrollHeight; 
	while( element = element.offsetParent ) 
	{ 
		if ( element.style.position == 'absolute' || element.style.position == 'relative'  
			|| ( element.style.overflow != 'visible' && element.style.overflow != '' ) ) 
		{ 
			break; 
		}  
		top += element.offsetTop; 
		left += element.offsetLeft; 
	} 
	return { top: top, left: left, width: width, height: height }; 
}
function GRN(e, id)
{
e = e || event;
var pos = getAbsolutePosition(e.srcElement || e.target);
var o = $(id||"adGRN");
o.style.left = (pos.left - 180) + "px";
o.style.top = (pos.top - 100) + "px";
o.style.visibility="visible";
o.onmouseout = function(){this.style.visibility="hidden"};
}
function funZL(e)
{
e = e || event;
var pos = getAbsolutePosition(e.srcElement || e.target);
var o = $("adZL");
o.style.left = pos.left + "px";
o.style.top = pos.top + "px";
o.style.visibility="visible";
o.onmouseout = function(){this.style.visibility="hidden"};
}

function mi(i) { document.write((i == "" ? "" : "&#") + i.replace(/;/g, ";&#")); }


//Ajax��ҳ
var ThisPage = location.pathname.substr(location.pathname.lastIndexOf("/") + 1);
ThisPage = ThisPage.replace("html", "aspx");
//alert(ThisPage);
var ListID = "DataList";
function getPage(str) {
    $(ListID).innerHTML = "<center><P style='height:100px;line-height:100px;'><strong><img src='/images/waiting.gif' align='absmiddle'> ���������У����Ժ򡭡� <a href=javascript:getPage(" + str + ")>����<a></strong></P></center>";
    AjaxMethod(ThisPage, "get", str + "&ajax=1", GetPageBack, ListID);
}
function GetPageBack(ajax, objID) {
    $(objID).innerHTML = ajax.responseText;
} 
