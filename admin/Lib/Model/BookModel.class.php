<?php
	class BookModel extends Model {
		//实际表名
		protected $trueTableName='wq_book';

		protected $_auto=array(
			array('date','getCTime','1','callback')
		);
		//获取栏目新增时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}	
		//自动验证
		protected $_validate=array(	
			array('content','require','请填写留言内容！'),
		);	
		
		//查找一条留言信息
		public function getOneBook($id){
			return $this->where("id=$id")->find();
		}
		//屏蔽留言
		public function separateOneBook($id){
			return $this->execute("update $this->trueTableName set is_show=0 where id=$id");
		}
		//更改回复状态
		public function changeAnswerState($id){
			return $this->execute("update $this->trueTableName set is_answer=1 where id=$id");
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>