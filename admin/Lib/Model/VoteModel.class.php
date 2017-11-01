<?php
	class VoteModel extends Model {
		//实际表名
		protected $trueTableName='gb_vote';

		protected $_auto=array(
			array('date','getCTime','1','callback'),
			array('reid','0'),
			array('count','0')
		);
		//获取投票创建时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}
		//查找一条投票信息
		public function getOneVote($id){
			return $this->where("id=$id")->find();
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>