<?php

class RCacher{
	private $cache_time;
	private $cache_path;
	private $category='';
	public function save($szCacheName,$str){
		if(!file_exists($this->cache_path.$this->category)){
			mkdirs($this->cache_path.$this->category);
		}
		$szFile=$this->getPath($szCacheName);
		file_put_contents($szFile,$str);
	}
	public function load($szCacheName,$timeBaseLine=null){
		global $_CONFIG;
		if( empty($_CONFIG['cache_time']) ) $_CONFIG['cache_time']=0;
		$szFile=$this->getPath($szCacheName);
		if(file_exists($szFile)){
			$mtime=filemtime($szFile);
			if($timeBaseLine){
				return $timeBaseLine>$mtime? null:$szFile;
			}else{
				/* cache time : 0 = always load cache */
				if($this->cache_time == 0 ) return $szFile;
				return ( (time()-$mtime) > $this->cache_time )? null:$szFile;
			}
		}else{
			return null;
		}
	}
	public function loadContent($szCacheName,$timeBaseLine=null){
		$f=$this->load($szCacheName,$timeBaseLine);
		if($f) return file_get_contents($f);
		else return null;
	}
	public function getPath($szCacheName){
		return $this->cache_path.$this->category.md5($szCacheName).'.php';
	}
	public function RCacher($cate=null,$time=null){
		global $_CONFIG;
		$this->cache_path=$_CONFIG['path_cache'];
		if($cate) $this->category=$cate.'/';
		if(!is_numeric($time)) $this->cache_time=$_CONFIG['cache_time'];
		else $this->cache_time=$time;
	}
	public function setCategory($szCate){
		$this->category=$szCate.'/';
		return true;
	}
	public function setCachePath($path){
		global $_CONFIG;
		if(substr($path,strlen($path)-1,1)!='/') $path.='/';
		if(!file_exists($path)) $this->cache_path=$_CONFIG['path_cache'];
		else $this->cache_path=$path;
	}
	public function setCacheTime($time){
		global $_CONFIG;
		if(!is_numeric($time)) $this->cache_time=$_CONFIG['cache_time'];
		else $this->cache_time=$time;
	}
}

?>