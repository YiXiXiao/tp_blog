<?php 
	class MemberAction extends CommonAction {
		public $page='';
		
		//显示会员列表
		public function index (){
			$this->checkLogin();
			
			$memberList=$this->getPageMemberList();
			//会员性别处理
			foreach($memberList as $key=>$value){
				if($value['sex']=='0'){
					$memberList[$key]['sex']='男';
				}else{
					$memberList[$key]['sex']='女';
				}
			}
			$this->assign('memberList',$memberList);
			
			
			//获取分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('member');			
		}
		//获取会员（分页显示）
		private function getPageMemberList($pagesize=15){
			$member=new UserModel();
			$memberSum=$member->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($memberSum,$pagesize);
			
			return $member->order('date desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//显示新增会员界面
		public function addShow(){
			
			$this->checkLogin();
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('member_add');				
		}
		//新增用户处理
		public function add(){
			
			$this->checkLogin();
			
			$member=new UserModel();
			
			if(!$member->create()){
				$this->error($member->getError());
			}
			//密码MD5加密处理
			$member->password=md5($member->password);
			
			//上传图像处理
			if(!empty($_FILES['face']['name'])){
				
				import("ORG.Net.UploadFile");
				$upload = new UploadFile();
				$upload->savePath ='./Public/Uploads/face/';
				$upload->thumb=true;	//进行缩略图处理
				$upload->thumbMaxWidth='80';
				$upload->thumbMaxHeight='80';
				//$upload->uploadReplace=true;
				
				if(!$upload->upload()) {
					$this->error($upload->getErrorMsg());		
				}else{
					$info =$upload->getUploadFileInfo();
					$member->face='thumb_'.$info[0]['savename'];
				}
			}			
			
			if($member->add()){
				$this->success('用户新增成功');
			}else{
				$this->error('用户新增失败,请联系管理员');
			}
		}
		//显示用户修改界面
		public function show(){
			
			$this->checkLogin();
			
			$id=$_GET['id']+0;
			
			$member=new UserModel();
			$oneMember=$member->getOneUserById($id);
			
			if(!is_array($oneMember)){
				$this->error('找不到该用户信息');
			}
			//处理用户性别的显示
			if($oneMember['sex']=='0'){
				$oneMember['sex']='<input type="radio" checked="checked" name="sex" value="0"/>&nbsp;男　&nbsp;<input type="radio" name="sex" value="1"/>&nbsp;女';
			}else{
				$oneMember['sex']='<input type="radio" name="sex" value="0"/>&nbsp;男　&nbsp;<input checked="checked" type="radio" name="sex" value="1"/>&nbsp;女';
			}
			$this->assign('oneMember',$oneMember);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('member_edit');
		}
		//处理修改操作
		public function modify(){
			
			$this->checkLogin();
			
			//修改前的检测
			$member=new UserModel();
			$id=$_POST['id']+0;
			
			$oneMember=$member->where("id=$id")->find();
			if(empty($oneMember)){
				$this->error('找不到该会员信息!');
			}
			
			//会员修改处理
			$member->create();
			
			if(empty($member->password)){
				$member->password=$oneMember['password'];
			}else{
				$member->password=md5($member->password);
			}
						
			if($member->save()){
				$this->success('会员信息修改成功!');
			}else{
				$this->error('会员信息修改失败,请联系管理员!');
			}			
		}
		//删除一条用户信息
		public function delete(){
			
			$this->checkLogin();
			
			//删除前的检测
			$member=new UserModel();
			$id=$_GET['id']+0;
			
			$oneMember=$member->where("id=$id")->find();
			if(empty($oneMember)){
				$this->error('找不到该会员信息!');
			}

			if($member->where("id=$id")->delete()){
				$this->success('会员信息删除成功');
			}else{
				$this->error('会员信息删除失败,请联系管理员');
			}
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>