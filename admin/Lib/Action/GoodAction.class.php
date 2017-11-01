<?php
	class GoodAction extends CommonAction {
		protected $page='';
		
		//显示商品列表
		public function index(){
			$this->checkLogin();
			
			//获取所有商品列表（分页）
			$goodList=$this->getPageGoodList();
		
			//将商品所属栏目的数字处理成栏目名称
			$nav=new navModel();
			$navList=$nav->getField("id,name");
			
			foreach($goodList as $key=>$value){
				$goodList[$key]['reid']=$navList[$value['reid']];
			}

			$this->assign('goodList',$goodList);
			
			
			//获取分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('good');			
		}
		//分页处理
		public function getPageGoodList($pagesize=5){
			
			$good=new GoodModel();
			$goodSum=$good->where()->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($goodSum,$pagesize);
			
			return $good->order('date desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//商品新增显示界面
		public function addShow(){
			$this->checkLogin();
			
			//获取所有栏目显示家谱树
			$nav=new NavModel();
			$navList=$nav->getAllNavByModel(2);//选取商品模型栏目
			
			$navList=$nav->getNavTree($navList);
			$this->assign('navList',$navList);
			
			$good=new GoodModel();
			$this->assign('sn',$good->makeGoodSn());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('good_add');			
		}
		//商品新增处理操作
		public function add(){
			$this->checkLogin();
			
			$good=new GoodModel();
			
			if(!$good->create()){
				$this->error($good->getError());
			}
			
			//处理文件上传		
			if(!empty($_FILES['thumb']['name'])){
				
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				
				$upload->thumb=true;	//进行缩略图处理
				$upload->thumbMaxWidth=$_POST['width'];
				$upload->thumbMaxHeight=$_POST['height'];
				
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$good->thumb='thumb_'.$info[0]['savename'];
				}
			}
			//处理自定义属性
			if(empty($good->flag)){
				$good->flag='';
			}else{
				$good->flag=implode(',',$good->flag);
			}
			
			if($good->add()){
				$this->success('商品新增成功!');
			}else{
				$this->error('商品新增失败,请联系管理员!');
			}
		}
		//修改商品显示界面
		public function show(){
			$this->checkLogin();
			
			$id=$_GET['id']+0;

			//获取所有栏目显示家谱树
			$nav=new NavModel();
			$navList=$nav->getAllNavByModel(2);
			$navList=$nav->getNavTree($navList);
			$this->assign('navList',$navList);
			
			//根据文章id查找一条商品信息
			$good=new GoodModel();
			$oneGood=$good->where("id=$id")->find();
			if(empty($oneGood)){
				$this->error('不存在这条商品');
			}else{
				
				$this->assign('oneGood',$oneGood);
			}
			
			//商品属性处理
			$goodFlagArr=explode(',',$oneGood['flag']);
			$this->assign('goodFlagArr',$goodFlagArr);

			list($width,$height)=getimagesize(__ROOT__.'Public/Uploads/'.$oneGood['thumb']);
			
			$this->assign('width',$width);
			$this->assign('height',$height);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('good_edit');
		}		
		//修改商品处理页面
		public function modify(){
			
			$this->checkLogin();
			
			//修改前的检测
			$good=new GoodModel();
			$id=$_POST['id']+0;
			
			$oneGood=$good->where("id=$id")->find();
			if(empty($oneGood)){
				$this->error('找不到该条商品信息!');
			}
			
			//修改处理
			$good->create();
			
			//是否上传缩略图,如果上传了,就处理,否则将该字段不变
			if(!empty($_FILES['thumb']['name'])){
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				
				$upload->thumb=true;	//进行缩略图处理
				$upload->thumbMaxWidth=$_POST['width'];
				$upload->thumbMaxHeight=$_POST['height'];
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$good->thumb='thumb_'.$info[0]['savename'];
				}		
			}else{
				$good->thumb=$oneGood['thumb'];
			}
			
			//处理自定义属性
			if(empty($good->flag)){
				$good->flag='';
			}else{
				$good->flag=implode(',',$good->flag);
			}
						
			if($good->save()){
				$this->success('商品信息修改成功!');
			}else{
				$this->error('商品信息修改失败,请联系管理员!');
			}			
		}		
		
		//删除一条商品信息
		public function delete(){
			
			$this->checkLogin();
			
			//删除前的检测
			$good=new GoodModel();
			$id=$_GET['id']+0;
			
			$oneGood=$good->where("id=$id")->find();
			if(empty($oneGood)){
				$this->error('找不到该条商品信息!');
			}
			
			if($good->where("id=$id")->delete()){
				$this->success('商品删除成功!');
			}else{
				$this->error('商品删除失败,请联系管理员!');
			}
		}

		
	}
?>