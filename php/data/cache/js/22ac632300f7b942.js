(function(a){var b=window.Think;b||a.thinkbox.error("ThinkPHP基础配置没有正确加载！");b.parse_url=function(c){var d=c.match(/^(?:([a-z]+):\/\/)?([\w-]+(?:\.[\w-]+)+)?(?::(\d+))?([\w-\/]+)?(?:\?((?:\w+=[^#&=\/]*)?(?:&\w+=[^#&=\/]*)*))?(?:#([\w-]+))?$/i);d||a.thinkbox.error("url格式不正确！");return{scheme:d[1],host:d[2],port:d[3],path:d[4],query:d[5],fragment:d[6]}};b.parse_str=function(f){var c=f.split("&"),d={},e;for(val in c){e=c[val].split("=");d[e[0]]=e[1]}return d};b.parse_name=function(c,d){if(d){c.replace(/_([a-z])/g,function(f,e){return e.toUpperCase()});c.replace(/[a-z]/,function(e){return e.toUpperCase()})}else{c=c.replace(/[A-Z]/g,function(e){return"_"+e.toLowerCase()});if(0===c.indexOf("_")){c=c.substr(1)}}return c};b.U=function(c,h,g){var f=this.parse_url(c),e=[],i={},d;f.path||a.thinkbox.error("url格式错误！");c=f.path;if(0===c.indexOf("/")){this.MODEL[0]===0&&a.thinkbox.error("该URL模式不支持使用路由!("+c+")");if("/"===c.substr(-1)){c=c.substr(0,c.length-1)}c=("/"===this.DEEP)?c.substr(1):c.substr(1).replace(/\//g,this.DEEP);c="/"+c}else{e=c.split("/");e=[e.pop(),e.pop(),e.pop()].reverse();e[1]||a.thinkbox.error("ThinkPHP.U("+c+")没有指定控制器");if(e[0]){i[this.VAR[0]]=this.MODEL[1]?e[0].toLowerCase():e[0]}i[this.VAR[1]]=this.MODEL[1]?this.parse_name(e[1]):e[1];i[this.VAR[2]]=e[2].toLowerCase();c="?"+a.param(i)}if(typeof h==="string"){h=this.parse_str(h)}else{if(!a.isPlainObject(h)){h={}}}f.query&&a.extend(h,this.parse_str(f.query));if(h){c+="&"+a.param(h)}if(0!==this.MODEL[0]){c=c.replace("?"+(e[0]?this.VAR[0]:this.VAR[1])+"=","/").replace("&"+this.VAR[1]+"=",this.DEEP).replace("&"+this.VAR[2]+"=",this.DEEP).replace(/(\w+=&)|(&?\w+=$)/g,"").replace(/[&=]/g,this.DEEP);if(false!==g){g=g||this.MODEL[2].split("|")[0];if(g){c+="."+g}}}c=this.APP+c;return c};b.setValue=function(d,f){var h=d.substr(0,1),c,e=0,g;if(f===""){return}if("#"===h||"."===h){c=a(d)}else{c=a("[name='"+d+"']")}if(c.eq(0).is(":radio")){c.filter("[value='"+f+"']").each(function(){this.checked=true})}else{if(c.eq(0).is(":checkbox")){if(!a.isArray(f)){g=new Array();g[0]=f}else{g=f}for(e=0,len=g.length;e<len;e++){c.filter("[value='"+g[e]+"']").each(function(){this.checked=true})}}else{c.val(f)}}};b.cookie=function(d,g){d=this.COOKIE_PREFIX+d;if(g===undefined){var c,e=new RegExp("(^| )"+d+"=([^;]*)(;|$)");if(c=document.cookie.match(e)){return unescape(c[2])}else{return null}}else{var f=30;var h=new Date();h.setTime(h.getTime()+f*24*60*60*1000);document.cookie=d+"="+escape(g)+";expires="+h.toGMTString()}}})(jQuery);