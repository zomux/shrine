__view_##SHRINE_HANDLE##.query=function(){
	$S("__shrine_##SHRINE_HANDLE##_btnQuery").disabled=true;
	shrine.callService(##SHRINE_HANDLE##,'query',$S("__shrine_##SHRINE_HANDLE##_txtWord").value,function(p){
		$S("__shrine_##SHRINE_HANDLE##_btnQuery").disabled=false;
		p=p.dict;
		var result='';
		if(p.key) result+=p.key;
		if(p.pron) result+=' ['+p.pron+']';
		result+='<br/>';
		result+=p.def;
		$S("__shrine_##SHRINE_HANDLE##_result").innerHTML=result;
		$S("__shrine_##SHRINE_HANDLE##_result").style.display='block';
	});
};
if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}