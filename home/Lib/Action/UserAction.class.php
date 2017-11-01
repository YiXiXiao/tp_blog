<?php
	class UserAction extends CommonAction {
		//会员中心页面
		public function index(){
			$user_id=$_SESSION['user_id'];
			$user=new UserModel();
			$oneUser=$user->getOneUserById($user_id);
			
			if(!is_array($oneUser)){
				$this->redirect('/User/login');
			}
			
			$this->header();
			$this->footer();
			
			//处理用户性别的显示
			if($oneUser['sex']=='0'){
				$oneUser['sex']='<input type="radio" checked="checked" name="sex" value="0"/>&nbsp;男　&nbsp;<input type="radio" name="sex" value="1"/>&nbsp;女';
			}else{
				$oneUser['sex']='<input type="radio" name="sex" value="0"/>&nbsp;男　&nbsp;<input checked="checked" type="radio" name="sex" value="1"/>&nbsp;女';
			}
			
			$this->assign('oneUser',$oneUser);
			
			$this->display('User:index');
			
		}
		
		//会员信息修改操作
		public function modify(){
			$this->checkLogin();
			
			$user_id=$_SESSION['user_id'];
			$member=new UserModel();
			
			$user_name=$member->where("id=$user_id")->getField('username');
			
			if($user_name!=$_POST['username']){
				$this->error('用户名禁止修改!');
				exit;
			}
			
			
			//会员修改处理
			if(!$member->create()){
				$this->error($member->getError());
			}
			
			
			if(empty($member->password)){
				$member->password=$oneUser['password'];
			}else{
				$member->password=md5($oneUser->password);
			}
						
			if($member->where("id=$user_id")->save()){
				$this->success('信息修改成功!');
			}else{
				$this->error('信息修改失败,请联系管理员!');
			}	
		}
		
		//注册页面以及注册处理
		public function register(){
			
			//判断是否登录状态
			if(isset($_SESSION['user_id']) && $_SESSION['user_id']>0){
				echo "<script type='text/javascript'>alert('你已经登录!');</script>";
				$this->redirect(__URL__.'/index');
			}
			
			if($_POST['dopost']=='insert'){
				
				$username=$_POST['username'];
				$password=md5($_POST['password']);
				$repassword=$_POST['repassword'];
				$email=$_POST['email'];
				$mobile=$_POST['mobile'];
				$date=date("Y-m-d H:i:s");
				
				$model=new Model();
				$sql="insert into wq_user (username,password,email,mobile,date) values ('$username','$password','$email','$mobile','$date')";
				
				if(!$model->execute($sql)){
					echo "<script type='text/javascript'>alert('注册失败!');history.back();</script>";
				}else{
					echo "<script type='text/javascript'>alert('注册成功!');</script>";
					$lastId=$model->getLastInsID();
					
					$_SESSION['user_name']=$username;
					$_SESSION['user_id']=$lastId;
					$this->redirect(__URL__.'/index');
				}
				
				exit;
			}
			
			$this->header();
			$this->footer();

			$this->display('User:register');
		}
		
		//登录页面
		public function login(){

			$this->header();
			$this->footer();
			
			$this->display('User:login');
		}
		
		//登录处理
		public function loginAct(){
			header("content-type:text/html;charset=utf-8");
			
			if(isset($_POST['dopost'])){
				$user=new Model('user');
			
				$username=$_POST['username'];
				$password=$_POST['password'];
				
				$imgcode=$_POST['imgcode'];
				
				if(empty($username)){
					echo "<script type='text/javascript'>alert('用户名不能为空!');history.back();</script>";
					exit;
				}
				if(empty($password)){
					echo "<script type='text/javascript'>alert('密码不能为空!');history.back();</script>";
					exit;
				}
				if(empty($imgcode)){
					echo "<script type='text/javascript'>alert('验证码不能为空!');history.back();</script>";
					exit;
				}
			
				if(md5($imgcode)!=$_SESSION['verify']){
					$this->error('验证码输入错误');
				}
				
				$oneUser=$user->where("username='$username'")->find();
				
				if(empty($oneUser)){
					echo "<script type='text/javascript'>alert('该用户不存在!');history.back();</script>";
					exit;
				}
				
				if($oneUser['password']!=md5($password)){
					echo "<script type='text/javascript'>alert('用户名或密码错误!');history.back();</script>";
					exit;
				}		
				//登录成功,写入session
				session_start();
				
				$_SESSION['user_name']=$username;
				$_SESSION['user_id']=$oneUser['id'];
				
				if($_COOKIE['username']){
					$cart=new CartModel();
					
					echo "update wq_cart set uid=".$_SESSION['user_id']." where username=".$_COOKIE['username'];
					exit;
					
					$cart->execute("update wq_cart set uid=".$_SESSION['user_id']." where username=".$_COOKIE['username']);
				}
				
				echo "<script type='text/javascript'>alert('登陆成功!');</script>";
				$this->redirect(__URL__.'/index');
			}
		}
		//退出操作
		public function logout(){
			header("content-type:text/html;charset=utf-8");
			
			unset($_SESSION['user_name']);
			unset($_SESSION['user_id']);
			
			echo "<script type='text/javascript'>alert('您已经成功退出登录!');</script>";
			$this->redirect('/Index/index');
		}
		
		//验证码
		public function imgcode(){
			import("ORG.Util.Image");		
			Image::buildImageVerify(4,1,'png',50,25);
		}

		//发布任务界面以及发布处理
		public function addA(){
			
			
			$this->header();
			$this->footer();
			
			//获取所有栏目显示家谱树
			$nav=new NavModel();
			$navList=$nav->getAllNavByModel(1);//选取普通文章的栏目
			
			$navList=$nav->getNavTree($navList);
			$this->assign('navList',$navList);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('User:addA');
		}
		
		//修改密码
		public function pass(){
			if($_POST['dopost']=='update'){
				$password=trim($_POST['password']);
				$repassword=trim($_POST['repassword']);
				
				if(mb_strlen($password,'utf-8')<6){
					$this->error('密码不能少于6位!');
					exit;
				}
				if($password!=$repassword){
					$this->error('两次输入的密码不一致!');
					exit;
				}
				
				if($_SESSION['verify']!= md5($_POST['imgcode'])) {
					$this->error('验证码错误!');
					exit;
				}
				
				$user=new UserModel();
				$password=md5($password);
				
				if(!$user->execute("update wq_user set password='$password' where id=".$_SESSION['user_id'])){
					$this->error('密码修改失败!');
					exit;
				}
				
				$this->success('密码修改成功!');
				exit;
			}
			
			$this->header();
			$this->footer();
			
			$this->display("User:pass");
		}
		
	}
?>