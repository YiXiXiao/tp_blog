<?php
	class CommonAction extends Action {
		protected $permission='';
		
		//判断管理员有没有登陆
		public function checkLogin(){
			header("Content-type:text/html;charset=utf-8");
			$username=$_SESSION['admin_username'];
			
			if(empty($username)||!isset($username)){
				echo "<script type='text/javascript'>alert('请先登录!');</script>";
				$this->redirect('/Index/index');
				exit;
			}else{
				return $username;
			}
		}
		//管理员等级检测,看是否具有相应的权限
		public function checkPermission($current_permission){
			header("Content-type:text/html;charset=utf-8");
			$name=$this->checkLogin();
			
			$user=new AdminModel();
			$oneAdmin=$user->getOneUserByName($name);
			
			if(empty($oneAdmin)){
				$this->error('系统发生错误,请联系管理员');
			}
			
			//权限检测,如果是超级管理员不检测,否则检测是否有足够的权限
			$level=$oneAdmin['level'];
			
			if($level!='1'){
				$permissionArr=explode(',',$oneAdmin['permission']);
				
				if(!in_array($current_permission,$permissionArr)){
					$this->error('您的权限不足,不能对此进行操作');
				}
			}
		}
		
		//检测是否是超级管理员
		public function isSuperAdmin(){
			$this->checkLogin();
			
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($_SESSION['admin_username']);
			
			return $oneAdmin['level']=='1' ? true:false;
		}
	}
?>