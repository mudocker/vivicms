function LoginSubmit() {
    if ($("t").value == "") {
        alert("请选择用户类别");
        $("t").focus();
        return;
    }
    if ($("u").value == "") {
        $("u").focus();
        alert("请输入用户名");
        return;
    }
    if ($("p").value == "") {
        alert("请输入密码");
        $("p").focus();
        return;
    }
    var returl = QueryString("returl");
    AjaxMethod("/Login.ashx", "get", "u=" + escape($("u").value) + "&p=" + escape($("p").value) + "&t=" + escape($("t").value) + "&returl=" + escape(returl), LoginCallBack);
}


function LoginSubmit2(t,u,p,returl) {
    if ($(t).value == "") {
        alert("请选择用户类别");
        $(t).focus();
        return;
    }
    if ($(u).value == "") {
        $(u).focus();
        alert("请输入用户名");
        return;
    }
    if ($(p).value == "") {
        alert("请输入密码");
        $(p).focus();
        return;
    }
    AjaxMethod("/Login.ashx", "get", "u=" + escape($(u).value) + "&p=" + escape($(p).value) + "&t=" + escape($(t).value) + "&returl=" + escape(returl), LoginCallBack);
}


function LoginCallBack(ajax) {
    var domain = document.domain.toLowerCase().replace("www.", "");
    var retval = ajax.responseText;
    var re = new RegExp("<script.*script>", "ig");
    retval = retval.replace(re, "");
    re = new RegExp("\\s*", "ig");
    retval = retval.replace(re, "");

    switch (retval) {
        case "N1":
            alert("参数错误！");
            break;
        case "N2":
            alert("登录失败，错误的用户名或密码！");
            break;
        case "N3":
            alert("登录失败");
            break;
        case "Y1":
            top.location.href = "http://ehr." + domain;
            break;
        case "FailureResume":
            top.location.href = "http://myjob." + domain + "/resume.aspx";
            break;
        case "PersonLogined":
            top.location.href = "http://myjob." + domain;
            break;
        case "PgPersonLogined":
            //            top.location.href = "/pg/Pg_Person.aspx";
            top.location.href = "http://myjob." + domain + "/PgResume.aspx";
            break;
        default:
            if (retval.split(":")[0] == "Redir") { top.location.href = retval.substring(retval.indexOf(":") + 1); return; }
            alert("未知的消息");
            break;
    }
}

function Reg() {
    if ($("t").value == "") {
        alert("请选择用户类别");
        $("t").focus();
        return;
    }
    if ($("t").value == "C")
        top.location.href = "/Company_Reg.aspx";
    else
        top.location.href = "/Person_Reg.aspx";
}

function getPass() {
    var h = '<form  action="/password.aspx?t=1" method="get" target="_blank"><input type="hidden" name="t" value="1"></form>';
    $j("#turnpass").html(h);
    $j("#turnpass").find("form").submit();
    $j("#turnpass").html("");
}
function getPassVal() {
    if ($("rb_p").checked == false && $("rb_c").checked == false) {
        alert("请选择用户类别");
        return false;
    }
    if ($("txt2").value == "") {
        alert("请输入用户名");
        $("txt2").focus();
        return false;
    }
    if ($("CheckCode").value == "") {
        alert("请输入验证码");
        $("CheckCode").focus();
        return false;
    }
}
function toUrl(urlType) {
    var t = $j('input:radio[name="demo-radio"]:checked').val();
    if (t == undefined) {
        alert("请选择用户类别");
        return false;
    }
    if (urlType == 1) {
        window.location = "Passporttss.aspx?t=" + t;
    } else if (urlType == 2) {
        window.location = "Passporttse.aspx?t=" + t;
    }
}
function KeyPress(e) {
    if (!e) e = event;
    if (e.keyCode == 13) {
        LoginSubmit();
        if (document.all)
            e.returnValue = false;
        else
            e.preventDefault();
        return false;
    }
}
//获取用户IP
function GUIP(id) {
    //缓存
    if (!window.Cache) {
        window.Cache = new Object();
    }
    if (window.Cache[id] != null) {
        alert(window.Cache[id]);
    }
    else {
        AjaxMethod("/Ajax.ashx?method=getUserIP", "post", "id=" + id, GUIPCallBack, id);
    }
}
//获取用户IP
function GUIPCallBack(ajax, id) {
    alert(ajax.responseText);
    window.Cache[id] = ajax.responseText;
}
//登录信息
function LoginInfo() {
    if (getCookie("P") != null || getCookie("C") != null || getCookie("Pg") != null) {
        AjaxMethod("/Ajax.ashx", "get", "method=LoginInfo", function (ajax) { $("Info").innerHTML = ajax.responseText; $("Info").style.lineHeight = "25px" });
        $j("#yhdl").html('<a href="/" class="navy_link" id="n1">首&nbsp;&nbsp;页</a>');
    }
    $("Info").style.display = "";
}
//培训频道登陆信息 
function LoginInfoE() {
    if (getCookie("E") != null) {
        AjaxMethod("/Ajax.ashx", "get", "method=LoginInfo", function (ajax) { $("Info").innerHTML = ajax.responseText; $("Info").style.lineHeight = "25px" });
    }
    $("Info").style.display = "";
}
//企业更新查看次数
function ComVT() {
    var Point = location.href.split("\#")[1]; ID = QueryString("id");

    if (ID != "") {
        if (Point == undefined) { AjaxMethod("/Ajax.ashx", "get", "rnd=" + Math.random() + "&method=InitLookTimes&p=&id=" + ID, null); document.write("<span style=\"color:#fff\">method=InitLookTimes&p=" + Point + "&id=" + ID + "</span>"); }
        else { AjaxMethod("/Ajax.ashx", "get", "rnd=" + Math.random() + "&method=InitLookTimes&p=" + Point + "&id=" + ID, null); document.write("<span style=\"color:#fff\">method=InitLookTimes&p=" + Point + "&id=" + ID + "</span>"); } 
    }
    //if(Point!=undefined){Event.observe(window, "load", function(){ComFocus(Point);}, false);}
    //Event.observe(window, "load", scroll, false);
    //Event.observe(window, "scroll", scroll, true);
    //Event.observe(window, "resize", scroll, true);
}
function VT(Point, ID) {
    if (ID != "" && Point != "") {
        AjaxMethod("/Ajax.ashx", "get", "rnd=" + Math.random() + "&method=InitLookTimes&p=" + Point + "&id=" + ID, null);
    }
    return true;
}
//聚焦
function ComFocus(id) {
    if (window.lastObject) window.lastObject.className = "job_end";
    if ($("j" + id)) {
        $("j" + id).className = "job_ing";
        window.lastObject = $("j" + id);
    }
}
function scroll() {
    var pos = getAbsolutePosition($("main"));
    var pos1 = getAbsolutePosition($("nav1"));
    if (document.documentElement.scrollTop > pos.top && pos1.height < document.documentElement.offsetHeight) {
        $("nav1").style.top = document.documentElement.scrollTop + "px";
    }
    $("nav1").style.left = (pos.left + pos.width - 10) + "px";
}
//个人更新查看次数
function UserVT() {
    var ID = QueryString("id");
    if (ID != "") {
        AjaxMethod("/Ajax.ashx?method=UserViewTimes", "post", "id=" + ID, null);
    }
}
function A(id) {
    __getAreaNameFromValue(id);
}
function S(id, type) {
    __getSysCodeFromValue(id, type);
}
function A1(id) {
  return  __getAreaNameFromValue1(id);
}
function S1(id, type) {
  return __getSysCodeFromValue1(id, type);
}
function getCookie(name) {
    var arg = name + "=";
    var alen = arg.length;
    var clen = document.cookie.length;
    var i = 0;
    while (i < clen) {
        var j = i + alen;
        if (document.cookie.substring(i, j) == arg)
            return getCookieVal(j);

        i = document.cookie.indexOf(" ", i) + 1;
        if (i == 0) break;
    }
    return null;
}
function getCookieVal(offset) {
    var endstr = document.cookie.indexOf(";", offset);
    if (endstr == -1)
        endstr = document.cookie.length;
    return unescape(document.cookie.substring(offset, endstr));
}
function getAllAreaCode(code) {
    var myName = __getAreaCodesName(code);
    var myCode = __getAreaCodesID(code);
    var retName = [], retCode = [];

    for (var i = 1; i < myCode.length; i++) {
        if (myCode[i].substr(4) == "00") {
            var tmp = __getAreaCodesName(myCode[i]);
            for (var j = 1; j < tmp.length; j++)
                tmp[j] = "　" + tmp[j];
            retName = retName.concat(tmp);
            retCode = retCode.concat(__getAreaCodesID(myCode[i]))
        }
        else {
            retName = retName.concat(new Array(myName[i]));
            retCode = retCode.concat(new Array(myCode[i]));
        }
    }
    retName.unshift(myName[0]); retCode.unshift(myCode[0]);
    return { "Name": retName, "Code": retCode };
}

function SearchSub() {
    var t = $("ST").value;
    var k = $("SK").value;
    var s = $("SS").value;
    if (window.location.href.toLowerCase().indexOf("gjrclist")>0) {
        t = "gjr";
        k = $('KeyWord').value;
    }
    var stype = $j("#searchtype").val();
    //var jobclass = GetQueryString("jobclass");
    
    var qu = new Array();
    if (k != "") {
        qu[qu.length] = "k=" + escape(k.trim()).replace(/\+/ig, '%2B').replace(new RegExp("#", "g"), '%23');
    }

    //if (jobclass != "") {
    //    qu[qu.length] = "jobclass=" + jobclass;
    //}
    if (t!=="P") {
        var a = ($("SA_d3").value != '') ? $("SA_d3").value : ($("SA_d2").value != '') ? $("SA_d2").value : ($("SA_d1").value != '') ? $("SA_d1").value : '';
        if (a != "" && $("SA_d1").style.display != "none") {
            qu[qu.length] = "a=" + a;
        }
        if (s != "") {
            qu[qu.length] = "s=" + s;
        }
    } else if ($('ms') && $('ms').style.display == '') {
        var a = ($("SA2_d3").value != '') ? $("SA2_d3").value : ($("SA2_d2").value != '') ? $("SA2_d2").value : ($("SA2_d1").value != '') ? $("SA2_d1").value : '';
        if (a != "") {
            qu[qu.length] = "a=" + a;
        }

        if ($("sp").value != "") {
            qu[qu.length] = "sp=" + $("sp").value;
        }

        if ($("h").value != "") {
            qu[qu.length] = "h=" + $("h").value;
        }
        if ($("y").value != "") {
            qu[qu.length] = "y=" + $("y").value;
            if ($("yt").value != "") {
                qu[qu.length] = "yt=" + $("yt").value;
            }
        }

        if ($("x").value != "") {
            qu[qu.length] = "x=" + $("x").value;
            if ($("xt").value != "") {
                qu[qu.length] = "xt=" + $("xt").value;
            }
        }

        if ($("nn1").value != "0" && $("nn1").value != "") {
            qu[qu.length] = "n1=" + $("nn1").value;
        }
        if ($("nn2").value != "0" && $("nn2").value != "") {
            qu[qu.length] = "n2=" + $("nn2").value;
        }
        if ($("f").value != "") {
            qu[qu.length] = "f=" + $("f").value;
        }
        if ($("s").value != "") {
            qu[qu.length] = "s=" + $("s").value;
        }
        qu[qu.length] = "ms=1";
        //string SP = Request.QueryString["sp"] + "";       //专业类别
        //string H = Request.QueryString["h"] + "";       //职位类别
        //string Q = Request.QueryString["q"] + "";       //行业类别
        //string Y = Request.QueryString["y"] + "";       //工作经验
        //string YT = Request.QueryString["yt"] + "";
        //string X = Request.QueryString["x"] + "";       //学历要求
        //string XT = Request.QueryString["xt"] + "";
        //string N = Request.QueryString["n"] + "";       //年龄    
        //string F = Request.QueryString["f"] + "";       //发布时间
        //string Type = Request.QueryString["type"] + ""; //搜索类别

    }
    var url = "";
    switch (t) {
        case "J":
            url = "/jobList.shtml?stype=" + stype;
            break;
        case "P":
            url = "/resumeList.shtml?stype=" + stype;
            break;
        case "gjr":
            url = "/gjrclist.shtml?stype=" + stype;
            break;
        case "C":
            url = "/companyList.shtml?stype=" + stype;
            break;
        case "Pn":
            url = "/Pg/resumeList.shtml?pg=1&stype=" + stype;
            top.location.href = url + "&" + qu.join("&");
            return;
            break;
        case "Pg":
            url = "/Pg/pg_Classlist.shtml?stype=" + stype;
            break;
    }
    window.location.href = url + "&" + qu.join("&");
}


function SearchChange(v) {
    if (v == "P") {
        if (QueryString("ms") == "1" && $("ms") && $("ms").style.display != "none") {
            $('sb').style.display = "none";
            $("msb").style.display = "none";
        } else {
            $("msb").style.display = "";
        }

    } else {
        $('sb').style.display = '';
        $("msb").style.display = "none";
        if ($("ms")) {
            $("ms").style.display = "none";
        }
    }
    switch (v) {
        case "J":
            Forms.initDropList($("SS"), __getSysCodesName("18000"), __getSysCodesID("18000"), QueryString("s"), "职位类别不限", "");
            $("SS").style.display = "none";
            //$("SS").style.width="100px";
            $("SA_d1").style.display = "";
            $("SA_d2").style.display = ($("SA_d2").value != $("SA_d1").value) ? "" : "none";
            $("SA_d3").style.display = ($("SA_d3").value != $("SA_d2").value) ? "" : "none";
            if ($("s_90") && location.href.substr(location.href.length - 1, 1) == "/") $("s_90").style.display = '';
            break;
        case "P":
            //Forms.initDropList($("SS"),__getSysCodesName("13000"),__getSysCodesID("13000"),QueryString("s"),"专业类别不限","");
            //Forms.initDropList($("SS"), new Array('男', '女'), new Array('1', '0'), "", "性别不限", "");
            $("SS").style.display = "none";
            $("SA_d1").style.display = "none";
            $("SA_d2").style.display = "none";
            $("SA_d3").style.display = "none";
            //$("SA_d2").style.display = ($("SA_d2").value != $("SA_d1").value) ? "" : "none";
            //$("SA_d3").style.display = ($("SA_d3").value != $("SA_d2").value) ? "" : "none";
            if (location.href.toLowerCase().indexOf("resumelist.aspx") != -1) {
                //$("SS").style.width="80px";
                if ($("s_90")) $("s_90").style.display = '';
            }
            else {
                if ($("s_90")) $("s_90").style.display = 'none';
            }
            break;
        case "C":
            Forms.initDropList($("SS"), __getSysCodesName("19000"), __getSysCodesID("19000"), QueryString("s"), "行业类别不限", "");
            $("SS").style.display = "none";
            $("SA_d1").style.display = "none";
            $("SA_d2").style.display = "none";
            $("SA_d3").style.display = "none";
            if ($("s_90")) $("s_90").style.display = '';
            break;
        case "Pg":
            Forms.initDropList($("SS"), __getSysCodesName("19000"), __getSysCodesID("19000"), QueryString("s"), "普工类别不限", "");
            $("SS").style.display = "none";
            $("SA_d1").style.display = "none";
            $("SA_d2").style.display = "none";
            $("SA_d3").style.display = "none";
            if ($("s_90")) $("s_90").style.display = '';
            break;
        case "Pn":
            //Forms.initDropList($("SS"), __getSysCodesName("19000"), __getSysCodesID("19000"), QueryString("s"), "普工求职类别不限", "");
            Forms.initDropList($("SS"), new Array('男', '女'), new Array('1', '0'), "", "性别不限", "");
            $("SS").style.display = "";
            $("SA_d1").style.display = "none";
            $("SA_d2").style.display = "none";
            $("SA_d3").style.display = "none";
            if ($("s_90")) $("s_90").style.display = '';
            break;
    }
}

function setCss(id, css) {
    if (css == undefined) css = "i_navy_ing";
    if ($(id)) $(id).className = css;
}

//原QZRC
var e1 = null;
var ts1 = null;
if (typeof (HTMLElement) != "undefined") {
    HTMLElement.prototype.contains = function(_child) {
        var _parent = this;
        if (_parent == _child) { return false };
        while (_child && _child != _parent) {
            _child = _child.parentNode;
        }
        return _child == _parent;
    };
}
function isIn(e, x, y) {
    var pos = getAbsolutePosition(e);
    x = x + document.body.scrollLeft - document.body.clientLeft;
    y = y + document.body.scrollTop - document.body.clientTop;
    //alert(x + " " + y + " " + pos.left + " " + pos.width + " " + pos.top + " " + pos.height);
    if (x > pos.left && x < pos.left + pos.width && y > pos.top && y < pos.top + pos.height) {
        return this;
    } else {
        return "outside";
    }
}
function createDiv() {
    var oDiv = document.getElementById("tips");
    if (oDiv == null) {
        oDiv = document.createElement("DIV");
        oDiv.id = "tips";
        oDiv.className = "ts";
        oDiv.style.position = "absolute";
        document.body.appendChild(oDiv);
        oDiv.style.zIndex = 1000;
        oDiv.onmouseout = function(e) {
            if (!this.contains(event.toElement)) { hideTip(); };
        };
    }
    return oDiv;
}
function showJobs(e, id) {
   
    if (e == e1) return;
    jQuery(ts1).hide();
    if (document.readyState != "complete") return;
    //var oDiv = createDiv();
    //if (!window.Cache) window.Cache = new Object();
    e1 = e.srcElement || e.target;
    //if (window.Cache["C_" + id] != null) {
    //    showJobsCallBack(window.Cache["C_" + id], id);
    //}
    //else {
    //    
    //}
    e2 = jQuery(e1).parent();
    while (jQuery(e2).html().indexOf('showJobs') == -1) {
        e2 = jQuery(e2).parent();
    }
//    if (jQuery(e2).children(".ts").html() == null) {
        AjaxMethod("/Ajax.ashx?method=getJobs2", "post", "id=" + id, showJobsCallBack, id);
//    } else {
//        jQuery(e2).children(".ts").show();
//        ts1 = jQuery(e2).children(".ts");
//    }
}
function showJobsCallBack(ajax, id) {
    if (document.readyState != "complete") return;
    var e = window.E || window.event;
    //var oDiv = createDiv();
    var txt = "";
    var inp = typeof (ajax) == "object" ? ajax.responseText : ajax;
    if (inp == "") return;

    var tmp = inp.split('|');

    var i = 1;
    for (var j = 0; j < tmp.length && j < 10; j++) {
        var tmp1 = tmp[j].split('$');
        if (tmp1.length == 2) {
            txt = txt + "<li><a href='http://company.qzrc.com/" + id + ".html#" + tmp1[0] + "' target=\"_blank\"><span>&nbsp;" + (i++) + ".</span>" + tmp1[1] + "</a></li>";
        }
    }
    //if (tmp.length >= 15) {
    txt = txt + "<li><a style='float:right;width:80px;' href='http://company.qzrc.com/" + id + ".html' target=\"_blank\">查看更多>></a></li>";
    //}
    //txt = "<span class='name'>诚聘岗位：</span>";
    txt = "<ul>" + txt + "</ul>"; //<li style=\"color:#ffffff\">" + id + "</li>
    //oDiv.innerHTML =txt;
    //oDiv.style.visibility = "visible";

    //alert(jQuery(e1).parent().html());
    //alert(jQuery(e1).parent().parent().html());

//    if (jQuery(e2).children(".ts").html() == null) {
        var _vmenu = "<div class='ts'>" + txt + "</div>";
        jQuery(e2).append(_vmenu);
        jQuery(e2).mouseleave(function() { jQuery(e2).children(".ts").hide(); });
        jQuery(e2).children(".ts").height("auto");
        if (jQuery(e2).width() == 288) { jQuery(e2).children(".ts").width(286); }
//    } else {

//        jQuery(e2).children(".ts").show();
//    }
    ts1 = jQuery(e2).children(".ts");
    return;
    //if (document.all)
    //    oDiv.style.filter = "Alpha(Opacity=20)";
    //else
    //    oDiv.style.opacity = "0.2";
    //oDiv.title = "20";
    //setTimeout('setOpacity()', 10);
    /*
    alert(e1.getElementsByTagName("a").length);
    var pos = getAbsolutePosition(e1);

    oDiv.style.left = (pos.left) + "px";
    oDiv.style.top = (pos.top - 2) + "px";

    if (pos.width == 288) {
    oDiv.style.width = 258 + "px";
    } else {
    oDiv.style.width = 157 + "px";
    }

    if (oDiv.offsetHeight < 60)
    oDiv.style.height = 60 + "px";
    else
    oDiv.style.height = "auto";
    */
    //window.Cache["C_" + id] = inp;
}
function setOpacity() {
    var oDiv = createDiv();
    var opacity = parseInt(oDiv.title);
    opacity += 20;
    oDiv.title = opacity;

    if (document.all)
        oDiv.style.filter = "Alpha(Opacity=" + opacity + ")";
    else
        oDiv.style.opacity = opacity / 100;

    if (opacity < 100) setTimeout('setOpacity()', 10);
}
function hideTip() {
    return;
    var oDiv = document.getElementById("tips");
    if (oDiv) {
        if (e1.componentFromPoint) {
            if (e1.componentFromPoint(event.clientX, event.clientY) == "outside" && oDiv.componentFromPoint(event.clientX, event.clientY) == "outside") {
                oDiv.style.visibility = 'hidden';
            }
        } else {

            if (isIn(e1, event.clientX, event.clientY) == "outside" && isIn(oDiv, event.clientX, event.clientY) == "outside") {
                oDiv.style.visibility = 'hidden';
            }
        }
    }
}

function hideDiv(div) {
    if ($(div).style.display == 'none') {
        $(div).style.display = '';
    } else {
        $(div).style.display = 'none'
    }
}

function hideMs() {
    if (location.href.toLowerCase().indexOf("resumelist") != -1) {
        if ($('ms').style.display == 'none') {
            $('ms').style.display = '';
            $('sb').style.display = 'none';
            $('msb').style.display = 'none';
        } else {
            $('ms').style.display = 'none'
            $('sb').style.display = '';
            $('msb').style.display = '';
        }
    } else {
        top.location.href = "resumelist.aspx?ms=1";
    }
}
