<?php

class RDatabase{
	public static $STACK_DRIVERS=array();
	public static function LoadDriver($driver,$param){
		switch($driver){
			case 'mysql':
				require_once('drivers/mysql.php');
				return new DriverMysql($param);
		}
	}
	public static function LoadDriverToTable(&$table){
		global $_CONFIG;
		if(array_key_exists($table['name'],RDatabase::$STACK_DRIVERS)){
			$table['driver']=RDatabase::$STACK_DRIVERS[$table['name']];
			return true;
		}
		$param=$table['connection'];
		if(!$table['connection']['host'] && array_key_exists('db_host',$_CONFIG)) $param['host']=$_CONFIG['db_host'];
		if(!$table['connection']['driver'] && array_key_exists('db_driver',$_CONFIG)) $param['driver']=$_CONFIG['db_driver'];
		if(!$table['connection']['database'] && array_key_exists('db_database',$_CONFIG)) $param['database']=$_CONFIG['db_database'];
		if(!$table['connection']['username'] && array_key_exists('db_username',$_CONFIG)) $param['username']=$_CONFIG['db_username'];
		if(!$table['connection']['password'] && array_key_exists('db_password',$_CONFIG)) $param['password']=$_CONFIG['db_password'];
		if(!$table['connection']['host'] && array_key_exists('db_port',$_CONFIG)) $param['port']=$_CONFIG['db_port'];
		$table['driver']=RDatabase::LoadDriver($param['driver'],$param);
		RDatabase::$STACK_DRIVERS[$table['name']]=$table['driver'];
		return true;
	}
	public static function Query(&$table=null,$szSql){
		global $_CONFIG,$_shrine_db;
		if(!$table){
			if(empty($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
			return $_shrine_db->query($szSql,$table);
		}else{
			if(!$table['driver']) RDatabase::LoadDriverToTable($table);
			return $table['driver']->query($szSql,$table);
		}
		
	}
	public static function Fetch(&$table=null){
		global $_CONFIG,$_shrine_db;
		if(!$table){
			if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
			return $_shrine_db->fetch();
		}else if(is_string($table)){
			if(array_key_exists($table,RDatabase::$STACK_DRIVERS)){
				return RDatabase::$STACK_DRIVERS[$table]->fetch();
			}else{
				return null;
			}
		}else{
			if(!$table['driver']) RDatabase::LoadDriverToTable($table);
			return $table['driver']->fetch();
		}
		
	}
	public static function Select(&$table,$column,$condition=''){
		global $_CONFIG,$_shrine_db;
		if(!$table['driver']) RDatabase::LoadDriverToTable($table);
		return $table['driver']->select($table,$column,$condition);

		
	}
	public static function Insert(&$table,&$id=null){
		global $_CONFIG,$_shrine_db;
		if(!$table['driver']) RDatabase::LoadDriverToTable($table);
		return $table['driver']->insert($table,$id);
	}
	public static function Delete(&$table){
		global $_CONFIG,$_shrine_db;
		if(!$table['driver']) RDatabase::LoadDriverToTable($table);
		return $table['driver']->delete($table);
	}
	public static function Update(&$table,$cols){
		global $_CONFIG,$_shrine_db;
		if(!$table['driver']) RDatabase::LoadDriverToTable($table);
		return $_shrine_db->update($table,$cols);
	}
	public static function RecordCount(&$table){
		global $_CONFIG,$_shrine_db;
		if(!$table['driver']) RDatabase::LoadDriverToTable($table);
		return $_shrine_db->RecordCount($table);
	}
	public static function FieldCount(){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->FieldCount();
	}
	public static function FieldName($index){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->FieldName($index);
	}
	function FieldValue($index){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->FieldValue($index);
	}
	public static function FieldType($index){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->FieldType($index);
	}
	public static function GetLastError(){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->GetLastError();
	}
	public static function Seek($offset){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->Seek($offset);
	}
	public static function CreateTable($name,$hashType,$key,$charset='utf8'){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->CreateTable($name,$hashType,$key,$charset);
	}
	public static function DropTable($name){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->DropTable($name);
	}
	public static function AlterTable($table,$field,$type){
		global $_CONFIG,$_shrine_db;
		if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
		return $_shrine_db->AlterTable($table,$field,$type);
	}
	public static function Error(&$table=null){
		global $_CONFIG,$_shrine_db;
		if(!$table){
			if(!isset($_shrine_db)) $_shrine_db=RDatabase::LoadDriver($_CONFIG['db_driver'],$_CONFIG);
			return $_shrine_db->error();
			
		}else{
			if(!$table['driver']) RDatabase::LoadDriverToTable($table);
			return $table['driver']->error();
			
		}
		

	}
}
?>