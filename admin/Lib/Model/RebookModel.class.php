<?php
	class RebookModel extends Model {
		//实际表名
		protected $trueTableName='wq_rebook';	

		protected $_auto=array(
			
		);
		//获取新增时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}	
		//自动验证
		protected $_validate=array(	
			array('content','require','请填写留言内容！'),
		);	
		
		//查找一条回复信息
		public function getOneRebook($id){
			return $this->where("id=$id")->find();
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>