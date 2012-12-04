@post=function(){
	if(view.btnPost.disabled==true) return ;
	view.btnPost.disabled=true;
	var txt=view.content.value;
	if(txt.length<5 || txt.length>300){
		alert('微博字数必须在5到300之间');
		view.btnPost.disabled=false;
		return ;
	}
	var b=server.post(txt);
	if(!b) alert('发布失败,请登录Wordpress后台发布试试看');
	else{
		view.content.value='';
		shrine.send('cosm.myposts','refresh');
		view.note.innerHTML='日志已经发布，<a href="/?p='+b+'">点此查看</a>';
	}
	view.btnPost.disabled=false;
};