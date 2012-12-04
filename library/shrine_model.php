<?php
class RModel{
	/* public functions */
	public static $RegVals=array();
	public static function Reg($name,$value,$isNumber=false){
		return RModel::RegisterSafeVar($name,$value,$isNumber);
	}
	public static function RegisterSafeVar($name,$value,$isNumber=false){
		if($isNumber){
			if(!is_numeric($value)){
				$value=preg_replace('/\D/','',$value);
			}
		}else{
			$value=str_replace('"','""',$value);
		}
		RModel::$RegVals[$name]=$value;
	}
	public static function ClearRegisterSafeVars(){
		RModel::$RegVals = array();
	}
	public static function Exists($name){
		global $_modPath,$_modName;
		$ar=explode('.',$name);
		if(count($ar)==1){
			$_modPath=SHRINE_PATH_MODELS.$ar[0].'.php';
			$_modName=$ar[0];
		}else{
			$_modPath=SHRINE_PATH_PACKS.$ar[0].'/models/'.$ar[1].'.php';
			$_modName=$ar[1];
		}
		return file_exists($_modPath);
	}
	public static function RebuildTable($name){
		if(!$model=RModel::CreateModel($name)) return false;
		RDatabase::DropTable($model->_table);
		return RModel::BuildTable($name);
		
	}
	public static function BuildTable($name){
		if(!$model=RModel::CreateModel($name)) return false;
		$aryFields=array();
		foreach ($model->_member as $k=>$v){
			$aryFields[$model->_field[$k]]=$model->_typeDb[$k];
		}
		if(RDatabase::CreateTable($model->_table,$aryFields,$model->_key)){
			return true;
		}else{
			$table=$model->_table;
			foreach ($model->_member as $key=>$val){
				if(array_key_exists($key,$model->_type)){
					$type=$model->_typeDb[$key];
					RDatabase::AlterTable($table,$model->_field[$key],$type);
				}
			}
			return false;
		}
	}
	public static function LoadModel($szModel){
		global $_modPath,$_modName;
		if(!RModel::Exists($szModel)) return null;
		$ar=explode(',',$_modName);
		if(count($ar)==1){
			$szClass=$ar[0];
			$szClass[0]=strtoupper($szClass[0]);
			$szClass='Model'.$szClass;
		}else{
			$szClass=$ar[1];
			$szClass[0]=strtoupper($szClass[0]);
			$szClass=$ar[0];
			$szClass[0]='Model'.strtoupper($szClass[0]);
		}
		if(class_exists($szClass)) return null;
		try{
			@include_once(RShrineCore::GetCache($_modPath,'model'));
		}catch(exception $e){
			return null;
		}
		return true;
	}
	public static function CreateModel($szModel){ 
		global $_modPath,$_modName;
		if(!RModel::Exists($szModel)) return null;
		$model=null;
		$ar=explode(',',$_modName);
		if(count($ar)==1){
			$szClass=$ar[0];
			$szClass[0]=strtoupper($szClass[0]);
			$szClass='Model'.$szClass;
		}else{
			$szClass=$ar[1];
			$szClass[0]=strtoupper($szClass[0]);
			$szClass=$ar[0];
			$szClass[0]='Model'.strtoupper($szClass[0]);
		}
		
		try{
			@include_once(RShrineCore::GetCache($_modPath,'model'));
			eval('$model=new '.$szClass.'();');
		}catch(exception $e){
			return null;
		}
		return $model;
	}
	/**
	 * 
	 * @param RModel $model
	 * @return 
	 */
	public static function SaveModel(&$model){
		if(!$model) return false;
		$arCol=array();
		if($model->_insert){
			//save as new model 
			$id=null;
			$ret=RDatabase::Insert($model->_table,$id);
			if($id) $model->_table['members'][$model->_table['key']]['value']=$id;
			return $ret;
		}else{
			//just update a record
			if(count($model->_modify)==0) return false;
			for($i=0;$i<count($model->_modify);$i++){
				$k=$model->_modify[$i];
				if(!in_array($k,$model->_table['members'])) return false;
				$arCol[$k]=$model->_table['members'][$k]['value'];
			}
			return RDatabase::Update($model->_table,$arCol);
		}
	}
	
	public static function FindOneModel($name,$condition=null,$fields=null){
		if(!$model=RModel::CreateModel($name)) return null;
		$model->_insert=false;
		RDatabase::Select($model->_table,$condition,$fields);
		if($row=RDatabase::Fetch($model->_table)){ 
			foreach ($model->_table['members'] as $k=>$v){
				if(array_key_exists($v['real'],$row)){
					$model->_table['members'][$k]['value']=$row[$v['real']];
				}
			}
			return $model;
		}else{
			return null;
		}
	}
	public static function Count($name,$condition=null){
		
		if(!$model=RModel::CreateModel($name)) return null;
		$model->_insert=false;
		RDatabase::Query($model->_table,'select count(*) as cnum from'.$table['name']);
		$row=RDatabase::Fetch($model->_table);
		if(array_key_exists('cnum',$row)) return $row['cnum'];
		else return 0;
	}
	public static function FindModels($name,$condition=null,$arFields=null,$nLimit=null,$nStart=null,&$pCountOut='NULL'){
		
		if(!$model=RModel::CreateModel($name)) return null;
		$model->_insert=false;
		$szTable=$model->_table['name'];
		if(!is_array($arFields)) $arFields=explode(',',$arFields);
		RDatabase::Select($model->_table,$condition,$arFields);
		if($pCountOut!='NULL') $pCountOut=RDatabase::RecordCount($model->_table);
		$aryRet=array();
		
		if($nStart){
			if($nStart<RDatabase::RecordCount()) RDatabase::Seek($nStart);
			else return $aryRet;
		}
		if(!$nLimit){
			
			while ($rs=RDatabase::Fetch($szTable)) {
				$tmp=clone $model;
				foreach ($tmp->_table['members'] as $key=>$val){
					$real=$tmp->_table['members'][$key]['real'];
					if(array_key_exists($real,$rs)) $tmp->$key=$rs[$real];
				}
				array_push($aryRet,$tmp);
			}
		}else{
			for($i=0;$i<$nLimit;$i++){
				if($rs=RDatabase::Fetch($szTable)){
					$tmp=clone $model;
					foreach ($tmp->_table['members'] as $key=>$val){
						$real=$tmp->_table['members'][$key]['real'];
						if(array_key_exists($real,$rs)) $tmp->$key=$rs[$real];
					}
					array_push($aryRet,$tmp);
				}
			}
		}
		
		return $aryRet;
	}
	public static function DeleteModels($name,$condition){
		if(!$model=RModel::CreateModel($name)) return false;
		foreach(RModel::$RegVals as $k=>$v){
			$condition=str_replace('{$'.$k.'}',$v,$condition);
		}
		$aryCnd=SplitStringByQuotes($condition);
		for($i=0;$i<count($aryCnd);$i+=2){
			foreach ($model->_field as $key=>$val){
				$aryCnd[$i]=str_replace($key,$val,$aryCnd[$i]);
				$aryCnd[$i]=str_replace('true','1',$aryCnd[$i]);
				$aryCnd[$i]=str_replace('false','0',$aryCnd[$i]);
			}
		}
		$condition='';for($i=0;$i<count($aryCnd);$i++) $condition.=$aryCnd[$i];
		return RDatabase::Delete($model->_table,$condition);
	}
	public static function DeleteOneModel(&$model){
		$table=$model->_table;
		$model->_insert=true;
		return RDatabase::Delete($table);
	}
	public static function GetForeignModels($szModel){
		
	}
	/* the object */
	public $_table=null;
	public  $_insert=true;
	public 	$_modify=array();
	public $active=false;
	public function __construct(){
		if(isset($this->table) && RTable::Exists($this->table)){
			$this->_table=RTable::Load($this->table);
			$this->active = true;
			return true;
		}else{
			return false;
		}
	}
	public function __set($key,$val){
		if(!$this->_table) return null;
		if(array_key_exists($key,$this->_table['members'])){
			if(!in_array($key,$this->_modify)) array_push($this->_modify,$key);
			$this->_table['members'][$key]['value']=$val;
		}else{
			$this->$key=$val;
		}
		/*
		if($this->_typeDb[$key]=='array'){
			if(is_array($val)){
				$tmp='';
				for($i=0;$i<count($val);$i++){
					$got=str_replace(',','##SHRINE_COMMA##',$val[$i]);
					$got=str_replace('"','""',$got);
					$tmp.=$got;
					if($i!=count($val)-1) $tmp.=',';
				}
				$val=$tmp;
			}else{
				$val=strval($val);
				$val=str_replace('"','""',$val);
			}
		}else{
			$val=strval($val);
			$val=str_replace('"','""',$val);
		}
		*/
	}
	public function __get($key){
		if(!$this->_table) return null;
		if(array_key_exists($key,$this->_table['members'])){
			return $this->_table['members'][$key]['value'];
		}else{
			return $this->$key;
		}
		/*
		if($this->_typeDb[$key]=='array'){
				if(substr($ret,0,1)==',') $ret=substr($ret,1,strlen($ret)-1);
				if(substr($ret,strlen($ret)-1,1)==',') $ret=substr($ret,0,strlen($ret)-1);
				$bacAry=split(',',$ret);
				$retAry=array();
				for($i=0;$i<count($bacAry);$i++){
					if($bacAry[$i]=='') continue;
					array_push($retAry,str_replace('##SHRINE_COMMA##',',',$bacAry[$i]));
				}
				return $retAry;
			} 
		 
		 */
		
	}
	public function save(){
		return RModel::SaveModel($this);
	}
	public function remove(){
		return RModel::DeleteOneModel($this);
	}
	public function delete(){
		return $this->remove();
	}
	public function foreign($szModel){
		return RModel::GetForeignModel($this,$szModel);
	}
}
?>