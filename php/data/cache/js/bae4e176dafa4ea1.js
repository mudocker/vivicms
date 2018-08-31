var Advice = {};
Advice.KeyWord = function () {
    return $j("#SK")
};
Advice.container = function () {
    return $j("#KeyList")
};
Advice.timer = undefined;
Advice.timer1 = undefined;
Advice.c = {};
Advice.init = function () {
    Advice.KeyWord().focus(function () {
        Advice.container().html("").show();
        Advice.GetAdvice()
    }).blur(function () {
        Advice.timer = setTimeout(function () {
            Advice.container().hide()
        }, 500)
    }).mouseover(function () {
        if (Advice.timer) {
            clearTimeout(Advice.timer)
        }
    }).keyup(function (e) {
        if (e.keyCode == 13) {
            SearchSub();
            e.returnValue = false;
            return
        }
        if (e.keyCode == 40) {
            Advice.container().show();
            $j(Advice.container().find("div[type=listitem]").get(0)).css("background-color", "#ddd");
            $j(Advice.container().find("div[type=listitem]").get(0)).siblings(function () {
                $j(this).css("background-color", "#fff")
            });
            return
        }
        if (Advice.timer1) {
            clearTimeout(Advice.timer1)
        }
        Advice.timer1 = setTimeout(function () {
            Advice.container().html("").show();
            Advice.GetAdvice()
        }, 500)
    });
    Advice.container().mouseover(function () {
        if (Advice.timer) {
            clearTimeout(Advice.timer)
        }
    }).click(function () {
        if (Advice.timer) {
            clearTimeout(Advice.timer)
        }
    }).mouseout(function () {
        Advice.timer = setTimeout(function () {
            Advice.container().hide()
        }, 500)
    })
};
Advice.GetAdvice = function () {
    $j.ajax({
        async: true,
        type: "POST",
        dataType: "json",
        url: "/Advice.ashx?action=GetList&rnd=" + Math.random(),
        data: {
            k: escape(Advice.KeyWord().val()),
            TheType: $j.TheType
        },
        contentType: "application/x-www-form-urlencoded; charset=utf-8",
        beforeSend: function () { },
        complete: function () { },
        error: function () { },
        success: function (json) {
            var List = json.tempTable;
            var count = json.rowcount[0].total;
            var content = "";
            $j.each(List, function (i, n) {
                content += '<div style="height:20px;line-height:20px;padding-left:5px;cursor:pointer;font-size:13px" type="listitem"><div style="float:left" type="k">' + n.KeyWord + '</div><div style="color:blue;margin-right:5px;float:right;display:none">(' + n.SearchTimes + ")</div></div>"
            });
            content += "";
            Advice.container().css("overflow", "auto").html(content);
            Advice.container().find("div[type=listitem]").mouseover(function () {
                $j(this).css("background-color", "#ddd");
                $j(this).siblings(function () {
                    $j(this).css("background-color", "#fff")
                })
            }).mouseout(function () {
                $j(this).css("background-color", "#fff")
            }).click(function () {
                Advice.container().hide();
                Advice.KeyWord().val($j(this).find("div[type=k]").html())
            })
        }
    })
};
var Search = {};
Search.HistoryID = "searchhistory";
Search.GetHistory = function () {
    $j.ajax({
        async: true,
        type: "POST",
        dataType: "html",
        url: "/Advice.ashx?action=GetSearchHistory",
        contenttype: "application/x-www-form-urlencoded;charset=GB2312",
        data: {
            location: window.location.href.split("?")[0],
            TheType: $j.TheType
        },
        beforeSend: function () { },
        complete: function () { },
        error: function () {
            if (request.isTest == "salad") {
                alert("服务器没有返回数据，可能服务器忙，请重试")
            }
        },
        success: function (json) {
            if (request.isTest == "salad") {
                alert(json)
            }
            if (json != "") {
                $j("#" + Search.HistoryID).html("您曾经搜索过:" + json)
            } else {
                $j("#" + Search.HistoryID).hide()
            }
        }
    })
};
Array.prototype.RemoveMul = function () {
    var arr = [];
    for (var i = 0; i < this.length; i++) {
        if (arr.indexOf(this[i]) < 0) {
            arr.push(this[i])
        }
    }
    return arr
};
Search.DoTemplate = function (temp, data) {
    var paras = temp.match(new RegExp("{.*?}", "g")).RemoveMul();
    for (var i = 0; i < paras.length; i++) {
        if (paras[i]) {
            var p = paras[i].replace("{", "").replace("}", "");
            if (p.indexOf(":") < 0) {
                if (p == "TrueName" && data[p] == "") {
                    temp = temp.replace(new RegExp("{" + p + "}", "g"), "匿名");
                }
                else if (p == "Telphone" && data[p] == "") {
                    temp = temp.replace(new RegExp("{" + p + "}", "g"), "待完善");
                }
                else if (p == "Age" && (data[p] == "0" || data[p] == "")) {
                    temp = temp.replace(new RegExp("{" + p + "}", "g"), "待完善").replace("岁","");
                }
                else if (p == "HopeSalary" && (data[p] == "0" || data[p] == "" || data[p] == "元/月")) {
                    temp = temp.replace(new RegExp("{" + p + "}", "g"), "待完善");
                    temp = temp.replace("<br>", "");
                }
                else {
                    temp = temp.replace(new RegExp("{" + p + "}", "g"), (data[p] ? data[p].replace(new RegExp("sadyhlad", "g"), "'") : ""))
                }
            } else {
                var fun = p.split(":")[0];
                var ps = p.split(":")[1].split(",");
                if (fun.indexOf("fun_") >= 0) {
                    fun = fun.split("_")[1];
                    var parass = "";
                    for (var ii = 0; ii < ps.length; ii++) {
                        var va = ps[ii].indexOf("string_") >= 0 ? ps[ii].split("_")[1] : (data[ps[ii]] ? data[ps[ii]].replace(new RegExp("sadyhlad", "g"), "'") : "");
                        parass += (parass == "" ? "" : ",") + "'" + va + "'"
                    }
                    var val = eval(fun + "(" + parass + ")");
                    temp = temp.replace(new RegExp("{" + p + "}", "g"), val)
                }
            }
        }
    }
    return temp
};
Search.GetRequest = function () {
    var l = window.location.href.split("?");
    var res = {};
    if (l.length > 1) {
        var ps = l[1].split("&");
        for (var i = 0; i < ps.length; i++) {
            if (ps[i].indexOf("=") > 0) {
                res[ps[i].split("=")[0]] = unescape(ps[i].split("=")[1])
            }
        }
    }
    res.urlfrom = l[0];
    return res
};
Search.timer = undefined;

function clone(myObj) {
    if (typeof (myObj) != "object") {
        return myObj
    }
    if (myObj == null) {
        return myObj
    }
    var myNewObj = new Object();
    for (var i in myObj) {
        myNewObj[i] = clone(myObj[i])
    }
    return myNewObj
}
Search.init = function (Action, callback) {
    Search.Request = Search.GetRequest();
    if (!Search.Request.p || isNaN(Search.Request.p) || Search.Request.p < 1) {
        Search.Request.p = 1
    }
    var temp = $j("#template").html();
    $j("#template").show().html("");
    var search = function () {
        Search.timer = undefined;
        var data = clone(Search.Request);
        if (Search.Page > 2) {
            return false
        }
        data.p = parseInt(Search.Request.p) + parseInt(Search.Page);
        if (!data.pn) {
            data.pn = Search.PageNumber
        }
        data.ps = 25;
        if (data.pn > 1 && data.p > data.pn) {
            return false
        }
        if (data.pn == 1 && data.p >= data.pn) {
            return false
        }
        $j.ajax({
            async: true,
            type: "POST",
            dataType: "json",
            url: "/Search.ashx?action=" + Action + "&rnd=" + Math.random(),
            data: data,
            contentType: "application/x-www-form-urlencoded; charset=utf-8",
            beforeSend: function () {
                $j(".page").show().html("<div id='systemWorking' style='font-size:16px'><img src='/images/ajax-loader.gif' align='absmiddle'>数据读取中.请稍候...</div>")
            },
            complete: function () { },
            error: function () { },
            success: function (json) {
                if (json.Res == "1") {
                    if (Search.Request.isTest == "salad") {
                        alert(json.time);
                        alert(data.p + "_" + Search.Page);
                        alert(json.table[0].UserID)
                    }
                    Search.PageNumber = json.pageNumber;
                    if (Search.Page < 3) {
                        Search.Page += 1
                    }
                    var List = json.table;
                    var count = json.resnum;
                    if (count > 0) {
                        var content = "";
                        $j.each(List, function (i, n) {
                            content += Search.DoTemplate(temp, n)
                        });
                        content += "";
                        if (data.p == 1) {
                            $j("#template").html(content)
                        } else {
                            $j("#template").append(content)
                        }
                        if (Search.Request.k) {
                            HigheLine(Search.Request.k.replace(new RegExp("%", "g"), "', '"))
                        }
                        var l = window.location.href.split("?");
                        var pa = "";
                        if (l.length > 1) {
                            pa = l[1];
                            pa = pa.replace(new RegExp("&p=.*?&", "g"), "&").replace(new RegExp("&pn=.*", "g"), "")
                        }
                        if (pa == "") {
                            pa = "rnd=" + Math.random()
                        }
                        if (Search.Request.isTest == "salad") {
                            document.write($j("#template").html())
                        }
                        $j(".page").html(Search.ShowPage(data.p, Search.PageNumber, pa) + '<span style="color:#fff;margin-left:20px">' + json.time + "</sapn>");
                        if (callback) {
                            callback()
                        }
                    } else {
                        var html = '<div style=";width:100%;text-align:left;padding-top:10px;color:#777;font-size:14px"> 没有找到您想要的数据，<a href="?stype=j&s=' + (Search.Request.s ? Search.Request.s : "") + "&a=" + (Search.Request.a ? Search.Request.a : "") + "&k=" + (Search.Request.k ? escape(Search.Request.k) : "") + '">换一种搜索方式</a>试试？</div>';
                        $j("#template").html(html);
                        $j(".page").html("")
                    }
                } else {
                    document.write(json.Mess)
                }
            }
        })
    };
    Search.Page = 0;
    Search.PageNumber = 0;
    $j(window).scroll(function () {
        if (($j(window).height() + $j(window).scrollTop()) >= $j("body").height() - 50) {
            if (Search.timer) {
                clearInterval(Search.timer)
            }
            Search.timer = setTimeout(search, 500)
        }
    });
    search()
};
Search.ShowPage = function (CurrentPage, PageNumber, Param) {
    if (PageNumber > 150) {
        PageNumber = 150
    }
    if (CurrentPage < 1) {
        CurrentPage = 1
    }
    if (CurrentPage > PageNumber) {
        CurrentPage = PageNumber
    }
    var str = "";
    if (CurrentPage > 1) {
        str = str + "<a href='?" + Param + "&p=" + (CurrentPage - 1) + "&pn=" + PageNumber + "'>上一页</a>&nbsp;"
    }
    var num = CurrentPage - 5;
    var num2 = CurrentPage + 5;
    if (num <= 0) {
        num = 1
    }
    if ((num2 - num) < 10) {
        num2 += 10 - (num2 - num)
    }
    if (num2 > PageNumber) {
        num2 = PageNumber
    }
    for (var i = num; i <= num2; i++) {
        if (i > 0) {
            if (i == CurrentPage) {
                str = str + i.toString() + "&nbsp;"
            } else {
                str = str + "<a href='?" + Param + "&p=" + i.toString() + "&pn=" + PageNumber + "'>[" + i.toString() + "]</a>&nbsp;"
            }
        }
    }
    if (CurrentPage < PageNumber) {
        str = str + "&nbsp;<a href='?" + Param + "&p=" + (CurrentPage + 1) + "&pn=" + PageNumber + "'>下一页</a>&nbsp;"
    }
    return str
};
var showview = function () {
    var r = "";
    $j("span[id*=view_]").each(function () {
        if (!$j(this).attr("isset")) {
            r = r + (r == "" ? "" : ",") + $j(this).attr("id").split("_")[1]
        }
    });
    if (r != "") {
        $j.ajax({
            type: "POST",
            url: "/Ajax.ashx?method=GetHistory",
            data: "&ids=" + r,
            success: function (msg) {
                if (msg != "") {
                    strs = r.split(",");
                    for (var i = 0; i < strs.length; i++) {
                        var tmp = getView(msg, strs[i]);
                        $j("#view_" + strs[i]).attr("isset", true);
                        if (tmp != null) {
                            $j("#view_" + strs[i]).html("最后查看：" + tmp)
                        }
                    }
                }
            }
        })
    }
    function getView(str, name) {
        var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
        var r = str.match(reg);
        if (r != null) {
            return unescape(r[2])
        }
        return null
    }
};
$j(document).ready(function () {
    if ($j.TheType == "P" || $j.TheType == "C") {
        Advice.init();
        Search.GetHistory()
    }
});