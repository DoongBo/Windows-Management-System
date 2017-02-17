<?php
namespace Admin\Controller;
use Think\Controller;
class JFGLController extends Controller {
    public function detial(){
		$room=I('room');
		if($room){
			$m=M('pcmessage');
            if($room=='所有')
            {
            $data=$m->order('PCM_Num')->select();
            }
            else
			$data=$m->where("PCM_RoomName='$room'")->order('PCM_Num')->select();
			$count=count($data);
			for($i=0;$i<$count;$i++){
				$m2=M('user');
				$PCM_UserNum=$data["$i"]['PCM_UserNum'];
				$data2=$m2->where("User_Num='$PCM_UserNum'")->find();
				$data["$i"]['User_Name']=$data2['User_Name'];
			}
			
			$this->assign('room',$room);
			$this->assign('list',$data);
			}
		$this->display();
    }
	public function ScreenJpg(){
		$room=I('room');
		$m=M('pcmessage');
		$data['PCM_GetNewOpera']=0;
		$res=$m->where("PCM_RoomName='$room'")->save($data);
		if($res){
			echo 1;
		}else{
			echo 0;
		}
	}
	public function history(){
			$this->display();
		}
	public function gethistory(){
		$page=I('page');	
		$rows=I('rows');
		$types=I('types');
		$searchs=I('searchs');
		$m=M('signrecord');
		$start=($page-1)*$rows;
		if($searchs==""){
			$row=$m->count();
			$result=$m->order($types)->limit($start,$rows)->select();	
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));			
			$row=$m->where($arr)->count();
			$result=$m->where($arr)->order($types)->limit($start,$rows)->select();
		}
		for($i=0;$i<$rows;$i++){
			if($result["$i"]['Record_RecordMHTsrc']){
				$result["$i"]['Record_RecordMHTsrc']=" <a href=".__ROOT__.'/Public/Upload/'.$result["$i"]['Record_RecordMHTsrc'].">点击查看</a>";
			}
		}	
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	
}