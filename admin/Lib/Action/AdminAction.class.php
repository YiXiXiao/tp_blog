<?php
	class AdminAction extends CommonAction {
		public function index(){
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->checkLogin();
			
			$this->display('admin');		
		}
		
		public function top(){
			
			$this->checkLogin();
			
			$username=$_SESSION['admin_username'];
			
			//处理管理员等级
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			$oneAdminLevel=$oneAdmin['level'];
			//等级处理
			$level=new Model('level');
			$oneLevel=$level->where("level=$oneAdminLevel")->find();
			
			$this->assign('oneLevel',$oneLevel);
			
			$this->assign('username',$username);
			$this->assign('user_id',$oneAdmin['id']);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			//时间处理
			$weekarray=array("日","一","二","三","四","五","六");

			$current_time=date('Y年m月d日').'&nbsp;&nbsp;星期'.$weekarray[date('w')];
			$this->assign('current_time',$current_time);
			
			$username=$_SESSION['admin_username'];
			
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			
			if($oneAdmin['level']=='1'){
				$this->assign('super_admin',1);
			}
			
			$this->display();
		}
		
		public function center(){
			
			$this->checkLogin();
			
			$username=$_SESSION['admin_username'];
			
			//处理管理员等级
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			$oneAdminLevel=$oneAdmin['level'];
			//等级处理
			$level=new Model('level');
			$oneLevel=$level->where("level=$oneAdminLevel")->find();
			
			$this->assign('oneLevel',$oneLevel);
			
			$this->assign('username',$username);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display();
		}
		
		public function middle(){
			
			$this->checkLogin();
			
			$username=$_SESSION['admin_username'];
			
			//处理管理员等级
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			$oneAdminLevel=$oneAdmin['level'];
			//等级处理
			$level=new Model('level');
			$oneLevel=$level->where("level=$oneAdminLevel")->find();
			
			$this->assign('oneLevel',$oneLevel);
			
			$this->assign('username',$username);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display();
		}
		
		public function left(){
			
			$this->checkLogin();
			
			$username=$_SESSION['admin_username'];
			
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			
			if($oneAdmin['level']=='1'){
				$this->assign('super_admin',1);
			}

			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display();
		}
		public function down(){
			
			$this->checkLogin();
			
			$username=$_SESSION['admin_username'];

			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display();
		}
		public function tab(){
			
			$this->checkLogin();
			
			$username=$_SESSION['admin_username'];
			
			//处理管理员等级
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			$oneAdminLevel=$oneAdmin['level'];
			//等级处理
			$level=new Model('level');
			$oneLevel=$level->where("level=$oneAdminLevel")->find();
			
			$this->assign('oneLevel',$oneLevel);
			
			$this->assign('username',$username);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display();
		}
		
		public function main(){
			
			$this->checkLogin();
			
			$username=$_SESSION['admin_username'];
			
			//处理管理员等级
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			$oneAdminLevel=$oneAdmin['level'];
			//等级处理
			$level=new Model('level');
			$oneLevel=$level->where("level=$oneAdminLevel")->find();
			
			$this->assign('oneLevel',$oneLevel);
			
			$this->assign('username',$username);
			
			$this->assign('oneAdmin',$oneAdmin);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display();
		}
		
	}
?>