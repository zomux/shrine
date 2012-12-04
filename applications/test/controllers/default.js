/* default controller of test1 */
@handler['fuck']=function(p){
	
	@write(p);
	var sa=view.createElement('input');
	sa.set('id','sa');
	sa.onclick=@krick;
	view.appendChild(sa);
};
@main=function(p){
	@mark('test');
	//@setContent("it;s test1");
};
@krick=function(){
	alert(view.sa.value);
}
