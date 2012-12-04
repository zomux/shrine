__view_##SHRINE_HANDLE##.m_opacity=1;

__view_##SHRINE_HANDLE##.handler['close']=function(){
	alert('pending to close...');
};

__view_##SHRINE_HANDLE##.main=function(){
	__view_##SHRINE_HANDLE##.mark('demo.general');
	__view_##SHRINE_HANDLE##.resize({width:500,height:300});
};

__view_##SHRINE_HANDLE##.setLang=function(lang){
	shrine.callService(##SHRINE_HANDLE##,'setLang',lang);
};

__view_##SHRINE_HANDLE##.doWidth=function(nWidth){
	var width=__view_##SHRINE_HANDLE##.m_size.width+nWidth;
	if(width<100) width=100;
	if(width>800) width=800;
	__view_##SHRINE_HANDLE##.resize({width:width});
};

__view_##SHRINE_HANDLE##.doOpacity=function(){
	__view_##SHRINE_HANDLE##.m_opacity= __view_##SHRINE_HANDLE##.m_opacity==1 ? 0.7:1;
	if(shrine.container) shrine.container.command('set_opacity',__view_##SHRINE_HANDLE##.m_opacity);
};

__view_##SHRINE_HANDLE##.square=function(){
	/* directly call */
	$S("__shrine_##SHRINE_HANDLE##_number1").value=shrine.callService(##SHRINE_HANDLE##,'square',$S("__shrine_##SHRINE_HANDLE##_number1").value);
};

__view_##SHRINE_HANDLE##.md5=function(){
	/* use callback */
	shrine.callService(##SHRINE_HANDLE##,'md5',$S("__shrine_##SHRINE_HANDLE##_number2").value,function(p){
		$S("__shrine_##SHRINE_HANDLE##_number2").value=p;
	});
};
if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}