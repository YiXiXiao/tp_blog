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
			array('username','','用户名已经存在',0,'unique',1),
			array('username','2,20','用户名长度不正确!',2,'length'),
			array('password','require','请填写密码'),
			array('password','4,32','密码长度不正确!',2,'length'),
			array('address','require','请填写您的收货地址'),
			array('address','0,100','收货地址长度不正确!',2,'length'),
			array('email','email','邮箱格式不正确',2),
			array('mobile','number','手机号格式不正确',2)
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