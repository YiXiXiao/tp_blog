<?php 
	class AdminModel extends Model{
		protected $_auto=array(
			array('date','getCTime','1','callback'),
			array('lastdate','getCTime','1','callback')
		);
		//获取管理员创建时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}	
		//根据管理员名称查找一条管理员信息 
		public function getOneUserByName($username){
			return $this->where("username='$username'")->find();
		}
		//根据id查找一条管理员信息
		public function getOneAdmin($id){
			return $this->where("id=$id")->find();
		}
		//管理员登陆更新相关信息
		public function updateAdminInfo($id){
			$data['id']=$id;
			$data['lastdate']=date('Y-m-d H:i:s');
			$data['lastip']=$_SERVER['REMOTE_ADDR'];
			$this->save($data);
		}
		
		//获取用户的权限数组
		public function getFormatUser($oneAdmin){
			return explode(',',$oneAdmin['permission']);
		}
	}
?>