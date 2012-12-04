@main=function(pic){
	@setSkin('wskin:move,close');
	@dock({method:'float',side:'center'});
	if(typeof(pic)=='string'){
		@view(pic);
	}
};
@view=function(pic){
	view.pic.src=pic;
	var arText=pic.split('/');
	view.text.innerHTML=arText[arText.length-1];
}
@onload=function(){
	var w=view.pic.width;
	var h=view.pic.height;
	if(w>h && w>400){
		h=400/w*h;
		w=400;
		view.pic.width=w;
		view.pic.height=h;
	}else if(h>w && h>300){
		w=300/h*w;
		h=300;
		view.pic.width=w;
		view.pic.height=h;
	}
};