@main=function(){
	@mark('shr.finder');
	ck_action_view=function(k){
		var szFile=k.replace('../../../../../../','');
		shrine.launch('cosm.picviewer',{pic:szFile});
	};
	shrine.pluginLoad('ckfinder',function(){ 
				var finder = new CKFinder() ;
				finder.container=view.container;
				//finder.SelectFunction = ShowFileInfo ;
				finder.Create() ;
			});
};