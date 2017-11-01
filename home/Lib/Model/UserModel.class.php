<?php
	class UserModel extends Model {
		//实际表名
		protected $trueTableName='wq_user';
		
		protected $_auto=array(
			array('date','getCTime','1','callback'),
			array('lasttime','getCTime','1','callback'),
			array('lastip','getCIp','1','callback')
		);
		//自动验证
		protected $_validate=array(	
			array('username','require','请填写用户名'),
			array('username','2,20','用户名长度不正确!',2,'length')
		);
		//获取文章创建时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}
		//获取客户端IP
		public function getCIp(){
			Load('extend');
			return get_client_ip();
		}	

		//根据用户名获取一条用户信息
		public function getOneUserByName($username){
			return $this->where("username='$username'")->find();
		}
		//根据用户id获取一条信息
		public function getOneUserById($id){
			return $this->where("id=$id")->find();
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>