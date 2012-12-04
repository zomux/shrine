	// create a tabbed mode search control
	var tabbed = new google.search.SearchControl();

	tabbed.addSearcher(new google.search.LocalSearch());
	tabbed.addSearcher(new google.search.WebSearch());
	tabbed.addSearcher(new google.search.BlogSearch());
	tabbed.addSearcher(new google.search.NewsSearch());
	tabbed.addSearcher(new google.search.BookSearch());
	tabbed.addSearcher(new google.search.PatentSearch());

	// draw in tabbed layout mode
	var drawOptions = new google.search.DrawOptions();
	drawOptions.setDrawMode(google.search.SearchControl.DRAW_MODE_TABBED);
	tabbed.draw($S("__shrine_##SHRINE_HANDLE##_seacher"), drawOptions);

	tabbed.execute("Ferrari Enzo");





if(typeof(__view_##SHRINE_HANDLE##.main)=="function" ){if(!__view_##SHRINE_HANDLE##.m_plugins){__view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);}else{shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,function(){ __view_##SHRINE_HANDLE##.main(__view_##SHRINE_HANDLE##.m_param);  });}}else if(__view_##SHRINE_HANDLE##.m_plugins){ shrine.pluginLoad(__view_##SHRINE_HANDLE##.m_plugins,null);}