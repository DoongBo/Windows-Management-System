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
			$this->redirect('Admin/Index/index');
		}        
    }
	public function logout(){
		session('name',null);
		$this->redirect('Admin/Index/index');
	}
}