<?php
namespace Admin\Controller;
use Think\Controller;
class WDKCController extends Controller {
    public function files(){
		$this->display();
    
    }
	public function getdownload(){
		$page=I('page');	
		$rows=I('rows');
		$types=I('types');
		$searchs=I('searchs');
		$m=M('file');
		$start=($page-1)*$rows;
		if($searchs==""){
			$arr["File_Ownner"]=session('name');	
			$row=$m->where($arr)->count();
			$result=$m->where($arr)->order('File_Time desc')->limit($start,$rows)->select();	
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));
			$arr["File_Ownner"]=session('name');			
			$row=$m->where($arr)->count();
			$result=$m->where($arr)->order($types)->limit($start,$rows)->select();
		}
		for($i=0;$i<$rows;$i++){
			if($result["$i"]['File_Name']){		
			$result["$i"]['File_Name']=$result["$i"]['File_Name']." <a href=".__ROOT__.'/Public/Upload/'.$result["$i"]['File_Path'].">下载</a>";
			}
		}	
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	public function upload(){
		$other=I('other');
		$date=date(ymdhis).rand(1000,9999);
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 0 ;// 设置附件上传大小
		$upload->rootPath = THINK_PATH; // 设置附件上传根目录
		$upload->autoSub = false;
		$upload->replace = true;
		$upload->savePath = '../Public/Upload/'; // 设置附件上传（子）目录
		$upload->saveName = $date;
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功
				$data['File_Name']=$info['file']['name'];
				$data['File_Path']=$info['file']['savename'];
				$data['File_Ownner']=session('name');
				$data['File_Time']=date("Y-m-d  H:i:s");
				$data['File_Other']=$other;
				$m=M('file');
				$m->add($data);
				$data1['Notice_Title']=session('name').'上传了'.$info['file']['name'];
				$data1['Notice_Sender']=session('name');
				$data1['Notice_Content']=$other;
				$data1['Notice_Time']=date("Y-m-d  H:i:s");
				$m1=M('notice');
				$m1->add($data1);
				$m2=M('user');
				$m2->where('1')->setField('User_HasNew','1');
			
			$this->redirect('files',array('info'=>1));
		}		
    }
	public function delete(){
		$id=I('id');
		$m=M('file');
		$result=$m->Where("File_Id='$id'")->delete();
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
}