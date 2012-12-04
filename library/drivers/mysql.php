<?php
class DriverMysql{
	private $m_connect=null;
	private $m_result=null;
	private $m_errors=array();
	private $m_database=null;
	public $connected=false;
	private $errorMsg=null;
	function DriverMysql($param){
		global $_CONFIG;
		if(array_key_exists('db_host',$param)){
			$this->m_connect=mysql_connect($param['db_host'],$param['db_username'],$param['db_password']);
			if(array_key_exists('db_database',$param)) $this->selectDatabase($param['db_database']);
		}else{
			$this->m_connect=mysql_connect($param['host'],$param['username'],$param['password']);
			if(array_key_exists('database',$param)) $this->selectDatabase($param['database']);
		}
		if(mysql_errno($this->m_connect)){
			$this->errorMsg=mysql_error($this->m_connect);
			$this->connected=false;
		}else{
			$this->connected=true;
			if(array_key_exists('charset',$_CONFIG)){
				mysql_set_charset($_CONFIG['charset'],$this->m_connect);
			}
		}
	}
	function selectDatabase($name){
		$m_database=$name;
		mysql_select_db($name,$this->m_connect);
	}
	function query($szSql,$table=null){
		if(!$this->m_connect || !$this->connected) return false;
		$ret=true;
		if(is_array($table)) $szSql=fix_sql_by_table($szSql);
		try{
			$this->m_result=mysql_query($szSql,$this->m_connect);
		}catch(Exception $e){
			RError::Log($e->getMessage());
			$ret=false;
		}
		if(mysql_errno($this->m_connect) && !in_array(mysql_errno($this->m_connect),$this->m_errors)){
			array_push($this->m_errors,mysql_errno($this->m_connect));
			RError::Log('Mysql Warning #'.mysql_errno($this->m_connect).' : '.mysql_error($this->m_connect));
		}
		return $ret;
	}
	function fetch(){
		if(!$this->m_result) return null;
		return mysql_fetch_array($this->m_result);
	}
	function close(){
		$this->connected=false;
		if($this->m_connect){
			mysql_close($this->m_connect);
			$this->m_connect=null;
		}
	}
	function select($table,$condition='',$fields=null){
		if(!is_array($table)) return false;
		if($condition==null) $condition='';
		else $condition=fix_sql_by_table($table,$condition);
		$szFields=fix_fields_by_table($table,$fields);
		$sql='select '.$szFields.' from '.$table['real'].' '.$condition;
		return $this->query($sql);
	}
	function insert($table,&$id=null){ 
		if(!is_array($table)) return false;
		
		$arCol=array();
		$arVal=array();
		$szTable=$table['real'];
		foreach($table['members'] as $k=>$v){
				if($v['type']=='auto') continue;
				array_push($arCol,$v['real']);
				array_push($arVal,$v['strtype']? '\''.addslashes($v['value']).'\'':$v['value'] );
		}
		$sql='INSERT INTO '.$szTable.' ('.implode(',',$arCol).') VALUES ('.implode(',',$arVal).')';
		$ret=$this->query($sql);
		if($id){
			$sql='SELECT MAX('.$id.') as ct FROM '.$szTable;
			if($this->query($sql)){
				$rs=$this->Fetch();
				$id=$rs->ct;
			}else{
				$id=null;
			}
		}
		return $ret;
	}
	
	function delete($table){
		if(!is_array($table)) return false;
		$szTable=$table['real'];
		$szKey=$table['key'];
		$szKeyVal=$table['members'][$szKey]['strtype']? '\''.addslashes($table['members'][$szKey]['value']).'\'':$table['members'][$szKey]['value'];
		return $this->query('delete from '.$szTable.' where '.$table['members'][$szKey]['real'].'='.$szKeyVal);
	}
	function update($table,$cols){
		if(!is_array($table)) return false;
		$arSql=array();
		$szTable=$table['real'];
		$szKey=$table['key'];
		$szKeyVal=$table['members'][$szKey]['strtype']? '\''.addslashes($table['members'][$szKey]['value']).'\'':$table['members'][$szKey]['value'];
		foreach($cols as $k=>$v){
			if(!array_key_exists($k,$table['members']) || $table['members'][$k]['type']=='auto') continue;
			$key=$table['members'][$k]['real'];
			$val=$table['members'][$k]['strtype']? '\''.addslashes($table['members'][$k]['value']).'\'':$table['members'][$k]['value'];
			array_push($arSql,$key.'='.$val);
		}
		
		$szSql='UPDATE '.$szTable.' SET '.implode(',',$arSql).' where '.$table['members'][$szKey]['real'].'='.$szKeyVal;
		return $this->query($szSql);
	}
	function error(){
		
	}
	
	function RecordCount(){
		if($this->m_result){
			return mysql_num_rows($this->m_result);
		}else return false;
	}
	function FieldCount(){
		if(!$this->m_result) return false;
		return $this->m_result->Fields->Count;
	}
	function FieldName($index){
		if(!$this->m_result) return false;
		if($index>=$this->m_result->Fields->Count) return false;
		return $this->m_result->Fields[$index]->Name;
	}
	function FieldValue($index){
		if(!$this->m_result) return false;
		if($index>=$this->m_result->Fields->Count) return false;
		return $this->m_result->Fields[$index]->Value;
	}
	function FieldType($index){
		if(!$this->m_result) return false;
		if($index>=$this->m_result->Fields->Count) return false;
		return is_string($this->m_result->Fields[$index]->Value)?'string':'int';
	}
	function GetLastError(){
		if($this->errorMsg) return $this->errorMsg;
	}
	function Seek($offset){
		if(!$this->m_result) return false;
		return mysql_data_seek($this->m_result,$offset);
	}
	function CreateTable($name,$hashType,$key,$charset=null){
		if(!array_key_exists($key,$hashType)) return false;		
		$sql="CREATE TABLE `$name` (\n";
		foreach ($hashType as $k=>$val){
			$val=$this->ConvertType($val);
			$sql.=' `'.$k.'` '.$val." ,\n";
		}
		$sql.="PRIMARY KEY (`$key`)";
		$sql.=")  ENGINE=MyISAM; ";
		return $this->query($sql);
	}
	function DropTable($name){
		return $this->query('drop table '.$name);
	}
	function AlterTable($table,$field,$type){
		$type=$this->ConvertType($type);
		if(!$this->query("ALTER TABLE $table ADD $field $type")) $this->query("ALTER TABLE $table ALTER $field $type");
	}
	private function ConvertType($type){
		if(strtolower($type)=='bool'){
				return 'bool';
		}else if(strtolower($type)=='text'){
				return 'text';
		}else if(strtolower($type)=='int'){
				return 'int(11)';
		}else if(strtolower($type)=='double'){
				return $type;
		}else if(strtolower($type)=='array'){
				return 'text';
		}else if(preg_match('/char\(\d+\)/',$type)){
				return $type;
		}else if(preg_match('/varchar\(\d+\)/',$type)){
				return $type;
		}else if(strtolower($type)=='auto'){
				return 'int(11) auto_increment';
		}else return 'text';
	}
}
?>
