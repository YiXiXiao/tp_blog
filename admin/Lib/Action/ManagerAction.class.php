<?php 
	class ManagerAction extends CommonAction {
		protected $page='';
		
		//显示所有的管理员
		public function index(){
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$adminList=$this->getPageAdminList();
			//处理管理员等级的显示问题
			$level=new Model('level');
			$levelList=$level->select();
			$levelArr=array();
			foreach($levelList as $value){
				$levelArr[$value['level']]=$value['name'];
			}
			foreach($adminList as $key=>$value){
				$adminList[$key]['level']=$levelArr[$value['level']];
			}			
			
			$this->assign('adminList',$adminList);
			
			//显示分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('admin');				
		}
		//分页处理
		private function getPageAdminList($pagesize=15){
			
			$admin=new AdminModel();
			$adminSum=$admin->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($adminSum,$pagesize);
			
			return $admin->order('id asc')->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//新增管理员显示页面
		public function addShow(){
			
			$this->checkLogin();
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			//从等级表中获取管理员的级别
			$level=new Model('level');
			$list=$level->select();
			$this->assign('list',$list);
			
			//获取所有的顶级栏目
			$nav=new NavModel();
			$main_nav=$nav->where("reid=0 and attr=1")->select();
			$this->assign('main_nav',$main_nav);
				
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('admin_add');		
		}
		//新增管理员处理操作
		public function add(){
			
			$this->checkLogin();
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$admin=new AdminModel();
			
			if(!$admin->create()){
				$this->error($admin->getError());
			}	
			
			//查看是否已经存在该管理员
			if(is_array($admin->getOneUserByName($admin->username))){
				$this->error('该管理员已经存在,请重新输入管理员名称!');
			}
			//md5加密处理
			$admin->password=md5($admin->password);
			
			//处理用户权限字符串
			$admin->permission=implode(',',$_POST['permission']);
			
			if($admin->add()){
				$this->success('管理员添加成功!');
			}else{
				$this->error('管理员添加失败,请联系管理员!');
			}
		}		
		//显示修改界面
		public function show(){
			
			$this->checkLogin();
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			//从等级表中获取管理员的级别
			$level=new Model('level');
			$list=$level->select();
			$this->assign('list',$list);
						
			//查找管理员信息
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneAdmin($id);
			
			if(empty($oneAdmin)){
				$this->error('找不到这个管理员信息!');
			}
			
			$this->assign('oneAdmin',$oneAdmin);
			
			//管理员属性处理
			$adminPermissionArr=explode(',',$oneAdmin['permission']);
			$this->assign('adminPermissionArr',$adminPermissionArr);
			
			//获取所有的顶级栏目
			$nav=new NavModel();
			$main_nav=$nav->where("reid=0 and attr=1")->select();
			$this->assign('main_nav',$main_nav);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('admin_edit');
		}
		//修改处理操作
		public function modify(){
			
			$this->checkLogin();
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			//修改前的检测
			$admin=new AdminModel();
			$id=$_POST['id']+0;
			
			$oneAdmin=$admin->where("id=$id")->find();
			
			if(empty($oneAdmin)){
				$this->error('找不到该管理员信息!');
			}
			
			//管理员修改处理
			$admin->create();

			//判断用户是否修改了密码
			if(empty($admin->password)){
				$admin->password=$oneAdmin['password'];
			}else{
				$admin->password=md5($admin->password);
			}
			
			//处理用户权限字符串
			$admin->permission=implode(',',$_POST['permission']);
			
			if($admin->save()){
				$this->success('管理员信息修改成功!');
			}else{
				$this->error('管理员信息修改失败,请联系管理员!');
			}				
		}		
			
		//删除管理员
		public function delete(){
			
			$this->checkLogin();
			
			//检测是否是超级管理员
			if(!$this->isSuperAdmin()){
				$this->error('权限不足!');
			}
			
			$id=$_GET['id']+0;
			
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneAdmin($id);
			
			if(!empty($oneAdmin)){
				if($admin->where("id=$id")->delete()){
					$this->success('管理员删除成功!');
				}else{
					$this->error('管理员删除失败,请联系管理员!');
				}
			}else{
				$this->error('找不到该管理员信息!');
			}			
		}		
		
		//个人资料
		public function PersonInfo(){
			
			$this->checkLogin();
			
			$username=$_SESSION['admin_username'];
			
			//处理管理员等级
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			$oneAdminLevel=$oneAdmin['level'];
			
			$this->assign('oneAdmin',$oneAdmin);
			
			//等级处理
			$level=new Model('level');
			$oneLevel=$level->where("level=$oneAdminLevel")->find();
			
			$this->assign('oneLevel',$oneLevel);
			
			$this->assign('username',$username);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('person');
		}
		
		//修改个人密码
		public function pass(){
			$this->checkLogin();			
			$username=$_SESSION['admin_username'];
			
			if(isset($_POST['dopost']) && $_POST['dopost']=='update'){
				$password=htmlspecialchars($_POST['password']);
				$repassword=htmlspecialchars($_POST['repassword']);
				
				if(empty($password)){
					$this->error('密码不能留空!');
					exit;
				}
				if($password!=$repassword){
					$this->error('两次输入不一致!');
					exit;
				}
				$password=md5($password);
				
				$admin=new AdminModel();
				
				if($admin->execute("update wq_admin set password='$password' where username='$username'")){
					$this->success('修改成功!');
				}else{
					$this->error('修改失败!');
				}
				exit;
			}
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('pass');
		}
		
		//修改用户名
		public function modifyName(){
			$this->checkLogin();			
			$username=$_SESSION['admin_username'];
			
			if(isset($_POST['dopost']) && $_POST['dopost']=='update'){
				$username=htmlspecialchars($_POST['username']);
	
				if(empty($username)){
					$this->error('用户名不能留空!');
					exit;
				}
				
				$admin=new AdminModel();
				
				$oneAdmin=$admin->getOneUserByName($username);
				
				if(!empty($oneAdmin)){
					$this->error('该用户名已经存在!');
					exit;
				}
				
				if($admin->execute("update wq_admin set username='$username' where username='".$_SESSION['admin_username']."'")){
					$this->success('修改成功!');
				}else{
					$this->error('修改失败!');
				}
				exit;
			}
			
			$this->assign('Public',APP_PUBLIC_PATH);
			$this->assign('username',$username);
			
			$this->display('name');
		}
	}
?>