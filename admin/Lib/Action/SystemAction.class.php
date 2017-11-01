<?php
	class SystemAction extends CommonAction {
		//显示网站配置信息
		public function index(){
			
			//权限以及登陆验证
			$this->checkPermission(999);
			
			load("extend");
			
			$system=new Model('system');
			$oneSystem=$system->find();
			
			if(!is_array($oneSystem)){
				$this->error('找不到网站配置信息');
			}
			
			$this->assign('system',$oneSystem);
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display();
		}
		//修改网站配置信息
		public function modify(){
			
			//权限以及登陆验证
			$this->checkPermission(999);
			
			$system=new Model('system');
			$data=array();
			
			$data['webname']=$_POST['webname'];
			$data['keywords']=$_POST['keywords'];
			$data['description']=$_POST['description'];
			
			$data['seo_description']=$_POST['seo_description'];
			
			$data['beian']=$_POST['beian'];
			$data['tel']=$_POST['tel'];
			$data['email']=$_POST['email'];
			
			$data['gsdz']=$_POST['gsdz'];
			$data['cfrx']=$_POST['cfrx'];
			$data['gsln']=$_POST['gsln'];
			$data['gsyj']=$_POST['gsyj'];
			
			$data['video']=stripslashes($_POST['video']);
			
			if($system->where("id=1")->save($data)){
				$this->success('网站配置信息修好成功');
			}else{
				$this->error('网站配置信息修改失败,请联系管理员');		
			}
		}
	}
?>