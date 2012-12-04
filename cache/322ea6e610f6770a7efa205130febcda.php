__view_##SHRINE_HANDLE##.main=function(ar){
	__view_##SHRINE_HANDLE##.mark('cosm.core');
	var arSide=ar[0];
	var arMain=ar[1];
	for(var k in arSide){
		var h=shrine.launch(arSide[k]);
		h.setParent($E('cosm_sidebar'));
		h.setSkin('cosm_skin');
	}
	for(var k in arMain){
		var h=shrine.launch(arMain[k]);
		h.setParent($E('cosm_mainbar'));
		h.setSkin('cosm_skin');
	}
}
__view_##SHRINE_HANDLE##.handler['save_app']=function(ar){
	shrine.callService(##SHRINE_HANDLE##,'saveApp',ar[0],ar[1],function(){
		__view_##SHRINE_HANDLE##.m_container.innerHTML='APP LIST SAVED';
	});
};
if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}