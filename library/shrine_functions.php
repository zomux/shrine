<?php
function convert_to_under($string){
	return str_replace(array(':','.','/','\\'),'_',$string);
}
function hash_to_string($hash){
	$json=new RJSON();

	$sz=base64_encode(escape($json->encode($hash)));
	//$sz=base64_encode($json->encode($hash));
	$sz=str_replace('+','*',$sz);
	$sz=str_replace('/','-',$sz);
	$sz=str_replace('=','!',$sz);
	return $sz;
}
function hash_from_string($str){
	$json=new RJSON();
	$str=str_replace('*','+',$str);
	$str=str_replace('-','/',$str);
	$str=str_replace('!','=',$str);
	return $json->decode(unescape(base64_decode($str)));
}
function escape($str) { 
	 preg_match_all("/[\x80-\xff].|[\x01-\x7f]+/",$str,$r);  
	 $ar = $r[0];  
	 foreach($ar as $k=>$v) {  
	   if(ord($v[0]) < 128)  
	     $ar[$k] = rawurlencode($v);  
	   else  
	     $ar[$k] = "%u".strtoupper(bin2hex(iconv("GBK","UCS-2",$v)));  
	 }  
	 return join("",$ar);  
}
function uni2utf8( $c ){
  if ($c < 0x80)  {
        $utf8char = chr($c);
  }  else if ($c < 0x800)  {
        $utf8char = chr(0xC0 | $c >> 0x06).chr(0x80 | $c & 0x3F);
  }  else if ($c < 0x10000)  {
        $utf8char = chr(0xE0 | $c >> 0x0C).chr(0x80 | $c >> 0x06 & 0x3F).chr(0x80 | $c & 0x3F);
  }  else  {
        $utf8char = "&#{$c};";
  }
  return $utf8char;
}
function unescape($source) { 
	 $decodedStr = "";
    $pos = 0;
    $len = strlen ($source);
    while ($pos < $len) {
        $charAt = substr ($source, $pos, 1);
        if ($charAt == '%') {
            $pos++;
            $charAt = substr ($source, $pos, 1);
            if ($charAt == 'u') {
                // we got a unicode character
                $pos++;
                $unicodeHexVal = substr ($source, $pos, 4);
                $unicode = hexdec ($unicodeHexVal);
				/*rafa hack*/
                //$entity = "&#". $unicode . ';';
                //$decodedStr .= utf8_encode ($entity);
				$entity = uni2utf8($unicode);
				$decodedStr .= $entity;
                $pos += 4;
            }
            else {
                // we have an escaped ascii character
                $hexVal = substr ($source, $pos, 2);
                $decodedStr .= chr (hexdec ($hexVal));
                $pos += 2;
            }
        } else {
            $decodedStr .= $charAt;
            $pos++;
        }
    }
    return $decodedStr;
}
function fix_sql_by_table($table,$sql){
	if(!is_array($table)) return $sql;
	$sql=preg_replace('/(\\W)true(\\W)/','\11\2',$sql);
	$sql=preg_replace('/(\\W)true(\\W)/','\10\2',$sql);
	$sql=preg_replace('/(\s)has(\s+?)\"(\w+?)\"/','\1like\2"%|\3|%"',$sql);	//array has "sth"
	$sql=preg_replace('/(\\W)'.$table['name'].'(\\W)/','\1'.$table['real'].'\2',$sql);
	foreach($table['members'] as $k=>$v){
		$sql=preg_replace('/(\\W)'.$k.'(\\W)/','\1'.$v['real'].'\2',$sql);
	}
	return $sql;
}
function fix_fields_by_table($table,$fields){
	$szFields='*';
	if(is_array($fields) && count($fields)>0){
		$arFields=array();
		for($i=0;$i<count($fields);$i++){
			$k=$fields[$i];
			if(array_key_exists($k, $table[members])) array_push($arFields,$table['members'][$k]['real']);
		}
		if(count($arFields)>0) $szFields=implode(',',$arFields);
	}
	return $szFields;
}
function mkdirs($dir)
{
	if(!$dir || trim($dir)=='') return false;
	if(!is_dir($dir))
	{
		if(!mkdirs(dirname($dir))){
			return false;
		}
		if(!mkdir($dir,0777)){
			return false;
		}
	}
	return true;
}

if ( !function_exists('xml2array') ) :
function xml2array($contents, $get_attributes=1, $priority = 'tag') {
      if(!$contents) return array();

      if(!function_exists('xml_parser_create')) {
        //print "'xml_parser_create()' function not found!";
        return array();
      }

    //Get the XML parser of PHP - PHP must have this module for the parser to work
    $parser = xml_parser_create('');
    xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); # http://minutillo.com/steve/weblog/2004/6/17/php-xml-and-character-encodings-a-tale-of-sadness-rage-and-data-loss
    xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    xml_parse_into_struct($parser, trim($contents), $xml_values);
    xml_parser_free($parser);

      if(!$xml_values) return;//Hmm...

      //Initializations
    $xml_array = array();
    $parents = array();
    $opened_tags = array();
    $arr = array();

    $current = &$xml_array; //Refference

      //Go through the tags.
    $repeated_tag_index = array();//Multiple tags with same name will be turned into an array
    foreach($xml_values as $data) {
          unset($attributes,$value);//Remove existing values, or there will be trouble

          //This command will extract these variables into the foreach scope
          // tag(string), type(string), level(int), attributes(array).
        extract($data);//We could use the array by itself, but this cooler.

        $result = array();
        $attributes_data = array();
         
          if(isset($value)) {
              if($priority == 'tag') $result = $value;
              else $result['value'] = $value; //Put the value in a assoc array if we are in the 'Attribute' mode
        }

        //Set the attributes too.
        if(isset($attributes) and $get_attributes) {
              foreach($attributes as $attr => $val) {
                  if($priority == 'tag') $attributes_data[$attr] = $val;
                  else $result['attr'][$attr] = $val; //Set all the attributes in a array called 'attr'
            }
          }

        //See tag status and do the needed.
        if($type == "open") {//The starting of the tag '<tag>'
            $parent[$level-1] = &$current;
              if(!is_array($current) or (!in_array($tag, array_keys($current)))) { //Insert New tag
                $current[$tag] = $result;
                  if($attributes_data) $current[$tag. '_attr'] = $attributes_data;
                $repeated_tag_index[$tag.'_'.$level] = 1;

                $current = &$current[$tag];

              } else { //There was another element with the same tag name

                if(isset($current[$tag][0])) {//If there is a 0th element it is already an array
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                    $repeated_tag_index[$tag.'_'.$level]++;
                  } else {//This section will make the value an array if multiple tags with the same name appear together
                    $current[$tag] = array($current[$tag],$result);//This will combine the existing item and the new item together to make an array
                    $repeated_tag_index[$tag.'_'.$level] = 2;
                     
                      if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                        $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                          unset($current[$tag.'_attr']);
                      }

                  }
                $last_item_index = $repeated_tag_index[$tag.'_'.$level]-1;
                $current = &$current[$tag][$last_item_index];
              }

          } elseif($type == "complete") { //Tags that ends in 1 line '<tag />'
              //See if the key is already taken.
            if(!isset($current[$tag])) { //New Key
                $current[$tag] = $result;
                $repeated_tag_index[$tag.'_'.$level] = 1;
                  if($priority == 'tag' and $attributes_data) $current[$tag. '_attr'] = $attributes_data;

              } else { //If taken, put all things inside a list(array)
                if(isset($current[$tag][0]) and is_array($current[$tag])) {//If it is already an array...

                      // ...push the new element into that array.
                    $current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
                     
                      if($priority == 'tag' and $get_attributes and $attributes_data) {
                        $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                      }
                    $repeated_tag_index[$tag.'_'.$level]++;

                  } else { //If it is not an array...
                    $current[$tag] = array($current[$tag],$result); //...Make it an array using using the existing value and the new value
                    $repeated_tag_index[$tag.'_'.$level] = 1;
                      if($priority == 'tag' and $get_attributes) {
                          if(isset($current[$tag.'_attr'])) { //The attribute of the last(0th) tag must be moved as well
                             
                            $current[$tag]['0_attr'] = $current[$tag.'_attr'];
                              unset($current[$tag.'_attr']);
                          }
                         
                          if($attributes_data) {
                            $current[$tag][$repeated_tag_index[$tag.'_'.$level] . '_attr'] = $attributes_data;
                          }
                      }
                    $repeated_tag_index[$tag.'_'.$level]++; //0 and 1 index is already taken
                }
              }

          } elseif($type == 'close') { //End of tag '</tag>'
            $current = &$parent[$level-1];
          }
      }
     
      return($xml_array);
} 
endif;
if ( !function_exists('array2xml') ):
class array2xml {
	var $xml;
	function array2xml($array,$encoding='utf-8') {
		$this->xml='<?xml version="1.0" encoding="'.$encoding.'"?>';
		$this->xml.=$this->_array2xml($array);

		}
		function getXml() {
		return $this->xml;
		}
		function _array2xml($array) {
		foreach($array as $key=>$val) {
		is_numeric($key)&&$key="item id=\"$key\"";
		$xml.="<$key>";
		$xml.=is_array($val)?$this->_array2xml($val):$val;
		list($key,)=explode(' ',$key);
		$xml.="</$key>";
		}
		return $xml;
	}
}
function array2xml($ar){
	if(!is_array($ar)) return $ar;
	$ax=new array2xml($ar);
	return $ax->getXML();
}
endif;

?>