@main=function(ar){
	@mark('cosm.core');
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
@handler['save_app']=function(ar){
	server.saveApp(ar[0],ar[1],function(){
		@m_container.innerHTML='APP LIST SAVED';
	});
};