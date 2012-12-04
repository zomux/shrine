__view_##SHRINE_HANDLE##.main=function(){
	__view_##SHRINE_HANDLE##.mark('cosm.myposts');
};
__view_##SHRINE_HANDLE##.handler['refresh']=function(){
	shrine.callService(##SHRINE_HANDLE##,'refresh',{callback:function(){}});
};
if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}