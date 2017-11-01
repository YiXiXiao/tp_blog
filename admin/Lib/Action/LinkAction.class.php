<?php 
	class LinkAction extends CommonAction {
		protected $page='';
		protected $permission='5';
		
		//显示所有的友情链接
		public function index(){
			//权限以及登陆验证
			$this->checkPermission(994);
			load("extend");
			
			$linkList=$this->getPageLinkList();
			foreach($linkList as $key=>$value){
				if($value['state']==0){
					$linkList[$key]['state']="<span style='color:red;'>待审核</span>";
				}else{
					$linkList[$key]['state']="<span style='color:green;'>已审核</span>";
				}
			}
			$this->assign('linkList',$linkList);
			
			//显示分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('link');				
		}
		//分页处理
		private function getPageLinkList($pagesize=15){
			
			$link=new LinkModel();
			$linkSum=$link->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($linkSum,$pagesize);
			
			return $link->order('date desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//新增友链显示页面
		public function addShow(){
			
			$this->checkPermission(994);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('link_add');		
		}
		//新增友链处理操作
		public function add(){
			$this->checkPermission(994);
			
			$this->checkLogin();
			
			$link=new LinkModel();
			
			$link->create();
			
			//处理文件上传		
			if(!empty($_FILES['imgurl']['name'])){
				
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$link->imgurl=$info[0]['savename'];
				}
			}			
			
			if($link->add()){
				$this->success('友链新增成功!');
			}else{
				$this->error('友链新增失败,请联系管理员!');
			}
		}
		//显示修改界面
		public function show(){
			$this->checkPermission(994);
	
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找栏目信息
			$link=new LinkModel();
			$oneLink=$link->getOneLink($id);
			
			if(empty($oneLink)){
				$this->error('找不到这条友链信息!');
			}
			
			$this->assign('oneLink',$oneLink);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('link_edit');
		}
		//修改处理操作
		public function modify(){
			
			$this->checkPermission(994);
			
			//修改前的检测
			$link=new LinkModel();
			$id=$_POST['id']+0;
			
			$oneLink=$link->where("id=$id")->find();
			if(empty($oneLink)){
				$this->error('找不到该条友链!');
			}

			if(!empty($_FILES['imgurl']['name'])){
				
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$link->imgurl=$info[0]['savename'];
				}
			}else{
				$link->imgurl=$oneLink['imgurl'];
			}
			
			//栏目修改处理
			if(!$link->create()){
				$this->error($link->getError());
			}
						
			if($link->save()){
				$this->success('链接修改成功!');
			}else{
				$this->error('链接修改失败,请联系管理员!');
			}				
		}	
		//删除友链
		public function delete(){
			
			$this->checkPermission(994);
			
			$id=$_GET['id']+0;
			
			$link=new LinkModel();
			$oneLink=$link->getOneLink($id);
			
			if(!empty($oneLink)){
				if($link->where("id=$id")->delete()){
					$this->success('友链删除成功!');
				}else{
					$this->error('友链删除失败,请联系管理员!');
				}
			}else{
				$this->error('找不到该友链!');
			}			
		}
		
		//分类排序
		public function sortAct(){
			//权限以及登陆验证
			$this->checkPermission(994);
			
			$ids=$_POST['id'];
			$sorts=$_POST['sort'];
			
			$model=new Model();
			
			foreach($sorts as $key=>$value){
				$id=$ids[$key];
				$sort=$sorts[$key];
				
				$model->query("update wq_link set sort=$sort where id=$id");
			}
			
			$this->success('排序成功!');
		}
		
	}
?>