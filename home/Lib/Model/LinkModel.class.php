<?php
	class LinkModel extends Model {
		//实际表名
		protected $trueTableName='wq_link';		
		
		//查找一条友链信息
		public function getOneLink($id){
			return $this->where("id=$id")->find();
		}
		//查找指定数量的友情链接
		public function getLink($sum){
			return $this->query("select * from $this->trueTableName where state=1 order by sort desc limit 0,$sum");
		}
	}
?>