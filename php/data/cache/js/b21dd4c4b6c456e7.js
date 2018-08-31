//**********************************************************
// Author:	陈世华
// QQ:		47210879
//**********************************************************
var Forms = 
{
    setValue : function(el, v)
    {
        var e = null;
        if(typeof el == "string")e=$(el);
        if(!e || !e.tagName){alert(el + " is null");return;}
        switch(e.tagName)
        {
            case "INPUT":
                this.input(e, v);
                break;
            case "TEXTAREA":
                e.value = v;
                break;
            case "SELECT":
                var selectCount = e.options.length;
                e.selectedIndex = -1;
                for (var j = 0; j < selectCount; j++)
                {
                    var selectChild = e.options[j];
                    if (selectChild.value == v)
                    {
                        e.selectedIndex = j;
                        break;
                    }
                }
                break;
            default:
                alert(e.tagName);
                break;
        }
    },
    
    //INPUT
    input : function(e, v)
    {
        switch(e.type)
        {
            case "radio":
                var objs = document.getElementsByName(e.name);
                for(var i=0;i<objs.length;i++)
                {
                    if(objs[i].value==v)
                    {
                        objs[i].checked=true;
                        break;
                    }
                }
                break;
            default:
                e.value = v;
                break;
        }
    },
    
    //选择得选框
    //t:S全选,U不选,其他反选
    //k:id 关键字
    selCheckBox : function(t, k)
    {
        var o = document.getElementsByTagName("INPUT");
        for(var i=0;i<o.length;i++)
        {
            if(o[i].type=="checkbox")
            {
                if(typeof k=='undefined')
                {
                    o[i].checked = (t=="S"?true:(t=="U"?false:!o[i].checked));
                }
                else
                {
                    if(o[i].id.indexOf(k)!=-1)
                    {
                        o[i].checked = (t=="S"?true:(t=="U"?false:!o[i].checked));
                    }
                }
            }
        }
    },
    
    //初始化下拉控件
    //控件, 系统代码, 初始化值, 第一项文本, 第一项值
    initDropList : function(Control, CodeName, CodeValue, Value, lstText, lstValue)
    {
        if(!Control || !Control.tagName || !Control.tagName == "SELECT")
        {
            alert(Control.id + " is not select control.");
            return;
        }
        Control.length = 0;
        if(typeof(lstText)!='undefined' && typeof(lstValue)!='undefined')
        {
            Control.options.add(new Option(lstText, lstValue));
        }
        for(var i=0;i<CodeName.length;i++)
        {
            var opt = new Option(CodeName[i], CodeValue[i]);
            Control.options.add(opt);
            if(typeof(Value)!='undefined' && Value==CodeValue[i])
            {
                opt.selected = true;
            }
        }
    },
    
    //初始化三级地区控件
    //控件, 初始化值, 第一项文本, 第一项值
    initAreaDropList : function(Control, Level, Parent, Value, lstText, lstValue)
    {
        Control.length = 0;
        var code = "AreaCode";
        if(!Control || !Control.tagName || !Control.tagName == "SELECT")
        {
            alert(Control.id + " is not select control.");
            return;
        }
        if(typeof(__SysCode)=='undefined' || typeof(__SysCode[code])=='undefined')
        {
            alert("include js file /js/sys" + code + ".js");
            return;
        }
        if(typeof(lstText)!='undefined' && typeof(lstValue)!='undefined')
        {
            Control.options.add(new Option(lstText, lstValue));
        }
        for(var i=0;i<__SysCode[code].length;i++)
        {
            if(__SysCode[code][i][0].length == Level + 2 && __SysCode[code][i][0].substring(0, Level) == Parent && Parent.length == Level)
            {
                var opt = new Option(__SysCode[code][i][1].replace(/-/g, ""), __SysCode[code][i][0]);
                Control.options.add(opt);
                if(typeof(Value)!='undefined' && Value==__SysCode[code][i][0])
                {
                    opt.selected = true;
                }
            }
        }
        if(Control.length==0){Control.style.display = "none";}else{Control.style.display = "";}
    }
}