<?php
class RXML 
{
	private $parser; 
	private $tags; 
	private $on; 
	private $root; 
	public $tag = array(); 
	function RXML($filename,$root) 
	{
	if(!file_exists($filename)) return false;
	$this->root = $root; 
	$this->parser = xml_parser_create();
	xml_set_object($this->parser,$this);
	xml_set_element_handler($this->parser,"tag_on","tag_off");
	xml_set_character_data_handler($this->parser,"getdata"); 
	xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING, 0); 
	
	
	if(!$c=file_get_contents($filename)){
		return false;
	}
	
	$this->parse($c);
	
	}
	
	private  function parse($data)
	{
	xml_parse($this->parser,$data); 
	}
	
	private function tag_on($parser,$tag,$attributes){
	$this->on = true; 
	$this->tags = $tag;
	}
	
	private function tag_off($parser,$tag) 
	{
	$this->on = false; 
	}
	
	private function getdata($parser,$cdata)
	{
	if($this->on && $this->tags!=$this->root)
	{
	$this->tag[$this->tags]=trim($cdata);
	
	}
	}
	private function check($str)
	{
	if( strlen($str)<1 )
	return false;
	else
	return $str;
	}
	public function Save($filename)
	{
	$c='';
	$c.='<'.$this->root.">\r\n";
	for( reset($this->tag);$i=key($this->tag);next($this->tag))
	{
	$c.= "<".$i.">".$this->check($this->tag[$i])."</".$i.">\r\n";
	
	} 
	$c.="</".$this->root.">\r\n";
	$fp = fopen( $filename , "w" );
	if(substr($filename,strlen($filename)-4,4)=='.php') fwrite($fp,'<?php exit; ?>'."\r\n");
	fwrite($fp,$c);
	fclose($fp);
	}
};

?>