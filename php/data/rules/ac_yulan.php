<?php
if($ac == 'yulan'){
    $GLOBALS['html'] = _htmlspecialchars($GLOBALS['html']);
    $GLOBALS['html'] = "	<script type=\"text/javascript\" src=\"../public/js/syntaxhighlighter/scripts/shCore.js\"></script>
	<script type=\"text/javascript\" src=\"../public/js/syntaxhighlighter/scripts/shBrushXml.js\"></script>
	<link type=\"text/css\" rel=\"stylesheet\" href=\"../public/js/syntaxhighlighter/styles/shCore.css\"/>
	<link type=\"text/css\" rel=\"stylesheet\" href=\"../public/js/syntaxhighlighter/styles/shThemeEditplus.css\"/>
	<script type=\"text/javascript\">
		SyntaxHighlighter.config.clipboardSwf = '../public/js/syntaxhighlighter/scripts/clipboard.swf';
		SyntaxHighlighter.config.tagName = 'textarea';
		SyntaxHighlighter.all();
	</script>
	<table width=\"99%\" border=\"0\" cellpadding=\"4\" cellspacing=\"1\" class=\"tableoutline\">
	<tbody>
		<tr nowrap class=\"tb_head\">
			<td><h2>源代码查看</h2></td>
		</tr>
	</tbody>
	<tr nowrap class=\"firstalt\">
		<td><b>以下为采集规则 [{$caiji_config['name']}] 的源代码，你可以根据这个编写过滤规则:</b></td>
	</tr>
	<tr nowrap class=\"firstalt\">
		<form method=\"get\" action=\"caiji_config.php\">
		<input type=\"hidden\" name=\"ac\" value=\"{$ac}\" />
		<input type=\"hidden\" name=\"collectid\" value=\"{$collectid}\" />
		<td><input type=\"text\" name=\"url\" size=\"80\" value=\"{$from_url}\" onFocus=\"this.style.borderColor='#00CC00'\" onBlur=\"this.style.borderColor='#999999'\" > <input type=\"submit\" value=\"查看源代码\" /></td>
		</form>
	</tr>
	<tr nowrap class=\"firstalt\">
		<td><textarea style=\"height:500px\" class=\"brush: html;auto-links:false;\">{$GLOBALS['html']}</textarea></td>
	</tr>
</table>
</body>
</html>";

    $GLOBALS['html'] = ADMIN_HEAD . $GLOBALS['html'];
    exit($GLOBALS['html']);
}