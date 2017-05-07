<?php
namespace Admin\Controller;
use Think\Controller;
class XXGLController extends Controller {
	public function notice(){
		date_default_timezone_set("Asia/Beijing");
		$date=date("Y-m-d  H:i:s");
		$this->assign('name',session('name'));
		$this->assign('date',$date);
		$this->display();
    }
	public function getnotice(){
		$page=I('page');	
		$rows=I('rows');
		$m=M('notice');
		$start=($page-1)*$rows;
		$result=$m->order('Notice_Time DESC')->limit("$start,$rows")->select();
		$row=$m->count();				
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	public function notice_delete(){
		$id=I('id');
		$m=M('notice');
		$result=$m->Where("Notice_Id='$id'")->delete();
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function notice_save(){
		$arr['Notice_Title']=I('title');
		$arr['Notice_Content']=I('content');
		$arr['Notice_Time']=I('time');
		$arr['Notice_Sender']=I('name');
		$m=M('notice');
		$result=$m->add($arr);
        if($result){
			$m=M('user');
			$m->where('1')->setField('User_HasNew','1');
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function notice_save1(){
		$id=I('id');
		$arr['Notice_Title']=I('title');
		$arr['Notice_Content']=I('content');
		$arr['Notice_Time']=I('time');
		$arr['Notice_Sender']=I('name');
		$m=M('notice');
		$result=$m->where("Notice_Id='$id'")->save($arr);
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function worklog(){
		date_default_timezone_set("Asia/Beijing");
		$date=date("Y-m-d  H:i:s");
		$this->assign('date',$date);
		$this->display();
    }
	public function getworklog(){
		$page=I('page');	
		$rows=I('rows');
		$m=M('sturecord');
		$start=($page-1)*$rows;
		$num=session('num');
		$result=$m->where("Stre_UserNum='$num'")->order('Stre_Time DESC')->limit("$start,$rows")->select();
		$row=$m->where("Stre_UserNum='$num'")->count();				
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	public function worklog_save(){
		$arr['Stre_Title']=I('title');
		$arr['Stre_Content']=I('content');
		$arr['Stre_Time']=I('time');
		$arr['Stre_UserName']=session('name');
		$arr['Stre_UserNum']=session('num');
		$m=M('sturecord');
		$result=$m->add($arr);
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function reply(){
		$this->display();
    }
	public function getmessage(){
		$page=I('page');	
		$rows=I('rows');
		$m=M('message');
		$start=($page-1)*$rows;
		$result=$m->order('Message_Time DESC')->limit("$start,$rows")->select();
		$row=$m->count();				
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	
	
}