<?php 
	class ClientAction extends CommonAction {
		public $page='';
		
		//显示客户列表
		public function index (){
			$clientList=$this->getPageClientList();
			//客户性别处理
			foreach($clientList as $key=>$value){
				if($value['sex']=='0'){
					$clientList[$key]['sex']='男';
				}else{
					$clientList[$key]['sex']='女';
				}
			}
			$this->assign('clientList',$clientList);
			
			
			//获取分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('client');			
		}
		//获取客户（分页显示）
		private function getPageClientList($pagesize=5){
			$client=new UserModel();
			$clientSum=$client->where("kind=1")->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($clientSum,$pagesize);
			
			return $client->order('date desc')->where("kind=1")->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//显示新增客户界面
		public function addShow(){
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('client_add');				
		}
		//新增客户处理
		public function add(){
			$client=new UserModel();
			
			if(!$client->create()){
				$this->error($client->getError());
			}
			//标志这是内部添加用户
			$client->kind=1;
			
			if($client->add()){
				$this->success('客户新增成功');
			}else{
				$this->error('客户新增失败,请联系管理员');
			}
		}
		//显示客户修改界面
		public function show(){
			$id=$_GET['id']+0;
			
			$client=new UserModel();
			$oneClient=$client->getOneUserById($id);
			
			if(!is_array($oneClient)){
				$this->error('找不到该客户信息');
			}
			//处理用户性别的显示
			if($oneClient['sex']=='0'){
				$oneClient['sex']='<input type="radio" checked="checked" name="sex" value="0"/>&nbsp;男　&nbsp;<input type="radio" name="sex" value="1"/>&nbsp;女';
			}else{
				$oneClient['sex']='<input type="radio" name="sex" value="0"/>&nbsp;男　&nbsp;<input checked="checked" type="radio" name="sex" value="1"/>&nbsp;女';
			}
			$this->assign('oneClient',$oneClient);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('client_edit');
		}
		//处理修改操作
		public function modify(){
			//修改前的检测
			$client=new UserModel();
			$id=$_POST['id']+0;
			
			$oneClient=$client->where("id=$id")->find();
			if(empty($oneClient)){
				$this->error('找不到该客户信息!');
			}
			
			//客户修改处理
			$client->create();
						
			if($client->save()){
				$this->success('客户信息修改成功!');
			}else{
				$this->error('客户信息修改失败,请联系管理员!');
			}			
		}
		//删除一条客户信息
		public function delete(){
			//删除前的检测
			$client=new UserModel();
			$id=$_GET['id']+0;
			
			$oneClient=$client->where("id=$id")->find();
			if(empty($oneClient)){
				$this->error('找不到该客户信息!');
			}

			if($client->where("id=$id")->delete()){
				$this->success('客户信息删除成功');
			}else{
				$this->error('客户信息删除失败,请联系管理员');
			}
		}		
	}
?>