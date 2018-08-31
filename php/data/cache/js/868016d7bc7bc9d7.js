var ts;
var width='"100%"';
var white="'#ffffff'";
var orange="'#E1F0FF'";
var black="'#000000'";

var tp1='<img src="http://www.qzrc.com/images/dot.gif" style="margin:0px 4px 2px 4px;">';

var tu1 = "http://www.qzrc.com/CompanyDetail.aspx?ID=";
var tu4=' onMouseOver="mover_hand(this,' + orange + ');" onclick="showLayer(event,{0});" onMouseOut="mout(this,'+white+');"';

function mout(src,color){src.style.backgroundColor='#FFFFFF'}
function mover_hand(src,color){src.style.backgroundColor=color;src.style.cursor='pointer'}
var ts = "";
var addtop = "145px";
try
{
    addtop = adtop;

}
catch(e)
{
    
}
ts += '<div id="Layer_ad" style="position:absolute; width:100px; height:300px; z-index:1000; left: 10px; top: ' + addtop + '">';
ts+='<table width="100" border="0" cellspacing="0" cellpadding="0" style="border:#fff 1px solid; background-color:#ff9800;"><tr><td align="center"><img src="http://www.qzrc.com/images/goodcompany.gif" /></td></tr><tr><td height="2" bgcolor="#CCCCCC"></td></tr></table>';
ts+='<table width="100"  border="0" cellspacing="0" cellpadding="0"><tr><td>';
ts+='<table width='+width+' border="0" cellspacing="0" cellpadding="0">';

for (i in _c)
{
	if(!_c[i].item)continue;
	ts+='<tr id="tr' + i + '" bgcolor='+white;
	ts+=tu4.replace("{0}", i).replace("{0}", i);
	ts+='>';
	ts+='<td height="24">';
	ts+=tp1+_c[i].Text;
	ts+='</td>';
	ts+='<td width="10"><img src="http://www.qzrc.com/images/irow_o_r.gif"></td>';
	ts+='<td width="0" valign="top"></td>';
	ts+='<tr><td colspan="2" background="http://www.qzrc.com/images/price_menu_bg.gif"><img src="http://www.pconline.com.cn/images/blank.gif" width="1" height="1"></td></tr></tr>';
}

ts+='</table>';
ts+='</td></tr></table>';
//ts+='<br/><a href="http://135.qzrc.com/" target="_blank"><img src="http://vip.qzrc.com/UploadFile/tmp/100-150.gif" border="0"></a>';
ts+='</div>';


function showLayer(e,i)
{
	if(document.readyState!="complete" && window.readyState!="complete")return;
	var oDiv = document.getElementById("tips");
	if(oDiv)oDiv.style.display="none";
	if(typeof(window.lastID)!='undefined'){if(window.lastID==i && document.getElementById("Layer" + window.lastID).style.visibility == "visible"){hiddenLayer(e,window.lastID);return;}else{hiddenLayer(e,window.lastID);}}
	window.lastID = i;
	var alp = document.getElementById("alpha");
	if(alp==null)
	{
		alp = document.createElement('DIV');
		alp.className="alpha";
		alp.id = "alpha";
		document.body.appendChild(alp);
	}
	alp.style.visibility = "visible";

	var div = document.getElementById("Layer" + i);
	if(div==null)
	{
		div = document.createElement('DIV');
		div.id="Layer" + i;
		div.className = "vip_layer";
		div.style.position = "absolute";
		div.style.visibility = "hidden";
		div.style.zIndex = 1001;
		document.getElementById("tr"+i).cells[2].appendChild(div);
	}
	else
	{
		div.style.visibility = "visible";
		return;
	}
	var t  = document.createElement("TABLE");
	t.style.width = "850px";
	t.cellPadding = 0;
	t.cellSpacing = 0;
	var tr, td, a;

	tr = t.insertRow(t.rows.length);
	tr.style.backgroundColor="#CEE7FF";
	tr.className="th";

	td = tr.insertCell(tr.cells.length);
	td.style.width = "25%";
	td.innerHTML = "<b>" + _c[i].Text + "</b>";
	td = tr.insertCell(tr.cells.length);
	td.style.width = "25%";
	td.innerHTML = "&nbsp;";
	td = tr.insertCell(tr.cells.length);
	td.style.width = "25%";
	td.innerHTML = "&nbsp;";
	td = tr.insertCell(tr.cells.length);
	td.style.width = "25%";
	//td.style.border = '1pt solid red'
	td.style.textAlign = 'right'
	td.style.paddingRight = '20px'
	td.innerHTML = '<img src="http://www.qzrc.com/images/v_close.gif" alt="¹Ø±Õ" onclick="hiddenLayer(event,' + i + ')"/>';

	for(var j=0;j<_c[i].item.length;j+=2)
	{
		if(j%8==0)
		{
			tr = t.insertRow(t.rows.length);
			tr.style.backgroundColor = "#FFF";
		}
		td = tr.insertCell(tr.cells.length);
		td.style.width = "25%";
		td.onclick=Function("window.open('" + tu1 + _c[i].item[j] + "')");
		td.onmouseover=function(){this.style.backgroundColor=orange.replace("'", "").replace("'", "")};
		td.onmouseout=function(){this.style.backgroundColor=white.replace("'", "").replace("'", "")};
		td.innerHTML = tp1 + _c[i].item[j+1];
	}
	while(tr.cells.length<4){td=tr.insertCell(tr.cells.length);td.innerHTML="&nbsp;";td.style.width = "25%";}
	div.appendChild(t);
	div.style.visibility = "visible";
	alp.style.height = document.documentElement.scrollHeight + "px";
}

function hiddenLayer(e,i)
{
	if(document.readyState!="complete" && window.readyState!="complete")return;
	var div = document.getElementById("Layer" + i);
	if(div!=null)div.style.visibility = "hidden";
	var alp = document.getElementById("alpha");
	if(alp!=null)alp.style.visibility = "hidden";
	if(document.all)
		e.cancelBubble=true;
	else
		e.stopPropagation();
}
if(screen.width>800)
document.write(ts);