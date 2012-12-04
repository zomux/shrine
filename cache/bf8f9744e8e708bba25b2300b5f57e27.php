<div class="frm">
	<div class="@title">Shrine Framework Demo</div>
	<div class="@cate">
		語源化
		<div class="@panel">
			<input type="button" value="English" onclick="__view_##SHRINE_HANDLE##.setLang('en');" />
			<input type="button" value="中文"  onclick="__view_##SHRINE_HANDLE##.setLang('zh_CN');"/>
			<input type="button" value="日本語"  onclick="__view_##SHRINE_HANDLE##.setLang('ja');"/>
		</div>
	</div>
	<div class="@cate">
		Appコントロール
		<div class="@panel">
			<input type="button" value="幅広さ増える" onclick="__view_##SHRINE_HANDLE##.doWidth(100);" />
			<input type="button" value="幅広さ減る" onclick="__view_##SHRINE_HANDLE##.doWidth(-100);" />
			<input type="button" value="透明さスイッチ" onclick="__view_##SHRINE_HANDLE##.doOpacity();" />
			<input type="button" value="終止" onclick="__view_##SHRINE_HANDLE##.close();" />
		</div>
	</div>
	<div class="@cate">
		App Launch
		<div class="@panel">
			<input type="button" value="辞書" onclick="shrine.launch('cosm.dict');" />
			<input type="button" value="検索" onclick="shrine.launch('cosm.searcher');" />
			<input type="button" value="天気" onclick="shrine.launch('cosm.weather');" />
			<input type="button" value="ノートパート" onclick="shrine.launch('cosm.notepad');" />
		</div>
	</div>
	<div class="@cate">
		Local Service Call
		<div class="@panel">
			<input type="text" value="" id="number1"/>
			<input type="button" value="二乗" onclick="__view_##SHRINE_HANDLE##.square();" />
			<input type="text" value="" id="number2" size="30"/>
			<input type="button" value="MD5暗号化" onclick="__view_##SHRINE_HANDLE##.md5();" />
		</div>
	</div>
</div>