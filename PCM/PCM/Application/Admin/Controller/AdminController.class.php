<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {
    public function index(){
		if(session('?name')){
			$this->assign('name',session('name'));
			$this->assign('type',session('type'));
			$this->display();
		}else{
			$this->error('非法登录，请通过正确渠道访问',U('Home/Index/index'));
		}        
    }
	public function logout(){
		session('adminname',null);
		$this->redirect('Home/Index/index');
	}
}
?>