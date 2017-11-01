<?php
	class ArticleModel extends Model {
		//实际表名
		protected $trueTableName='wq_article';
		
		protected $_auto=array(
			array('pubdate','getCTime','1','callback'),
			array('lastmod','getCTime','1','callback'),
			array('userip','getCIp','1','callback'),
			array('click','100'),
			array('goodpost','100'),
			array('badpost','100')
		);
		//自动验证
		protected $_validate=array(
			array('title','require','请填写文章标题!'),
			array('title','0,50','文章标题不得超过50个字符!',0,'length'),
			array('reid','ckNav','请选择文章所属栏目!',1,'callback'),
			array('keywords','0,20','关键词描述过长!',2,'length'),
			array('source','0,20','文章来源过长!',2,'length'),
			array('writer','0,20','作者姓名过长!',2,'length'),
			array('description','0,1000','文章简介过长!',2,'length'),
		);
		//回调函数检测栏目
		public function ckNav($reid){
			if(!is_numeric($reid)||$reid=='0'){
				return false;
			}
			return true;
		}
		//获取文章创建时间
		public function getCTime(){
			return date('Y-m-d H:i:s');
		}
		//获取客户端IP
		public function getCIp(){
			Load('extend');
			return get_client_ip();
		}
		public function getAllArticle(){
			return $this->order('id asc')->select();
		}
		//根据文章id获取一条文章信息
		public function getOneArticle($id){
			return $this->where("id=$id")->find();
		}
		//根据栏目id获取一定数量的文章列表
		public function getArticlesByNav($id,$sum){
			return $this->query("select * from $this->trueTableName where reid=$id order by pubdate desc limit 0,$sum");
		}
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>