__view_##SHRINE_HANDLE##.post=function(){
	if($S("__shrine_##SHRINE_HANDLE##_btnPost").disabled==true) return ;
	$S("__shrine_##SHRINE_HANDLE##_btnPost").disabled=true;
	var txt=$S("__shrine_##SHRINE_HANDLE##_content").value;
	if(txt.length<5 || txt.length>300){
		alert('微博字数必须在5到300之间');
		$S("__shrine_##SHRINE_HANDLE##_btnPost").disabled=false;
		return ;
	}
	var b=shrine.callService(##SHRINE_HANDLE##,'post',txt);
	if(!b) alert('发布失败,请登录Wordpress后台发布试试看');
	else{
		$S("__shrine_##SHRINE_HANDLE##_content").value='';
		shrine.send('cosm.myposts','refresh');
		$S("__shrine_##SHRINE_HANDLE##_note").innerHTML='日志已经发布，<a href="/?p='+b+'">点此查看</a>';
	}
	$S("__shrine_##SHRINE_HANDLE##_btnPost").disabled=false;
};
if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}