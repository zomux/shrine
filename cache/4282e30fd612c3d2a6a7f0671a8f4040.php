__view_##SHRINE_HANDLE##.main=function(){
	__view_##SHRINE_HANDLE##.mark('shr.finder');
	ck_action_view=function(k){
		var szFile=k.replace('../../../../../../','');
		shrine.launch('cosm.picviewer',{pic:szFile});
	};
	shrine.pluginLoad('ckfinder',function(){ 
				var finder = new CKFinder() ;
				finder.container=$S("__shrine_##SHRINE_HANDLE##_container");
				//finder.SelectFunction = ShowFileInfo ;
				finder.Create() ;
			});
};
if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}