<?php 
	class MessageAction extends CommonAction {
		protected $page='';
		
		//显示所有的用户留言
		public function index(){
			
			$this->checkPermission(997);
			
			load("extend");
			
			$bookList=$this->getPageBookList();
			foreach($bookList as $key=>$value){
				$url=__URL__;
				$id=$value['id'];
				if($value['is_show']==0){
					$bookList[$key]['is_show']="<span style='color:red;'>待审核</span>";
				}else{
					$bookList[$key]['is_show']="<span style='color:green;'>已审核</span>"."　<a href='$url/separate/id/$id'>屏蔽</a>";
				}
				if($value['is_answer']==0){
					
					$bookList[$key]['is_answer']="<span style='color:red;'>未回复</span>"."　<a href='$url/answer/id/$id'>回复</a>";
				}else{
					$bookList[$key]['is_answer']="<span style='color:green;'>已回复</span>";
				}
			}
			$this->assign('bookList',$bookList);
			
			//显示分页样式
			$this->assign('page',$this->page->show());
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('message');			
		}
		//分页处理
		private function getPageBookList($pagesize=5){
			
			$book=new BookModel();
			$bookSum=$book->count();
			
			import("ORG.Util.Page");
			$this->page=new Page($bookSum,$pagesize);
			
			return $book->order('date desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();			
		}
		//屏蔽留言
		public function separate(){
			
			$this->checkPermission(997);
			
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找留言信息
			$book=new BookModel();
			$oneBook=$book->getOneBook($id);
			
			if(empty($oneBook)){
				$this->error('找不到这条留言信息!');
			}
			if($book->separateOneBook($id)){
				$this->success('留言屏蔽成功');
			}else{
				$this->error('留言屏蔽失败,请联系管理员');
			}	
		}
		//显示回复留言界面
		public function answer(){
			
			$this->checkPermission(997);
			
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找留言信息
			$book=new BookModel();
			$oneBook=$book->getOneBook($id);
			
			if(empty($oneBook)){
				$this->error('找不到这条留言信息!');
			}
			//载入回复留言界面
			$this->assign('oneBook',$oneBook);
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('message_add');						
		}
		
		public function modify(){
			//修改前的检测
			$guest=new BookModel();
			$id=$_POST['id']+0;
			
			$oneGuest=$guest->where("id=$id")->find();
			if(empty($oneGuest)){
				$this->error('找不到该条留言!');
			}
			
			$guest->create();
						
			if($guest->save()){
				$this->success('修改成功!');
			}else{
				$this->error('修改失败!');
			}
		}
		
		//回复留言处理
		public function answerAction (){
			
			$this->checkPermission(997);
			
			$id=$_POST['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找留言信息
			$book=new BookModel();
			$oneBook=$book->getOneBook($id);

			if(empty($oneBook)){
				$this->error('找不到这条留言信息!');
			}
			//回复处理
			$rebook=new RebookModel();
			if(!$rebook->create()){
				$this->error($rebook->getError());
			}
			
			$rebook->reid=$id;
			$rebook->name=$_SESSION['admin_username'];
			$rebook->date=date("Y-m-d H:i:s");
			
			if($rebook->add()){
				$book=new BookModel();
				
				if($book->changeAnswerState($id)){
					$this->success('提交留言回复成功');
				}else{
					$this->error('提交留言回复失败,请联系管理员');
				}
			}else{
				$this->error('提交留言回复失败,请联系管理员');
			}
		}
		//显示留言详情
		public function show(){
			
			$this->checkPermission(997);
	
			$id=$_GET['id']+0;
			if(!is_numeric($id)){
				$this->error('参数传递有误!');
			}
			
			//查找留言信息
			$book=new BookModel();
			$oneBook=$book->getOneBook($id);
			
			if(empty($oneBook)){
				$this->error('找不到这条留言信息!');
			}
			
			$this->assign('oneBook',$oneBook);
			
			$this->assign('Public',APP_PUBLIC_PATH);
			
			$this->display('message_edit');
		}
		//删除留言信息
		public function delete(){
			
			$this->checkPermission(997);
			
			$id=$_GET['id']+0;
			
			$book=new BookModel();
			$oneBook=$book->getOneBook($id);
			
			if(!empty($oneBook)){
				if($book->where("id=$id")->delete()){
					$this->success('留言信息删除成功!');
				}else{
					$this->error('留言信息删除失败,请联系管理员!');
				}
			}else{
				$this->error('找不到该留言信息!');
			}			
		}	
		
	}
?>