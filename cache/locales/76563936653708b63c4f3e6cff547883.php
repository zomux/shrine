@m_opacity=1;

@handler['close']=function(){
	alert('pending to close...');
};

@main=function(){
	@mark('demo.general');
	@resize({width:500,height:300});
};

@setLang=function(lang){
	server.setLang(lang);
};

@doWidth=function(nWidth){
	var width=@m_size.width+nWidth;
	if(width<100) width=100;
	if(width>800) width=800;
	@resize({width:width});
};

@doOpacity=function(){
	@m_opacity= @m_opacity==1 ? 0.7:1;
	if(shrine.container) shrine.container.command('set_opacity',@m_opacity);
};

@square=function(){
	/* directly call */
	view.number1.value=server.square(view.number1.value);
};

@md5=function(){
	/* use callback */
	server.md5(view.number2.value,function(p){
		view.number2.value=p;
	});
};