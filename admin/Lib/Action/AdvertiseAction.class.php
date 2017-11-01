<?php 
	class AdvertiseAction extends CommonAction {
		protected $page='';
		
		//显示所有的广告
		public function index(){
			$this->checkPermission(995);
			load("extend");
			
			$adList=$this->getPageAdList();
			foreach($adList as $key=>$value){
				if($value['state']==0){
					$adList[$key]['state']="<span style='color:red;'>待审核</span>";
				}else{
					$adList[$key]['state']="<span style='color:green;'>已审核</span>";
				}
			}
			$this->assign('adList',$adList);
			
			//显示分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('ad');				
		}
		//分页处理
		private function getPageAdList($pagesize=15){
			
			$advertise=new AdvertiseModel();
			$advertiseSum=$advertise->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($advertiseSum,$pagesize);
			
			return $advertise->order('date desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//新增广告显示页面
		public function addShow(){
			$this->checkPermission(995);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('ad_add');		
		}
		//新增广告处理操作
		public function add(){
			$this->checkPermission(995);
			
			$advertise=new AdvertiseModel();
			
			$advertise->create();
			
			//处理文件上传		
			if(!empty($_FILES['url']['name'])){
				
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$advertise->url=$info[0]['savename'];
				}
			}
			
			if($advertise->add()){
				$this->success('广告新增成功!');
			}else{
				$this->error('广告新增失败,请联系管理员!');
			}
		}
		//显示修改界面
		public function show(){
			$this->checkPermission(995);
	
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找广告信息
			$advertise=new AdvertiseModel();
			$oneAd=$advertise->getOneAd($id);
			
			if(empty($oneAd)){
				$this->error('找不到这条广告信息!');
			}
			
			$this->assign('oneAd',$oneAd);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('ad_edit');
		}
		//修改处理操作
		public function modify(){
			$this->checkPermission(995);
			
			//修改前的检测
			$advertise=new AdvertiseModel();
			$id=$_POST['id']+0;
			
			$oneAd=$advertise->where("id=$id")->find();
			if(empty($oneAd)){
				$this->error('找不到该广告信息');
			}
			
			//广告修改处理
			$advertise->create();
			
			//是否上传缩略图,如果上传了,就处理,
			if(!empty($_FILES['url']['name'])){
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$advertise->url=$info[0]['savename'];
				}		
			}else{
				$advertise->url=$oneAd['url'];
			}
						
			if($advertise->save()){
				$this->success('广告修改成功!');
			}else{
				$this->error('广告修改失败,请联系管理员!');
			}				
		}	
		//删除广告
		public function delete(){
			$this->checkPermission(995);
			
			$id=$_GET['id']+0;
			
			$advertise=new AdvertiseModel();
			$oneAd=$advertise->getOneAd($id);
			
			if(!empty($oneAd)){
				if($advertise->where("id=$id")->delete()){
					$this->success('广告删除成功!');
				}else{
					$this->error('广告删除失败,请联系管理员!');
				}
			}else{
				$this->error('找不到该广告!');
			}			
		}
		
		
	}
?>