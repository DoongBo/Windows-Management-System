<?php
namespace Admin\Controller;
use Think\Controller;
class GJQXController extends Controller {
    public function room(){
		$this->display();
    }
	public function getpcmessage(){
		$page=I('page');	
		$rows=I('rows');
		$types=I('types');
		$searchs=I('searchs');
		$m=M('pcmessage');
		$start=($page-1)*$rows;
		if($searchs==""){
			$row=$m->count();
			$arr['PCM_Mac']=array('neq','');
			$result=$m->where($arr)->order('PCM_Num')->limit($start,$rows)->select();	
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));
			$arr['PCM_Mac']=array('neq','');
			$row=$m->where($arr)->count();
			$result=$m->where($arr)->order($types)->limit($start,$rows)->select();
		}	
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	public function pcsave(){
		$arr['PCM_Num']=I('PCM_Num');
		$arr['PCM_RoomName']=I('PCM_RoomName');
		$arr['PCM_Mac']=I('PCM_Mac');
		$PCM_Id=I('PCM_Id');
		$m=M('pcmessage');
		$result=$m->where("PCM_Id='$PCM_Id'")->save($arr);
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function pcdelete(){
		$PCM_Id=I('PCM_Id');
		$arr['PCM_Mac']='';
		$m=M('pcmessage');
		$result=$m->Where("PCM_Id='$PCM_Id'")->save($arr);
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function student(){
		$this->display();
    }
	public function getstumessage(){
		$page=I('page');	
		$rows=I('rows');
		$types=I('types');
		$searchs=I('searchs');
		$m=M('user');
		$start=($page-1)*$rows;
		if($searchs==""){
			$row=$m->count();
			$result=$m->order($types)->limit($start,$rows)->select();	
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));			
			$row=$m->where($arr)->count();
			$result=$m->where($arr)->order($types)->limit($start,$rows)->select();
		}	
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	public function stusave(){
		$User_Num=I('User_Num');
		$arr['User_Name']=I('User_Name');
		$arr['User_Dept']=I('User_Dept');
		$arr['User_Class']=I('User_Class');
		$m=M('user');
		$result=$m->where("User_Num='$User_Num'")->save($arr);
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function stusave1(){
		$User_Num=I('User_Num');
		$arr['User_Num']=I('User_Num');
		$arr['User_Name']=I('User_Name');
		$arr['User_Dept']=I('User_Dept');
		$arr['User_Class']=I('User_Class');
		$m=M('user');
		$res=$m->where("User_Num='$User_Num'")->find();
		if($res){
			$this->ajaxReturn(2);
		}else{
			$result=$m->add($arr);
			if($result){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn($result);          
			}
		}
    }
	public function studelete(){
		$User_Num=I('User_Num');
		$m=M('user');
		$result=$m->Where("User_Num='$User_Num'")->delete();
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function stuimport(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 0 ;// 设置附件上传大小
		$upload->exts = array('xls');// 设置附件上传类型
		$upload->rootPath = THINK_PATH; // 设置附件上传根目录
		$upload->autoSub = false;
		$upload->replace = true;
		$upload->savePath = '../Public/Upload/'; // 设置附件上传（子）目录
		$upload->saveName = "22";
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功
			$m=M('user');
			Vendor('PHPExcel'); 
			$objPHPExcel = new \PHPExcel();
            $file_name= "Public/Upload/22.xls";
            $objReader = new \PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($file_name);
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
          	for($i=2;$i<=$highestRow;$i++){
               	$arr['User_Num'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();          
				$arr['User_Name'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
				$arr['User_Dept'] = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
				$arr['User_Class'] = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
				$num=$arr['User_Num'];
				$res=$m->where("User_Num='$num'")->find();
				if($res){
					$m->where("User_Num='$num'")->save($arr);
				}else{
					$m->add($arr);
				}			
            }
			$this->success('导入成功');
			
		}				
    }
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
			$row=$m->count();
			$result=$m->order('File_Time desc')->limit($start,$rows)->select();	
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));			
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
	public function fileupload(){
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
	public function teacher(){
		$this->display();
    }
	public function getteamessage(){
		$page=I('page');	
		$rows=I('rows');
		$types=I('types');
		$searchs=I('searchs');
		$m=M('manager');
		$start=($page-1)*$rows;
		if($searchs==""){
			$row=$m->where("Mana_Type='授课教师'")->count();
			$result=$m->where("Mana_Type='授课教师'")->order($types)->limit($start,$rows)->select();	
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));
			$arr["Mana_Type"]='授课教师'	;		
			$row=$m->where($arr)->count();
			$result=$m->where($arr)->order($types)->limit($start,$rows)->select();
		}	
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	public function teasave(){
		$Mana_Num=I('Mana_Num');
		$arr['Mana_Name']=I('Mana_Name');
		$m=M('manager');
		$result=$m->where("Mana_Num='$Mana_Num'")->save($arr);
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function teasave1(){
		$Mana_Num=I('Mana_Num');
		$arr['Mana_Num']=I('Mana_Num');
		$arr['Mana_Name']=I('Mana_Name');
		$arr['Mana_PSD']=md5($Mana_Num);
		$arr['Mana_Type']='授课教师';
		$m=M('manager');
		$res=$m->where("Mana_Num='$Mana_Num'")->find();
		if($res){
			$this->ajaxReturn(2);
		}else{
			$result=$m->add($arr);
			if($result){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn($result);          
			}
		}
    }
	public function teadelete(){
		$Mana_Num=I('Mana_Num');
		$m=M('manager');
		$result=$m->Where("Mana_Num='$Mana_Num'")->delete();
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
	public function teaimport(){
		function trimall($str){
		$qian=array(" ","　","\t","\n","\r");
		return str_replace($qian, '', $str);   
		}
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 0 ;// 设置附件上传大小
		$upload->exts = array('xls');// 设置附件上传类型
		$upload->rootPath = THINK_PATH; // 设置附件上传根目录
		$upload->autoSub = false;
		$upload->replace = true;
		$upload->savePath = '../Public/Upload/'; // 设置附件上传（子）目录
		$upload->saveName = "22";
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功
			$m=M('manager');
			Vendor('PHPExcel'); 
			$objPHPExcel = new \PHPExcel();
            $file_name= "Public/Upload/22.xls";
            $objReader = new \PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($file_name);
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
          	for($i=2;$i<=$highestRow;$i++){
               	$arr['Mana_Num'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();   
				//$arr['Mana_Num']= trimall($arr['Mana_Num'] );
				$arr['Mana_Name'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
				$arr['Mana_Type']='授课教师';
				$arr['Mana_PSD']=md5($arr['Mana_Num']);
				$num=$arr['Mana_Num'];
				$res=$m->where("Mana_Num='$num'")->find();
				if($res){
					$m->where("Mana_Num='$num'")->save($arr);
				}else{
					$m->add($arr);
				}			
            }
			$this->success('导入成功');
			
		}				
    }
	public function manager(){
		$this->display();
    }
	 
	public function getmanamessage(){
		$page=I('page');	
		$rows=I('rows');
		$types=I('types');
		$searchs=I('searchs');
		$m=M('manager');
		$start=($page-1)*$rows;
		if($searchs==""){
			$row=$m->where("Mana_Type='学生管理员'")->count();
			$result=$m->where("Mana_Type='学生管理员'")->order($types)->limit($start,$rows)->select();	
		}else{
			$arr["$types"]=array('like',array('%'.$searchs.'%'));
			$arr["Mana_Type"]='学生管理员'	;		
			$row=$m->where($arr)->count();
			$result=$m->where($arr)->order($types)->limit($start,$rows)->select();
		}	
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	public function manasave1(){
		$Mana_Num=I('Mana_Num');
		$arr['Mana_Num']=I('Mana_Num');
		$arr['Mana_Name']=I('Mana_Name');
		$arr['Mana_PSD']=md5($Mana_Num);
		$arr['Mana_Type']='学生管理员';
		$m=M('manager');
		$res=$m->where("Mana_Num='$Mana_Num'")->find();
		if($res){
			$this->ajaxReturn(2);
		}else{
			$result=$m->add($arr);
			if($result){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn($result);          
			}
		}
    }
	public function manaimport(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 0 ;// 设置附件上传大小
		$upload->exts = array('xls');// 设置附件上传类型
		$upload->rootPath = THINK_PATH; // 设置附件上传根目录
		$upload->autoSub = false;
		$upload->replace = true;
		$upload->savePath = '../Public/Upload/'; // 设置附件上传（子）目录
		$upload->saveName = "22";
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功
			$m=M('manager');
			Vendor('PHPExcel'); 
			$objPHPExcel = new \PHPExcel();
            $file_name= "Public/Upload/22.xls";
            $objReader = new \PHPExcel_Reader_Excel5();
            $objPHPExcel = $objReader->load($file_name);
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
          	for($i=2;$i<=$highestRow;$i++){
               	$arr['Mana_Num'] = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();          
				$arr['Mana_Name'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
				$arr['Mana_Type']='学生管理员';
				$arr['Mana_PSD']=md5($arr['Mana_Num']);
				$num=$arr['Mana_Num'];
				$res=$m->where("Mana_Num='$num'")->find();
				if($res){
					$m->where("Mana_Num='$num'")->save($arr);
				}else{
					$m->add($arr);
				}			
            }
			$this->success('导入成功');
			
		}				
    }
	public function verify(){
		$this->display();
    }public function studuty(){
		$this->display();
    }
	public function upload(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 0 ;// 设置附件上传大小
		$upload->rootPath = THINK_PATH; // 设置附件上传根目录
		$upload->autoSub = false;
		$upload->replace = true;
		$upload->exts = array('jpg');//
		$upload->savePath = '../Public/Upload/'; // 设置附件上传（子）目录
		$upload->saveName = "course";
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功
			
			$this->redirect('verify',array('info'=>1));
		}		
    }
	public function upload1(){
		$upload = new \Think\Upload();// 实例化上传类
		$upload->maxSize = 0 ;// 设置附件上传大小
		$upload->rootPath = THINK_PATH; // 设置附件上传根目录
		$upload->autoSub = false;
		$upload->replace = true;
		$upload->exts = array('jpg');//
		$upload->savePath = '../Public/Upload/'; // 设置附件上传（子）目录
		$upload->saveName = "studuty";
		// 上传文件
		$info = $upload->upload();
		if(!$info) {// 上传错误提示错误信息
			$this->error($upload->getError());
		}else{// 上传成功	
			$this->redirect('verify',array('info'=>1));
		}		
    }
	public function worklog(){
		$this->display();
    }
	public function getworklog(){
		$page=I('page');	
		$rows=I('rows');
		$m=M('sturecord');
		$start=($page-1)*$rows;
		$result=$m->order('Stre_Time DESC')->limit("$start,$rows")->select();
		for($i=0;$i<count($result);$i++){
			if($result[$i]['Stre_IsNew']==0){
				$result[$i]['Stre_IsNew']="未读";
			}else{
				$result[$i]['Stre_IsNew']="已读";
			}
		}
		$row=$m->count();				
		$data['total']=$row;
		$data['rows']=$result;
		echo json_encode($data);
    }
	public function refresh(){
		$id=I('id');
		$arr['Stre_IsNew']=1;
		$m=M('sturecord');
		$result=$m->where("Stre_Id='$id'")->save($arr);
        if($result){
            $this->ajaxReturn(1);
        }else{
           	$this->ajaxReturn($result);          
		}
    }
}