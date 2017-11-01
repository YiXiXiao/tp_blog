<?php
	class IndexAction extends CommonAction{
		public function index(){
			
			$username=$_SESSION['admin_username'];
			
			if(!empty($username)){
				$this->redirect('/Admin/index');
			}
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display();
		}
		//处理管理员登录
		public function LoginAct(){
			header("Content-type:text/html;charset=utf-8");
			
			$username=$_POST['username'];
			$password=md5($_POST['password']);
			
			$admin=new Model();
			
			$list=$admin->query("select * from wq_admin where username='$username' limit 0,1");
			
			if(($list[0]['password'])==$password){
				$_SESSION['admin_username']=$username;		
				$adminModel=new AdminModel();
				$adminModel->updateAdminInfo($list[0]['id']);
				$this->redirect("/Admin/index");		
			}else{
				$this->error('用户名或密码错误!');
			}
		}
		//处理用户退出操作
		public function logout(){
			header("Content-type:text/html;charset=utf-8");
			
			unset($_SESSION['admin_username']);
			echo "<script type='text/javascript'>alert('成功退出登录!');</script>";
			$this->redirect("/Index/index");
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>