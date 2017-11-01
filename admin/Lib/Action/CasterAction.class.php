<?php 
	class CasterAction extends CommonAction {
		protected $page='';
		
		//显示所有的幻灯
		public function index(){
			$this->checkPermission(996);
			load("extend");
			
			$casterList=$this->getPageCasterList();
			foreach($casterList as $key=>$value){
				if($value['state']==0){
					$casterList[$key]['state']="<span style='color:red;'>待审核</span>";
				}else{
					$casterList[$key]['state']="<span style='color:green;'>已审核</span>";
				}
			}
			$this->assign('casterList',$casterList);
			
			//显示分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('caster');				
		}
		//分页处理
		private function getPageCasterList($pagesize=15){
			
			$caster=new CasterModel();
			$casterSum=$caster->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($casterSum,$pagesize);
			
			return $caster->order('date desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//新增幻灯显示页面
		public function addShow(){
			$this->checkPermission(996);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('caster_add');		
		}
		//新增幻灯处理操作
		public function add(){
			$this->checkPermission(996);
			
			$caster=new CasterModel();
			
			$caster->create();
			
			//处理文件上传		
			if(!empty($_FILES['image']['name'])){
				
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$caster->url=$info[0]['savename'];
				}
			}
			
			if($caster->add()){
				$this->success('幻灯新增成功!');
			}else{
				$this->error('幻灯新增失败,请联系管理员!');
			}
		}
		//显示修改界面
		public function show(){
			$this->checkPermission(996);
	
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找幻灯信息
			$caster=new CasterModel();
			$oneCaster=$caster->getOneCaster($id);
			
			if(empty($oneCaster)){
				$this->error('找不到这条幻灯信息!');
			}
			
			$this->assign('oneCaster',$oneCaster);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('caster_edit');
		}
		//修改处理操作
		public function modify(){
			$this->checkPermission(996);
			
			//修改前的检测
			$caster=new CasterModel();
			$id=$_POST['id']+0;
			
			$oneCaster=$caster->where("id=$id")->find();
			if(empty($oneCaster)){
				$this->error('找不到该幻灯信息');
			}
			
			//幻灯修改处理
			$caster->create();
			
			//是否上传缩略图,如果上传了,就处理,
			if(!empty($_FILES['image']['name'])){
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/';
				$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$caster->url=$info[0]['savename'];
				}		
			}else{
				$caster->url=$oneCaster['url'];
			}
						
			if($caster->save()){
				$this->success('幻灯修改成功!');
			}else{
				$this->error('幻灯修改失败,请联系管理员!');
			}				
		}	
		//删除幻灯
		public function delete(){
			$this->checkPermission(996);
			
			$id=$_GET['id']+0;
			
			$caster=new CasterModel();
			$oneCaster=$caster->getOneCaster($id);
			
			if(!empty($oneCaster)){
				if($caster->where("id=$id")->delete()){
					$this->success('幻灯删除成功!');
				}else{
					$this->error('幻灯删除失败,请联系管理员!');
				}
			}else{
				$this->error('找不到该幻灯!');
			}			
		}	

	}
?>