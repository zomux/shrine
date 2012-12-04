<?php
	class RTable{
		/*** global functions ***/
		public static function Path($table){
			global $_modName;
			$ar=explode('.',$table);
			if(count($ar)==1){
				// local table
				$_modName = $ar[0];
				return SHRINE_PATH_TABLES.$ar[0].'.php';
			}else{
				//in package
				$_modName = $ar[1];
				return SHRINE_PATH_PACKS.$ar[0].'/models/tables/'.$ar[1].'.php';
			}
		}
		public static function Exists($table){
			return file_exists(RTable::Path($table));
		}
		public static function Load($table){
			if(RTable::Exists($table)){
				return unserialize( file_get_contents(RShrineCore::GetCache(RTable::Path($table),'table')) );
				
			}
			return false;
		}
		/*** objective ***/
		private $_table=null;
		public $active=false;
		public function RTable($szTable){
			$this->_table=RTable::Load($szTable);
			if($this->_table) $this->active=true;
		}
		public function query(){
			
		}
		public function fetch(){
			
		}
		public function select(){
			
		}
		
	}
	
	
?>