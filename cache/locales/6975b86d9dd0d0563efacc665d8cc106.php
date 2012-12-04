@query=function(){
	view.btnQuery.disabled=true;
	server.query(view.txtWord.value,function(p){
		view.btnQuery.disabled=false;
		p=p.dict;
		var result='';
		if(p.key) result+=p.key;
		if(p.pron) result+=' ['+p.pron+']';
		result+='<br/>';
		result+=p.def;
		view.result.innerHTML=result;
		view.result.style.display='block';
	});
};