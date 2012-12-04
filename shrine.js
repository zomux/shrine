/*Rafa Shrine Core JS*/

//pack:base64
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?'':e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('s d=z(){};d.o="1i+/";d.y=1j 1k(-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,-1,1h,-1,-1,-1,1g,1c,1d,1e,1f,1l,1m,1s,1t,1u,C,-1,-1,-1,-1,-1,-1,-1,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,1r,1q,1b,1o,1p,1v,-1,-1,-1,-1,-1,-1,O,N,S,T,Z,V,U,W,X,Y,P,R,Q,1a,M,1n,1G,1N,1M,1P,1L,1K,1O,1w,1T,1R,-1,-1,-1,-1,-1);d.1Q=z(b){s a,i,e;s g,h,f;e=b.A;i=0;a="";t(i<e){g=b.j(i++)&x;m(i==e){a+=d.o.l(g>>2);a+=d.o.l((g&F)<<4);a+="==";q}h=b.j(i++);m(i==e){a+=d.o.l(g>>2);a+=d.o.l(((g&F)<<4)|((h&J)>>4));a+=d.o.l((h&H)<<2);a+="=";q}f=b.j(i++);a+=d.o.l(g>>2);a+=d.o.l(((g&F)<<4)|((h&J)>>4));a+=d.o.l(((h&H)<<2)|((f&I)>>6));a+=d.o.l(f&u)}v a};d.1S=z(b){s g,h,f,r;s i,e,a;e=b.A;i=0;a="";t(i<e){B{g=d.y[b.j(i++)&x]}t(i<e&&g==-1);m(g==-1)q;B{h=d.y[b.j(i++)&x]}t(i<e&&h==-1);m(h==-1)q;a+=n.p((g<<2)|((h&1I)>>4));B{f=b.j(i++)&x;m(f==C)v a;f=d.y[f]}t(i<e&&f==-1);m(f==-1)q;a+=n.p(((h&1B)<<4)|((f&1A)>>2));B{r=b.j(i++)&x;m(r==C)v a;r=d.y[r]}t(i<e&&r==-1);m(r==-1)q;a+=n.p(((f&1J)<<6)|r)}v a};d.1x=z(b){s a,i,e,c;a="";e=b.A;1y(i=0;i<e;i++){c=b.j(i);m((c>=1C)&&(c<=1D)){a+=b.l(i)}G m(c>1H){a+=n.p(1F|((c>>12)&L));a+=n.p(E|((c>>6)&u));a+=n.p(E|((c>>0)&u))}G{a+=n.p(I|((c>>6)&K));a+=n.p(E|((c>>0)&u))}}v a};d.1z=z(b){s a,i,e,c;s w,D;a="";e=b.A;i=0;t(i<e){c=b.j(i++);1E(c>>4){k 0:k 1:k 2:k 3:k 4:k 5:k 6:k 7:a+=b.l(i-1);q;k 12:k 13:w=b.j(i++);a+=n.p(((c&K)<<6)|(w&u));q;k 14:w=b.j(i++);D=b.j(i++);a+=n.p(((c&L)<<12)|((w&u)<<6)|((D&u)<<0));q}}v a};',62,118,'||||||||||out|str||Base64|len|c3|c1|c2||charCodeAt|case|charAt|if|String|encodeChars|fromCharCode|break|c4|var|while|0x3F|return|char2|0xff|decodeChars|function|length|do|61|char3|0x80|0x3|else|0xF|0xC0|0xF0|0x1F|0x0F|40|27|26|36|38|37|28|29|32|31|33|34|35|30|||||||||||39|22|52|53|54|55|63|62|ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789|new|Array|56|57|41|23|24|21|20|58|59|60|25|49|utf16to8|for|utf8to16|0x3C|0XF|0x0001|0x007F|switch|0xE0|42|0x07FF|0x30|0x03|47|46|44|43|48|45|encode|51|decode|50'.split('|'),0,{}))

//pack:JSON
if(!this.JSON){JSON=function(){function f(n){return n<10?'0'+n:n;}
Date.prototype.toJSON=function(key){return this.getUTCFullYear()+'-'+
f(this.getUTCMonth()+1)+'-'+
f(this.getUTCDate())+'T'+
f(this.getUTCHours())+':'+
f(this.getUTCMinutes())+':'+
f(this.getUTCSeconds())+'Z';};String.prototype.toJSON=Number.prototype.toJSON=Boolean.prototype.toJSON=function(key){return this.valueOf();};var cx=/[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,escapeable=/[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,gap,indent,meta={'\b':'\\b','\t':'\\t','\n':'\\n','\f':'\\f','\r':'\\r','"':'\\"','\\':'\\\\'},rep;function quote(string){escapeable.lastIndex=0;return escapeable.test(string)?'"'+string.replace(escapeable,function(a){var c=meta[a];if(typeof c==='string'){return c;}
return'\\u'+('0000'+
(+(a.charCodeAt(0))).toString(16)).slice(-4);})+'"':'"'+string+'"';}
function str(key,holder){var i,k,v,length,mind=gap,partial,value=holder[key];if(value&&typeof value==='object'&&typeof value.toJSON==='function'){value=value.toJSON(key);}
if(typeof rep==='function'){value=rep.call(holder,key,value);}
switch(typeof(value)){case'string':return quote(escape(value));case'number':return isFinite(value)?String(value):'null';case'boolean':case'null':return String(value);case'object':if(!value){return'null';}
gap+=indent;partial=[];if(typeof(value.length)==='number' && !(value.propertyIsEnumerable('length')) ){length=value.length;for(i=0;i<length;i+=1){partial[i]=str(i,value)||'null';}
v=partial.length===0?'[]':gap?'[\n'+gap+
partial.join(',\n'+gap)+'\n'+
mind+']':'['+partial.join(',')+']';gap=mind;return v;}
if(rep&&typeof rep==='object'){length=rep.length;for(i=0;i<length;i+=1){k=rep[i];if(typeof k==='string'){v=str(k,value);if(v){partial.push(quote(k)+(gap?': ':':')+v);}}}}else{for(k in value){if(Object.hasOwnProperty.call(value,k)){v=str(k,value);if(v){partial.push(quote(k)+(gap?': ':':')+v);}}}}
v=partial.length===0?'{}':gap?'{\n'+gap+partial.join(',\n'+gap)+'\n'+
mind+'}':'{'+partial.join(',')+'}';gap=mind;return v;}}
return{stringify:function(value,replacer,space){var i;gap='';indent='';if(typeof space==='number'){for(i=0;i<space;i+=1){indent+=' ';}}else if(typeof space==='string'){indent=space;}
rep=replacer;if(replacer&&typeof replacer!=='function'&&(typeof replacer!=='object'||typeof replacer.length!=='number')){throw new Error('JSON.stringify');}
return str('',{'':value});},parse:function(text,reviver){var j;function walk(holder,key){var k,v,value=holder[key];if(value&&typeof value==='object'){for(k in value){if(Object.hasOwnProperty.call(value,k)){v=walk(value,k);if(v!==undefined){value[k]=v;}else{delete value[k];}}}}
return reviver.call(holder,key,value);}
cx.lastIndex=0;if(cx.test(text)){text=text.replace(cx,function(a){return'\\u'+('0000'+
(+(a.charCodeAt(0))).toString(16)).slice(-4);});}
if(/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g,'@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g,']').replace(/(?:^|:|,)(?:\s*\[)+/g,''))){j=eval('('+text+')');return typeof reviver==='function'?walk({'':j},''):j;}
throw new SyntaxError('JSON.parse');}};}();}
//pack: cookie_set/cookie_get
cookie_set=function(name,value,expires,path,domain,secure){var strCookie=name+"="+value;if(expires){var curTime=new Date();curTime.setTime(curTime.getTime()+expires*24*60*60*1000);strCookie+=";   expires="+curTime.toGMTString()}strCookie+=(path)?";   path="+path:"";strCookie+=(domain)?";   domain="+domain:"";strCookie+=(secure)?";   secure":"";document.cookie=strCookie};cookie_get=function(name){var strCookies=document.cookie;var cookieName=name+"=";var valueBegin,valueEnd,value;valueBegin=strCookies.indexOf(cookieName);if(valueBegin==-1)return null;valueEnd=strCookies.indexOf(";",valueBegin);if(valueEnd==-1)valueEnd=strCookies.length;value=strCookies.substring(valueBegin+cookieName.length,valueEnd);return value};
//basic library
if(typeof(screen)=='undefined') screen={};
in_array=function(needle,haystack){
	for(var i=0;i<haystack.length;i++){ if(haystack[i]==needle) return true; }
	return false;
};
_fd=function(n){
	n=n.toString();
	if( n.length < 2 ) n='0'+n;
	return n;
};
_loadsfx=function(){
	var d=new Date();
	return d.getDate()+_fd(d.getHours())+_fd(d.getMinutes())+''+_fd(d.getSeconds());
};
_str_to_under=function(sz){
	str=str.replaceAll('.','_');
	str=str.replaceAll('/','_');
	str=str.replaceAll('\\','_');
	str=str.replaceAll('?','_');
	str=str.replaceAll('=','_');
	str=str.replaceAll('&','_');
	str=str.replaceAll('-','_');
	str=str.replaceAll(':','_');
	return str;
};
_none=function(e){
	if(typeof(e)=='undefined' || e==null) return true;
	else return false;
};
_clone=function(o){
	var n = new Object();
	for(var e in o){
		n[e] = o[e];
	}
	return n;
};
_file_extname=function(f){
	if(typeof(f)!='string') return '';
	var x=f.lastIndexOf('.');
	return f.substr(x+1,f.length-x-1).toLowerCase();
};
_event=function(){
	if(document.all) return window.event;
	var o = arguments.callee.caller; 
	var e; 
	while(o != null){
		  e = o.arguments[0]; 
	if(e && (e.constructor == Event || e.constructor == MouseEvent)) return e; 
		  o = o.caller; 
	} 
	return null; 
};
Function.prototype.attach=function(func){
        var f=this;
        return function(){
	        f();
	        func();
        };
};
_dump=function(x){
	var s='';
	for(var k in x){
		s+='['+k+'] => '+x[k]+'\r\n';
	}
	alert(s);
};


_hash_to_string=function(hash){
	if(hash===null) hash={};
	var sz=Base64.encode(escape(JSON.stringify(hash)));
	return sz.replaceAll('+','*').replaceAll('/','-').replaceAll('=','!');
};
_hash_from_string=function(str){
	var ret=null;
	str=str.replaceAll('!','=').replaceAll('-','/').replaceAll('*','+');
	str=unescape(Base64.decode(str));
	try{
		eval('ret='+str+';');
	}catch(e){
		return null;
	}
	return ret;
};
_hash_count=function(hash){
	var i=0;for(var k in hash){i++;} return i;
};
_get_opacity=function(e){
	if(typeof(document.all)!='undefined') return (typeof(e.filters.alpha)!='undefined' && typeof(e.filters.alpha.opacity))?e.filters['alpha'].opacity/100:1.0;
	if(typeof(e.style.opacity)!='undefined') return e.style.opacity;
	return 1.0;
};
_set_opacity=function(e,opa){
	if(typeof(document.all)!='undefined') e.style.filter='alpha(opacity ='+opa*100+')'; 
	else e.style.opacity=opa;
};
String.prototype.replaceAll = function(sz,rep){
	 var result = this;
     var index = result.indexOf(sz);
     while(index != -1){
             result = result.replace(sz,rep);
             index = result.indexOf(sz);
     }
     return typeof(result)=='string'? result:result.toString();
    
};
String.prototype.trim = function() { return this.replace(/(^\s*)|(\s*$)/g, ""); };
_absx=function(e){
	var   x=e.offsetLeft;
    while(e=e.offsetParent){ 
       x+=e.offsetLeft;
    } 
    return x;
};
_absy=function(e){
	var   y=e.offsetTop;   
    while(e=e.offsetParent){  
       y+=e.offsetTop;
    } 
    return y;
};
$E=function(id){
	if(typeof(id)=='string') return document.getElementById(id);
	else return id;
};
strval=function(num){
	return num.toString();
};
intval=function(str){
	return parseInt(str);
};
_fixrect=function(o){
	var ret={width:null,height:null,x:null,y:null};
	if( typeof(o)=='object' ){
		if(typeof(o.width)!='undefined') ret.width=o.width;	
		if(typeof(o.height)!='undefined') ret.height=o.height;
		if(typeof(o.x)!='undefined') ret.x=o.x;
		if(typeof(o.y)!='undefined') ret.y=o.y;
	}
	return ret;
};
_fixpos=function(o){
	var ret={x:null,y:null,top:null,left:null,right:null,bottom:null};
	if( typeof(o)=='object' ){
		if(typeof(o.x)!='undefined') ret.x=o.x;
		if(typeof(o.y)!='undefined') ret.y=o.y;
		if(typeof(o.top)!='undefined') ret.top=o.top;
		if(typeof(o.left)!='undefined') ret.left=o.left;
		if(typeof(o.right)!='undefined') ret.right=o.right;
		if(typeof(o.bottom)!='undefined') ret.bottom=o.bottom;
		if(ret.top===null) ret.top=ret.y;
		if(ret.left===null) ret.left=ret.x;
	}
	return ret;
};
_fixsize=function(o){
	var ret={width:null,height:null};
	if( typeof(o)=='object' ){
		if(typeof(o.width)!='undefined') ret.width=o.width;	
		if(typeof(o.height)!='undefined') ret.height=o.height;
	}
	return ret;
};
_fixdock=function(o){
	var ret={parent:null,method:null,side:''};
	if( typeof(o)=='object' ){
		if(typeof(o.parent)!='undefined') ret.parent=o.parent;	
		if(typeof(o.method)!='undefined') ret.method=o.method;
		if(typeof(o.side)=='string') ret.side=o.side;	
	}
	return ret;
};
// object : shrine
shrine={
	m_shrine:true,
	m_address:'/shrine/',
	iTopZ:5,
	idUnique:1,
	idFocus:null,
	listProcess:{},
	listMark:{},
	listView:{},
	listMutex:{},
	plugPending:[],
	listPlugin:{},
	listCtrl:{},
	listStyle:{},
	scriptCallbacks:{},
	_sfx:null,
	container:null,
	drag_element:null,
	registerMark:function(mark,id){
		shrine.listMark[mark]=id;
		return true;
	},
	getMark:function(mark){
		var id=typeof(shrine.listMark[mark])=='undefined'?null:shrine.listMark[mark];
		if(_view.exists(id)) return id;
		return null;
	},
	pluginLoad:function(plug,callback){
		var addr=shrine.m_address+'plugin.php?p='+plug+'&addr='+shrine.m_address;
		if(typeof(callback)!='function') callback=null;
		shrine.controllerLoad(addr,callback);
	},
	pluginRegister:function(plug){
		if(typeof(shrine.listPlugin[plug])=='undefined') shrine.listPlugin[plug]=true;
		shrine.refreshPlugins();
	},
	pluginRefresh:function(){
		for(var i=0;i<shrine.plugPending.length;i++){
			var arPlugs=shrine.plugPending[i][0].split(',');
			var bAllPlugs=true;
			for(var j=0;j<arPlugs.length;j++) if(typeof(shrine.listPlugin[arPlugs[j]])=='undefined') {
				bAllPlugs=false;
				break;
			}
			if(bAllPlugs && typeof(shrine.plugPending[i][1])=='function'){
				shrine.plugPending.splice(i,1);
				i--;
			}
		}
	},
	pluginExists:function(plug){
		var arPlugs=plug.split(',');
		for(var i=0;i<arPlugs.length;i++){
			if(typeof(shrine.listPlugin[arPlugs[i]])=='undefined' || !shrine.listPlugin[arPlugs[i]]) return false;
		}
		return true;
	},
	styleExists:function(sz){
		for(var k in shrine.listStyle){
			if(shrine.listStyle[k]==sz) return k;
		}
		return false;
	},
	styleLoad:function(sz){
		var id=shrine.styleExists(sz);
		if(id) return id;
		id=shrine.getUniqueId();
		var css=document.createElement('link');
		css.rel='stylesheet';
		css.type='text/css';
		css.href=sz;
		css.id='SHR_CSS_'+id;
		document.getElementsByTagName('head')[0].appendChild(css);
		shrine.listStyle[id]=sz;
		return id;
	},
	styleRemove:function(id){
		if(id in shrine.listStyle){
			delete shrine.listStyle[id];
			if($E('SHR_CSS_'+id)) document.getElementsByTagName('head')[0].removeChild($E('SHR_CSS_'+id));
			return true;
		}
		return false;
	},
	controllerExists:function(sz){
		for(var k in shrine.listCtrl){
			if(shrine.listCtrl[k]==sz) return k;
		}
		return false;
	},
	controllerLoad:function(sz,callback){
		var id=shrine.controllerExists(sz);
		if(id){
			if(typeof(callback)=='function') callback();
			return id;
		}
		id=shrine.getUniqueId();
		var script=document.createElement('script');
		script.src=sz;
		script.defer='defer';
		script.id='SHR_JS_'+id;
		document.getElementsByTagName('head')[0].appendChild(script);
		shrine.listCtrl[id]=sz;
		if(typeof(callback)=='function'){
			 if(script.addEventListener){
				script.addEventListener("load", callback, false);  
			 }else if(script.attachEvent){
				shrine.scriptCallbacks[id]=callback;
				eval('script.attachEvent("onreadystatechange",function(){if(window.event.srcElement.readyState == "loaded"){shrine.scriptCallbacks['+id+']();}});'); 
			 }
		}
		return id;
	},
	controllerRemove:function(id){
		if(id in shrine.listCtrl){
			delete shrine.listCtrl[id];
			if($E('SHR_CSS_'+id)) document.getElementsByTagName('head')[0].removeChild($E('SHR_JS_'+id));
			return true;
		}
		return false;
	},
	getTopZ:function(){
		return Shrine.iTopZ++;
	},
	getUniqueId:function(){
		return shrine.idUnique++;
	},
	registerProcess:function(id,p){
		if(typeof(p)!='object') return false;
		shrine.listProcess[id]=p;
		eval('__proc_'+id+'=p;');
		return true;
	},
	deleteProcess:function(id){
		if( typeof(shrine.listProcess[id])!='undefined' ) delete shrine.listProcess[id];
		return true;
	},
	registerView:function(id,v){
		if(typeof(v)!='object') return false;
		shrine.listView[id]=v;
		eval('__view_'+id+'=v;');
		return true;
	},
	deleteView:function(id){
		if( typeof(shrine.listView[id])!='undefined' ) delete shrine.listView[id];
		return true;
	},
	terminalProcess:function(pid){
		if( typeof(shrine.listProcess[pid])!='undefined' ){
			//TERMINAL VIEWS
			var p=shrine.listProcess[pid];
			for(var i=0;i<p.m_views;i++){
				shrine.terminateView(p.m_views.m_id);
			}
			eval('__proc_'+pid+'=null;');
			delete shrine.listProcess[pid];
		}
	},
	terminateView:function(vid){
		if( typeof(shrine.listView[vid])!='undefined' ){
			var v=_view.get(vid);
			if(v.m_controller) shrine.controllerRemove(v.m_controller);
			//for(var k in v.m_styles) shrine.styleRemove(k);
			if($E('__container_'+vid)) $E('__container_'+vid).parentNode.removeChild($E('__container_'+vid));
			eval('__view_'+vid+'=null;');
			delete shrine.listView[vid];
		}
	},
	getAppList:function(app){
		var ret=[];
		for(var k in shrine.listProcess){
			if( typeof(shrine.listProcess[k])=='object' && shrine.listProcess[k].m_app==app ) 
				ret.push(shrine.listProcess[k]);
		}
		return ret;
	},
	getProcess:function(pid){
		if( typeof(shrine.listProcess[pid])!='undefined' ) return eval('__proc_'+pid);
		else return null;
	},
	getView:function(vid){
		if( typeof(shrine.listView[vid])!='undefined' ) return eval('__view_'+vid);
		else return null;
	},
	msgHandler:function(msg,param){
		switch(msg){
			
		}
	},
	launch:function(app,param,cb,pid){
		if(typeof(app)!='string') return false;
		if(typeof(cb)!='function') cb=null;
		if(typeof(param)!='object') param=null;
		if(typeof(pid)=='undefined') pid=null;
		if(!shrine.container || ( typeof(SHRINE_APP_LOCK)!='undefined' && SHRINE_APP_LOCK )){
			SHRINE_APP_LOCK=false;
			return _query_launch(pid,app,param,cb,false);
		}else{
			shrine.container.command('launch',app);
		}
	},
	cb_launch:function(vid,cb){
		if(cb){
			cb(vid);
		}
		return true;
	},
	send:function(id,msg,param){
		if(typeof(param)=='undefined') param=null;
		if(!isNaN(id)) id=parseInt(id);
		if(typeof(id)=='string'){
			id=shrine.getMark(id);
			if(!id) return false;
		}
		if(typeof(id)=='object' && typeof(id.m_shrine)!='undefined'){
			shrine.msgHandler(msg,param);
			for(var k in shrine.listProcess){
				return shrine.listProcess[k].msgHandler(msg,param);
			}
		}else{
			if(typeof(shrine.listProcess[id])!='undefined') return shrine.listProcess[id].msgCallback(msg,param);
			else if(typeof(shrine.listView[id])!='undefined') return shrine.listView[id].msgCallback(msg,param);
		}
	},
	call:function(){
		
	},
	callService:function(id,target,param){
		var v=_view.get(id);
		if(!v) return null;
		if(typeof(target)!='string') return null;
		if(arguments.length>3){
			var p=[];
			for(var i=2;i<arguments.length;i++){
				var e=arguments[i];
				if(typeof(e)!='function') p.push(e);
			}
			var f=arguments[arguments.length-1];
			if(typeof(f)=='function') var cb=f;
			else var cb=null;
			param=p;
		}else{
			if(typeof(param)=='undefined') param=null;
			var cb=(typeof(param)=='object' && param && typeof(param.callback)=='function')? param.callback:null;
			if(cb) delete param.callback;
		}
		return _query_service(id,target,param,cb, v.m_address);
	},
	callStatus:function(){
		
	}
	
};
_process={
	create:function(){
		var id=shrine.getUniqueId();
		return id;
	},
	exists:function(pid){
		return typeof(shrine.listProcess[pid]!='undefined');
	},
	close:function(pid){
		shrine.send(pid,'close');
	},
	terminate:function(pid){
		return shrine.terminalProcess(pid);
	},
	setMark:function(id,mark){
		shrine.send(id,'mark',mark);
	},
	getMark:function(id){
		return _view.exists(id)?_view.get(id).m_mark:null;
	},
	getInstance:function(id){
		return shrine.getProcess(id);
	}
};
_process.get=_process.getInstance;
_view={
	create:function(title,rect,content){
		rect=_fixrect(rect);
		var id=shrine.getUniqueId();
		if( typeof(document_state)=='string' && document_state=='loading' && 1==2){
			document.write('<div style="position:relative;" id="__container_'+id+'" _vid="'+id+'" onmousedown="_view.focus(this.getAttribute(\'_vid\'));"></div>');
		}else{
			var div=document.createElement('div');
			if(typeof(title)=='undefined' || !title) title='';
			div.id='__container_'+id;
			div.style.position='relative';
			div.setAttribute('_vid',id);
			div.onmousedown=function(){
				_view.focus(this.getAttribute('_vid'));	
			};
			document.body.appendChild(div);
		}
		_view.setTitle(id,title);
		if(typeof(content)!='undefined') _view.setContent(id,content);
		_view.setRect(id,rect);
		_view.focus(id);
		return id;
	},
	getInstance:function(id){
		if($E('__container_'+id)) return eval('__view_'+id);
		else return null;
	},
	
	setContent:function(id,content){
		shrine.send(id,'set_content',content);
	},
	exists:function(id){
		return $E('__container_'+id);
	},
	close:function(id){
		shrine.send(id,'close');
	},
	terminate:function(id){
		return shrine.terminateView(id);
	},
	display:function(id,dis){
		if(typeof(id)!='undefined' && typeof(dis)!='undefined') return;
		shrine.send(id,'display',dis);
	},
	getDisplay:function(id){
		return _view.exists(id)?_view.get(id).m_display:null;
	},
	setPos:function(id,pos){
		pos=_fixpos(pos);
		shrine.send(id,'move',pos);
	},
	getPos:function(id){
		return _view.exists(id)?_view.get(id).m_display:null;
	},
	setSize:function(id,size){
		size=_fixsize(size);
		shrine.send(id,'resize',size);
	},
	setDragger:function(id,e){
		shrine.send(id,'set_dragger',e);
	},
	getSize:function(id){
		return _view.exists(id)?_view.get(id).m_size:null;
	},
	
	setRect:function(id,rect){
		rect=_fixrect(rect);
		_view.move(id,rect);
		_view.resize(id,rect);
	},
	getRect:function(){
		
	},
	getContainer:function(id){
		return _view.get(id).m_container;
	},
	getLayer:function(id){
		return $E('__container_'+id);
	},
	setTitle:function(id,tit){
		shrine.send(id,'set_title',tit);
	},
	getTitle:function(id){
		return _view.exists(id)?_view.get(id).m_title:null;
	},
	setMark:function(id,mark){
		shrine.send(id,'mark',mark);
	},
	getMark:function(id){
		return _view.exists(id)?_view.get(id).m_mark:null;
	},
	setFocus:function(id){
		shrine.send(id,'focus');
	},
	getFocus:function(id){
		return shrine.idFocus==id;
	},
	
	setDock:function(id,dock){
		dock=_fixdock(dock);
		shrine.send(id,'dock',dock);
	},
	getDock:function(id){
		return _view.exists(id)?_view.get(id).m_dock:null;
	},
	setParent:function(id,parent){
		shrine.send(id,'set_parent',parent);
	},
	getParent:function(){
		return _view.exists(id)?_view.get(id).m_parent:null;
	},
	setSkin:function(id,skin){
		shrine.send(id,'set_skin',skin);
	},
	getSkin:function(){
		return _view.exists(id)?_view.get(id).m_skin:null;
	},
	clear:function(id){
		shrine.send(id,'clear');
	},
	write:function(id,data){
		shrine.send(id,'write',data);
	},
	setConrtoller:function(id,ctrl){
		
	},
	loadStyle:function(id,sz){
		
	},
	removeStyle:function(id,styleid){
		
	},
	clearStyle:function(){
		
	}
	
};
_view.get=_view.getInstance;
_view.focus=_view.setFocus;
_view.mark=_view.setMark;
_view.move=_view.setPos;
_view.resize=_view.setSize;
_view.show=_view.display;

function Process(app,addr,idForce){
	this.m_address=null;
	this.m_plugins=[];
	if( typeof(idForce)=='number' ) this.m_id=idForce;
	else this.m_id=_process.create();
	this.id=this.m_id;
	this.m_app=null;
	this.m_views={};
	this.handler={};
	if(typeof(app)=='string') this.m_app=app;
	if(typeof(addr)=='string') this.m_address=addr;
	shrine.registerProcess(this.m_id,this);
	this.addView=function(id){
		if(typeof(this.m_views[id])=='undefined' && _view.exists(id)){
			this.m_views[id]=_view.get(id);
			return true;
		}else return false;
	};
	this.removeView=function(id){
		if(typeof(this.m_views[id])!='undefined' ){
			delete this.m_views[id];
			return true;
		}else return false;
	};
	this.msgCallback=function (msg,p){
		if(typeof(p)=='undefined') p=null;
		var ret=true;
		if(typeof(this.handler[msg])=='function'){
			ret=this.handler[msg](p);
		}
		if(typeof(ret)=='undefined' || ret==true) ret=this.msgHandler(msg,p);
		if(typeof(ret)=='undefined' || ret==true){
			for(var k in this.m_views){
				this.m_views[k].msgCallback(msg,p);
			}
		}
	};
	this.msgHandler=function (msg,p){
		switch(msg){
			
		}
		return true;
	};
};
function View(proc,rect,title,content,idForce){
	if(typeof(proc)!='undefined' && _process.exists(proc)) this.m_process=_process.get(proc);
	else return false;
	this.m_parent=null;
	this.m_address=null;
	this.m_app='';
	this.m_title=typeof(title)=='string'? title:'';
	this.m_lock=false;
	this._initp=null;
	this.m_controller=null;
	this.m_plugins=null;
	this.m_skin=null;
	this.m_styles={};
	if( typeof(idForce)=='number' ) this.m_id=idForce;
	else this.m_id=_view.create();
	this.id=this.m_id;
	this.m_layer=$E('__container_'+this.m_id);
	this.m_dock={method:'float',parent:null,side:null};
	this.m_name=null;
	this.m_param={};
	this.m_display=true;
	this.m_pos=typeof(rect)!='undefined' && rect ? _fixpos(rect):{top:null,left:null,right:null,bottom:null,x:null,y:null};
	this.m_size=typeof(rect)!='undefined' && rect ? _fixsize(rect):{width:null,height:null};
	this.m_container=$S('__container_'+this.m_id);
	this.handler={};
	var ps=this.m_process;
	shrine.registerView(this.m_id,this);
	this.m_app=ps.m_app;
	this.m_address=ps.m_address;
	ps.addView(this.m_id);
	this.alert=function(msg,caption,icon,f){
		var h=this.m_hWnd;
		if(typeof(msg)!='string') msg='';
		if(typeof(caption)!='string') caption='Message Box';
		if(typeof(icon)!='string') icon='happy';
		var xmsg=new MessageBox(msg);
		xmsg.icon=icon;
		xmsg.addButton(' O K ',function(){ LockApp(h,false);xmsg.hide();if(typeof(f)=='function') f(); });
		xmsg.show();
		LockApp(this.m_hWnd,xmsg.hWnd);
	};
	this.close=function(){
		shrine.send(this.m_id,'close');
	};
	this.exit=this.close;
	this.mark=function(p){
		shrine.send(this.m_id,'mark',p);
	};
	this.display=function(dis){	_view.display(this.m_id,dis);};
	this.getDisplay=function(){	return _view.getDisplay(this.m_id);};
	this.setPos=function(pos){return _view.setPos(this.m_id,pos);};
	this.getPos=function(){return _view.getPos(this.m_id);};
	this.setSize=function(size){return _view.setSize(this.m_id,size);};
	this.getSize=function(){return _view.getSize(this.m_id);};
	this.setRect=function(rect){return _view.setRect(this.m_id,rect);};
	this.getRect=function(){return _view.getRect(this.m_id);};
	this.getContainer=function(){return _view.getContainer(this.m_id);};
	this.setTitle=function(tit){return _view.setTitle(this.m_id,tit);};
	this.getTitle=function(){return _view.getTitle(this.m_id);};
	this.setMark=function(mark){return _view.setMark(this.m_id,mark); };
	this.getMark=function(){return _view.getMark(this.m_id);};
	this.setFocus=function(){return _view.setFocus(this.m_id);};
	this.getFocus=function(){return _view.getFocus(this.m_id);};
	this.setDock=function(dock){return _view.setDock(this.m_id,dock);};
	this.getDock=function(){return _view.getDock(this.m_id);};
	this.setParent=function(parent){return _view.setParent(this.m_id,parent);};
	this.getParent=function(){return _view.getParent(this.m_id);};
	this.setSkin=function(skin){return _view.setSkin(this.m_id,skin);};
	this.getSkin=function(){return _view.getSkin(this.m_id);};
	this.setDragger=function(e){return _view.setDragger(this.m_id,e);};
	this.setContent=function(content){return _view.setContent(this.m_id,content);};
	this.clear=function(){return _view.clear(this.m_id);};
	this.write=function(data){return _view.write(this.m_id,data);};
	this.focus=this.setFocus;
	this.dock=this.setDock;
	this.move=this.setPos;
	this.resize=this.setSize;
	this.show=this.display;
	this.quickMove=function(left,top){
		if(top!==null){
			$E('__container_'+this.m_id).style.top=top+'px';
			this.m_pos.top=top;
		}
		if(left!==null){
			$E('__container_'+this.m_id).style.left=left+'px';
			this.m_pos.left=left;
		}
	}
	this.bindMsgProc=function(msg,callback){
		if(typeof(callback)=='function'){
			this.handler[msg]=callback;
		}
	};
	this.msgCallback=function (msg,p){
		if(typeof(p)=='undefined') p=null;
		var ret=true;
		if(typeof(this.handler[msg])=='function'){
			ret=this.handler[msg](p);
		}
		if(typeof(ret)=='undefined' || ret==true) this.msgHandler(msg,p);
	};
	this.msgHandler=function (msg,p){
		
		switch(msg){
			case 'exit': 
			case 'close':
				shrine.terminateView(this.m_id);
				if(shrine.container) shrine.container.command('close',null);
				break;
			case 'set_process':
				if(!_process.exists(p)) return false;
				this.m_process=_process.get(p);
				this.m_address=this.m_process.m_address;
				this.m_app=this.m_process.m_app;
				break;
			case 'set_controller':
				if(!p) return;
				var addr=this.m_address? this.m_address:shrine.m_address;
				addr+='controller.php?i='+this.m_id+'&p='+this.m_process.m_id+'&a='+this.m_app+'&t='+p;
				var id=shrine.controllerLoad(addr);
				if(id==this.m_controller) return;
				shrine.controllerRemove(this.m_controller);
				this.m_controller=id;
				break;
			case 'set_dragger':
				if(!p) break;
				p.setAttribute('dragid',this.m_id);
				p.style.cursor='move';
				p.onmousedown=function(){
					var v=_view.get(this.getAttribute('dragid'));
					v.m_origX=_event().clientX;
					v.m_origY=_event().clientY;
					v.m_origLayerX=_absx(v.m_layer);
					v.m_origLayerY=_absy(v.m_layer);
					shrine.drag_element=this;
					this.setAttribute('ondrag',true);
					if(this.setCapture){
						this.setCapture();
					}else if(window.captureEvents){ 
						document.onmousemove=this.onmousemove;
						document.onmouseup=this.onmouseup;
					}
				};
				p.onmousemove=function(){
					if(!shrine.drag_element || !shrine.drag_element.getAttribute('ondrag')) return;
					var v=_view.get(shrine.drag_element.getAttribute('dragid'));
					var x=_event().clientX-v.m_origX+v.m_origLayerX;
					var y=_event().clientY-v.m_origY+v.m_origLayerY;
					v.quickMove(x,y);
					window.getSelection ? window.getSelection().removeAllRanges() : document.selection.empty();
				};
				p.onmouseup=function(){
					if(!shrine.drag_element || !shrine.drag_element.getAttribute('ondrag')) return;
					var v=_view.get(shrine.drag_element.getAttribute('dragid'));
					if(v.m_app){
						cookie_set('shrine_pos_'+v.m_app,_absx(v.m_layer)+','+_absy(v.m_layer));
					}
					shrine.drag_element.setAttribute('ondrag',false);
					if(shrine.drag_element.releaseCapture){
						shrine.drag_element.releaseCapture();
					}else if(window.captureEvents){
						document.onmousemove=null;
						document.onmouseup=null;
					}
					shrine.drag_element=null;
				};
				break;
			case 'set_skin':
				 if(!p){
					 try{ this.m_skin.unload(this.m_id,this.m_container);}catch(e){}
						this.m_skin=null;
						//this.m_container=$S('__container_'+this.m_id);
					 return true;
				 }
				 if(typeof(p)!='string') return false;
				 var ar=p.split(':');
				 if(ar.length>1) var prm=ar[1];
				 else var prm=null;
				 var skin=null;
				 try{
					 eval('skin='+ar[0]);
				 }catch(e){ return false; }
				 if(!skin) return false;
				 if(this.m_skin){
					try{ this.m_skin.unload(this.m_id,this.m_container);}catch(e){}
					this.m_skin=null;
				 }
				 this.m_skin=skin;
				 try{ this.m_skin.load(this.m_id,this.m_container,prm); }catch(e){}
				 return true;
				break;
			case 'set_style':
				for(var k in this.m_style){
					shrine.styleRemove(k);
					delete this.m_styles[k];
				}
			case 'load_style':
				if(!p) return;
				var ar=p.split(',');
				var addr=this.m_address? this.m_address:shrine.m_address;
				addr+='style.php?a='+this.m_app+'&t=';
				for(var k in ar){
					var sz=ar[k];
					if(sz.substr(0,7)=='http://'){
						var url=sz;
					}else{
						var url=addr+sz;
					}
					var id=shrine.styleLoad(url);
					this.m_styles[id]=url;
				}
				
				break;
			case 'clear_style':
				for(var k in this.m_style){
					shrine.styleRemove(k);
					delete this.m_styles[k];
				}
			case 'set_title':
				if(typeof(p)!='string') return;
				this.m_title=p;
				if(shrine.container) shrine.container.command('set_title',p);
				break;
			case 'set_parent':
				if(typeof(p)=='undefined') return;
				if(!p) return;
				if( typeof(p.nodeName)=='string' && p!=this.m_container.parentNode ){
					this.m_container.parentNode.removeChild(this.m_container);
					p.appendChild(this.m_container);
					this.m_parent=p;
				}
				break;
			case 'set_content':
				this.m_container.innerHTML='';
				try{
					if(typeof(p)=='object'){
						this.m_container.appendChild(p);
					}else if(typeof(p)=='string'){
						this.m_container.innerHTML+=p;
					}
					_constructor.setToApp(this.m_container,this.m_id,this.m_app,true);
				}catch(e){
					
				}
				break;
			case 'display':
				if(typeof(p)=='undefined' || p==null) p=true ;
				this.m_display=p;
				this.m_container.style.display=p?'block':'none';
			case 'dock':
				if(typeof(p)=='undefined') return ;
				p=_fixdock(p);
				if(!(p.method in {'fill':null,'float':null,'child':null,'stick':null} )) return ;
				switch(p.method){
					case 'fill':
						this.m_layer.style.position='relative';
						this.m_layer.style.width='100%';
						this.m_layer.style.height='100%';
						
						break;
					case 'child':
						this.m_layer.style.position='relative';
						this.m_layer.style.width='';
						this.m_layer.style.height='';
						
						break;
					case 'float':
					case 'stick': 
						if(p.method=='float') this.m_layer.style.position='absolute';
						else this.m_layer.style.position='fixed';
						var arSide=p.side.split(',');
						for(var i=0;i<arSide.length;i++){
							switch(arSide[i]){
							case 'left':
								this.m_layer.style.left='0px';
								break;
							case 'right':
								this.m_layer.style.right='0px';
								break;
							case 'top':
								this.m_layer.style.top='0px';
								break;
							case 'bottom':
								this.m_layer.style.bottom='0px';
								break;
							case 'center':
								if(this.m_app && cookie_get('shrine_pos_'+this.m_app)){
									var szPos=cookie_get('shrine_pos_'+this.m_app);
									var ar=szPos.split(',');
									this.m_layer.style.top=isNaN(ar[1])? '100px':ar[1]+'px';
									this.m_layer.style.left=isNaN(ar[0])? '100px':ar[0]+'px';
								}else{
									this.m_layer.style.top='100px';
									this.m_layer.style.left='100px';
								}
								break;
							}
						}
						break;
						
				}
				this.m_dock=p;
			case 'move':
				if(typeof(p)=='undefined') return ;
				p=_fixsize(p);
				try{
					if(!isNaN(p.top)){
						$E('__container_'+this.m_id).style.top=p.top+'px';
						this.m_pos.top=p.top;
						if(shrine.container) shrine.container.command('move',{top:p.top});
					}
					if(!isNaN(p.left)){
						$E('__container_'+this.m_id).style.left=p.left+'px';
						this.m_pos.left=p.left;
						if(shrine.container) shrine.container.command('move',{left:p.left});
					}
					if(!isNaN(p.right)){
						$E('__container_'+this.m_id).style.right=p.right+'px';
						this.m_pos.right=p.right;
						if(shrine.container) shrine.container.command('move',{right:p.right});
					}
					if(!isNaN(p.bottom)){
						$E('__container_'+this.m_id).style.bottom=p.bottom+'px';
						this.m_pos.bottom=p.bottom;
						if(shrine.container) shrine.container.command('move',{bottom:p.bottom});
					}
				}catch(e){}
				
				break;
			case 'resize':
				if(typeof(p)=='undefined') return ;
				p=_fixsize(p);
				try{
					if(p.width){
						this.m_container.style.width=isNaN(p.width) ? p.width:p.width+'px';
						this.m_size.width=p.width;
						if(shrine.container) shrine.container.command('resize',{width:p.width});
					}
					if(p.height){
						this.m_container.style.height=isNaN(p.height) ? p.height:p.height+'px';
						this.m_size.height=p.height;
						if(shrine.container) shrine.container.command('resize',{height:p.height});
					}
				}catch(e){}
				
				break;
			case 'lock':
				if(p!==false) p=true;
				if(this.m_skin){
					if(p){ 
						try{ this.m_skin.lock(this.m_id,this.m_container); }catch(e){} 
					}else{
						try{ this.m_skin.unlock(this.m_id,this.m_container); }catch(e){}
					}
					return true;
				}else{
					//default lock code
				}
			case 'clear':
				this.m_container.innerHTML='';
			case 'write':
				try{
					if(typeof(p)=='object'){
						this.m_container.appendChild(p);
					}else if(typeof(p)=='string'){
						this.m_container.innerHTML+=p;
					}
					_constructor.setToApp(this.m_container,this.m_id,this.m_app,true);
				}catch(e){
					
				}
				break;
			case 'mark':
				if(typeof(p)!='string') return false;
				shrine.registerMark(p,this.m_id);
				return true;
				break;
			case 'focus': 
				shrine.idFocus=this.m_id;
				shrine.iTopZ++;
				this.m_layer.style.zIndex=shrine.iTopZ;
		}
	};
	if(typeof(content)!='undefined' && content!=null) shrine.send(this.m_id,'set_content',content);
};

//object : constructor
_constructor={
		makeId:function(e,id){
			if(e.getAttribute('skin')) return;
			if(e.getAttribute('_shrine_app')==null){
				e.setAttribute('id',id);
			}else{
				if(typeof(id)!='undefined') var eid=id;
				else if(e.getAttribute('_shrine_id')!=null) var eid=e.getAttribute('_shrine_id');
				else return;
				e.setAttribute('id','__shrine_'+e.getAttribute('_shrine_view')+'_'+eid);
				var arClass=e.className.split(' ');
				for(var i=0;i<arClass.length;i++){
					if(arClass[i].substr(0,10)=='_style_id_') arClass[i]='';
				}
				arClass.push('_style_id_'+e.getAttribute('_shrine_app')+'_'+eid);
				e.setAttribute('class',arClass.join(' '));	
				e.setAttribute('className',arClass.join(' '));	
			}
		},
		makeClass:function(e,classx){
			if(e.getAttribute('skin')) return;
			if(e.getAttribute('_shrine_app')==null){
				if(typeof(classx)!='undefined') e.setAttribute('class',classx);
			}else{
				var fclass='_style_tag_'+e.getAttribute('_shrine_app').replace('.','_')+'_'+e.nodeName.toUpperCase()+' ';
				if(typeof(classx)!='undefined'){ e.setAttribute('_shrine_class',e.getAttribute('_shrine_class')+' '+classx); }
					var aryClass=e.getAttribute('_shrine_class').split(' ');
					for(var i=0;i<aryClass.length;i++){
						if(aryClass[i].length==0) continue;
						if(aryClass[i].substr(0,1)!='@'){
							fclass+=aryClass[i];
							continue;
						}
						fclass+='_style_'+e.getAttribute('_shrine_app').replace('.','_')+'_'+aryClass[i].replace('@','')+' ';
					}

				if(e.getAttribute('_shrine_id')!=null && e.getAttribute('_shrine_id')!='') fclass+=' _style_id_'+e.getAttribute('_shrine_app').replace('.','_')+'_'+e.getAttribute('_shrine_id'); 
				e.className=fclass;
			}
		},
		hasClass:function(e,name){
			var eclass=e.getAttribute('_shrine_app')?e.getAttribute('_shrine_class'):e.className;
			if (!name || !eclass || eclass.search(new RegExp("\\b" + name + "\\b")) == -1)
			return false;
			return true;
		},
		addClass:function(e,classx){
			if(!e) return;
			if(e.getAttribute('_shrine_app')==null){
				var eclass=e.className;
				if(eclass.indexOf(classx+' ')==-1 && eclass.indexOf('_'+classx)==-1 && eclass!=classx){
					e.setAttribute('class',eclass+' '+classx);
				}
			}else{
				var eclass=e.getAttribute('_shrine_class');
				if(eclass.indexOf(classx+' ')==-1 && eclass.indexOf('_'+classx)==-1 && eclass!=classx){
					e.setAttribute('_shrine_class',eclass+' '+classx);
					if (classx.substr(0,1)!='@') {
						e.setAttribute('class',e.className+' '+classx);
					}else{
						e.setAttribute('class',e.className+' '+'_style_'+e.getAttribute('_shrine_app').replace('.','_')+'_'+classx.replace('@',''));
					}
				}
			}
		},
		removeClass:function(e,classx){
			if(!e) return;
			if(e.getAttribute('_shrine_app')==null){
				var eclass=e.className;
				eclass.replace(classx+' ','');
				eclass.replace(' '+classx,'');
				if(eclass==classx) eclass='';
				e.setAttribute('class',eclass);
			}else{
				var eclass=e.getAttribute('_shrine_class');
				if(eclass.indexOf(classx+' ')!=-1 || eclass.indexOf('_'+classx)!=-1 || eclass==classx){
					eclass.replace(classx+' ','');
					eclass.replace(' '+classx,'');
					if(eclass==classx) eclass='';
					e.setAttribute('_shrine_class',eclass);
					var aclass=e.className;
					if(classx.substr(0,1)!='@'){
						var sclass=classx;
					}else{
						var sclass='_style_'+e.getAttribute('_shrine_app')+'_'+classx.replace('@','');
					}	
					aclass.replace(sclass+' ','');
					aclass.replace(' '+sclass,'');
					e.setAttribute('class',aclass);
				}
			}
		},
		setToApp:function(e,vid,app,parent){
			if(!e) return;
			if(typeof(e)=='string') e=$E(e);
			if(e.tagName && !(!e.getAttribute('_shrine_app') && (typeof(e.getAttribute('id'))=='string' && e.getAttribute('id').substr(0,9)=='__shrine_')) && e.getAttribute('_shrine_app')!=app){
			if(e.getAttribute('skin')){
				e.setAttribute('_shrine_app',app);
				e.setAttribute('_shrine_view',vid);
			}
			if((typeof(parent)=='undefined' || parent==false) && !e.getAttribute('skin') ){ 
				e.setAttribute('_shrine_app',app);
				e.setAttribute('_shrine_view',vid);
				if(e.getAttribute('id')!=null && e.getAttribute('id')!='' && e.getAttribute('id').substr(0,9)!='__shrine_'){
					var eid=e.getAttribute('id');
					e.setAttribute('_shrine_id',eid);
					e.setAttribute('id','__shrine_'+e.getAttribute('_shrine_view')+'_'+eid);
				}
				
				if(e.className!=null) e.setAttribute('_shrine_class',e.className);
				else e.setAttribute('_shrine_class','');
				_constructor.makeClass(e);
			}}
			if(e.hasChildNodes()){
				for(var i=0;i<e.childNodes.length;i++) _constructor.setToApp(e.childNodes[i],vid,app);
			}
		},
		setToPage:function(e){
			if(!e) return;
			if(e.getAttribute('_shrine_app')!=null){
				e.removeAttribute('_shrine_app');
				if(e.getAttribute('_shrine_class')!=null) e.setAttribute('class',e.getAttribute('_shrine_class'));
				if(e.getAttribute('_shrine_id')!=null) e.setAttribute('class',e.getAttribute('_shrine_id'));
			}
			if(e.hasChildNodes()){
				for(var i=0;i<e.childNodes.length;i++) _constructor.setToPage(e.childNodes[i]);
			}
		},
		getApp:function(e){
			return e.getAttribute('_shrine_app');
		},
		getView:function(e){
			return e.getAttribute('_shrine_view');
		},
		set:function(e,key,val){
			if(key.toUpperCase()=='APP'){
				if(val==null) _constructor.setToPage(e);
				else _constructor.setToApp(e,val.m_id,val.m_app);
				return;
			}
			if(e.getAttribute('_shrine_app')==null){
				e.setAttribute(key,val);
			}else{ 
				switch(key.toUpperCase()){ 
					case 'ID': _constructor.makeId(e,val);break;
					case 'CLASS': _constructor.makeClass(e,val);break;
					default: e.setAttribute(key,val);
				}
			}
		},
		get:function(e,key){
			if(key.toUpperCase()=='APP'){
				return e.getAttribute('_shrine_app');
			}
			if(e.getAttribute('_shrine_app')==null){
				e.getAttribute(key);
			}else{
				switch(key.toUpperCase()){
					case 'ID': return e.getAttribute('_shrine_id');break;
					case 'CLASS': return e.getAttribute('_shrine_class');break;
					default: return e.getAttribute(key);
				}
			}
		}
};

_query_controller=function(id,app,ctrl,rm){
	if( typeof(rm)=='string' ){
		
	}else{
		var src=shrine.m_address+'controller.php?i='+id+'&a='+app+'&t='+ctrl+'&x='+new Date().getTime().toString().substr(-6,6);
		_call_javascript(src);
	}
};
_query_service=function(id,serv,p,cb, rm){
	if(typeof(cb)=='undefined') cb=null;
	if(p) p=_hash_to_string(p);
	if( typeof(rm)=='string' ){
		if(rm.substr(-1,1)!='/') rm+='/';
		var src=rm+'service.php?r=1&f='+shrine._sfx+'&i='+id+'&a='+view.m_app+'&t='+serv+'&p='+p;
		_call_javascript(src);
		//protocol needed
	}else{
		var v=_view.get(id);
		if(!v || !v.m_app) return null;
		var s='f='+shrine._sfx+'&i='+id+'&a='+v.m_app+'&t='+serv+'&p='+p;
		var vid=id;
		if(typeof(cb)=='function'){
			var func=function(sz){
				_callback_service(sz,vid,cb);
			};
			_query_ajax(shrine.m_address+'service.php',s,func);
			return true;
		}else{
			var ret=_query_ajax(shrine.m_address+'service.php',s,null,true);
			return _callback_service(ret,vid,null);
		}
	}
};
_query_launch=function(pid,app,p,cb,rm){
	if(typeof(cb)=='undefined') cb=null;
	if(typeof(app)=='undefined') return false;
	if(typeof(pid)!='number') pid=null;
	if(typeof(p)!='object') p=null;
	//init
	if(pid==null){
		var ps=new Process(app);
		pid=ps.m_id;
	}
	var v=new View(pid,null,null,null);
	v.m_app=app;
	var vid=v.m_id;
	v.focus();
	var msg='i='+vid+'&a='+app+'&f='+shrine._sfx+'&p='+_hash_to_string(p);
	if( typeof(rm)=='string' ){
		if(rm.substr(-1,1)!='/') rm+='/';
		var src=rm+'service.php?r=1&i='+id+'&a='+view.m_app+'&t='+serv+'&p='+p;
		_call_javascript(src);
		return v;
		//protocol needed
	}else{
		var func=function(sz){
			_callback_launch(sz,vid,cb);
		};
		_query_ajax(shrine.m_address+'launch.php',msg,func);
		return v;
	}
	
};
_callback_analyzer=function(sz){
	//sz=sz.replaceAll('##','[SHRINE_DELI]'); if base64 encoded no need this
	var ar=sz.split('#');
	if(ar.length<2){ alert("App Load Error:\r\n"+sz);return null; };
	if(ar[0]=='1'){
		if(ar.length!=4) return null;
		var cmd=ar[1].replaceAll('[SHRINE_DELI]','#').split(';');
		var prm=ar[2].replaceAll('[SHRINE_DELI]','#');
		var code=ar[3].replace('[SHRINE_DELI]','#');
		return [true,cmd,prm,code];
	}else{
		return [false,ar[1]];
	}
};
_view_command=function(vid,ar){
	for(var k in ar){
		var e=ar[k];
		var l=e.split(':');
		if(l.length>2) continue;
		var p=l.length==2?_hash_from_string(l[1]):null;
		switch(parseInt(l[0])){
			case 1:
				shrine._sfx=p;
				break;
			case 2:
				shrine.send(vid,'write',p);
				break;
			case 3:
				_view.clear(vid);
				break;
			case 4:
				shrine.send(vid,'set_controller',p);
				break;
			case 5:
				shrine.send(vid,'set_style',p);
				break;
			case 6:
				shrine.send(vid,'load_plugin',p);
				break;
			case 7:
				shrine.send(vid,'set_skin',p);
				break;
			case 8:
				shrine.send(vid,'set_title',p);
				break;
		}
	}
};
_callback_launch=function(sz,vid,cb){
	var ar=_callback_analyzer(sz);
	var v=_view.get(vid);
	if(!v) return ;
	if(!ar){ _view.terminate(vid);return ; }
	if(ar[0]){ //suc launch
		v.m_param=_hash_from_string(ar[2]);
		_view_command(vid,ar[1]);
		try{
			eval(_hash_from_string(ar[3]));
		}catch(e){}
		shrine.cb_launch(vid,cb);
	}else{ //fail
		alert('System Error:'+ar[1]);
		shrine.terminateView(v.m_id);
	}
};
_callback_service=function(sz,vid,cb){
	var ar=_callback_analyzer(sz);
	var v=_view.get(vid);
	if(!v) return null;
	if(!ar){ 
		if(typeof(cb)=='function'){
			cb(null);
		}
		return null; 
	}
	if(ar[0]){ //suc launch
		var prm=_hash_from_string(ar[2]);
		_view_command(vid,ar[1]);
		try{
			eval(_hash_from_string(ar[3]));
		}catch(e){}
		if(typeof(cb)=='function'){
			cb(prm);
		}
		return prm;
	}else{ //fail
		alert(ar[1]);
		return null;
	}
	
};
_call_javascript=function(src){
	var script=document.createElement('script');
	script.src=src;
	script.defer='defer';
	document.getElementsByTagName('head')[0].appendChild(script);
};
_query_ajax=function(addr,message,callback,synchronize)//callback: func/dom
{
	var theHttpRequest=getHttpObject(); 
	if(typeof(synchronize)!='undefined' && synchronize==true){
		theHttpRequest.open("POST",addr,false);
		theHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
		theHttpRequest.send(message);
		var result=theHttpRequest.responseText;
		return unescape(result);
	}
	theHttpRequest.onreadystatechange=function ()
	{
		backAJAX();
	}; 
	theHttpRequest.open("POST",addr,true); 
	theHttpRequest.setRequestHeader("Content-Type","application/x-www-form-urlencoded"); 
	theHttpRequest.send(message); 
	return null;
	function getHttpObject()
	{
		var objType=false; 
		
		if(typeof(XMLHttpRequest)!='undefined'){
			objType=new XMLHttpRequest(); 
		}else{
			try{
				objType=new ActiveXObject('Msxml2.XMLHTTP');
			}catch(e){
				objType=new ActiveXObject('Microsoft.XMLHTTP'); 
			}
		}
		return objType; 
	}
	function backAJAX(){
		if(theHttpRequest.readyState==4){
			if(theHttpRequest.status==200){
				if(typeof(callback)=='function') callback(unescape(theHttpRequest.responseText));
				if(typeof(callback)=='string' && $E(callback)) $E(callback).innerHTML=unescape(theHttpRequest.responseText);
			}else{
				//MessageBox(theHttpRequest.statusText,'ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½ï¿?','MB_ERROR'); 
			}
		}
	}
};
_launch=function(a,p,s){ return  ShellExecute(null,a,p,s); };
function ShellExecute(hWnd,app,param,szShowCmd){ //hWnd: null - new Wnd  
	if(!hWnd){ 
		//var ws=new WindowStyle('WHITE');
		hWnd=CreateWindow('Rafa Shrine App',null,'',-1,-1,0,0);
		ShowWindow(hWnd,'SW_HIDE');
	}
	GetWindow(hWnd).m_app=app; 
	if(Shrine._sfh){
		if(typeof(param)!='object' || param==null) param={_s_f_h:Shrine._sfh};
		else param._s_f_h=Shrine._sfh;
	}
	if(typeof(param)=='object') param=HashToString(param); 
	var msg=param?'shrine_hwnd='+hWnd+'&shrine_app='+app+'&'+param:'shrine_hwnd='+hWnd+'&shrine_app='+app;
	var func=function(text){
		CallBackShellExecute(hWnd,text,szShowCmd);
	};
	Query('server-run.php',msg,func);
	return hWnd;
};
// element interface
function $S(id){ //id or ele
	if(typeof(id)=='string'){
			var e=typeof($)=='function'?$(id):document.getElementById(id);
	}else if(typeof(id)!='undefined'){
			var e=id;
	}
	if(!e) return null;
	e.createElement=function(type){
		var ex=$S(document.createElement(type));
		if(this.getAttribute('_shrine_view')){
			ex.setToApp(this.getAttribute('_shrine_view'),this.getAttribute('_shrine_app'));
		}
		return ex;
	};
	e.clearHTML=function(){
		this.innerHTML='';
	};
	e.set=function(key,val){
		_constructor.set(this,key,val);
	};
	e.get=function(key){
		return _constructor.get(this,key);
	};
	e.setStyle=function(key,val){
		switch(key){
			case 'opacity': 
				if(document.all){ 
					try{
						if(typeof(this.filters.Alpha)=='undefined'){ 
							
							this.style.filter="Alpha(Opacity="+(val*100)+")";
						}else{
							this.style.filter="Alpha(Opacity="+(val*100)+")";
						}
					}catch(e){}
				}else{
					try{ this.style.opacity=val; }catch(e){}
				}
				break;
			case 'background': 
				var w=_view.getContainer(this.getAttribute('_shrine_view'));
				if(w && w.m_app){
					val=val.replace('%resource%/',w.m_path+'/%25resource%25/');
				}
				this.style[key]=val;
				break;
			case 'backgroundImage':
				var w=null;
				if(w && w.m_app){
					val=val.replace('%resource%/',w.m_path+'/%25resource%25/');
				}
				this.style[key]=val;
				break;
			default:
					this.style[key]=val;
					break;
		}
	};
	e.getStyle=function(key){
		if(key=='opacity'){
			if(document.all){ //ie 
				try{
					if(typeof(this.filters.Alpha.Opacity)!='undefined') return this.filters.Alpha.Opacity;
					else return 1;
				}catch(e){ return 1; }
			}else{ //ff
				if(typeof(e.style.opacity)!='undefined') return this.style.opacity;
				else return 1;
			}
		}else{
			return this.style[key];
		}
		
	};
	e.hasClass=function(name){
		return _constructor.hasClass(this,name);
	};
	e.addClass=function(name){
		_constructor.addClass(this,name);
	};
	e.removeClass=function(name){
		_constructor.removeClass(this,name);
	};
	e.getApp=function(){
		return _constructor.getApp(this);
	};
	e.setToApp=function(hWnd,app,parent){
		_constructor.setToApp(this,hWnd,app,parent);
	};
	e.setToPage=function(){
		_constructor.setToPage(e);
	};
	e.remove=function(name){
		try
		{
			this.removeAttribute(name);
			if (name == "class"){
				this.removeAttribute("className");
				this.removeAttribute("_shrine_class");
			}else if(name=='id'){
				this.removeAttribute("_shrine_id");
			}else if(name=='app'){
				_constructor.setToPage(this);
			}
		} catch(e) {}
	};
	e.addEventListener = function(eventType, handler, capture){
		try
		{
				if (this.addEventListener)
					this.addEventListener(eventType, handler, capture);
				else if (this.attachEvent)
					this.attachEvent("on" + eventType, handler);
		}
		catch (e) {}
	};
	e.removeEventListener=function(eventType, handler, capture){
		try
		{
				if (this.removeEventListener)
					this.removeEventListener(eventType, handler, capture);
				else if (this.detachEvent)
					this.detachEvent("on" + eventType, handler);
		}
		catch (e) {}
	};
	e.addLoadListener = function(handler)
	{
		if (typeof window.addEventListener != 'undefined')
			window.addEventListener('load', handler, false);
		else if (typeof document.addEventListener != 'undefined')
			document.addEventListener('load', handler, false);
		else if (typeof window.attachEvent != 'undefined')
			window.attachEvent('onload', handler);
	};
	
	return e;
}

//sec : alias
SendMessage=shrine.send;
shrine.view=_view;
shrine.process=_process;
shrine.constructor=_constructor;
shrine.scriptLoad=shrine.controllerLoad;
shrine._sfx=_loadsfx();
if(typeof(_shrine_container)!='undefined') shrine.container=_shrine_container;
/* sec : event handle */
window.onresize=function(){
	return shrine.send(shrine,'page_resize',{width:document.body.offsetWidth,height:document.body.offsetHeight});
};
document.onclick=function(){
	var e=_event();
	return shrine.send(shrine,'click',{x:e.clientX,y:e.clientY});
};
window.onscroll=function(){
	return shrine.send(shrine,'page_scroll',[document.body.scrollTop,document.body.scrollHeight]);
};
shrine.lock=function(){
	shrine.send(shrine,'lock',true);
};
shrine.unlock=function(){
	shrine.send(shrine,'lock',false);
};
/* document_state */
document_state='loading';
window.onload=function(){ 
	document_state='complete';
};
shrine_load=true;
if(typeof(on_shrine_load)=='function'){
	on_shrine_load();
}
document.write=function(html){
	var arMatch=html.match(/<script (.*?)>(.*?)<\/script>/gi);
	if(arMatch){
		for(var i =0; i < arMatch.length; i++){
			var arSrc=arMatch[i].match(/src=[\'\"]?([^\'\"]+)[\'\"]?/gi);
			if(arSrc.length>0){
				shrine.scriptLoad(arSrc[0].replaceAll('src=','').replaceAll('\'','').replaceAll('"',''));
			}
			var arCode=arMatch[i].match(/>.*?<\//gi);
			if(arSrc.length>0){
				eval(arCode[0].substr(1,arCode[0].length-3));
			}
		}
	}
	html.replaceAll(/<script (.*?)>(.*?)<\/script>/gi,'');
	var eWrite=$E('document_write');
	if(!eWrite){
		var div=document.createElement('div');
		div.id='document_write';
		document.body.appendChild(div);
		eWrite=div;
	}
	eWrite.innerHTML=eWrite.innerHTML+html;
};
/* NOTE
	ALERT : SEND MESSAGE  TO  me and push it into the stack of alert
	_center(); : return the rect of center;
*/