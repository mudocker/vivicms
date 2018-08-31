function __getSysCodesID(idx) {
    switch (idx) {
        case '10000':
            return new Array('10001', '10002', '10003', '10004', '10999');
        case '11000':
            return new Array('11001', '11002', '11003', '11004', '11005', '11006', '11007', '11008', '11999');
        case '12000':
            return new Array('12001', '12002', '12003', '12004', '12005', '12006', '12007', '12008', '12009', '12010');
        case '13000':
            return new Array('13001', '13002', '13003', '13004', '13005', '13006', '13007', '13008', '13009', '13010', '13011', '13012', '13013', '13014', '13015', '13016', '13017', '13018', '13019', '13020', '13021', '13022', '13023', '13024', '13025', '13026', '13027', '13028', '13029', '13030', '13031', '13032', '13033', '13034', '13035', '13036', '13037', '13038', '13039', '13040', '13041', '13042', '13043', '13044', '13045', '13046', '13047', '13048', '13049', '13050', '13051', '13052', '13053', '13054', '13055', '13056', '13057', '13058', '13059', '13060', '13061', '13062', '13063', '13064', '13065', '13066', '13067', '13068', '13069', '13070', '13071', '13072', '13073', '13999');
        case '14000':
            return new Array('14001', '14002', '14003', '14004', '14005', '14006', '14007', '14008');
        case '15000':
            return new Array('15001', '15002', '15003', '15004');
        case '17000':
            return new Array('17001', '17002', '17003', '17004', '17005');
        case '18000':
            return new Array('18001', '18002', '18003', '18004', '18005', '18006', '18007', '18008', '18009', '18010', '18011', '18012', '18013', '18014', '18015', '18016', '18017', '18018', '18019', '18020', '18021', '18022', '18023', '18024', '18025', '18026', '18027', '18028', '18029', '18030', '18031', '18032', '18033', '18034', '18035', '18036', '18999');
        case '20000':
            return new Array('20001', '20002', '20003', '20004', '20005', '20006', '20007', '20008', '20009', '20010', '20011', '20012', '20013', '20999');
        case '21000':
            return new Array('21001', '21002');
        case '22000':
            return new Array('22001', '22002', '22003', '22004', '22005', '22006', '22007');
        case '23000':
            return new Array('23001', '23002', '23003', '23004', '23005', '23006');
        case '19000':
            return new Array('19001', '19002', '19003', '19004', '19005', '19006', '19007', '19008', '19009', '19010', '19011', '19012', '19013', '19014', '19015', '19016', '19038', '19017', '19018', '19019', '19020', '19021', '19022', '19023', '19024', '19025', '19026', '19027', '19028', '19029', '19030', '19031', '19032', '19033', '19034', '19035', '19036', '19037', '19999');
        default:
            return new Array();
    }
}
function __getSysCodesName(idx) {
    switch (idx) {
        case '10000':
            return new Array('共产党员', '共青团员', '民主党派', '无党派', '其他');
        case '11000':
            return new Array('初中', '高中', '中技', '中专', '大专', '本科', '硕士', '博士', '其他');
        case '12000':
            return new Array('无要求', '1年以上', '2年以上', '3年以上', '4年以上', '5年以上', '6年以上', '7年以上', '8年以上', '8年以上');
        case '13000':
            return new Array('计算机/网络/软件/通信', '应用电子技术', '经济学/财政金融/会计', '工商管理类', '营销/国际贸易/旅游/物流', '管理科学与工程类', '外语类', '机械/自动化/工业设计', '艺术类', '法学类', '电气信息类', '公共管理类', '建筑类', '教育学类', '中国语言文学类', '新闻传播/广告', '数学类', '统计学类', '临床医学与医学技术', '化学类', '轻工纺织食品类', '交通运输类', '材料科学类', '材料类', '物理学类', '药学类', '化工与制药类', '生物科学类', '生物工程类', '环境科学类', '能源动力类', '社会学类', '体育学类', '仪器仪表类', '护理学类', '中医学类', '图书档案/信息管理/文秘', '政治学类', '力学类', '历史学类', '哲学类', '人力资源与心理学类', '工程力学类', '农业工程类', '环境与安全类', '公安学类', '航空航天类', '基础医学类', '预防医学类', '口腔医学类', '水利类', '农业经济管理类', '环境生态类', '林业工程类', '测绘类', '地矿类', '地质学类', '地理科学类', '水产类', '公安技术类', '植物生产类', '动物医学类', '动物生产类', '地球物理学类', '海洋科学类', '海洋工程类', '马克思主义理论类', '军事类', '森林资源类', '大气科学类', '草业科学类', '天文学类', '法医学类', '其他');
        case '14000':
            return new Array('英语', '日语', '德语', '法语', '西班牙语', '朝鲜语', '意大利语', '其他');
        case '15000':
            return new Array('一般', '良好', '熟练', '精通');
        case '17000':
            return new Array('全职', '兼职', '临时', '实习', '不限');
        case '18000':
            return new Array('经营管理类', '销售类', '客户服务类', '项目管理类', '质量管理类', '市场/公关/媒介类', '人力资源类', '行政/后勤类', '财务/审计/统计类', '计算机/网络/技术类', '电子/电器/通信技术类', '电气/能源/动力类', '咨询/顾问类', '金融类(银行/基金/证券)', '保险类', '贸易/物流/采购/运输类', '建筑/房地产/装修/物业', '翻译类', '酒店/餐饮/旅游/服务类', '技工类', '工厂生产类', '机械/仪器仪表类', '商业零售类', '美术/设计/创意类', '文体/影视/写作/媒体类', '教育/培训类', '法律类', '医疗卫生/美容保健类', '生物/制药/化工/环保类', '科研类', '公务员类', '培训生类', '在校学生类', '农林水类', '纺织服装类', '工业自动化', '其他');
        case '20000':
            return new Array('外资企业', '合资企业', '私营企业', '民营企业', '股份制企业', '集体企业', '集体事业', '乡镇企业', '行政机关', '社会团体', '事业单位', '跨国企业(集团)', '国有企业', '其它');
        case '21000':
            return new Array('电子', '家具业');
        case '22000':
            return new Array('一周', '半个月', '一个月', '二个月', '三个月', '半年', '长期');
        case '23000':
            return new Array('已发布职位', '职位名称', '刷新日期', '截止日期', '发布已结束职位', '暂停中职位');
        case '19000':
            return new Array('计算机', '互联网/电子商务', '电子/微电子', '通信(设备/运营/增值服务)', '广告/会展/公关', '房地产开发/建筑与工程', '物业管理/商业中心', '家居/室内设计/装潢', '中介服务(人才/商标专利)', '专业服务(咨询/财会/法律等)', '金融业(投资/保险/证券/银行/基金)', '贸易/进出口', '媒体/出版/文化传播', '印刷/包装/造纸', '快速消费品(食品/饮料/日化/烟酒等)', '服装/鞋帽/纺织/皮革', '家具/工艺品/玩具', '家电业', '办公设备/用品', '旅游/酒店/餐饮服务', '批发/零售', '交通/运输/物流', '娱乐/运动/休闲', '制药/生物工程', '医疗/保健/美容/卫生服务', '医疗设备/器械', '环保', '石油/化工/采掘/冶炼/原材料', '能源(电力/石油)/水利', '仪器/仪表/工业自动化/电气', '机械制造/机电/重工', '服务业', '农/林/牧/渔', '航空/航天研究与制造', '教育/培训/科研/院校', '原材料加工(金属/塑料/玻璃/陶瓷/建材)', '政府/非营利机构', '汽车/摩托车(制造/维护/配件/销售/服务)', '其他');
        default:
            return new Array();
    }
}
function __InitSysCodeServer(ControlID, code, value, note) {
    if (document.readyState != "complete") return;

    var layer = $(ControlID + "_layer");
    if (!layer) {
        layer = document.createElement("div");
        //layer.style.display='none';
        layer.id = ControlID + "_layer";
        layer.className = "mms1";
        layer.style.zIndex = '1000';
        layer.style.position = 'absolute';
        layer.innerHTML += __getSysCodesIDServer(ControlID, code, value, note);
        document.body.appendChild(layer);
    }
    else {
        layer.style.display = "";
    }
    InitObjectPos(layer);
}

function __InitSysCodeTextServer(ControlID, code, value) {
    var ids = __getSysCodesID(code);
    var names = __getSysCodesName(code);
    var obj = $(ControlID);
    if (!obj) return;
    for (var i = 0; i < ids.length; i++) {
        if (ids[i] == value) {
            obj.innerHTML = names[i];
            break;
        }
    }
}
function __setSysCodeValue(ControlID, value, name) {
    $(ControlID + "_hid").value = value;
    $(ControlID + "_h1").innerHTML = name;
}
function __getSysCodesIDServer(ControlID, code, value, note) {
    var ids = __getSysCodesID(code);
    var names = __getSysCodesName(code);
    var htmlDiv = '';
    var css = "pera";
    if (code == "19000") css = "perb";

    htmlDiv += '<div class="mms">';
    htmlDiv += '<div class="top"><div class="left">请选择' + note + '</div><div class="right"><img src="images/gb.gif" onclick="javascript:hideObject(\'' + ControlID + '_layer\');" style="cursor:pointer;" /></div></div>';
    htmlDiv += '<div class="data">';

    for (var i = 1; i <= ids.length; i++) {
        htmlDiv += '<div class="' + css + '" onmouseover="this.style.color=\'#ff7300\'" onmouseout="this.style.color=\'\'" onclick="javascript:__setSysCodeValue(\'' + ControlID + '\', \'' + ids[i - 1] + '\', \'' + names[i - 1] + '\');hideObject(\'' + ControlID + '_layer\');">' + names[i - 1] + '</div>';
    }
    htmlDiv += '<div class="clear"></div></div>';
    return htmlDiv;
}
//职位导航START by ETP 2011.8.25
function __getSysCodesIDServer2(ControlID, code, value, note, mode) {
    var layer = $(ControlID + "_layer");
    if (layer) {
        var ids = __getSysCodesID(code);
        var names = __getSysCodesName(code);
        var page = "jobList.aspx";
        var jobclass = "S";

        if (mode == 2) {
            page = "resumeList.aspx";
            jobclass = "jobclass";
        }
        var cid = GetQueryString(jobclass);
        var cname = "全部类别";
        var key = GetQueryString("K");
        var qs = (key == "" ? "" : ("?K=" + key));
        var htmlDiv = '<div class="top"><span class="title">' + (mode == 1 ? "职位" : "简历") + '导航</span> <font color=red>' + (key == "" ? "" : ("  搜索:[" + unescape(key)) + ']</font> <a href=' + page + (cid == "" ? '' : ('?' + jobclass + '=' + cid)) + '>重置</a>') + '</div><div class="list">';

        if (cid == "") {
            htmlDiv += '<a href="' + (mode == 1 ? "companylist.aspx" : page) + qs + '" style="background-color:\'#66CCFF\'"> 全部类别 </a>';
        } else {
            htmlDiv += '<a href="' + (mode == 1 ? "companylist.aspx" : page) + qs + '" onmouseover="this.style.background=\'#99CCFF\'" onmouseout="this.style.background=\'\'"> 全部类别 </a>';
        }
        for (var i = 1; i <= ids.length; i++) {

            if (cid == ids[i - 1]) {
                htmlDiv += '<a href="' + page + qs + (qs == "" ? "?" : "&") + jobclass + '=' + ids[i - 1] + '" style="background:\'#66CCFF\'">' + names[i - 1] + '</a>';
                cname = names[i - 1];
            } else {
                htmlDiv += '<a href="' + page + qs + (qs == "" ? "?" : "&") + jobclass + '=' + ids[i - 1] + '" onmouseover="this.style.background=\'#99CCFF\'" onmouseout="this.style.background=\'\'">' + names[i - 1] + '</a>';
            }
        }
        htmlDiv += '</div></div><div class="clear"></div>';
        layer.innerHTML = htmlDiv;
    }
}
//职位导航END

//普工职位导航START by Tse 2011.8.27
function __getSysCodesIDServerForPg(ControlID, value, note, mode, page) {
    var layer = $(ControlID + "_layer");
    //alert($j("#txtHopeJobClass_layer").attr("class"));
    if (layer) {
        var arrJobtypeJson = eval(arrSubjobtype);
        var jobclass = "S";
        if (mode == 2) {
            jobclass = "jobclass";
        }
        var cid = GetQueryString(jobclass);
        var cname = "全部类别";
        var key = GetQueryString("K");
        var qs = (key == "" ? "" : ("?K=" + key));
        var htmlDiv = '<div class="top"><span class="title">' + (mode == 1 ? "职位" : "简历") + '导航</span> <font color=red>' + (key == "" ? "" : ("  搜索:[" + unescape(key)) + ']</font> <a href=' + page + (cid == "" ? '' : ('?' + jobclass + '=' + cid)) + '>重置</a>') + '</div><div class="list">';
        if (cid == "") {
            htmlDiv += '<a href="' + page + qs + '" style="background-color:\'#66CCFF\'"> 全部类别 </a>';
        } else {
            htmlDiv += '<a href="' + page + qs + '" onmouseover="this.style.background=\'#99CCFF\'" onmouseout="this.style.background=\'\'"> 全部类别 </a>';
        }
        for (var i = 0; i < arrJobtypeJson.length; i++) {
            if (arrJobtypeJson[i][1] == "0") {
                if (cid == arrJobtypeJson[i][0]) {
                    htmlDiv += '<a class=\"parenthref\" s="' + arrJobtypeJson[i][0] + '" href="' + page + qs + (qs == "" ? "?" : "&") + jobclass + '=' + arrJobtypeJson[i][0] + '" style="background:\'#66CCFF\'">' + arrJobtypeJson[i][2] + '</a>';
                    cname = arrJobtypeJson[i][2];
                } else {
                    htmlDiv += '<a class=\"parenthref" s="' + arrJobtypeJson[i][0] + '" href="' + page + qs + (qs == "" ? "?" : "&") + jobclass + '=' + arrJobtypeJson[i][0] + '" onmouseover="this.style.background=\'#99CCFF\'" onmouseout="this.style.background=\'\'">' + arrJobtypeJson[i][2] + '</a>';
                }
            } else {
                if (cid == arrJobtypeJson[i][0]) {
                    htmlDiv += '<a class=\"sonhref\" s="' + arrJobtypeJson[i][1] + '"  href="' + page + qs + (qs == "" ? "?" : "&") + jobclass + '=' + arrJobtypeJson[i][0] + '" style="background:\'#66CCFF\'">' + arrJobtypeJson[i][2] + '</a>';
                    cname = arrJobtypeJson[i][2];
                } else {
                    htmlDiv += '<a class=\"sonhref\" s="' + arrJobtypeJson[i][1] + '"  href="' + page + qs + (qs == "" ? "?" : "&") + jobclass + '=' + arrJobtypeJson[i][0] + '" onmouseover="this.style.background=\'#99CCFF\'" onmouseout="this.style.background=\'\'">' + arrJobtypeJson[i][2] + '</a>';
                }
            }
        }

        htmlDiv += '</div></div><div class="clear"></div>';
        layer.innerHTML = htmlDiv;
    }
    if (cid != "") {
        $j("#txtHopeJobClass_layer").find(".list").find("a").attr("class", "parenthref").css("display", "none");
        $j("#txtHopeJobClass_layer").find(".list").find("a").attr("s", cid).css("display", "block");
    }
}
//职位导航END


function __getSysCodeFromValue(value, type) {
    value = value.toString();
    var retval = type ? "其他" : "不限";
    var ids = __getSysCodesID(value.substr(0, 2) + "000");
    var names = __getSysCodesName(value.substr(0, 2) + "000");
    for (var i = 0; i < ids.length; i++) {
        if (value == ids[i]) {
            retval = names[i];
            if (type) { if (i != ids.length - 1) retval = retval.replace("以上", ""); }
            break;
        }
    }
    document.write(retval);
}

function __getSysCodeFromValue1(value, type) {
    value = value.toString();
    var retval = type ? "其他" : "不限";
    var ids = __getSysCodesID(value.substr(0, 2) + "000");
    var names = __getSysCodesName(value.substr(0, 2) + "000");
    for (var i = 0; i < ids.length; i++) {
        if (value == ids[i]) {
            retval = names[i];
            if (type) { if (i != ids.length - 1) retval = retval.replace("以上", ""); }
            break;
        }
    }
    return retval;
}
function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    return r != null ? r[2] : "";
}
