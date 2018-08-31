

var Message = new Object;
function JobListForPg(cid, jid) {
    var obj = "job" + cid;
    if ($(obj).style.display == 'none') {
        if (Message[obj] == null) {
            AjaxMethod("/Ajax.ashx", "get", "method=GetJobDetail&cid=" + cid + "&jid=" + jid + "&ispg=1", GetJobDetailBack, obj);
        }
        else {
            $(obj).innerHTML = Message[obj];
        }
        $(obj).style.display = "";
    }
    else {
        $(obj).style.display = 'none'
    }
}

function JobList(cid, jid) {
    var obj = "job" + cid;
    if ($(obj).style.display == 'none') {
        if (Message[obj] == null) {
            AjaxMethod("/Ajax.ashx", "get", "method=GetJobDetail&cid=" + cid + "&jid=" + jid + "", GetJobDetailBack, obj);
        }
        else {
            $(obj).innerHTML = Message[obj];
        }
        $(obj).style.display = "";
    }
    else {
        $(obj).style.display = 'none'
    }
}

function PgJobList(cid, jid) {

    window.open("../CompanyDetail.aspx?id=" + cid + "#" + jid);

}



function GetJobDetailBack(ajax, objID) {
    Message[objID] = ajax.responseText;
    $(objID).innerHTML = Message[objID];
}

function GotIP(cid) {
    AjaxMethod("/Ajax.ashx", "get", "method=GotIP&cid=" + cid + "", GotIPBack, "");
}

function GotIPBack(ajax) {
    alert(ajax.responseText);
}

function GotIPJob(jid) {
    AjaxMethod("/Ajax.ashx", "get", "method=GotIPJob&jid=" + jid + "", GotIPBack, "");
}
