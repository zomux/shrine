<?php 
class RTemplateComsenz{
	public static function Load($tplfile) {
		global $_CONFIG;
		/* assume the cache path */ 
		$pathCache=$_CONFIG['path_cache'].'tpl_comsenz/'; 
		if(!is_dir($pathCache)) mkdirs($pathCache);
		
		$objfile = md5(str_replace(array('/','\\'), '_', $tplfile));
		
		$objfile = $pathCache.$objfile.'.php';
		
		$tplrefresh = 1;	
		if(!file_exists($tplfile)){
			echo 'WARN: TEMPLATE NOT EXIST ('.$tplfile.')';
			return false;
		}
		if(@filemtime($tplfile) <= @filemtime($objfile)) {
			$tplrefresh = 0;
		}
	
		if($tplrefresh) {
			parse_template($tplfile, $objfile);
		}
		return $objfile;
		
	}
}
function parse_template($tplfile, $objfile, $template='') {

	//read
	if(empty($template)) {
		if(!@$fp = fopen($tplfile, 'r')) {
			exit('Template file :<br>'.srealpath($tplfile).'<br>Not found or have no access!');
		}
		$nSizeFile= filesize($tplfile);
		$template =$nSizeFile>0? fread($fp, filesize($tplfile)) : '';
		fclose($fp);
		$template = str_replace('<?exit?>', '', $template);
	}
	
	//parse
	$var_regexp = "((\\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)(\[[a-zA-Z0-9_\-\.\"\'\[\]\$\x7f-\xff]+\])*)";
	$const_regexp = "([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)";
	
	$template = preg_replace("/([\n\r]+)\t+/s", "\\1", $template);
	$template = preg_replace("/\<\!\-\-\{(.+?)\}\-\-\>/s", "{\\1}", $template);
	//$template = preg_replace("/\{lang\s+(.+?)\}/ies", "languagevar('\\1')", $template);
	$template = str_replace("{LF}", "<?=\"\\n\"?>", $template);

	$template = preg_replace("/(\\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\.([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)/s", "\\1['\\2']", $template);
	$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", "<?=\\1?>", $template);
	$template = preg_replace("/\{(\\\$[a-zA-Z0-9_\[\]\'\"\$\.\x7f-\xff]+)\}/s", "<?=\\1?>", $template);
	$template = preg_replace("/$var_regexp/es", "addquote('<?=\\1?>')", $template);
	$template = preg_replace("/\<\?\=\<\?\=$var_regexp\?\>\?\>/es", "addquote('<?=\\1?>')", $template);

	$template = preg_replace("/[\n\r\t]*\{block\s+name=\"(.+?)\"\s+parameter=\"(.+?)\"\}[\n\r\t]*/ies", "blocktags('\\1', '\\2')", $template);
	$template = preg_replace("/[\n\r\t]*\#date\((.+?)\)\#[\n\r\t]*/ies", "striptagquotes('<?php sdate(\\1); ?>')", $template);
	$template = preg_replace("/[\n\r\t]*\#getad\((.+?)\)\#[\n\r\t]*/ies", "striptagquotes('<?php echo getad(\\1); ?>')", $template);
	$template = preg_replace("/[\n\r\t]*\#(uid|action)(.+?)\#[\n\r\t]*/ies", "striptagquotes('<?php echo geturl(\"\\1\\2\"); ?>')", $template);
	$template = preg_replace("/[\n\r\t]*\#cut\((.+?)\)\#[\n\r\t]*/ies", "striptagquotes('<?php echo str_cut(\\1); ?>')", $template);
	

	$template = ltrim($template);
	$template = "<?php if(!defined('SHRINE_VERSION')) exit('Access Denied'); ?>$template";
	$template = preg_replace("/[\n\r\t]*\{template\s+([a-z0-9_]+)\}[\n\r\t]*/is", "\n<?php include ('\\1.php'); ?>\n", $template);
	$template = preg_replace("/[\n\r\t]*\{template\s+(.+?)\}[\n\r\t]*/is", "\n<?php include ('\\1'); ?>\n", $template);
	$template = preg_replace("/[\n\r\t]*\{eval\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('<?php \\1; ?>','')", $template);
	$template = preg_replace("/[\n\r\t]*\{echo\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('\n<?php echo \\1; ?>\n','')", $template);
	$template = preg_replace("/[\n\r\t]*\{elseif\s+(.+?)\}[\n\r\t]*/ies", "stripvtags('\n<?php } elseif(\\1) { ?>\n','')", $template);
	$template = preg_replace("/[\n\r\t]*\{else\}[\n\r\t]*/is", "\n<?php } else { ?>\n", $template);

	for($i = 0; $i < 5; $i++) {
		$template = preg_replace("/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\}[\n\r]*(.+?)[\n\r]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('\n<?php if(is_array(\\1)) { foreach(\\1 as \\2) { ?>','\n\\3\n<?php } } ?>\n')", $template);
		$template = preg_replace("/[\n\r\t]*\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}[\n\r\t]*(.+?)[\n\r\t]*\{\/loop\}[\n\r\t]*/ies", "stripvtags('\n<?php if(is_array(\\1)) { foreach(\\1 as \\2 => \\3) { ?>','\n\\4\n<?php } } ?>\n')", $template);
		$template = preg_replace("/[\n\r\t]*\{if\s+(.+?)\}[\n\r]*(.+?)[\n\r]*\{\/if\}[\n\r\t]*/ies", "stripvtags('\n<?php if(\\1) { ?>','\n\\2\n<?php } ?>\n')", $template);
	}
	$template = preg_replace("/\{$const_regexp\}/s", "<?=\\1?>", $template);
	$template = preg_replace("/ \?\>[\n\r]*\<\? /s", " ", $template);
	
	/*replace <?= by <?php echo */
	$template = str_replace('<?=','<?php echo ',$template);
	//write
	$template = trim($template);
	if(!empty($template)) {
		$needwrite = false;
		if(@unlink($objfile)) {
			writefile($objfile.'.tmp', $template, 'text', 'w', 0);
			if(@rename($objfile.'.tmp', $objfile)) {
				$needwrite = false;
			} else {
				$needwrite = true;
			}
		} else {
			$needwrite = true;
		}
		//再次写入
		if($needwrite) writefile($objfile, $template, 'text', 'w', 0);
	}
}

/**
 * 正则表达式匹配替换
 *
 * @param string $var ：
 * @return 
 */
function addquote($var) {
	return str_replace("\\\"", "\"", preg_replace("/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s", "['\\1']", $var));
}
//格式化路径
function srealpath($path) {
	$path = str_replace('./', '', $path);
	if(DIRECTORY_SEPARATOR == '\\') {
		$path = str_replace('/', '\\', $path);
	} elseif(DIRECTORY_SEPARATOR == '/') {
		$path = str_replace('\\', '/', $path);
	}
	return $path;
}
/**
 * 正则表达式匹配替换
 *
 * @param string $expr ：
 * @return 
 */
function striptagquotes($expr) {
	$expr = preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr);
	$expr = str_replace("\\\"", "\"", preg_replace("/\[\'([a-zA-Z0-9_\-\.\x7f-\xff]+)\'\]/s", "[\\1]", $expr));
	return $expr;
}

/**
 * ?
 *
 * @param string $var ：
 * @return 
 */
function languagevar($var) {
	global $lang;
	if(isset($lang[$var])) {
		return $lang[$var];
	} else {
		return "!$var!";
	}
}

/**
 * 将模板中的块替换成BLOCK函数
 *
 * @param string $cachekey ：
 * @param string $parameter ：
 * @return 
 */
function blocktags($cachekey, $parameter) {
	return striptagquotes("<?php block(\"$cachekey\", \"$parameter\"); ?>");
}

/**
 * 正则表达式匹配替换
 *
 * @param string $expr ：
 * @param string $statement ：
 * @return 
 */
function stripvtags($expr, $statement='') {
	$expr = str_replace("\\\"", "\"", preg_replace("/\<\?\=(\\\$.+?)\?\>/s", "\\1", $expr));
	$statement = str_replace("\\\"", "\"", $statement);
	return $expr.$statement;
}

function writefile($filename, $writetext, $filemod='text', $openmod='w', $eixt=1) {
	if(!@$fp = fopen($filename, $openmod)) {
		if($eixt) {
			exit('File :<br>'.srealpath($filename).'<br>Have no access to write!');
		} else {
			return false;
		}
	} else {
		$text = '';
		if($filemod == 'php') {
			$text = "<?php\r\n\r\nif(!defined('SHRINE_VERSION')) exit('Access Denied');\r\n\r\n";
		}
		$text .= $writetext;
		if($filemod == 'php') {
			$text .= "\r\n\r\n?>";
		}
		flock($fp, 2);
		fwrite($fp, $text);
		fclose($fp);
		return true;
	}
}
function str_cut($string, $sublen, $start = 0, $code = 'UTF-8')
{
    if($code == 'UTF-8')
    {
        $pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);

        if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."...";
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';

        for($i=0; $i< $strlen; $i++)
        {
            if($i>=$start && $i< ($start+$sublen))
            {
                if(ord(substr($string, $i, 1))>129)
                {
                    $tmpstr.= substr($string, $i, 2);
                }
                else
                {
                    $tmpstr.= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1))>129) $i++;
        }
        if(strlen($tmpstr)< $strlen ) $tmpstr.= "...";
        return $tmpstr;
    }
}
?>
