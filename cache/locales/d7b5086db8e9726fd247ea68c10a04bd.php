<?php
class AppBlogcdPoll{
	public $_CONFIG=array(
		'template_engine'=>'comsenz'
	);
	private $listPolls=array(
		'1'=>array(
			'title'=> 'USA',
			'count'=> 3
		),
		'2'=>array(
			'title'=> 'Africa Countries',
			'count'=> 0
		),
		'3'=>array(
			'title'=> 'China',
			'count'=> 5
		),
		'4'=>array(
			'title'=> 'Japan',
			'count'=> 2
		),
		'5'=>array(
			'title'=> 'Europe & Australia',
			'count'=> 1
		)
	);
	private $titlePoll='Where r u come from?';
	public function main(){
		/* load setting or init  */
		$list=RSetting::Load('list_polls');
		if(!$list){
			$list=$this->listPolls;
			RSetting::Save('list_polls',$list);
		}
		$this->refreshView($list);
		return array_keys($list);
	}
	public function refreshView($list){
		global $list_poll,$title_poll,$need_submit;
		$title_poll = $this->titlePoll;
		
		$list_poll=$this->makeRate($list);
		
		$arIpPolled=RSetting::Load('list_ip');
		if(!$arIpPolled) $arIpPolled=array();
		if(in_array($_SERVER['REMOTE_ADDR'],$arIpPolled)) $need_submit=false;
		else $need_submit=true;
		RView::Clear();
		RView::LoadView('default');
	}
	
	public function makeRate($list){
		$countAll=0;
		foreach( $list as $k=>$v ){
			
			$countAll+=$v['count'];
		}
		foreach( $list as $k=>$v ){
			if($countAll == 0) $list[$k]['rate']=0;
			else $list[$k]['rate']=intval($v['count']*100/$countAll);
		}
		return $list;
		
	}
	public function poll($id){
		if(!is_numeric($id)) return false;
		$arIpPolled=RSetting::Load('list_ip');
		if(!$arIpPolled) $arIpPolled=array();
		$ip=$_SERVER['REMOTE_ADDR'];
		if(in_array($ip,$arIpPolled)){
			/*polled*/
			return false;
		}else{
			$list=RSetting::Load('list_polls');
			if(array_key_exists($id,$list)){
				/* update the list of poll */
				$list[$id]['count'] =$list[$id]['count'] +1;
				RSetting::Save('list_polls',$list);
				/* update the list of ip */
				array_push($arIpPolled,$ip);
				RSetting::Save('list_ip',$arIpPolled);
				/* refresh de view */
				$this->refreshView($list);
				return true;
			}else{
				return false;
			}
			return true;
		}
	}
}
?>