shrine.scriptLoad('http://www.google.com/jsapi',function(){
	google.load('search', '1.0',{callback:@onLoad,language:'zh_CN'});
});
@onLoad=function(){
	var tabbed = new google.search.SearchControl();
	tabbed.addSearcher(new google.search.WebSearch());
	tabbed.addSearcher(new google.search.NewsSearch());
	tabbed.addSearcher(new google.search.BlogSearch());
	tabbed.addSearcher(new google.search.BookSearch());
	tabbed.addSearcher(new google.search.LocalSearch());
	tabbed.addSearcher(new google.search.PatentSearch());
	
	var drawOptions = new google.search.DrawOptions();
	drawOptions.setDrawMode(google.search.SearchControl.DRAW_MODE_TABBED);
	tabbed.draw(view.seacher, drawOptions);
};



