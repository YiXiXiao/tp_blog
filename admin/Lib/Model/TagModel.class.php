<?php
	class TagModel extends Model {
		//实际表名
		protected $trueTableName='wq_tag';
		
		//根据tagname查找一条信息
		public function getOneTag($tagname){
			return $this->where("tagname='$tagname'")->find();
		}
	}
?>