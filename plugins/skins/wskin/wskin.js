wskin={
	/* Standard Interfaces */
	load:function(id,e,param){
		if(!_view.exists(id)) return false
		if(e.getAttribute('_wskin_load')) return false;
		if(typeof(param)!='string') param='';
		e.setAttribute('_wskin_load',true);
		param=wskin.fixParam(param);
		var code=wskin.requireCode(id,param.color);
		var arWarp=[];
		for(var i=0;i<e.childNodes.length;i++){
			arWarp.push(e.childNodes[i]);
		}
		e.innerHTML=code;
		var eCont=$S('_wskin_cont_'+id);
		var eTit=$E('_wskin_tit_'+id);
		var v=_view.get(id);
		v.m_container=eCont;
		for(var i=0;i<arWarp.length;i++){
			eCont.appendChild(arWarp[i]);
		}
		if(param.title){
			eTit.innerHTML=v.m_title;
			v.handle['set_title']=function(p){
				if(p && $E('_wskin_tit_'+this.m_id)) $E('_wskin_tit_'+this.m_id).innerHTML=p;
				return true;
			};
		}
		if(param.close){
			$E('_wskin_close_'+id).style.display='block';
			$E('_wskin_close_'+id).setAttribute('_view_id',id);
			$E('_wskin_close_'+id).onclick=function(){
				shrine.send(this.getAttribute('_view_id'),'close');
			};
		}else{
			$E('_wskin_close_'+id).style.display='none';
		}
		if(param.move){
			v.setDragger(eTit);
		}
	},
	unload:function(id,e){
		if(!_view.exists(id)) return false
		if(!e.getAttribute('_wskin_load')) return false;
		e.setAttribute('_wskin_load',null)
		var eCont=$E('_wskin_cont_'+id);
		var arWarp=[];
		for(var i=0;i<eCont.childNodes.length;i++){
			arWarp.push(e.childNodes[i]);
		}
		e.innerHTML='';
		for(var i=0;i<arWarp.length;i++){
			e.appendChild(arWarp[i]);
		}
		_view.get(id).handle['set_title']=null;
		_view.get(id).m_container=$S('__container_'+id);
		return true;
	},
	lock:function(id,e){
		
	},
	unlock:function(id,e){
		
	},
	/* Private Codes */
	codeFrame:'<table cellspacing="0" cellpadding="0"><tr><td class="w7"></td><td id="_wskin_tit_##SHRID##" class="w8" valign="bottom" align="right"><a  id="_wskin_close_##SHRID##" class="wskin_closer"></a></td><td class="w9"></td></tr><tr><td class="w4"></td><td id="_wskin_cont_##SHRID##" class="w5"></td><td class="w6"></td></tr><tr><td class="w1"></td><td class="w2"></td><td class="w3"></td></tr></table>',
	colorLoaded:{white:1},
	colorAvail:['white','black'],
	requireCode:function(id,color){
		if(!(color in wskin.colorLoaded)){
			wskin.colorLoaded[color]=1;
			shrine.styleLoad(PATH_PLUGIN+'load.php?c='+color);
		}
		return wskin.codeFrame.replaceAll('##COLOR##',color).replaceAll('##SHRID##',id);
	},
	fixParam:function(p){
		var obj={color:'white',move:false,close:false,title:false};
		p=p.split(',');
		for(var i=0;i<p.length;i++){
			var v=p[i];
			if(in_array(v,wskin.colorAvail)){ obj.color=v; }
			switch(v){
			case 'move':
			case 'close':
			case 'title':
				obj[v]=true;
				break;
			}
		}
		return obj;
	}
};
shrine.styleLoad(PATH_PLUGIN+'load.php?c=white');