<?php
namespace Admin\Controller;
use Think\Controller;
class SSJKController extends Controller {
    public function detial(){
		$room=I('room');
		if($room){
			$m=M('pcmessage');
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
		$mm=M('pcmessage');
		$roomdata=$mm->distinct(true)->field('PCM_RoomName')->select();
		$this->assign('roomnames',$roomdata);
		$this->display();
    }
	public function getroomnames()
	{
			$mm=M('pcmessage');
			$roomdata=$m->distinct(true)->fileds('PCM_RoomName')->select();
			$this->ajaxReturn($data);
	}
	public function gotmathion()
	{
		$room=I('room');
		if($room){
			$m=M('pcmessage');
			$data=$m->where("PCM_RoomName='$room' and PCM_Mac is not NULL ")->order('PCM_Num')->select();
			
			$count=count($data);
			for($i=0;$i<$count;$i++){
				$m2=M('user');
				$PCM_UserNum=$data["$i"]['PCM_UserNum'];
				$data2=$m2->where("User_Num='$PCM_UserNum'")->find();
				$data["$i"]['User_Name']=$data2['User_Name'];
			}
			$this->ajaxReturn($data);
			}
	}
	public function ScreenJpg(){
		$room=I('room');
		$m=M('pcmessage');
		$data['PCM_GetNewOpera']=0;
		$res=$m->where("PCM_RoomName='$room'")->save($data);
	}
	public function ScreenLock(){
		$room=I('room');
		$m=M('pcmessage');
		$data['PCM_GetNewOpera']=1;
		$res=$m->where("PCM_RoomName='$room'")->save($data);
	}
	public function ScreenLockOpen(){
		$room=I('room');
		$m=M('pcmessage');
		$data['PCM_GetNewOpera']=2;
		$res=$m->where("PCM_RoomName='$room'")->save($data);
	}
	public function PowerOff(){
		$room=I('room');
		$m=M('pcmessage');
		$data['PCM_GetNewOpera']=3;
		$res=$m->where("PCM_RoomName='$room'")->save($data);
	}
	public function ScreenPlayOpen(){
		$room=I('room');
		$m=M('pcmessage');
		$data['PCM_GetNewOpera']=4;
		$res=$m->where("PCM_RoomName='$room'")->save($data);
	}
	public function ScreenPlayOff(){
		$room=I('room');
		$m=M('pcmessage');
		$data['PCM_GetNewOpera']=5;
		$res=$m->where("PCM_RoomName='$room'")->save($data);
	}
	public function history(){
			$this->display();
		}
	public function online(){
		$m=M('signrecord');
		$result=$m->where("TIMESTAMPDIFF(SECOND ,now(),Record_OutTime )>-10")->
			distinct(true)->order('Record_Id desc')->limit($start,$rows)->select();	
		$row=count($result);
		$this->assign('row',$row);
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
			$result=$m->where("TIMESTAMPDIFF(SECOND ,now(),Record_OutTime )>-10")->
			distinct(true)->order('Record_Id desc')->limit($start,$rows)->select();	
			$row=count($result);
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));			
			$row=$m->where($arr)->count();
			$result=$m->where($arr,"TIMESTAMPDIFF(SECOND ,now(),Record_OutTime )>-10")->order($types)->
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
	public function unonline(){
		$Modle =new \Think\Model();
		$result=$Modle->query("select * from t_user where User_Class in(  select distinct User_Class from t_user where User_Num in (select distinct Record_Num from t_signrecord where TIMESTAMPDIFF(SECOND ,now(),Record_OutTime )>-10 order by Record_Id desc) order by User_Num  desc) and User_Num not in  (select distinct Record_Num from t_signrecord where TIMESTAMPDIFF(SECOND ,now(),Record_OutTime )>-10 )");
		$row=count($result);
		$this->assign('row',$row);
		$this->display();
	}
	public function getunline()
	{
		$page=I('page');	
		$rows=I('rows');
		$types=I('types');
		$searchs=I('searchs');
		$start=($page-1)*$rows;
		$Modle =new \Think\Model();
		$result=$Modle->query("select * from t_user where User_Class in(  select distinct User_Class from t_user where User_Num in (select distinct Record_Num from t_signrecord where TIMESTAMPDIFF(SECOND ,now(),Record_OutTime )>-10 order by Record_Id desc) order by User_Num  desc) and User_Num not in  (select distinct Record_Num from t_signrecord where TIMESTAMPDIFF(SECOND ,now(),Record_OutTime )>-10 )");
		$row=count($result);
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
	}
	
	
}