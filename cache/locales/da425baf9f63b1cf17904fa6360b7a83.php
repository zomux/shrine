@main=function(){
	@mark('cosm.myposts');
};
@handler['refresh']=function(){
	server.refresh({callback:function(){}});
};