<?php
	class CashModel extends Model {
		//实际表名
		protected $trueTableName='gb_cash';

		protected $_auto=array(
			array('username','getUsername','1','callback')
		);
		//自动验证
		protected $_validate=array(	
			array('sn','','凭证号已经存在！',0,'unique')
		);
		//获取添加信息者姓名
		public function getUsername(){
			return 'admin';
		}
		
		//获取现金账目创建时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}
		//查找一条现金账目信息
		public function getOneCash($id){
			return $this->where("id=$id")->find();
		}
		//产生一条不重复的凭证号
		public function makeSn(){
			$sn='O'.mt_rand(10000,99999);
			return $this->snExists($sn)? $this->makeOrderSn():$sn;
		}		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>