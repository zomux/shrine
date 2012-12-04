@arId=[];
@main=function(ar){
	@arId=ar;
};
@submit=function(){
	var idPoll=null;
	for(k in @arId){
		id=@arId[k];
		if(view['poll_'+id].checked){
			idPoll=id;
			break;
		}
	}
	if(idPoll){
		var ret=server.poll(idPoll);
		
		if(!ret) alert('BLOG.CD Poll: Some error happened :(');
	}
};