<?php 
	class VoteAction extends CommonAction {
		protected $page='';
		
		//显示所有的投票主题
		public function index(){
			$this->checkLogin();
			
			$voteList=$this->getPageVoteList();
			foreach($voteList as $key=>$value){
				if($value['state']==0){
					$voteList[$key]['state']="<span style='color:red;'>否</span>";
				}else{
					$voteList[$key]['state']="<span style='color:green;'>是</span>";
				}
			}
			$this->assign('voteList',$voteList);
			
			//显示分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('vote');				
		}
		//分页处理
		public function getPageVoteList($pagesize=5){
			
			$vote=new VoteModel();
			$voteSum=$vote->where("reid=0")->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($voteSum,$pagesize);
			
			return $vote->order('date desc')->where("reid=0")->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//新增投票主题显示页面
		public function addShow(){
			
			$this->checkLogin();
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('vote_add');	
		}
		//新增投票主题处理操作
		public function add(){
			
			$this->checkLogin();
			
			$vote=new VoteModel();
			
			$vote->create();
			if($vote->add()){
				$this->success('投票主题新增成功!');
			}else{
				$this->error('投票主题新增失败,请联系管理员!');
			}
		}
		//显示修改界面
		public function show(){
			
			$this->checkLogin();
	
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找投票信息
			$vote=new VoteModel();
			$oneVote=$vote->getOneVote($id);
			
			if(empty($oneVote)){
				$this->error('找不到这条投票信息!');
			}
			
			$this->assign('oneVote',$oneVote);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('vote_edit');
		}
		//修改处理操作
		public function modify(){
			
			$this->checkLogin();
			
			//修改前的检测
			$vote=new VoteModel();
			$id=$_POST['id']+0;
			
			$oneVote=$vote->where("id=$id")->find();
			if(empty($oneVote)){
				$this->error('找不到该条投票主题!');
			}
			
			//修改处理
			$vote->create();
						
			if($vote->save()){
				$this->success('投票主题修改成功!');
			}else{
				$this->error('投票主题修改失败,请联系管理员!');
			}				
		}	
		//删除主题
		public function delete(){
			
			$this->checkLogin();
			
			$id=$_GET['id']+0;
			
			$vote=new VoteModel();
			$oneVote=$vote->getOneVote($id);
			
			if(!empty($oneVote)){
				if($vote->where("id=$id")->delete()){
					$this->success('投票主题删除成功!');
				}else{
					$this->error('投票主题删除失败,请联系管理员!');
				}
			}else{
				$this->error('找不到该投票主题!');
			}			
		}	
		//查看投票主题的投票项目
		public function detail(){
			$this->checkLogin();
			
			$id=$_GET['id']+0;
			
			$vote=new VoteModel();
			$oneVote=$vote->getOneVote($id);
			
			if(!is_array($oneVote)){
				$this->error('找不到投票主题信息');
			}	
			$this->assign('oneVote',$oneVote);	
			
			//查找投票主题的投票项目
			$itemList=$vote->where("reid=".$oneVote['id'])->select();
			
			$this->assign('itemList',$itemList);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('vote_item');			
		} 
		//增加投票主题的子项目显示界面
		public function addItemShow(){
			
			$this->checkLogin();
			
			$id=$_GET['id']+0;
			
			$vote=new VoteModel();
			$oneVote=$vote->getOneVote($id);
			
			if(!is_array($oneVote)){
				$this->error('找不到投票主题信息');
			}	
			$this->assign('oneVote',$oneVote);	

			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('vote_item_add');				
		}
		//新增投票项目
		public function addItem(){
			
			$this->checkLogin();
			
			$id=$_POST['reid']+0;
			
			$vote=new VoteModel();
			$oneVote=$vote->getOneVote($id);
			
			if(!is_array($oneVote)){
				$this->error('找不到投票主题信息');
			}	
			
			//新增处理
			$vote->create();
			$vote->reid=$id;
			
			if($vote->add()){
				$this->success('投票项目新增成功!');
			}else{
				$this->error('投票项目新增失败,请联系管理员!');
			}						
		}
		//显示项目修改界面
		public function showItem(){
			$this->checkLogin();
			
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找项目信息
			$vote=new VoteModel();
			$oneVote=$vote->getOneVote($id);
			
			if(empty($oneVote)){
				$this->error('找不到这条项目信息!');
			}
			
			$this->assign('oneVote',$oneVote);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('vote_item_edit');			
		}		
		//项目修改处理
		public function modifyItem(){
			
			$this->checkLogin();
			
			//修改前的检测
			$vote=new VoteModel();
			$id=$_POST['id']+0;
			
			$oneVote=$vote->where("id=$id")->find();
			if(empty($oneVote)){
				$this->error('找不到该条投票项目!');
			}
			
			//修改处理
			$vote->create();
						
			if($vote->save()){
				$this->success('投票项目修改成功!');
			}else{
				$this->error('投票项目修改失败,请联系管理员!');
			}			
		}
		//删除项目
		public function deleteItem(){
			
			$this->checkLogin();
			
			$id=$_GET['id']+0;
			
			$vote=new VoteModel();
			$oneVote=$vote->getOneVote($id);
			
			if(!empty($oneVote)){
				if($vote->where("id=$id")->delete()){
					$this->success('投票项目删除成功!');
				}else{
					$this->error('投票项目删除失败,请联系管理员!');
				}
			}else{
				$this->error('找不到该投票项目!');
			}		
		}
	}
?>