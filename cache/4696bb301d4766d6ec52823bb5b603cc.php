__view_##SHRINE_HANDLE##.main=function(pic){
	__view_##SHRINE_HANDLE##.setSkin('wskin:move,close');
	__view_##SHRINE_HANDLE##.dock({method:'float',side:'center'});
	if(typeof(pic)=='string'){
		__view_##SHRINE_HANDLE##.view(pic);
	}
};
__view_##SHRINE_HANDLE##.view=function(pic){
	$S("__shrine_##SHRINE_HANDLE##_pic").src=pic;
	var arText=pic.split('/');
	$S("__shrine_##SHRINE_HANDLE##_text").innerHTML=arText[arText.length-1];
}
__view_##SHRINE_HANDLE##.onload=function(){
	var w=$S("__shrine_##SHRINE_HANDLE##_pic").width;
	var h=$S("__shrine_##SHRINE_HANDLE##_pic").height;
	if(w>h && w>400){
		h=400/w*h;
		w=400;
		$S("__shrine_##SHRINE_HANDLE##_pic").width=w;
		$S("__shrine_##SHRINE_HANDLE##_pic").height=h;
	}else if(h>w && h>300){
		w=300/h*w;
		h=300;
		$S("__shrine_##SHRINE_HANDLE##_pic").width=w;
		$S("__shrine_##SHRINE_HANDLE##_pic").height=h;
	}
};
if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}