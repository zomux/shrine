<div class="frm">
	<div class="@title">Shrine Framework Demo</div>
	<div class="@cate">
		Locale
		<div class="@panel">
			<input type="button" value="English" onclick="__view_##SHRINE_HANDLE##.setLang('en');" />
			<input type="button" value="中文"  onclick="__view_##SHRINE_HANDLE##.setLang('zh_CN');"/>
			<input type="button" value="日本語"  onclick="__view_##SHRINE_HANDLE##.setLang('ja');"/>
		</div>
	</div>
	<div class="@cate">
		App Control
		<div class="@panel">
			<input type="button" value="More Width" onclick="__view_##SHRINE_HANDLE##.doWidth(100);" />
			<input type="button" value="Less Width" onclick="__view_##SHRINE_HANDLE##.doWidth(-100);" />
			<input type="button" value="Opacity Switch" onclick="__view_##SHRINE_HANDLE##.doOpacity();" />
			<input type="button" value="Close Me" onclick="__view_##SHRINE_HANDLE##.close();" />
		</div>
	</div>
	<div class="@cate">
		App Launch
		<div class="@panel">
			<input type="button" value="Dict" onclick="shrine.launch('cosm.dict');" />
			<input type="button" value="Search" onclick="shrine.launch('cosm.searcher');" />
			<input type="button" value="Weather" onclick="shrine.launch('cosm.weather');" />
			<input type="button" value="Notepad" onclick="shrine.launch('cosm.notepad');" />
		</div>
	</div>
	<div class="@cate">
		Local Service Call
		<div class="@panel">
			<input type="text" value="" id="number1"/>
			<input type="button" value="Square" onclick="__view_##SHRINE_HANDLE##.square();" />
			<input type="text" value="" id="number2" size="30"/>
			<input type="button" value="MD5 Encode" onclick="__view_##SHRINE_HANDLE##.md5();" />
		</div>
	</div>
</div>