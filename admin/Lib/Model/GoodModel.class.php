<?php
	class GoodModel extends Model {
		//实际表名
		protected $trueTableName='wq_good';
		
		protected $_auto=array(
			array('date','getCTime','1','callback'),
			array('click','100')
		);
		//自动验证
		protected $_validate=array(
			array('name','require','请填写商品名称!'),
			array('name','0,50','商品名称不得超过50个字符!',0,'length'),
			array('reid','ckNav','请选择商品所属分类!',1,'callback'),
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
		//生成一个唯一的不重复的商品sn
		public function makeGoodSn(){
			$sn='G-'.date('Y').mt_rand(1000,9999);
			return $this->snExists($sn)? $this->makeGoodSn():$sn;
		}
		//查看数据库中是否存在某条订单sn
		public function snExists($sn){
			return is_array($this->where("sn='$sn'")->find())? true:false;
		}		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	}
?>