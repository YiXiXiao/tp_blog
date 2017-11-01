<?php
	class ArticleAction extends CommonAction {
		protected $page='';
		protected $permission='2';
		
		//显示文档列表
		public function index(){
			
			//权限以及登陆验证
			$this->checkPermission(998);
			load("extend");
			
			//获取所有文章列表（分页）
			$articleList=$this->getPageArticleList();
			
			//将文章所属栏目的数字处理成栏目名称
			$nav=new navModel();
			$navList=$nav->getField("id,name");
			
			foreach($articleList as $key=>$value){
				$articleList[$key]['reid']=$navList[$value['reid']];
			}
			$this->assign('articleList',$articleList);
			
			
			//获取分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('article');			
		}
		//分页处理
		private function getPageArticleList($pagesize=20){
			
			$article=new ArticleModel();
			
			$sql="select count(*) as total from wq_article as a left join wq_nav as n on a.reid=n.id";
			$res=$article->query($sql);		
			$articleSum=$res[0]['total'];
			
			import("ORG.Util.Page");
			$this->page=new Page($articleSum,$pagesize);
			
			$sql="select a.* from wq_article as a left join wq_nav as n on a.reid=n.id order by id desc limit ".$this->page->firstRow.','.$this->page->listRows;
			return $article->query($sql);	
		}
		//新增文章显示页面
		public function addShow(){
			//权限以及登陆验证
			$this->checkPermission(991);
			
			//获取所有栏目显示家谱树
			$nav=new NavModel();
			$navList=$nav->getAllNavByModel(1);//选取普通文章的栏目
			
			$navList=$nav->getNavTree($navList);
			$this->assign('navList',$navList);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('article_add');
		}
		//新增文章处理页面
		public function add(){
			//权限检测
			$reid=$_POST['reid'];
			$nav=new NavModel();
			$oneNav=$nav->getOneNav($reid);
			
			$currentPermission='';
			if($oneNav['reid']!='0'){
				$allNav=$nav->getAllNav();
				$breadNav=$nav->getFamily($allNav,$reid);
				$breadNav=array_reverse($breadNav);
				$topNav=$breadNav[0];
				
				$currentPermission=$topNav['id'];
			}else{
				$currentPermission=$oneNav['id'];
			}

			$username=$this->checkLogin();
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			
			if($oneAdmin['level']!='1'){
				$permissionArr=$admin->getFormatUser($oneAdmin);
				
				if(!in_array($currentPermission,$permissionArr)){
					$this->error('权限不足,不能进行该操作!');
				}
			}
			
			$article=new ArticleModel();
			
			if(!$article->create()){
				$this->error($article->getError());
			}
			
			//处理文件上传		
			if(!empty($_FILES['thumb']['name'])){
				
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				
				$upload->thumb=false;	//进行缩略图处理
				$upload->thumbMaxWidth=$_POST['width'];
				$upload->thumbMaxHeight=$_POST['height'];
				
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$article->thumb=$info[0]['savename'];
				}
				
			}
			//处理自定义属性
			if(empty($article->flag)){
				$article->flag='';
			}else{
				$article->flag=implode(',',$article->flag);
			}
			
			//$article->body=stripslashes($article->body);
			
			//处理文档标签
			$keywords=explode(',',trim($_POST['keywords']));
			if(!empty($keywords)){
				$tag=new TagModel();
				foreach($keywords as $value){
					if(!$tag->getOneTag($value)){
						$data=array(
							'tagname'=>$value,
							'date'=>date('Y-m-d H:i:s')
						);					
						$tag->data($data)->add();
					}
				}
			}
			
			if($article->add()){
				$this->success('文章新增成功!');
			}else{
				$this->error('文章新增失败,请联系管理员!');
			}
			
		}
		//修改文章显示界面
		public function show(){
			
			$id=$_GET['id']+0;

			//获取所有栏目显示家谱树
			$nav=new NavModel();
			$navList=$nav->getAllNavByModel();
			$navList=$nav->getNavTree($navList);
			$this->assign('navList',$navList);
			
			//根据文章id查找一条文章信息
			$article=new ArticleModel();
			$oneArticle=$article->where("id=$id")->find();
			if(empty($oneArticle)){
				$this->error('不存在这条文章');
			}else{
				$this->assign('oneArticle',$oneArticle);
			}
			
			//权限检测
			$allNav=$nav->getAllNav();
			$oneNav=$nav->getOneNav($oneArticle['reid']);
			
			$breadNav=$nav->getFamily($allNav,$oneNav['id']);
			$breadNav=array_reverse($breadNav);
			
			$topNav=$breadNav['0'];
			
			$username=$this->checkLogin();
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			
			$permissionArr=$admin->getFormatUser($oneAdmin);
			
			if($oneAdmin['level']!='1'){
				if(!in_array($topNav['id'],$permissionArr)){
					$this->error('权限不足,不能进行该操作!');
				}
			}
			
			
			//文章属性处理
			$articleFlagArr=explode(',',$oneArticle['flag']);
			$this->assign('articleFlagArr',$articleFlagArr);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('article_edit');
		}
		
		//修改文章处理页面
		public function modify(){
			
			//修改前的检测
			$article=new ArticleModel();
			$id=$_POST['id']+0;
			
			$oneArticle=$article->where("id=$id")->find();
			if(empty($oneArticle)){
				$this->error('找不到该条文章!');
			}
			
			//权限检测
			$nav=new NavModel();
			$allNav=$nav->getAllNav();
			$oneNav=$nav->getOneNav($oneArticle['reid']);
			
			$breadNav=$nav->getFamily($allNav,$oneNav['id']);
			$breadNav=array_reverse($breadNav);
			
			$topNav=$breadNav['0'];
			
			$username=$this->checkLogin();
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			
			$permissionArr=$admin->getFormatUser($oneAdmin);
			
			if($oneAdmin['level']!='1'){
				if(!in_array($topNav['id'],$permissionArr)){
					$this->error('权限不足,不能进行该操作!');
				}
			}
			
			//权限检测
			$reid=$_POST['reid'];
			$nav=new NavModel();
			$oneNav=$nav->getOneNav($reid);
			
			$currentPermission='';
			if($oneNav['reid']!='0'){
				$allNav=$nav->getAllNav();
				$breadNav=$nav->getFamily($allNav,$reid);
				$breadNav=array_reverse($breadNav);
				$topNav=$breadNav[0];
				
				$currentPermission=$topNav['id'];
			}else{
				$currentPermission=$oneNav['id'];
			}

			$username=$this->checkLogin();
			$admin=new AdminModel();
			$oneAdmin=$admin->getOneUserByName($username);
			
			$permissionArr=$admin->getFormatUser($oneAdmin);
			
			if($oneAdmin['level']!='1'){
				if(!in_array($currentPermission,$permissionArr)){
					$this->error('权限不足,不能进行该操作!');
				}
			}
			
			//文章修改处理
			if(!$article->create()){
				$this->error($article->getError());
			};
			
			//是否上传缩略图,如果上传了,就处理,否则将该字段不变
			if(!empty($_FILES['thumb']['name'])){
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				
				$upload->thumb=false;
				$upload->thumbMaxWidth=$_POST['width'];
				$upload->thumbMaxHeight=$_POST['height'];
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$article->thumb=$info[0]['savename'];
				}		
			}else{
				$article->thumb=$oneArticle['thumb'];
			}
			
			//更新文档最后修改时间
			$article->lastmod=date("Y-m-d H:i:s");
			
			//处理自定义属性
			if(empty($article->flag)){
				$article->flag='';
			}else{
				$article->flag=implode(',',$article->flag);
			}

			//处理文档标签
			$keywords=explode(',',trim($_POST['keywords']));
			if(!empty($keywords)){
				$tag=new TagModel();
				foreach($keywords as $value){
					if(!$tag->getOneTag($value)){
						$data=array(
							'tagname'=>$value,
							'date'=>date('Y-m-d H:i:s')
						);					
						$tag->data($data)->add();
					}
				}
			}
			
			if($article->save()){
				$this->success('文章修改成功!');
			}else{
				$this->error('文章修改失败,请联系管理员!');
			}			
		}
		//删除文章处理
		public function delete(){
			$this->checkLogin();
			
			$id=$_GET['id']+0;
			
			$article=new ArticleModel();
			$oneArticle=$article->getOneArticle($id);
			if(!empty($oneArticle)){
				
				//权限检测
				$nav=new NavModel();
				$allNav=$nav->getAllNav();
				$oneNav=$nav->getOneNav($oneArticle['reid']);
				
				$breadNav=$nav->getFamily($allNav,$oneNav['id']);
				$breadNav=array_reverse($breadNav);
				
				$topNav=$breadNav['0'];
				
				$username=$this->checkLogin();
				$admin=new AdminModel();
				$oneAdmin=$admin->getOneUserByName($username);
				
				$permissionArr=$admin->getFormatUser($oneAdmin);
				
				if($oneAdmin['level']!='1'){
					if(!in_array($topNav['id'],$permissionArr)){
						$this->error('权限不足,不能进行该操作!');
					}
				}
			
				if($article->where("id=$id")->delete()){
					$this->success('文章删除成功!');
				}else{
					$this->error('文章删除失败,请联系管理员!');
				}
			}else{
				$this->error('找不到该文章!');
			}			
		}
	}
?>