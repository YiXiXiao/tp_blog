<?php
	class GuestAction extends CommonAction {
		
		//新增留言入库操作
		public function insert(){
			header("content-type:text/html;charset=utf-8");
			
			$data['theme']=$_POST['theme'];
			
			$data['content']=$_POST['content'];
			$data['address']=$_POST['address'];
			$data['name']=$_POST['name'];
			
			$data['phone']=$_POST['phone'];
			$data['email']=$_POST['email'];
			
			$data['date']=date('Y-m-d H:i:s');	
			
			$book=new Model('book');
			
			if(empty($data['name'])){
				$this->error('姓名不能为空!');
			}
			
			if(!empty($data['phone'])){
				if(!is_numeric($data['phone'])){
					$this->error('联系电话格式不正确!');
				}
			}
			
			if(empty($data['content'])){
				$this->error('留言内容不能为空!');
			}
			
			if($book->add($data)){
				$url=__APP__.'/List/index/id/6';
				echo "<script type='text/javascript'>alert('您的留言已成功提交,请等待管理员审核!');location.href='$url';</script>";
				exit;
			}else{
				echo "<script type='text/javascript'>alert('留言提交失败!');history.back();</script>";
				exit;
			}
		}
		
		//留言列表
		public function latest(){
			$this->header();
			$this->footer();
			
			//左侧产品分类
			$nav=new NavModel();
			$guest_leftNav=$nav->getSons(2);
			$this->assign('guest_leftNav',$guest_leftNav);
			
			//最新留言
			$model=new Model('book');
			$left_guest=$model->order("id desc")->where("is_show=1")->limit("0,7")->select();
			$this->assign('left_guest',$left_guest);
			
			$guestList=$this->getPageList(10);
			$this->assign('guestList',$guestList);
			
			//分页输出
			$this->assign('page',$this->page->show());
			
			$this->display('Public:latest');
		}
		
		private function getPageList($limit){
			import("ORG.Util.Page");
			if(!isset($limit)){
				$limit=15;
			}
			
			$guest=new Model('book');
			
			$guestSum=$guest->where("is_show=1")->count();
			
			$this->page=new Page($guestSum,$limit);		
			return $guest->where("is_show=1")->order('id desc')->limit($this->page->firstRow.','.$this->page->listRows)->select();	
		}
		
		//留言详情
		public function message(){
			$id=$_GET['id']+0;
			$guest=new Model('book');
			$oneGuest=$guest->where("id=$id and is_show=1")->find();
			
			if(empty($oneGuest)){
				$this->error('找不到该信息!');
			}

			//左侧产品分类
			$nav=new NavModel();
			$guest_leftNav=$nav->getSons(2);
			$this->assign('guest_leftNav',$guest_leftNav);
			
			//最新留言
			$model=new Model('book');
			$left_guest=$model->order("id desc")->where("is_show=1")->limit("0,7")->select();
			$this->assign('left_guest',$left_guest);
			
			$this->header();
			$this->footer();
			
			$this->assign('oneGuest',$oneGuest);
			
			//留言回复
			$reguest=new Model('rebook');
			$oneReGuest=$reguest->where("reid=$id")->find();
			
			$this->assign('oneReGuest',$oneReGuest);
			
			$this->display('Public:message');
		}
		
	}
?>