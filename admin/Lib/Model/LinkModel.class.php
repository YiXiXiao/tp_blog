<?php
	class LinkModel extends Model {
		//实际表名
		protected $trueTableName='wq_link';

		protected $_auto=array(
			array('date','getCTime','1','callback')
		);
		//获取友链创建时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}
		//查找一条友链信息
		public function getOneLink($id){
			return $this->where("id=$id")->find();
		}
		
		
		
	}
?>