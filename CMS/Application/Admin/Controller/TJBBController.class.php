<?php
namespace Admin\Controller;
use Think\Controller;
class TJBBController extends Controller {
    public function detial(){
		$this->display();
    
    }
	public function history(){
		$this->display();
    
    }
	public function discipline(){
		$this->display();
    
    }
	public function getonline(){
		$page=I('page');	
		$rows=I('rows');
		$types=I('types');
		$searchs=I('searchs');
		$m=M('signrecord');
		$start=($page-1)*$rows;
		if($searchs==""){
			$result=$m->where("1")->
			distinct(true)->order('Record_Id desc')->limit($start,$rows)->select();	
			$row=count($result);
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));			
			$row=$m->where($arr)->count();
			$result=$m->where($arr,"1")->order($types)->
			distinct(true)->limit($start,$rows)->select();
		}
		for($i=0;$i<$rows;$i++){
			if($result["$i"]['Record_Id']){
				$result["$i"]['Record_RecordMHTsrc']=" <a href='../SSJK/userrecord.html' target='_blank'>点击查看</a>";
			}
		}	
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	
}