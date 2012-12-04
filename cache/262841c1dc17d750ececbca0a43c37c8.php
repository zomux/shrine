<div class="frm">
	<div class="@title">Shrine框架演示</div>
	<div class="@cate">
		本地化
		<div class="@panel">
			<input type="button" value="English" onclick="__view_##SHRINE_HANDLE##.setLang('en');" />
			<input type="button" value="中文"  onclick="__view_##SHRINE_HANDLE##.setLang('zh_CN');"/>
			<input type="button" value="日本語"  onclick="__view_##SHRINE_HANDLE##.setLang('ja');"/>
		</div>
	</div>
	<div class="@cate">
		App控制
		<div class="@panel">
			<input type="button" value="加宽" onclick="__view_##SHRINE_HANDLE##.doWidth(100);" />
			<input type="button" value="减宽" onclick="__view_##SHRINE_HANDLE##.doWidth(-100);" />
			<input type="button" value="透明度切换" onclick="__view_##SHRINE_HANDLE##.doOpacity();" />
			<input type="button" value="关闭" onclick="__view_##SHRINE_HANDLE##.close();" />
		</div>
	</div>
	<div class="@cate">
		运行应用
		<div class="@panel">
			<input type="button" value="词典" onclick="shrine.launch('cosm.dict');" />
			<input type="button" value="搜索" onclick="shrine.launch('cosm.searcher');" />
			<input type="button" value="天气" onclick="shrine.launch('cosm.weather');" />
			<input type="button" value="记事本" onclick="shrine.launch('cosm.notepad');" />
		</div>
	</div>
	<div class="@cate">
		本地服务函数调用
		<div class="@panel">
			<input type="text" value="" id="number1"/>
			<input type="button" value="平方" onclick="__view_##SHRINE_HANDLE##.square();" />
			<input type="text" value="" id="number2" size="30"/>
			<input type="button" value="MD5编码" onclick="__view_##SHRINE_HANDLE##.md5();" />
		</div>
	</div>
</div>